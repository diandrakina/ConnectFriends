<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentUserID = Auth::user()->id;

        $searchTerm = $request->input('search');

        $sentRequestUserIDs = DB::table('friend_requests')
            ->where('sender_id', '=', $currentUserID)
            ->pluck('receiver_id');

        $friendUserIDs = DB::table('friends')
            ->where('user_id', '=', $currentUserID)
            ->pluck('friend_id');

        $dataUser = User::whereNotIn('id', $sentRequestUserIDs)
            ->whereNotIn('id', $friendUserIDs)
            ->where('id', '!=', $currentUserID)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        return view('home', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function update_paid(Request $request){
 
        $validatedData = $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
        ]);

        $paymentAmount = $validatedData['payment_amount'];
        $price = $validatedData['price'];
        $difference = $paymentAmount - $price;

        $user = Auth::user();

        if ($difference < 0) {

            return redirect()->back()->with('error', 'You are still underpaid $' . number_format(-$difference, 2));
        } elseif ($difference > 0) {

            return redirect()->route('handleOverpayment', [
                'amount' => $difference,
                'payment_amount' => $paymentAmount,
                'price' => $price
            ]);
        } else {
            $user->has_paid = true;
            $user->save();
            return redirect()->back()->with('success', 'Payment successful!');
        }
    }

    public function handleOverpayment(Request $request)
    {
        $amount = $request->input('amount');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');

        // Show a view or dialog to handle overpayment
        return view('overpayment', [
            'amount' => $amount,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    }

    public function processOverpayment(Request $request)
    {
        
        $action = $request->input('action');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');
        $user = Auth::user();
        $userId = $user->id;
        if ($action === 'accept') {
            // Add the overpaid amount to the user's wallet balance
            $amount = $request->input('amount');            
            $user->coins += $amount;
            $user->has_paid = true;
            $user->save();
            
            return redirect()->route('user.index')->with('success', 'The excess amount has been added to your wallet.');
        } else {

            return redirect()->route('pay')->with('error', 'Please enter the correct payment amount.');
        }
    }
}

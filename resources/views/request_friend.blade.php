@extends('widget.navbar')

@section('title', 'Request')
@section('activeRequest', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $fr)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($fr->profile) }}" alt="{{ $fr->name }}'s profile" class="card-img-top img-fluid"
                            style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $fr->name }}</h5>
                            <p class="card-text">{{ $fr->job }}</p>
                            <form method="POST" action="{{ route('friend.store') }}" class="mb-2">
                                @csrf
                                <input type="hidden" name="request_id" value="{{ $fr->request_id }}">
                                <input type="hidden" name="friend_id" value="{{ $fr->id }}">
                                <button type="submit" class="btn btn-primary w-100"
                                    style="background-color: green; border-color: green">Accept</button>
                            </form>
                            <form method="POST" action="{{ route('friend_request.destroy', $fr->request_id) }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger w-100">Decline</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

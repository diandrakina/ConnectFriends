@extends('widget.navbar')

@section('title', 'Friend Page')
@section('activeHome', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <div class="row">
            @foreach ($dataFriend as $df)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset($df->profile) }}" alt="{{ $df->name }}'s profile" class="card-img-top img-fluid"
                            style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $df->name }}</h5>
                            <p class="card-text">{{ $df->job }}</p>
                            <a href="{{ route('message.show', $df->id) }}" class="btn btn-primary mt-auto w-100"
                                style="background-color: #9A616D; border-color: #9A616D;">Message</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

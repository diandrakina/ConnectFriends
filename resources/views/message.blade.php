<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .chat-room {
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        .message {
            border-radius: 15px;
        }

        .chat-messages {
            overflow-y: auto;
            padding: 15px;
            height: 400px;
            border-bottom: 1px solid #ddd;
        }

        .input-group {
            margin-top: 10px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark "style="background-color: #9A616D">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('user.index') }}">Job Friend</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('activeHome')" href="{{ route('user.index') }}" style="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeRequest')" href="{{ route('friend_request.index') }}">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeFriend')" href="{{ route('friend.index') }}">Friends</a>
                    </li>
                </ul>
                @if (Auth::check())
                    <div class="d-flex align-items-center">
                        <span class="text-light me-3">Welcome, {{ Auth::user()->name }}!</span>
                        <form method="POST" action="{{ url('/logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5">
                <div class="card chat-room shadow-sm">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="chat-messages" id="chat-messages">
                            @foreach ($messages as $msg)
                                <div
                                    class="d-flex {{ $msg->sender_id === auth()->user()->id ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                                    <div class="message p-3 rounded-3 {{ $msg->sender_id === auth()->user()->id ? 'bg-primary text-white' : 'bg-light' }}"
                                        style="max-width: 75%;">
                                        <p class="mb-0">{{ $msg->message }}</p>
                                        @if ($msg->created_at)
                                            <p class="text-muted text-end small mb-0">
                                                {{ $msg->created_at->format('H:i') }}</p>
                                        @else
                                            <p class="text-muted text-end small mb-0">--</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('message.store') }}" id="message-form" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="new_message" class="form-control" placeholder="Enter your message"
                            required>
                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <button type="button" id="reply-btn" class="btn btn-warning mt-2 w-50 me-2">Aku Mau
                            Balasan</button>
                        <button type="button" class="btn btn-secondary mt-2 w-50" onclick="openZoomMeeting()"
                            style="background-color: #9A616D; border-color: #9A616D;">
                            <i class="fas fa-video"></i> Zoom Invitation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('reply-btn').addEventListener('click', function() {
            const chatMessages = document.getElementById('chat-messages');
            const replyMessage = document.createElement('div');
            replyMessage.className = 'd-flex justify-content-start mb-3';
            replyMessage.innerHTML = '<div class="message p-3 rounded-3 bg-light" style="max-width: 75%;">' +
                '<p class="mb-0">Thank you for your message! How can I assist you further?</p>' +
                '<p class="text-muted text-end small mb-0">--</p>' +
                '</div>';
            chatMessages.appendChild(replyMessage);
            chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
        });

        function showZoomNotification() {
            alert('You have been invited to a Zoom meeting!');
        }

        function openZoomMeeting() {
            const zoomMeetingUrl =
                'zoommtg://zoom.us/join?confno=1234567890&pwd=abcdef'; // Replace with your actual Zoom URL
            window.location.href = zoomMeetingUrl;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>

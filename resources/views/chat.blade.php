<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot ROT13</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e5ddd5;
        }
        .chat-container {
            max-width: 400px;
            margin: 50px auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .messages {
            max-height: 500px;
            overflow-y: auto;
            padding: 20px;
            border-bottom: 1px solid #ccc;
            background-color: #f8f9fa;
        }
        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 20px;
            max-width: 75%;
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .user {
            background-color: #dcf8c6;
            margin-left: auto;
            flex-direction: row-reverse;
        }
        .bot {
            background-color: #f1f0f0;
            margin-right: auto;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 10px;
        }
        .form-container {
            padding: 10px;
            background-color: #fff;
        }
        .form-control {
            border-radius: 20px;
            border: 1px solid #ced4da;
        }
        .btn {
            border-radius: 20px;
        }
        .encrypted-message {
            font-size: 0.9em;
            color: #555;
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container chat-container">
        <h2 class="text-center mb-4">Arina ROT13</h2>

        <div class="messages">
            @foreach ($messages as $message)
                <div class="message {{ $message->sender == 'user' ? 'user' : 'bot' }}" data-bs-toggle="collapse" data-bs-target="#encrypted-{{ $loop->index }}">
                    @if ($message->sender == 'user')
                        <img src="{{ $userProfilePicUrl }}" alt="User  Profile" class="profile-pic">
                    @else
                        <img src="{{ $botProfilePicUrl }}" alt="Bot Profile" class="profile-pic">
                    @endif
                    <div>
                        <strong>{{ ucfirst($message->sender) }}:</strong> {{ $message->message }}
                        <div id="encrypted-{{ $loop->index }}" class="collapse encrypted-message">
                            <strong>Encrypted:</strong> {{ \App\Http\Controllers\ChatController::encryptROT13($message->message) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-container">
            <form action="{{ route('send.message') }}" method="POST" class="d-flex">
                @csrf
                <input type="text" name="message" class="form-control me-2" placeholder="Tulis pesanmu..." required>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

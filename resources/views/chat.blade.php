<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot ROT13</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- Google Material Icons -->
</head>
<body>
    <div class="container chat-container">
        <div class="header">
            <h2 class="text-center">Arina ROT13 by Kelompok 2</h2>
        </div>

        <div class="messages">
            @foreach ($messages as $message)
                <div class="message {{ $message->sender == 'user' ? 'user' : 'bot' }}">
                    <div class="profile-container">
                        <div class="profile-name">
                            @if ($message->sender == 'user')
                                Kamu
                            @else
                                Arina
                            @endif
                        </div>
                        <img src="{{ $message->sender == 'user' ? $userProfilePicUrl : $botProfilePicUrl }}" alt="Foto Profil" class="profile-pic">
                    </div>
                    <div class="message-content">
                        {{ $message->message }}
                        <div id="encrypted-{{ $loop->index }}" class="collapse encrypted-message">
                            <strong>Terenkripsi:</strong> {{ \App\Http\Controllers\ChatController::encryptROT13($message->message) }}
                        </div>
                        <div class="message-footer">
                            <span class="material-icons toggle-encryption" data-bs-toggle="collapse" data-bs-target="#encrypted-{{ $loop->index }}">
                                visibility
                            </span>
                            @if ($message->sender == 'user')
                                <span class="material-icons">done_all</span> <!-- Ikon centang Telegram -->
                            @endif
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

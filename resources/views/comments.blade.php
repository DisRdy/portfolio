<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar - Portofolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar />

    <header>
        <h1>Komentar & Pesan</h1>
    </header>

    @include('partials.toast')

    <div class="container">
        <div>
            <div class="main-content" id="comments">
                <div class="comment-form-wrapper">
                    <!-- Form Komentar -->
                    <div class="comment-form-section">
                        <div class="comment-limit-info"
                            style="margin-bottom: 20px; padding: 10px; background: rgba(0,0,0,0.2); border-radius: 4px; text-align: center;">
                            <span style="color: var(--kof-gold);">Sisa Kuota Komentar Anda: <strong>{{ $remaining }} /
                                    {{ $maxAttempts }}</strong></span>
                        </div>
                        <h3>Tulis Komentar</h3>

                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <div>
                                <label for="name" class="form-group-label">Name</label>
                                <input type="text" id="name" name="name" required maxlength="255"
                                    placeholder="Masukkan nama Anda" class="form-input">
                                @error('name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div style="margin-bottom: 20px;">
                                <label for="comment" class="form-group-label">Komentar Anda</label>
                                <textarea id="comment" name="comment" required maxlength="1000" rows="5"
                                    placeholder="Bagikan pemikiran, saran, atau pertanyaan Anda..."
                                    class="form-textarea"></textarea>
                                <small class="form-help-text">Maksimal 1000 karakter</small>
                                @error('comment')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn">
                                Kirim Komentar
                            </button>
                        </form>
                    </div>

                    <!-- Daftar Komentar -->
                    <div style="margin-top: 30px;">
                        <h3 class="comment-list-title">Daftar Komentar ({{ $comments->count() }})</h3>

                        @if ($comments->count() > 0)
                            <div class="comment-list">
                                @foreach ($comments as $c)
                                    <div class="comment-item">
                                        <div class="comment-meta">
                                            <div>
                                                <h4>{{ $c->name }}</h4>
                                                <p class="comment-date">
                                                    {{ \Carbon\Carbon::parse($c->created_at)->translatedFormat('d F Y H:i') }}
                                                </p>
                                            </div>
                                            @if(auth()->check() && auth()->id() === $c->user_id)
                                                <span class="comment-author-badge">
                                                    👤 Anda
                                                </span>
                                            @endif
                                        </div>
                                        <p class="comment-text">{{ $c->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <p>Belum ada komentar. Jadilah yang pertama memberikan komentar!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Portofolio Saya. Semua hak dilindungi.</p>
    </footer>
</body>

</html>
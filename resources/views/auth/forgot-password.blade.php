<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Desa Kopo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #047857 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .forgot-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            color: white;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .forgot-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .forgot-header h2 {
            font-size: 1.8rem;
            color: white;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .forgot-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.9rem;
            color: rgba(255,255,255,0.9);
        }

        .input-group {
            position: relative;
        }

        .input-group > i:first-child {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.6);
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-family: inherit;
            font-size: 1rem;
            outline: none;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--accent);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .btn-forgot {
            background: var(--accent);
            color: white;
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
            transition: var(--transition);
            margin-top: 1rem;
        }

        .btn-forgot:hover {
            background: #fbbf24;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(245, 158, 11, 0.4);
        }

        .message-success {
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 0.85rem;
            color: #a7f3d0;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .message-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.4);
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 0.85rem;
            color: #fca5a5;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-link {
            text-align: center;
            margin-top: 2rem;
        }

        .back-link a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-link a:hover {
            color: white;
        }
    </style>
</head>
<body>

    <div class="forgot-card">
        <div class="forgot-header">
            <div style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 1rem;">
                <img src="{{ asset('images/logos/logokabserang.png') }}" alt="Logo Desa Kopo" style="height: 60px;">
                <div style="font-size: 2.5rem; color: var(--accent);"><i class="fa-solid fa-key"></i></div>
            </div>
            <h2>Lupa Password</h2>
            <p>Masukkan alamat email Anda untuk menerima link reset password.</p>
        </div>

        @if (session('status'))
            <div class="message-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>Link reset password telah dikirim ke email Anda. Silakan periksa inbox atau folder spam Anda.</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="message-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required autofocus value="{{ old('email') }}">
                </div>
            </div>

            <button type="submit" class="btn-forgot">Kirim Link Reset</button>
        </form>

        <div class="back-link">
            <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left" style="margin-right: 5px;"></i> Kembali ke Halaman Login</a>
        </div>
    </div>

</body>
</html>

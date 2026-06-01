<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Login - Desa Kopo</title>
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

        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            color: white;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-header .logo-icon {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
        }

        .login-header h2 {
            font-size: 1.8rem;
            color: white;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: rgba(255,255,255,0.7);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
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

        .input-group i {
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

        .error-message {
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

        .btn-login {
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

        .btn-login:hover {
            background: #fbbf24;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(245, 158, 11, 0.4);
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

    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon"><i class="fa-solid fa-users-gear"></i></div>
            <h2>Portal Desa Kopo</h2>
            <p>Silakan masuk menggunakan akun Penduduk atau Admin.</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ url('/admin/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="nama@desakoposerang.id" required autofocus value="{{ old('email') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login">Masuk Sekarang</button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: rgba(255,255,255,0.7);">
            Belum punya akun? <a href="{{ route('register') }}" style="color: var(--accent); font-weight: 700; text-decoration: none; transition: var(--transition);" onmouseover="this.style.color='#fbbf24'" onmouseout="this.style.color='var(--accent)'">Daftar di sini</a>
        </div>

        <div class="back-link" style="margin-top: 1.5rem;">
            <a href="{{ route('home') }}"><i class="fa-solid fa-arrow-left" style="margin-right: 5px;"></i> Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>

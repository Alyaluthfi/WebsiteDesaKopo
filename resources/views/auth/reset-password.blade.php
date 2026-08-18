<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password - Desa Kopo</title>
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

        .reset-card {
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

        .reset-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .reset-header h2 {
            font-size: 1.8rem;
            color: white;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .reset-header p {
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

        .btn-reset {
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

        .btn-reset:hover {
            background: #fbbf24;
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(245, 158, 11, 0.4);
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
    </style>
</head>
<body>

    <div class="reset-card">
        <div class="reset-header">
            <div style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 1rem;">
                <img src="{{ asset('images/logos/logokabserang.png') }}" alt="Logo Desa Kopo" style="height: 60px;">
                <div style="font-size: 2.5rem; color: var(--accent);"><i class="fa-solid fa-lock-open"></i></div>
            </div>
            <h2>Reset Password</h2>
            <p>Masukkan kata sandi baru untuk akun Anda.</p>
        </div>

        @if ($errors->any())
            <div class="message-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ $email ?? old('email') }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Min. 6 karakter" required style="padding-right: 45px;">
                    <i class="fa-solid fa-eye-slash" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: rgba(255,255,255,0.6); font-size: 1.1rem; z-index: 10;"></i>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru" required style="padding-right: 45px;">
                    <i class="fa-solid fa-eye-slash" id="togglePasswordConfirmation" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: rgba(255,255,255,0.6); font-size: 1.1rem; z-index: 10;"></i>
                </div>
            </div>

            <button type="submit" class="btn-reset">Atur Ulang Password</button>
        </form>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirm = document.querySelector('#password_confirmation');
        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>

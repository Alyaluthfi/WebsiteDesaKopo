<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Kopo - Cerdas, Maju, & Sejahtera</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logos/logokabserang.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=2">
    <style>
        .success-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: white;
            border-left: 5px solid #10b981;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 9999;
            max-width: 400px;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .toast-icon {
            font-size: 1.8rem;
            color: #10b981;
        }

        .toast-content h4 {
            margin: 0;
            color: #022c22;
            font-size: 1rem;
            font-weight: 700;
        }

        .toast-content p {
            margin: 2px 0 0 0;
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #cbd5e1;
            cursor: pointer;
            padding: 0;
            margin-left: 10px;
        }

        .toast-close:hover {
            color: #1e293b;
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="success-toast" id="successToast">
            <i class="fa-solid fa-circle-check toast-icon"></i>
            <div class="toast-content">
                <h4>Berhasil!</h4>
                <p>{{ session('success') }}</p>
            </div>
            <button class="toast-close" onclick="document.getElementById('successToast').style.display='none'">&times;</button>
        </div>
        <script>
            setTimeout(function() {
                var toast = document.getElementById('successToast');
                if (toast) toast.style.display = 'none';
            }, 6000);
        </script>
    @endif

    @include('partials.navbar')
    
    @include('partials.hero')

    @include('partials.struktur')

    @include('partials.pelayanan')

    @include('partials.keuangan')

    @include('partials.bumdes')

    @include('partials.berita')

    @include('partials.dokumen')

    @include('partials.footer')

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sistem Pengelola Kehadiran SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <title>Error Presensi - Hadirin</title>
  <style>
    .btn-animate {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    .btn-animate:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .btn-animate:active {
      transform: translateY(0);
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Poppins', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: {
              600: '#2563eb',
              700: '#1d4ed8',
              800: '#1e40af',
              900: '#1e3a8a',
            },
            dark: {
              700: '#374151',
              800: '#1f2937',
              900: '#111827',
            }
          },
          boxShadow: {
            'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
          },
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col font-sans">

  <header class="bg-gradient-to-r from-dark-800 to-dark-900 shadow-sm sticky top-0 z-10">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4 sm:px-6 lg:px-8 flex justify-between items-center">
      <div class="flex items-center space-x-3 sm:space-x-4">
        <a href="{{ route('scan.show') }}" class="text-gray-300 hover:text-white transition-colors" title="Kembali ke Scanner">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <h1 class="text-lg sm:text-xl font-bold text-white">
          Gagal Presensi
        </h1>
      </div>
    </div>
  </header>

  <main class="flex-grow max-w-2xl mx-auto p-4 w-full">
    <div class="bg-white rounded-xl shadow-card p-6 text-center">
      <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
        <div class="flex flex-col items-center">
          <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-3"></i>
          <h2 class="text-xl font-semibold text-red-800 mb-2">{{ $message }}</h2>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('scan.show') }}" 
           class="btn-animate px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
          <i class="fas fa-qrcode mr-2"></i> Coba Lagi
        </a>
        <a href="{{ url('/') }}" 
           class="btn-animate px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
          <i class="fas fa-home mr-2"></i> Beranda
        </a>
      </div>
    </div>
  </main>
</body>
</html>
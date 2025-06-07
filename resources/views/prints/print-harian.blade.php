<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Sistem Pengelola Kehadiran SMKN 1 Kota Bengkulu">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Cetak Kehadiran Harian - Hadirin</title>
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .btn-animate {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform-origin: center;
      position: relative;
      overflow: hidden;
    }
    
    .btn-animate:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .btn-animate:active {
      transform: translateY(0);
    }

    .btn-animate::after {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 0;
      border-radius: 100%;
      transform: scale(1, 1) translate(-50%, -50%);
      transform-origin: 50% 50%;
    }
    
    .btn-animate:focus:not(:active)::after {
      animation: ripple 0.6s ease-out;
    }
    
    @keyframes ripple {
      0% {
        transform: scale(0, 0);
        opacity: 0.5;
      }
      100% {
        transform: scale(20, 20);
        opacity: 0;
      }
    }
    
    .fade-in {
      animation: fadeIn 0.5s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    }

    @media (max-width: 767px) {
      .mobile-hidden {
        display: none;
      }
      .action-buttons {
        display: flex;
        flex-direction: row;
        gap: 0.5rem;
        justify-content: flex-end;
      }
      .action-btn {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
      }
      .action-text {
        display: none;
      }
    }
    @media (min-width: 768px) {
      .action-btn {
        padding: 0.4rem 0.75rem;
        border-radius: 0.375rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.375rem;
      }
    }
    
    .status-badge {
      padding: 4px 8px;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: capitalize;
    }

    @media print {
      body { 
        padding: 0; 
        margin: 0; 
        font-size: 12pt;
        background: white;
      }
      .no-print { 
        display: none !important; 
      }
      header { 
        display: none; 
      }
      .print-header { 
        display: block !important; 
      }
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
      }
      .hover\:bg-gray-50 { 
        background-color: transparent !important; 
      }
      .summary-grid {
        page-break-inside: avoid;
      }
    }
    
    @page {
      size: A4 portrait;
      margin: 15mm;
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Poppins', 'system-ui', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: {
              50: '#eff6ff',
              100: '#dbeafe',
              200: '#bfdbfe',
              300: '#93c5fd',
              400: '#60a5fa',
              500: '#3b82f6',
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
            'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
          },
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

  <!-- Header -->
  <div class="w-full rounded-b-3xl bg-gradient-to-br from-dark-800 to-dark-900 p-6 relative overflow-hidden">
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-center">
        <div class="text-white font-bold text-lg md:text-xl">HADIRIN</div>
        <div class="flex space-x-2">
          <div class="w-4 h-4 bg-yellow-400 rounded-full"></div>
          <div class="w-4 h-4 bg-red-400 rounded-full"></div>
        </div>
      </div>

      <div class="flex items-center mt-6">
        <a href="{{ url('/') }}" class="text-gray-300 hover:text-white transition-colors mr-4">
          <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-bold text-white">Rekap Kehadiran Harian</h1>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-6xl mx-auto fade-in">

    <!-- Header untuk cetakan -->
    <div class="print-header hidden bg-white py-4 border-b-2 border-primary-600">
      <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="h-16 mx-auto mb-2">
        <h1 class="text-xl font-bold">SMK NEGERI 1 KOTA BENGKULU</h1>
        <p class="text-sm">Jl. Jati No 41, Kelurahan Padang Jati<br>Kecamatan Ratu Samban, Kota Bengkulu 38222</p>
        <h2 class="text-lg font-semibold mt-4">REKAPITULASI KEHADIRAN HARIAN GURU</h2>
        <p class="text-md font-medium text-primary-600">{{ $date }}</p>
      </div>
    </div>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('print.harian') }}" class="no-print mb-6 p-4 rounded-lg shadow-card">
      <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
        <div class="w-full sm:w-auto">
          <label class="block mb-1 text-sm font-medium text-gray-700">Pilih Tanggal:</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-calendar text-gray-400"></i>
            </div>
            <input type="date" name="date" value="{{ $rawDate }}" 
                   class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500">
          </div>
        </div>
        <button type="submit" class="btn-animate bg-primary-600 hover:bg-primary-700 text-white text-sm px-4 py-2 rounded">
          <i class="fas fa-search mr-1"></i> Tampilkan
        </button>
      </div>
    </form>

    <!-- Report Card -->
    <div class="bg-white rounded-lg shadow-card overflow-hidden">
      <!-- Report Header -->
      <div class="px-6 py-4 border-b bg-gray-50 no-print">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div class="text-center md:text-left">
            <h2 class="text-xl font-semibold text-gray-800">REKAP KEHADIRAN HARIAN GURU</h2>
            <p class="text-gray-600">SMKN 1 Kota Bengkulu</p>
            <p class="text-md font-medium text-primary-600">{{ $date }}</p>
          </div>
          <div class="action-buttons">
            <button onclick="window.print()" class="btn-animate action-btn bg-primary-600 text-white hover:bg-primary-700">
              <i class="fas fa-print"></i>
              <span class="action-text">Cetak</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Report Content -->
      <div class="p-4 sm:p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">No</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama Guru</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Keterangan</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Waktu</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @forelse($attendances as $index => $attendance)
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-center text-sm text-gray-700">{{ $index + 1 }}</td>
                <td class="px-4 py-3">
                  <div class="text-sm font-medium text-gray-900">{{ $attendance->user->name }}</div>
                </td>
                <td class="px-4 py-3">
                  <span class="status-badge 
                    {{ $attendance->status === 'hadir' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $attendance->status === 'izin' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $attendance->status === 'sakit' ? 'bg-purple-100 text-purple-800' : '' }}
                    {{ $attendance->status === 'tidak hadir' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ ucfirst($attendance->status) }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">
                  {{ $attendance->keterangan ?? '-' }}
                </td>
                <td class="px-4 py-3 text-sm text-gray-700">
                  {{ $attendance->scan_time->format('H:i:s') }}
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="px-4 py-4 text-sm text-gray-500 text-center">
                  Tidak ada data kehadiran pada tanggal ini
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Summary -->
        @if($attendances->count() > 0)
        <div class="mt-6 p-4 bg-gray-50 rounded-lg summary-grid">
          <div class="mb-3 text-sm text-gray-700">
            <strong>Total Data:</strong> {{ $attendances->count() }} guru
          </div>
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="bg-green-100 text-green-800 p-3 rounded text-center">
              <div class="text-sm font-semibold">Hadir</div>
              <div class="text-xl font-bold">{{ $statusCounts['hadir'] ?? 0 }}</div>
            </div>
            <div class="bg-blue-100 text-blue-800 p-3 rounded text-center">
              <div class="text-sm font-semibold">Izin</div>
              <div class="text-xl font-bold">{{ $statusCounts['izin'] ?? 0 }}</div>
            </div>
            <div class="bg-purple-100 text-purple-800 p-3 rounded text-center">
              <div class="text-sm font-semibold">Sakit</div>
              <div class="text-xl font-bold">{{ $statusCounts['sakit'] ?? 0 }}</div>
            </div>
            <div class="bg-red-100 text-red-800 p-3 rounded text-center">
              <div class="text-sm font-semibold">Tidak Hadir</div>
              <div class="text-xl font-bold">{{ $statusCounts['tidak_hadir'] ?? 0 }}</div>
            </div>
          </div>
          <div class="mt-4 text-xs text-gray-500 text-right">
            Dicetak pada: {{ now()->format('d-m-Y H:i:s') }} oleh {{ auth()->user()->name ?? 'Admin' }}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>

  <script>
    // Initialize feather icons
    feather.replace();
    
    // Menyiapkan halaman sebelum dicetak
    function beforePrint() {
      document.querySelectorAll('.hover\\:bg-gray-50').forEach(el => {
        el.classList.remove('hover:bg-gray-50');
      });
      document.querySelector('.print-header').classList.remove('hidden');
    }
    
    // Mengembalikan setelah cetakan
    function afterPrint() {
      document.querySelectorAll('.hover\\:bg-gray-50').forEach(el => {
        el.classList.add('hover:bg-gray-50');
      });
      document.querySelector('.print-header').classList.add('hidden');
    }
    
    window.addEventListener('beforeprint', beforePrint);
    window.addEventListener('afterprint', afterPrint);
  </script>
</body>
</html>
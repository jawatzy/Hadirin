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
  <script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
  <title>Cetak Kartu Anggota - Hadirin</title>
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

    .floating-btn {
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                  0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .floating-btn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
                  0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .empty-state {
      background-color: #f9fafb;
      border: 1px dashed #e5e7eb;
    }
    
    /* Print specific styles */
    @media print {
      body { 
        background-color: white;
        padding: 0;
        margin: 0;
      }
      .navigation, .no-print { 
        display: none !important; 
      }
      .id-card {
        page-break-inside: avoid;
        box-shadow: none;
        margin: 0;
        border: 1px solid #e5e7eb !important;
      }
      .hover\:shadow-lg {
        box-shadow: none !important;
      }
      @page {
        size: auto;
        margin: 5mm;
      }
    }
    
    /* Card specific styles */
    .id-card-gradient {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }
    
    .school-logo {
      filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }
    
    /* Animation for cards */
    .id-card {
      animation: fadeIn 0.3s ease-out forwards;
      opacity: 0;
    }
    
    .id-card:nth-child(1) { animation-delay: 0.1s; }
    .id-card:nth-child(2) { animation-delay: 0.2s; }
    .id-card:nth-child(3) { animation-delay: 0.3s; }
    .id-card:nth-child(4) { animation-delay: 0.4s; }
    .id-card:nth-child(5) { animation-delay: 0.5s; }
    .id-card:nth-child(n+6) { animation-delay: 0.6s; }
    
    /* Improved card styling */
    .id-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border: 1px solid rgba(229, 231, 235, 0.8);
    }
    
    .id-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Gradient header */
    .card-header-gradient {
      background: linear-gradient(135deg, #3b82f6 0%, #10b981 100%);
      height: 8px;
    }
    
    /* QR code styling */
    .qr-container {
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 8px;
      background: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    /* Print optimization */
    .print-optimized {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
      .mobile-hidden {
        display: none;
      }
      .header-buttons {
        flex-wrap: wrap;
        gap: 8px;
      }
      .header-buttons button {
        flex: 1 1 120px;
        font-size: 14px;
        padding: 8px 12px;
      }
      .id-card {
        margin-left: auto;
        margin-right: auto;
        max-width: 320px;
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
    
    @media (max-width: 400px) {
      .user-details {
        font-size: 14px;
      }
      .qr-container {
        width: 80px;
        height: 80px;
      }
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
    <div class="relative z-10 max-w-7xl mx-auto">
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
        <h1 class="text-xl font-bold text-white">Cetak Kartu Anggota</h1>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-7xl mx-auto fade-in">

    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-card p-6 mb-6 print:hidden">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <h2 class="text-xl font-semibold text-gray-800">Kartu Anggota</h2>
          <p class="text-gray-600">Dicetak pada: <span id="print-date">{{ date('d F Y H:i') }}</span></p>
          <p class="text-sm text-gray-500 mt-1">Total: <span id="total-members">{{ count($users) }}</span> anggota</p>
        </div>
        <div class="flex flex-wrap gap-2 header-buttons">
          <button onclick="window.print()" class="btn-animate bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center gap-2">
            <i class="fas fa-print"></i>
            <span class="hidden sm:inline">Cetak</span> Semua
          </button>
          <button onclick="printSelected()" class="btn-animate bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center gap-2">
            <i class="fas fa-print"></i>
            <span class="hidden sm:inline">Cetak</span> Terpilih
          </button>
          <button onclick="selectAllCards()" class="btn-animate bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            Pilih Semua
          </button>
        </div>
      </div>
    </div>

    <!-- Cards Container -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 print:grid-cols-2 print:gap-4">
      @forelse ($users as $user)
      <div class="id-card bg-white rounded-xl shadow-card hover:shadow-card-hover transition-shadow duration-300 overflow-hidden border border-gray-200 print-optimized">
        <!-- Card Header -->
        <div class="card-header-gradient w-full"></div>
        
        <!-- Card Content -->
        <div class="p-5">
          <!-- School Logo and Name -->
          <div class="flex justify-center items-center mb-4 gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sekolah" class="school-logo h-12 w-12">
            <div class="text-center">
              <h3 class="text-lg font-bold text-gray-800">{{ $user->name }}</h3>
              <p class="text-xs text-gray-500">SMKN 1 Kota Bengkulu</p>
            </div>
          </div>
          
          <div class="flex flex-col sm:flex-row gap-4 items-center">
            <!-- QR Code -->
            <div class="flex-shrink-0 mx-auto sm:mx-0">
              <div class="qr-container" id="qrcode-{{ $user->id }}"></div>
            </div>
            
            <!-- User Details -->
            <div class="flex-grow user-details">
              <div class="space-y-2">
                <div>
                  <p class="text-xs font-medium text-gray-500">ID Anggota</p>
                  <p class="text-sm font-semibold text-gray-800 font-mono">{{ $user->user_id }}</p>
                </div>
                @if($user->gender)
                <div>
                  <p class="text-xs font-medium text-gray-500">Jenis Kelamin</p>
                  <p class="text-sm text-gray-800">{{ $user->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                @endif
                @if($user->class)
                <div>
                  <p class="text-xs font-medium text-gray-500">Kelas</p>
                  <p class="text-sm text-gray-800">{{ $user->class }}</p>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        
        <!-- Card Footer -->
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
          <div class="flex items-center print:hidden">
            <input type="checkbox" class="card-checkbox h-4 w-4 text-primary-600 rounded border-gray-300 focus:ring-primary-500" data-user-id="{{ $user->id }}">
            <label class="ml-2 text-xs text-gray-500">Pilih untuk dicetak</label>
          </div>
          <p class="text-xs text-gray-500">ID: {{ $user->id }} | {{ date('Y') }}</p>
        </div>
      </div>

      <script>
        // Generate QR code for this user
        document.addEventListener('DOMContentLoaded', function() {
          new QRCode(document.getElementById("qrcode-{{ $user->id }}"), {
            text: "{{ $user->user_id }}",
            width: 100,
            height: 100,
            colorDark: "#1f2937",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
          });
        });
      </script>
      @empty
      <div class="empty-state px-4 py-8 text-center rounded-lg col-span-full">
        <i class="fas fa-id-card text-4xl mb-3 text-gray-300"></i>
        <p class="text-gray-500 font-medium">Tidak ada kartu anggota ditemukan</p>
        <p class="text-gray-400 text-sm mt-1">Tidak ada data anggota yang tersedia untuk ditampilkan</p>
      </div>
      @endforelse
    </div>
  </div>

  <script>
    // Check if there are any users, if not show empty state
    document.addEventListener('DOMContentLoaded', function() {
      feather.replace();
      
      const totalMembers = parseInt(document.getElementById('total-members').textContent);
      if (totalMembers === 0) {
        document.getElementById('empty-state').classList.remove('hidden');
      }
      
      // Update print date in real-time
      updatePrintDate();
      setInterval(updatePrintDate, 60000); // Update every minute
    });
    
    function updatePrintDate() {
      const now = new Date();
      const options = { 
        day: 'numeric', 
        month: 'long', 
        year: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit' 
      };
      document.getElementById('print-date').textContent = now.toLocaleDateString('id-ID', options);
    }
    
    // Auto-print after 1 second (optional)
    window.onload = function() {
      setTimeout(function() {
        // Uncomment to enable auto-print
        // window.print();
      }, 1000);
    }
    
    // Select all cards function (toggle)
    function selectAllCards() {
      const checkboxes = document.querySelectorAll('.card-checkbox');
      const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
      
      checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
      });
      
      // Change button text based on state
      const button = document.querySelector('[onclick="selectAllCards()"]');
      const icon = button.querySelector('i');
      icon.className = allChecked ? 'fas fa-check-circle' : 'fas fa-times-circle';
    }
    
    // Print selected cards function
    function printSelected() {
      const selectedIds = [];
      document.querySelectorAll('.card-checkbox:checked').forEach(checkbox => {
        selectedIds.push(checkbox.dataset.userId);
      });
      
      if (selectedIds.length === 0) {
        alert('Silakan pilih setidaknya satu kartu untuk dicetak');
        return;
      }
      
      // Store original display values
      const originalDisplays = [];
      const cards = document.querySelectorAll('.id-card');
      cards.forEach(card => {
        originalDisplays.push(card.style.display);
      });
      
      // Hide all cards first
      cards.forEach(card => {
        card.style.display = 'none';
      });
      
      // Show only selected cards
      selectedIds.forEach(id => {
        const card = document.querySelector(`.card-checkbox[data-user-id="${id}"]`)?.closest('.id-card');
        if (card) {
          card.style.display = 'block';
        }
      });
      
      // Add a small delay before printing to ensure DOM is updated
      setTimeout(() => {
        window.print();
        
        // After printing, restore original display values
        setTimeout(() => {
          cards.forEach((card, index) => {
            card.style.display = originalDisplays[index] || '';
          });
        }, 500);
      }, 200);
    }
    
    // Handle window resize for better mobile experience
    window.addEventListener('resize', function() {
      // Adjust card layout if needed
      if (window.innerWidth < 640) {
        document.querySelectorAll('.id-card').forEach(card => {
          card.style.maxWidth = '320px';
        });
      } else {
        document.querySelectorAll('.id-card').forEach(card => {
          card.style.maxWidth = '';
        });
      }
    });
  </script>
</body>
</html>
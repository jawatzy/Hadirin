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
  <title>Hadirin</title>
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
    
    @media (max-width: 640px) {
      .header-height {
        height: auto;
        min-height: 18rem;
      }
      
      .card-square {
        aspect-ratio: 1/1;
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
  <div class="w-full header-height rounded-b-3xl bg-gradient-to-br from-dark-800 to-dark-900 p-6 md:p-8 relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full opacity-10">
      <div class="absolute top-10 left-20 w-32 h-32 rounded-full bg-white"></div>
      <div class="absolute bottom-10 right-20 w-24 h-24 rounded-full bg-yellow-400"></div>
    </div>
    
    <div class="relative z-10 max-w-6xl mx-auto">
      <div class="flex justify-between items-center">
        <div class="text-white font-bold text-lg md:text-xl">HADIRIN</div>
        <div class="flex space-x-2">
          <div class="w-4 h-4 bg-yellow-400 rounded-full"></div>
          <div class="w-4 h-4 bg-red-400 rounded-full"></div>
        </div>
      </div>

      <div class="text-white text-center mt-6 md:mt-8">
        <div class="w-16 h-16 md:w-20 md:h-20 rounded-full mx-auto mb-2 overflow-hidden bg-gray-600 border-2 border-gray-500 flex items-center justify-center">
          <img src="{{ asset('images/logo.png') }}" class="w-full h-full object-cover" />
        </div>
        <p class="text-lg md:text-xl mt-2">SMKN 1</p>
        <p class="text-lg md:text-xl font-medium">Kota Bengkulu</p>
      </div>

      <div class="w-full flex justify-center mt-6 md:mt-8">
        <div class="inline-flex gap-2 md:gap-4 bg-dark-700 bg-opacity-50 rounded-full p-1">
          <button id="b1" onclick="switchTab(1)" class="btn-animate text-sm md:text-base px-3 md:px-4 py-1 rounded-full text-white flex items-center">
            <i class="fas fa-tools mr-1 md:mr-2 text-xs md:text-sm"></i> Tools
          </button>
          <button id="b2" onclick="switchTab(2)" class="btn-animate text-sm md:text-base px-3 md:px-4 py-1 rounded-full text-gray-300 flex items-center">
            <i class="fas fa-print mr-1 md:mr-2 text-xs md:text-sm"></i> Prints
          </button>
          <button id="b3" onclick="switchTab(3)" class="btn-animate text-sm md:text-base px-3 md:px-4 py-1 rounded-full text-gray-300 flex items-center">
            <i class="fas fa-info-circle mr-1 md:mr-2 text-xs md:text-sm"></i> Info
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-6xl mx-auto">

    <!-- Tools Tab -->
    <div id="tab1" class="hidden fade-in grid grid-cols-2 gap-3 sm:gap-4 md:gap-6">
      <a href="/users" class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
        <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Input</div>
        <div class="text-gray-600 text-xs md:text-sm mb-3">Anggota</div>
        <div class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
          Buka
        </div>
      </a>

      <a href="/events" class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
        <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Input</div>
        <div class="text-gray-600 text-xs md:text-sm mb-3">Kegiatan</div>
        <div class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
          Buka
        </div>
      </a>
      
      <a href="{{ route('generate.id.show') }}" class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
        <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
          <i class="fas fa-id-card"></i>
        </div>
        <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Generate ID</div>
        <div class="text-gray-600 text-xs md:text-sm mb-3">Anggota</div>
        <div class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
          Buka
        </div>
      </a>

      <a href="{{ route('scan.show') }}" class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
        <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
          <i class="fas fa-qrcode"></i>
        </div>
        <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Scan</div>
        <div class="text-gray-600 text-xs md:text-sm mb-3">Kehadiran</div>
        <div class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
          Buka
        </div>
      </a>
    </div>

    <!-- Prints Tab -->
    <div id="tab2" class="hidden fade-in">
      <div class="mb-4">
        <a href="{{ route('print.harian') }}" class="block bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
          <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
            <i class="fas fa-calendar-day"></i>
          </div>
          <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Print Kehadiran</div>
          <div class="text-gray-600 text-xs md:text-sm mb-3">Harian</div>
          <div class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg w-full">
            Cetak
          </div>
        </a>
      </div>
      
      <div class="grid grid-cols-2 gap-3 sm:gap-4 md:gap-6">
        <div class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
          <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Print Kehadiran</div>
          <div class="text-gray-600 text-xs md:text-sm mb-3">Bulanan</div>
          <button onclick="printBulanan()" class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
            Cetak
          </button>
        </div>
        
        <div class="card-square bg-white rounded-xl border border-gray-200 shadow-card hover:shadow-card-hover hover:scale-[1.02] transition-all duration-200 p-4 md:p-5 text-center flex flex-col">
          <div class="text-primary-600 text-2xl md:text-3xl mb-3 transition duration-300 hover:scale-110 mx-auto">
            <i class="fas fa-id-card-alt"></i>
          </div>
          <div class="text-primary-700 font-medium text-sm md:text-base mb-1">Print Seluruh</div>
          <div class="text-gray-600 text-xs md:text-sm mb-3">ID Anggota</div>
          <button onclick="printAllID()" class="btn-animate mt-auto bg-primary-600 hover:bg-primary-700 text-white text-xs md:text-sm font-medium py-2 px-4 rounded-lg">
            Cetak
          </button>
        </div>
      </div>
    </div>
    
    <!-- Info Tab -->
    <div id="tab3" class="hidden fade-in bg-white rounded-xl border border-gray-200 shadow-card p-6 md:p-8">
      <h2 class="text-primary-700 font-bold text-xl md:text-2xl mb-4 text-center">HADIRIN</h2>
      <h3 class="text-gray-700 font-medium text-lg md:text-xl mb-2 text-center">SMKN 1 Kota Bengkulu</h3>
      
      <div class="text-gray-600 text-sm md:text-base mb-4 space-y-3">
        <p><strong>Hadirin merupakan sebuah sistem pengelola kehadiran dalam lingkungan sekolah.</strong></p>
        <p>Dengan desain minimalis dan sederhana, Hadirin mampu mengakomodasi kebutuhan pencatatan kehadiran masyarakat sekolah dalam berbagai situasi.</p>
        <p>Pengembangan sistem ini didukung sepenuhnya secara swadaya, sebagai produk hibah dari Guru Produktif Jurusan PPLG SMKN 1 Kota Bengkulu.</p>
      </div>
      
      <div class="text-center mt-6">
        <button onclick="showMoreInfo()" class="btn-animate bg-primary-600 hover:bg-primary-700 text-white text-sm md:text-base font-medium py-2 px-6 rounded-lg inline-block">
          <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
        </button>
      </div>
    </div>
  </div>

  <script>
    // Tab switching function
    function switchTab(id) {
      for (let i = 1; i <= 3; i++) {
        document.getElementById('tab' + i).classList.add('hidden');
        document.getElementById('b' + i).classList.remove('bg-primary-600', 'text-white');
        document.getElementById('b' + i).classList.add('text-gray-300');
      }
      document.getElementById('tab' + id).classList.remove('hidden');
      document.getElementById('b' + id).classList.remove('text-gray-300');
      document.getElementById('b' + id).classList.add('bg-primary-600', 'text-white');
      
      // Store selected tab
      sessionStorage.setItem('selectedTab', id);
    }

    // Print functions
    function printAllID() {
      // Ganti dengan URL route yang sesuai di Laravel
      window.location.href = "{{ route('print.card.id') }}";
    }

    function printBulanan() {
      // Ganti dengan URL route yang sesuai di Laravel
      window.location.href = "{{ route('print.bulanan') }}";
    }

    function showMoreInfo() {
      alert('Informasi lebih lanjut tentang aplikasi Hadirin');
      // Atau bisa diarahkan ke halaman info
      // window.location.href = "/info";
    }

    // Initialize feather icons
    feather.replace();
    
    // Set initial tab from sessionStorage or default to 1
    document.addEventListener('DOMContentLoaded', () => {
      const selectedTab = sessionStorage.getItem('selectedTab') || 1;
      switchTab(selectedTab);
    });
  </script>
</body>
</html>
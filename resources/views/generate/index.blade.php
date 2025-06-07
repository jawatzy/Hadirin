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
  <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
  <title>Generate ID Anggota - Hadirin</title>
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

    /* Responsive actions */
    @media (max-width: 640px) {
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

    @media (min-width: 641px) {
      .action-btn {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
      }
      .action-text {
        display: inline;
        margin-left: 0.25rem;
      }
    }

    /* QR Code styles */
    .qr-container {
      width: 100px;
      height: 100px;
      margin: 0 auto;
      background: white;
      padding: 8px;
      border: 1px solid #e5e7eb;
      border-radius: 4px;
    }
    
    .modal-qr-container {
      width: 240px;
      height: 240px;
      margin: 0 auto;
      background: white;
      padding: 16px;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Modal animations */
    .modal-backdrop {
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .modal-backdrop.show {
      opacity: 1;
    }

    .modal-content {
      transform: scale(0.9) translateY(-20px);
      opacity: 0;
      transition: all 0.3s ease;
    }
    
    .modal-content.show {
      transform: scale(1) translateY(0);
      opacity: 1;
    }

    @media (max-width: 640px) {
      .modal-qr-container {
        width: 200px;
        height: 200px;
        padding: 12px;
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
        <h1 class="text-xl font-bold text-white">Generate ID Anggota</h1>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-6xl mx-auto fade-in">

    @if(session('success'))
      <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 rounded-lg">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-green-500"></i>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-green-800">
              {{ session('success') }}
            </p>
          </div>
        </div>
      </div>
    @endif

    <!-- Generate Button -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-card p-6 mb-8">
      <form action="{{ route('generate.id.process') }}" method="POST">
        @csrf
        <button type="submit" class="btn-animate bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-6 rounded-lg flex items-center gap-2">
          <i class="fas fa-qrcode"></i>
          Generate ID Sekarang
        </button>
      </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-card overflow-hidden">
      <div class="px-6 py-4 border-b flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Anggota</h2>
        <div class="relative w-full sm:w-64">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input 
            type="text" 
            id="searchInput" 
            placeholder="Cari anggota..." 
            class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
          >
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 text-left">
            <tr>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">QR Code</th>
              <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                <div class="text-sm text-gray-500 sm:hidden">{{ $user->email }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                {{ $user->email }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                @if($user->user_id)
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $user->user_id }}
                  </span>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($user->user_id)
                  <div class="qr-container" id="qr-{{ $user->user_id }}">
                    {!! DNS2D::getBarcodeSVG($user->user_id, 'QRCODE', 4, 4) !!}
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @if($user->user_id)
                  <div class="action-buttons">
                    <button
                      class="btn-animate action-btn bg-primary-50 text-primary-600 hover:bg-primary-100"
                      onclick="showQRModal('{{ $user->user_id }}', '{{ $user->name }}', '{{ $user->user_id }}')"
                      type="button"
                      title="Lihat QR Code"
                    >
                      <i class="fas fa-eye"></i>
                      <span class="action-text">Lihat</span>
                    </button>
                    <button
                      class="btn-animate action-btn bg-green-50 text-green-600 hover:bg-green-100 ml-2"
                      onclick="downloadQRCode('{{ $user->user_id }}', '{{ $user->name }}')"
                      type="button"
                      title="Download QR Code"
                    >
                      <i class="fas fa-download"></i>
                      <span class="action-text">Download</span>
                    </button>
                  </div>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- QR Code Modal -->
  <div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden modal-backdrop">
    <div class="bg-white rounded-xl w-full max-w-md mx-4 shadow-2xl modal-content">
      
      <!-- Modal Header -->
      <div class="flex justify-between items-center p-6 border-b border-gray-200">
        <div class="flex-1">
          <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">John Doe</h3>
          <p class="text-sm text-gray-500 mt-1">QR Code ID Anggota</p>
        </div>
        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
          <i class="fas fa-times text-lg"></i>
        </button>
      </div>
      
      <!-- Modal Body -->
      <div class="p-6">
        <!-- QR Code Container -->
        <div class="modal-qr-container">
          <canvas id="modalQRCanvas"></canvas>
        </div>
        
        <!-- User ID Display -->
        <div class="text-center mt-6 p-4 bg-gray-50 rounded-lg">
          <p class="text-sm font-medium text-gray-600 mb-1">User ID:</p>
          <p class="text-xl font-bold text-primary-600" id="modaluserId">USR001</p>
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="flex justify-center p-6 pt-0">
        <button 
          id="modalDownloadBtn"
          class="btn-animate bg-primary-600 hover:bg-primary-700 text-white font-medium py-3 px-8 rounded-lg flex items-center gap-3"
        >
          <i class="fas fa-download"></i>
          Download QR Code
        </button>
      </div>
    </div>
  </div>

  <!-- Hidden canvas for QR generation -->
  <canvas id="qrCanvas" style="display: none;"></canvas>

  <script>
    // Fungsi pencarian
    document.getElementById('searchInput').addEventListener('input', function() {
      const searchValue = this.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      
      rows.forEach(row => {
        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const userId = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
        
        if (name.includes(searchValue) || email.includes(searchValue) || userId.includes(searchValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });

    // Fungsi untuk menampilkan modal QR Code
    function showQRModal(userId, name, userIdText) {
      document.getElementById('modalTitle').textContent = name;
      document.getElementById('modaluserId').textContent = userIdText;
      
      // Generate QR code
      const canvas = document.getElementById('modalQRCanvas');
      generateQRCode(canvas, userId, 208);
      
      // Update tombol download
      const downloadBtn = document.getElementById('modalDownloadBtn');
      downloadBtn.onclick = () => downloadQRCode(userId, name);
      
      // Tampilkan modal dengan animasi
      const modal = document.getElementById('qrModal');
      const backdrop = modal;
      const content = modal.querySelector('.modal-content');
      
      modal.classList.remove('hidden');
      
      // Trigger animasi
      setTimeout(() => {
        backdrop.classList.add('show');
        content.classList.add('show');
      }, 10);
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      const modal = document.getElementById('qrModal');
      const backdrop = modal;
      const content = modal.querySelector('.modal-content');
      
      backdrop.classList.remove('show');
      content.classList.remove('show');
      
      setTimeout(() => {
        modal.classList.add('hidden');
      }, 300);
    }

    // Fungsi untuk generate QR code ke canvas
    function generateQRCode(canvas, text, size) {
      const qr = qrcode(0, 'L');
      qr.addData(text);
      qr.make();
      
      const cellSize = size / qr.getModuleCount();
      const ctx = canvas.getContext('2d');
      
      canvas.width = size;
      canvas.height = size;
      
      // Background putih
      ctx.fillStyle = 'white';
      ctx.fillRect(0, 0, size, size);
      
      // Gambar QR code
      ctx.fillStyle = 'black';
      for (let row = 0; row < qr.getModuleCount(); row++) {
        for (let col = 0; col < qr.getModuleCount(); col++) {
          if (qr.isDark(row, col)) {
            ctx.fillRect(col * cellSize, row * cellSize, cellSize, cellSize);
          }
        }
      }
    }

    // Fungsi untuk download QR Code
    function downloadQRCode(userId, name) {
      const canvas = document.getElementById('qrCanvas');
      generateQRCode(canvas, userId, 512);
      
      // Konversi ke PNG dan download
      const pngUrl = canvas.toDataURL('image/png');
      const a = document.createElement('a');
      a.href = pngUrl;
      a.download = `${name.replace(/\s+/g, '_')}_${userId}_qrcode.png`;
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }

    // Close modal ketika klik di luar konten modal
    document.getElementById('qrModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Close modal dengan ESC key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const modal = document.getElementById('qrModal');
        if (!modal.classList.contains('hidden')) {
          closeModal();
        }
      }
    });

    // Initialize feather icons
    feather.replace();
  </script>

</body>
</html>
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
  <title>Tambah Event - Hadirin</title>
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

    .form-input {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .form-input:focus {
      box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.2);
      border-color: #2563eb;
    }
    .form-select {
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.5rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
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
        <a href="{{ route('events.index') }}" class="text-gray-300 hover:text-white transition-colors mr-4">
          <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-xl font-bold text-white">Tambah Event Baru</h1>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-6xl mx-auto fade-in">

    <!-- Create Form Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-card overflow-hidden">
      <!-- Card Header -->
      <div class="px-6 py-4 bg-gradient-to-r from-primary-700 to-primary-800">
        <h3 class="text-lg font-semibold text-white">
          <i class="fas fa-calendar-plus mr-2"></i>Informasi Event
        </h3>
      </div>

      <!-- Card Body -->
      <div class="p-6">
        <!-- Error Messages -->
        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500"></i>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                  Terdapat {{ $errors->count() }} error pada input Anda
                </h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endif

        <!-- Form -->
        <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
          @csrf

          <!-- Title Field -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
              Judul Event <span class="text-red-500">*</span>
            </label>
            <div class="relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-heading text-gray-400"></i>
              </div>
              <input 
                type="text" 
                name="title" 
                id="title" 
                value="{{ old('title') }}"
                class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="Masukkan judul event"
                required
              >
            </div>
          </div>

          <!-- Description Field -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
              Deskripsi <span class="text-red-500">*</span>
            </label>
            <div class="relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 pt-3 flex items-start pointer-events-none">
                <i class="fas fa-align-left text-gray-400"></i>
              </div>
              <textarea 
                name="description" 
                id="description" 
                rows="4"
                class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                placeholder="Masukkan deskripsi event"
                required
              >{{ old('description') }}</textarea>
            </div>
          </div>

          <!-- Date Field -->
          <div>
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
              Tanggal Event <span class="text-red-500">*</span>
            </label>
            <div class="relative rounded-md shadow-sm">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-calendar-day text-gray-400"></i>
              </div>
              <input 
                type="date" 
                name="date" 
                id="date" 
                value="{{ old('date') }}"
                class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                required
              >
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex items-center justify-end pt-6 border-t border-gray-200">
            <a 
              href="{{ route('events.index') }}" 
              class="btn-animate mr-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="fas fa-times mr-2"></i> Batal
            </a>
            <button 
              type="submit"
              class="btn-animate inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
              <i class="fas fa-save mr-2"></i> Simpan Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Initialize feather icons
    feather.replace();
  </script>
</body>
</html>
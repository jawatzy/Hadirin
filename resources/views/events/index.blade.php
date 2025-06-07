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
  <title>Event Management - Hadirin</title>
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
      .event-title {
        font-weight: 600;
        color: #1f2937;
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
    .event-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .empty-state {
      background-color: #f9fafb;
      border: 1px dashed #e5e7eb;
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
        <h1 class="text-xl font-bold text-white">Event Management</h1>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="w-full px-4 md:px-6 pt-8 pb-6 bg-white rounded-t-3xl -mt-4 min-h-[65vh] max-w-6xl mx-auto fade-in">

    <!-- Search Bar -->
    <div class="mb-4 sm:mb-6">
      <form method="GET" action="{{ route('events.index') }}" class="w-full">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
          </div>
          <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari event..."
            class="form-input block w-full pl-10 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
          />
        </div>
      </form>
    </div>

    @if (session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
      </div>
    @endif

    <!-- Desktop Table View -->
    <div class="hidden md:block bg-white rounded-xl border border-gray-200 shadow-card overflow-hidden">
      <div class="grid grid-cols-12 bg-gray-50 px-4 py-3 border-b border-gray-200 text-gray-600 font-medium text-sm uppercase tracking-wider">
        <div class="col-span-1">No</div>
        <div class="col-span-3">Judul</div>
        <div class="col-span-4">Deskripsi</div>
        <div class="col-span-2">Tanggal</div>
        <div class="col-span-2 text-right">Aksi</div>
      </div>

      @forelse ($events as $event)
        <div class="grid grid-cols-12 px-4 py-3 border-b border-gray-100 hover:bg-gray-50 items-center transition-colors">
          <div class="col-span-1 text-gray-500">{{ $loop->iteration }}</div>
          <div class="col-span-3 text-gray-800 font-medium truncate">{{ $event->title }}</div>
          <div class="col-span-4 text-gray-600 truncate">{{ $event->description }}</div>
          <div class="col-span-2 text-sm text-gray-600">
            {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
          </div>
          <div class="col-span-2 flex justify-end">
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="btn-animate action-btn bg-primary-50 text-primary-600 hover:bg-primary-100"
                 title="Edit">
                <i class="fas fa-edit"></i>
                <span class="action-text">Edit</span>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn-animate action-btn bg-red-50 text-red-600 hover:bg-red-100"
                        title="Hapus">
                  <i class="fas fa-trash-alt"></i>
                  <span class="action-text">Hapus</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="fas fa-calendar-times text-4xl mb-3 text-gray-300"></i>
          <p class="text-gray-500 font-medium">Tidak ada event ditemukan</p>
          <p class="text-gray-400 text-sm mt-1">Buat event pertama Anda dengan menekan tombol +</p>
        </div>
      @endforelse
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-3">
      @forelse ($events as $event)
        <div class="event-card bg-white rounded-lg shadow-card p-4 transition-all">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="event-title text-gray-800">{{ $event->title }}</h3>
              <p class="text-gray-500 text-sm mt-1">
                <i class="far fa-calendar-alt mr-1"></i>
                {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
              </p>
            </div>
            <div class="action-buttons">
              <a href="{{ route('events.edit', $event->id) }}"
                 class="btn-animate action-btn bg-primary-50 text-primary-600 hover:bg-primary-100"
                 title="Edit">
                <i class="fas fa-edit text-sm"></i>
              </a>
              <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn-animate action-btn bg-red-50 text-red-600 hover:bg-red-100"
                        title="Hapus">
                  <i class="fas fa-trash-alt text-sm"></i>
                </button>
              </form>
            </div>
          </div>
          @if($event->description)
            <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $event->description }}</p>
          @endif
        </div>
      @empty
        <div class="empty-state px-4 py-8 text-center rounded-lg">
          <i class="fas fa-calendar-times text-3xl mb-3 text-gray-300"></i>
          <p class="text-gray-500 font-medium">Tidak ada event ditemukan</p>
        </div>
      @endforelse
    </div>
  </div>

  <!-- Floating Add Event Button -->
  <a href="{{ route('events.create') }}" 
     class="btn-animate fixed bottom-5 right-5 bg-primary-600 text-white rounded-full p-4 hover:bg-primary-700"
     title="Tambah Event">
    <i class="fas fa-plus text-xl"></i>
    <span class="sr-only">Tambah Event</span>
  </a>

  <script>
    // Initialize feather icons
    feather.replace();
  </script>
</body>
</html>
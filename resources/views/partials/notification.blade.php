<!-- resources/views/partials/notification-dropdown.blade.php -->
<div class="relative" @click.away="notifDropdownOpen = false">
    <button @click="notifDropdownOpen = !notifDropdownOpen" class="relative text-gray-600">
        <!-- Ikon Lonceng -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z" />
        </svg>
        <!-- Jumlah Notifikasi Belum Dibaca -->
        @php
            $unreadCount = auth()->user()->unreadNotifications->count();
        @endphp
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
        @endif
    </button>

    <!-- Dropdown Notifikasi -->
    <div x-show="notifDropdownOpen" class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-md shadow-lg z-20">
        <div class="p-4">
            <h4 class="font-bold text-gray-700">Notifikasi</h4>
            @forelse(auth()->user()->unreadNotifications as $notification)
                <div class="mt-2 p-2 bg-white border border-gray-200 rounded-md shadow-sm">
                    <p class="text-gray-600">{{ $notification->data['message'] }}</p>
                    <small class="text-gray-400">{{ $notification->created_at->diffForHumans() }}</small>
                    <a href="{{ route('tasks.show', $notification->data['task_id']) }}" class="text-blue-500">Lihat Tugas</a>
                </div>
            @empty
                <p class="text-gray-500 mt-2">Tidak ada notifikasi baru</p>
            @endforelse
        </div>
    </div>
</div>
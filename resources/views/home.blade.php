<!-- resources/views/dashboard.blade.php -->
@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Proyek</h1>

    <!-- Alert untuk Tugas Mendekati Deadline -->
    @auth
        @if($upcomingTasks->isNotEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow-md mb-6">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-yellow-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 11-10 10A10 10 0 0112 2z" />
                    </svg>
                    <span class="font-semibold">Perhatian!</span> Anda memiliki tugas yang mendekati batas waktu dalam 36 jam.
                </div>
                <ul class="mt-3 ml-6 list-disc list-inside text-sm text-yellow-800">
                    @foreach($upcomingTasks as $task)
                        <li>
                            <strong>{{ $task->nama_tugas }}</strong> 
                            <span class="text-gray-600">(Batas Waktu: {{ $task->tanggal_deadline ? \Carbon\Carbon::parse($task->tanggal_deadline)->format('d-m-Y') : '-' }})</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endauth
</div>
@endsection

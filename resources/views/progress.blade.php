@extends('layouts.master')

@section('content')
<div class="container mx-auto p-6">
    <!-- Detail Proyek -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ $project->nama_project }}</h2>
        <p class="text-gray-600 mb-2">{{ $project->deskripsi_project }}</p>
        <p class="mb-2">Status: 
            <span class="px-2 py-1 rounded-full text-white {{ $project->status_project == 'completed' ? 'bg-green-500' : ($project->status_project == 'in progress' ? 'bg-yellow-500' : 'bg-gray-400') }}">
                {{ ucfirst($project->status_project) }}
            </span>
        </p>

        <!-- Progress Bar for Project -->
        <div class="relative pt-1">
            <div class="overflow-hidden h-4 text-xs flex rounded bg-blue-200 mt-2">
                <div style="width: {{ $progressPercentage }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
            </div>
            <p class="text-gray-700 mt-2">{{ number_format($progressPercentage, 2) }}% tugas selesai</p>
        </div>

        <!-- Task List -->
        <div class="mt-4">
            <h4 class="text-md font-semibold text-gray-600">Daftar Tugas</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto mt-2 border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-gray-600 border-b">Nama Tugas</th>
                            <th class="px-4 py-2 text-left text-gray-600 border-b">Deskripsi</th>
                            <th class="px-4 py-2 text-left text-gray-600 border-b">Status</th>
                            <th class="px-4 py-2 text-left text-gray-600 border-b">Tanggal Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project->tasks as $task)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $task->nama_tugas }}</td>
                            <td class="px-4 py-2">{{ $task->deskripsi_tugas ?? 'Tidak ada deskripsi.' }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-white {{ $task->status_tugas == 'completed' ? 'bg-green-500' : ($task->status_tugas == 'in progress' ? 'bg-yellow-500' : 'bg-gray-400') }}">
                                    {{ ucfirst($task->status_tugas) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $task->tanggal_deadline ? \Carbon\Carbon::parse($task->tanggal_deadline)->format('d-m-Y') : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="flex justify-start mt-4">
        <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Kembali</a>
    </div>
</div>
@endsection

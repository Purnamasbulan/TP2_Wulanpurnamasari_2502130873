@extends('layouts.master')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Detail Proyek: {{ $project->nama_project }}</h3>

<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded px-8 py-6">
        <form>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Proyek:</label>
                <div class="bg-gray-100 border border-gray-300 rounded p-2">
                    {{ $project->nama_project }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Proyek:</label>
                <div class="bg-gray-100 border border-gray-300 rounded p-2">
                    {{ $project->deskripsi_project ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai:</label>
                <div class="bg-gray-100 border border-gray-300 rounded p-2">
                    {{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d-m-Y') }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai:</label>
                <div class="bg-gray-100 border border-gray-300 rounded p-2">
                    {{ $project->tanggal_selesai ? \Carbon\Carbon::parse($project->tanggal_selesai)->format('d-m-Y') : 'Belum selesai' }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Proyek:</label>
                <div class="bg-gray-100 border border-gray-300 rounded p-2">
                    {{ ucfirst($project->status_project) }}
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('projects.edit', $project->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 mr-2">Edit</a>
                <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-6 py-2 rounded-full hover:bg-gray-600">Kembali</a>
            </div>
        </form>

        <h4 class="text-2xl font-medium text-gray-700 mt-6">Daftar Tugas</h4>

        <div class="mt-4 mb-6">
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition duration-200">Tambah Tugas</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b text-left text-gray-600">Nama Tugas</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Deskripsi Tugas</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Status Tugas</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Tanggal Deadline</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->tasks as $task)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $task->nama_tugas }}</td>
                            <td class="py-2 px-4 border-b">{{ $task->deskripsi_tugas ?? 'Tidak ada deskripsi.' }}</td>
                            <td class="py-2 px-4 border-b">
                                <span class="{{ $task->status_tugas == 'completed' ? 'text-green-500' : ($task->status_tugas == 'in progress' ? 'text-yellow-500' : 'text-red-500') }}">
                                    {{ ucfirst($task->status_tugas) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 border-b">{{ $task->tanggal_deadline ? \Carbon\Carbon::parse($task->tanggal_deadline)->format('d-m-Y') : 'Belum ada deadline' }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection

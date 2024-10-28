@extends('layouts.master')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Edit Tugas untuk Proyek: {{ $project->nama_project }}</h3>

<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded px-8 py-6">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_tugas">Nama Tugas:</label>
                <input type="text" name="nama_tugas" id="nama_tugas" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_tugas') border-red-500 @enderror" 
                    value="{{ old('nama_tugas', $task->nama_tugas) }}" required>
                @error('nama_tugas')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="deskripsi_tugas">Deskripsi Tugas:</label>
                <textarea name="deskripsi_tugas" id="deskripsi_tugas" rows="4" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('deskripsi_tugas') border-red-500 @enderror">{{ old('deskripsi_tugas', $task->deskripsi_tugas) }}</textarea>
                @error('deskripsi_tugas')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status_tugas">Status Tugas:</label>
                <select name="status_tugas" id="status_tugas" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status_tugas') border-red-500 @enderror" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="pending" {{ old('status_tugas', $task->status_tugas) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in progress" {{ old('status_tugas', $task->status_tugas) == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status_tugas', $task->status_tugas) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status_tugas')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_deadline">Tanggal Deadline:</label>
                <input type="date" name="tanggal_deadline" id="tanggal_deadline" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_deadline') border-red-500 @enderror" 
                    value="{{ old('tanggal_deadline', $task->tanggal_deadline) }}">
                @error('tanggal_deadline')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('tasks.index', $project->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-full hover:bg-gray-600 mr-2">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">Update Tugas</button>
            </div>
        </form>
    </div>
</div>

@endsection

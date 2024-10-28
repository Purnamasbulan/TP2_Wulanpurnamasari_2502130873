@extends('layouts.master')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Edit Proyek: {{ $project->nama_project }}</h3>

<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded px-8 py-6">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Proyek:</label>
                <input type="text" name="nama_project" value="{{ old('nama_project', $project->nama_project) }}" required class="border border-gray-300 rounded w-full p-2">
                @error('nama_project')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Proyek:</label>
                <textarea name="deskripsi_project" class="border border-gray-300 rounded w-full p-2">{{ old('deskripsi_project', $project->deskripsi_project) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $project->tanggal_mulai) }}" required class="border border-gray-300 rounded w-full p-2">
                @error('tanggal_mulai')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $project->tanggal_selesai) }}" class="border border-gray-300 rounded w-full p-2" id="tanggal_selesai">
                @error('tanggal_selesai')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Status Proyek:</label>
                <select name="status_project" id="status_project" class="border border-gray-300 rounded w-full p-2">
                    <option value="pending" {{ $project->status_project == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in progress" {{ $project->status_project == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $project->status_project == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status_project')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 mr-2 py-2 rounded hover:bg-gray-600">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mengatur status project saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const statusProjectSelect = document.getElementById('status_project');
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
        if (statusProjectSelect.value === 'completed') {
            tanggalSelesaiInput.required = true;
        } else {
            tanggalSelesaiInput.required = false;
        }
    });

    document.getElementById('status_project').addEventListener('change', function() {
        const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
        if (this.value === 'completed') {
            tanggalSelesaiInput.required = true;
        } else {
            tanggalSelesaiInput.required = false;
            tanggalSelesaiInput.value = ''; // Reset value if not completed
        }
    });
</script>

@endsection

@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold mb-4">Tambah User ke Proyek: {{ $project->nama_project }}</h2>

    <!-- Tampilkan pesan sukses -->
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('projectsUser.store') }}" method="POST" class="space-y-4">
        @csrf
        <!-- Input tersembunyi untuk project_id -->
        <input type="hidden" name="project_id" value="{{ $project->id }}">

        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Pilih User</label>
            <select id="user_id" name="user_id" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @foreach($availableUsers as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah User</button>
    </form>
</div>
@endsection

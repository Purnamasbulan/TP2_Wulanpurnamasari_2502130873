@extends('layouts.master')

@section('content')

<h3 class="text-3xl font-medium text-gray-700">Daftar Proyek</h3>

<div class="container mx-auto mt-2">
    <div class="py-5">
        <form method="GET" action="{{ route('projects.index') }}" class="mb-4 flex flex-wrap items-center gap-2">
            <input type="text" name="search" placeholder="Cari nama proyek..." class="border p-2 rounded flex-grow">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cari</button>
            <a href="{{ route('projects.create') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Tambah Proyek</a>
        </form>
    </div>

    <div class="flex flex-col">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nama Proyek
                            </th>
                            <!-- <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Deskripsi
                            </th> -->
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Tanggal Mulai
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Tanggal Selesai
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Status
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($projects as $index => $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $index + 1 }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">{{ $project->nama_project }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $project->tanggal_mulai }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $project->tanggal_selesai ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $project->status_project === 'completed' ? 'bg-green-100 text-green-800' : ($project->status_project === 'in progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($project->status_project) }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex justify-end flex-wrap gap-3">
                                        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}">
                                            <img src="{{ asset('icon/add.svg') }}" alt="Tambah Tugas" class="w-6 h-6">
                                        </a>
                                        <a href="{{ route('progress', ['project_id' => $project->id]) }}">
                                            <img src="{{ asset('icon/graph.svg') }}" alt="Grafik Progres" class="w-6 h-6">
                                        </a>
                                        <a href="{{ route('projectsUser.index', ['project_id' => $project->id]) }}">
                                            <img src="{{ asset('icon/add-account.svg') }}" alt="Tambah Akun" class="w-6 h-6">
                                        </a>
                                        <a href="{{ route('projects.show', $project->id) }}">
                                            <img src="{{ asset('icon/info.svg') }}" alt="Detail Proyek" class="w-6 h-6">
                                        </a>
                                        <a href="{{ route('projects.edit', $project->id) }}">
                                            <img src="{{ asset('icon/edit.svg') }}" alt="Edit Proyek" class="w-6 h-6">
                                        </a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                                <img src="{{ asset('icon/delete.svg') }}" alt="Hapus Proyek" class="w-6 h-6">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

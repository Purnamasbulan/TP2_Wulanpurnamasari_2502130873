@foreach (auth()->user()->notifications()->where('is_read', false)->get() as $notification)
    <div class="bg-white p-4 border border-gray-200 rounded-md shadow-md">
        <h4 class="font-bold">{{ $notification->data['title'] }}</h4>
        <p>{{ $notification->data['message'] }}</p>
        <small>{{ $notification->created_at->diffForHumans() }}</small>
        <a href="{{ route('tasks.show', $notification->data['task_id']) }}" class="text-blue-500">Lihat Tugas</a>
    </div>
@endforeach

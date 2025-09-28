@extends('layouts.app')

@section('title', 'Teacher bo‘lish uchun so‘rovlar')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Teacher bo‘lish uchun so‘rovlar</h2>

    @if($requests->count())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Foydalanuvchi</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Sebab</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Harakatlar</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($requests as $req)
                    <tr>
                        <td class="px-4 py-2">{{ $req->id }}</td>
                        <td class="px-4 py-2">{{ $req->user->name }}</td>
                        <td class="px-4 py-2">{{ $req->reason }}</td>
                        <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($req->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($req->status == 'approved') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($req->status) }}
                                </span>
                        </td>
                        <td class="px-4 py-2">
                            @if($req->status == 'pending')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.teacher.requests.approve', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 text-sm bg-green-500 text-white rounded hover:bg-green-600">
                                            ✅ Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.teacher.requests.reject', $req->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                            ❌ Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-500 italic text-sm">Harakat talab qilinmaydi</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">Hozircha teacher bo‘lish uchun hech qanday so‘rov yo‘q.</p>
    @endif
@endsection

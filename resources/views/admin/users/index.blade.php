@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Foydalanuvchilar ro‘yxati</h2>

    @if($users->count())
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Ism</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Rollar</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Harakat</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs rounded">
                                    {{ implode(', ', $user->getRoleNames()->toArray()) }}
                                </span>
                        </td>
                        <td class="px-4 py-2">
                            @if(!$user->banned)
                                <form action="{{ url('admin/users/'.$user->id.'/ban') }}" method="POST" onsubmit="return confirm('Ushbu foydalanuvchini ban qilmoqchimisiz?')">
                                    @csrf
                                    <button type="submit"
                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                        🚫 Ban
                                    </button>
                                </form>
                            @else
                                <span class="px-2 py-1 bg-gray-200 text-gray-600 text-xs rounded">Banned</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">Hozircha foydalanuvchilar mavjud emas.</p>
    @endif
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                    <td>
                        @if(!$user->banned)
                            <form action="{{ url('admin/users/'.$user->id.'/ban') }}" method="POST">
                                @csrf
                                <button type="submit">Ban</button>
                            </form>
                        @else
                            <span>Banned</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection


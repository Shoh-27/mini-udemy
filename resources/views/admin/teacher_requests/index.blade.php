<h2>Teacher bo‘lish uchun sorovlar</h2>

<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @foreach($requests as $req)
        <tr>
            <td>{{ $req->id }}</td>
            <td>{{ $req->user->name }}</td>
            <td>{{ $req->reason }}</td>
            <td>{{ $req->status }}</td>
            <td>
                @if($req->status == 'pending')
                    <form action="{{ route('admin.teacher.requests.approve', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit">✅ Approve</button>
                    </form>

                    <form action="{{ route('admin.teacher.requests.reject', $req->id) }}" method="POST">
                        @csrf
                        <button type="submit">❌ Reject</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>

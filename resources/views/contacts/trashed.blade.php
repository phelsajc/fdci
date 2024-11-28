@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Trashed Users</h1>

    @if ($users->isEmpty())
        <div class="alert alert-info">No trashed users found.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            @if ($user->photo)
                                <img src="{{ asset($user->photo) }}" alt="{{ $user->name }}" width="50" height="50">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td>{{ $user->prefixname }} {{ $user->firstname }} {{mb_substr($user->middlenanamehow, 0, 1)}} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->deleted_at->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('users.restore', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to restore this user?');">Restore</button>
                            </form>
                            
                            <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this user?');">Delete Permanently</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Details</h1>
    <div class="card">
        <div class="card-header">
            {{ $user->fullname }}
        </div>
        <div class="card-body">
            <p><strong>Fullname:</strong> {{ $user->fullname }}</p>
            <p><strong>Photo:</strong> 
                @if ($user->photo)
                    <img src="{{ $user->photo }}" alt="{{ $user->firstname }}" width="50" height="50">
                @endif
            </p>
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back to Users List</a>
        </div>
    </div>
</div>
@endsection

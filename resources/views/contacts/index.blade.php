@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contacts</h1> 
    <a href="{{ route('contacts.create') }}" class="btn btn-success mb-3">Create New Contact</a>
    {{-- <input
        type="text"
        id="search"
        class="form-control w-25"
        placeholder="Search..."
    /> --}}
    <table class="table table-striped" id="contactTbl">
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->company }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to DELETE?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $contacts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#search').on('change', function () {
            let query = $(this).val();

            // Send AJAX request
            $.ajax({
                url: "{{ route('contacts.search') }}", // Your search route
                type: 'GET',
                data: { search: query },
                success: function (data) {
                    // Update the table
                    let rows = '';
                    data.forEach(function (contact) {
                        rows += `
                            <tr>
                                <td>${contact.name}</td>
                                <td>${contact.company}</td>
                                <td>${contact.phone}</td>
                                <td>${contact.email}</td>
                                <td>
                                    <button class="btn btn-warning">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        `;
                    });

                    $('#contactTbl').html(rows);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
@endsection
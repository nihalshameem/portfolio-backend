@extends('layouts.app')

@section('title', 'Contact me')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Contact me</h1>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $item)
                        <tr>
                            <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->message, 100, '...') }}</td>
                            <td>
                                <a href="{{ route('contactMe.view', $item->id) }}" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('contactMe.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Add pagination links -->
            <div class="d-flex justify-content-center">
                {{ $messages->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

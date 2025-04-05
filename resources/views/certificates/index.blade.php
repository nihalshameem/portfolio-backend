@extends('layouts.app')

@section('title', 'Certificates')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Certificates</h1>
            <a href="{{ route('certificates.create') }}" class="btn btn-primary mb-3">Add New Certificate</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $project)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Certificate Image"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>{{ $project->title }}</td>
                            <td>
                                <a href="{{ route('certificates.show', $project->id) }}"
                                    class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('certificates.edit', $project->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('certificates.destroy', $project->id) }}" method="POST"
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
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center mb-4">Projects</h1>
            <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>
                            <td>
                                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
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

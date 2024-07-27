@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Project Details</h1>
            <h3>{{ $project->title }}</h3>
            <p><strong>Short Description:</strong> {{ $project->shortDesc }}</p>
            <p><strong>Description:</strong> {{ $project->desc }}</p>
            <!-- Display other fields as necessary -->
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
        </div>
    </div>
@endsection

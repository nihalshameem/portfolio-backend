@extends('layouts.app')

@section('title', 'Certificate Details')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Certificate Details</h1>
            <h3>{{ $certificate->title }}</h3>
            <img src="{{ asset($certificate->image_path) }}" alt="Certificate Image" class="img-fluid mb-2">
            <p><strong>Slug:</strong> {{ $certificate->slug }}</p>
            <p><strong>Description:</strong> {{ $certificate->desc }}</p>
            <p><strong>Earned On:</strong> {{ $certificate->earned_on }}</p>
            <p><strong>Expiry Date:</strong> {{ $certificate->expiry_date }}</p>
            <p><strong>Issuer:</strong> {{ $certificate->issuer }}</p>
            <p><strong>Certificate:</strong> <a href="{{ asset($certificate->file_path) }}" target="_blank">View
                    Certificate</a></p>
            <!-- Display other fields as necessary -->
            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">Back to Certificates</a>
        </div>
    </div>
@endsection

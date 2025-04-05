@extends('layouts.app')

@section('title', 'Create Certificate')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Create Certificate</h1>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="image">Main Image:</label>
                    <input type="file" id="image" name="image" class="form-control mb-2" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="desc">Description:</label>
                    <textarea id="desc" name="desc" class="form-control" required>{{ old('desc') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="file">Certificate:</label>
                    <input type="file" id="file" name="file" class="form-control mb-2" accept="pdf/*" required>
                </div>

                <div class="form-group">
                    <label for="earned_on">Earned On:</label>
                    <input type="date" id="earned_on" name="earned_on" class="form-control"
                        value="{{ old('earned_on') }}" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="date" id="expiry_date" name="expiry_date" class="form-control"
                        value="{{ old('expiry_date') }}">
                </div>

                <div class="form-group">
                    <label for="issuer">Issuer:</label>
                    <input type="text" id="issuer" name="issuer" class="form-control" value="{{ old('issuer') }}"
                        required>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="certificate_link_text">Certificate Link Text:</label>
                        <input type="text" id="certificate_link_text" name="certificate_link_text" class="form-control"
                            value="{{ old('certificate_link_text') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="certificate_link">Certificate Link:</label>
                        <input type="url" id="certificate_link" name="certificate_link" class="form-control"
                            value="{{ old('certificate_link') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'View Message')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="text-center mb-4">View Message</h1>
            <div class="card">
                <div class="card-header">
                    <h3>{{ $message->first_name . ' ' . $message->last_name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $message->email }}</p>
                    <p><strong>Message:</strong> {{ $message->message }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('contactMe.list') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

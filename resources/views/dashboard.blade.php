@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Dashboard</h1>
            <p class="text-center">Welcome to your dashboard, {{ Auth::user()->name }}!</p>
            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h3> {{ __('account_system') }}</h3>
                    </div>

                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <img src="https://img.icons8.com/emoji/96/000000/sparkles-emoji.png" alt="مرحبا" class="mb-3">
                        </div>

                        <h2 class="mb-3"> {{ $data['name'] }} 🌸</h2>

                        <p class="lead mb-4">{{ $data['message'] }}</p>

                        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-lg rounded-pill">
                            {{ __('account_system') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

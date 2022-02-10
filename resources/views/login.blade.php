@extends('template')

@section('content')
    <div class="container d-flex flex-column align-items-center">
        <div class="card mt-5" style="width: 99%;">
            <div class="card-body">
                <h4 class="card-title mb-4">Masuk ke Sistem</h4>
                <div class="mb-3">
                    <span class="form-label" id="email">Email</span>
                    <input type="email" name="email" class="form-control" placeholder="enter your email" aria-label="email" aria-describedby="email">
                </div>
                <div class="mb-4">
                    <span class="form-label" id="password">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="enter your password" aria-label="password" aria-describedby="password">
                </div>
                <button type="button" class="btn btn-primary" id="btn-login">Masuk</button>
            </div>
        </div>
    </div>
    <script src="{{url('/assets/pages/login.js')}}"></script>
@endsection


@extends('layouts.auth.master', ['title' => 'Login - Coffee'])


@section('content')

<div class="row align-items-center justify-content-center">
    <div class="col-lg-5">
        <div class="card card-pages shadow-none mt-4">
            <div class="card-body">
                <div class="text-center mt-0 mb-3">
                    <a href="index.html" class="logo logo-admin">
                        <img src="{{ asset('/be/assets/images/coffee/biji-kopi.png') }}" class="mt-3" alt="" height="50"></a>
                    {{-- <p class="text-muted w-75 mx-auto mb-4 mt-4">Enter your email address and password to access admin panel.</p> --}}
                </div>

                @if (session('status'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('status') }}
                    </div>
                </div>
                @endif
                
                <form class="form-horizontal mt-4" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <label for="username">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="email" id="email" placeholder="Email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <label for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" id="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1"> Remember me</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-3">
                        <div class="col-12">
                            <button class="btn btn-brown btn-block waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <div class="col-12">
                            <div class="float-left">
                                <a href="/forgot-password" class="text-muted"><i class="fa fa-lock mr-1"></i> Forgot your password?</a>
                            </div>
                            {{-- <div class="text-right">
                                <a href="pages-register.html" class="text-muted">Create an account</a>
                            </div> --}}
                        </div>
                    </div>

                    {{-- <div class="text-center">
                        <p class="mt-4 text-muted">Sign in with</p>
                        <ul class="social-list list-inline mb-2">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                            </li>
                        </ul>
                    </div> --}}

                </form>

            </div>

        </div>

    </div>
</div>
    
@endsection
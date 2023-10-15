@extends('layouts.auth.master', ['title' => 'Login - Coffee'])


@section('content')

<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-lg-4">
            <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                <div class="w-100">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div>
                                <div class="text-center">
                                    <div>
                                        <a href="index.html" class="">
                                            <img src="assets/images/logo-dark.png" alt="" height="20" class="auth-logo logo-dark mx-auto">
                                            <img src="assets/images/logo-light.png" alt="" height="20" class="auth-logo logo-light mx-auto">
                                        </a>
                                    </div>

                                    <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                    <p class="text-muted">Sign in to continue to Nazox.</p>
                                </div>

                                <div class="p-2 mt-5">
                                    <form class="" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="auth-form-group-custom mb-4">
                                            <i class="ri-user-2-line auti-custom-input-icon"></i>
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email placeholder="Enter username">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                
                                        <div class="auth-form-group-custom mb-4">
                                            <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                            <label for="userpassword">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline">
                                            <label class="form-check-label" for="customControlInline">Remember me</label>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <a href="/forgot-password" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                        </div>
                                    </form>
                                </div>

                                {{-- <div class="mt-5 text-center">
                                    <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Register </a> </p>
                                    <p>© <script>document.write(new Date().getFullYear())</script> Nazox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="authentication-bg">
                <div class="bg-overlay"></div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@extends('layouts.auth.master', ['title' => 'Forgot Password - Coffee'])


@section('content')

<div class="row row justify-content-center">
    <div class="col-lg-5">
        <div class="card card-pages mt-4">
            <div class="card-body">
                <div class="text-center mt-0 mb-3">
                    <a href="index.html" class="logo logo-admin">
                        <img src="assets/images/logo-dark.png" class="mt-3" alt="" height="26"></a>
                    <h5>Reset Password</h5>
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
                <form class="form-horizontal mt-4" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    {{-- <div class="col-12">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            Enter your <b>Email</b> and instructions will be sent to you!
                        </div>
                    </div> --}}

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

                    <div class="form-group text-center mt-3">
                        <div class="col-12">
                            <button class="btn btn-brown btn-block waves-effect waves-light" type="submit">Send Password Reset Link</button>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <p class="text-muted mb-2">Back to <a href="{{ route('login') }}" class="ml-1"><b>Log in</b></a></p>
                        </div>
                        <!-- end col -->
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>
<!-- end row -->

@endsection
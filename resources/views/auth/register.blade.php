@extends('layouts.app')

@section('pageTitle', 'Register')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="card mt-5">
                    <div class="card-body">
                        <a href="#" class="d-flex justify-content-center mt-3"><img src="/images/logo.png" alt="image" style="max-width: 50%;"></a>
                        <div class="row">
                            <div class="d-flex justify-content-center">
                                <div class="auth-header">
                                    <h2 class="text-secondary mt-5"><b>Sign up</b></h2>
                                    <p class="f-16 mt-2">Enter your credentials to continue</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="nameInput" placeholder="Enter Full Name"> 
                                    <label for="nameInput">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="usernameInput" placeholder="Enter Username"> 
                                    <label for="usernameInput">Username</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phoneInput" placeholder="Enter Phone"> 
                                    <label for="phoneInput">Phone</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Email Address"> 
                            <label for="email">Email Address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput3" placeholder="Password"> 
                            <label for="floatingInput3">Password</label>
                        </div>
                        <div class="form-check mt-3s">
                            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked=""> 
                            <label class="form-check-label" for="customCheckc1">
                                <span class="h5 mb-0">Agree with <span>Terms & Condition.</span></span>
                            </label>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-secondary p-2">Sign Up</button>
                        </div>
                        <hr>
                        <a href="{{ route('login') }}" class="d-flex justify-content-center">Already have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
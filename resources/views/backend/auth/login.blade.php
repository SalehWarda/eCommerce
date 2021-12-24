@extends('layouts.auth.adminLogin')
@section('content')


    <section class="height-100vh d-flex align-items-center page-section-ptb login"
             style="background-image: url({{asset('backend/images/sativa.png')}});">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">

                <div class="col-lg-4 col-md-6 bg-white">
                    <div class="login-fancy pb-40 clearfix">
                        <h3 class="mb-30">Sign In To Admin</h3>
                        <form action="{{route('loginAdmin')}}" method="post">
                            @csrf
                            <div class="section-field mb-20">
                                <label class="mb-10" for="username">User name* </label>
                                <input id="username" class="web form-control" type="text" placeholder="User name"
                                       name="username">
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">Password* </label>
                                <input id="Password" class="Password form-control" type="password"
                                       placeholder="Password" name="password">
                            </div>
                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <input class="custom-control-input" type="checkbox" name="remember"
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label for="two"> Remember me</label>
                                    <a href="password-recovery.html" class="float-right">Forgot Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="button">
                                <span>Log in</span>
                                <i class="fa fa-check"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

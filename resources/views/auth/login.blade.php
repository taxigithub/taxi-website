@extends('layouts.main')

@section('content')

<div class="section"></div>
<main>
    <center>


        <h5 >Please, login into your account</h5>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>

                    <div class='row'>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">

                            <div class='input-field col s12'>
                                <input class='validate' type='text' id='phone' name="phone" value="{{ old('phone') }}" required/>
                                <label for='phone'>Enter your phone</label>
                            </div>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class='row'>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='password' id='password' />
                                <label for='password'>Enter your password</label>
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="col s12">
                                    <p>
                                        <input type="checkbox" name="remember" id="remember">
                                        <label for="remember">Remember me</label>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <label>
                        <a class='pink-text' href="{{ route('password.request') }}"><b>Forgot Password?</b></a>
                    </label>

                    <br />
                    <br />
                    <center>
                        <div class='row'>
                            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect '>Login</button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
        <a href="{{ route('register') }}">Create account</a>
    </center>


</main>

@endsection

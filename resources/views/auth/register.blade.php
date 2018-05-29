@extends('layouts.main')
@section('content')
<div class="section"></div>
<main>
    <center>

        <div class="section"></div>

        <h5 >Registration</h5>
        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="role" value="1">
                    <div class="input-field col s12">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <i class="material-icons prefix">account_circle</i>
                            <input id="icon_prefix" type="text" class="form-control" name="name" value="{{ old('name') }}" required >
                            <label for="icon_prefix">First Name</label>

                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">phone</i>
                        <input id="icon_telephone" type="tel" name="phone" value="{{ old('phone') }}" required >
                        <label for="icon_telephone">Telephone(required)</label>
                        @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="input-field col s12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <label for="email" >E-Mail Address</label>
                        </div>
                    </div>
                    
                    <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="sos_email" type="email" name="sos_email" value="{{ old('sos_email') }}">
                            @if ($errors->has('sos_email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('sos_email') }}</strong>
                            </span>
                            @endif
                            <label for="sos_email" >SOS E-Mail Address</label>
                    </div>

                    <div class="input-field col s12">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <i class="material-icons prefix">lock</i>

                            <input id="password" type="password" class="form-control" name="password" required>
                            <label for="password" >Password(required)</label>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="form-group">
                            <i class="material-icons prefix">lock</i>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <label for="password-confirm" >Confirm Password</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                    <br />
                </form>
            </div>
    </center>


</main>

@endsection


@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Edit profile</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <form method="POST" action="{{action('ProfileController@UpdateProfile')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="priceId"  value="{{$userData->id}}" /> 

                    <input  type='text' id="name" name="name" value="{{$userData->name}}" />
                    <label for='name'>Name</label>
                    <input  type='tel' id="phone" name="phone" value="{{$userData->phone}}" />
                    <label for='name'>Phone</label>
                    <input  type='email' id="email" name="email" value="{{$userData->email}}" />
                    <label for='email'>E-mail</label>
                    <input  type='email' id="sos_email" name="sos_email" value="{{$userData->sos_email}}" />
                    <label for='email'>SOS E-mail</label>
                    
                    <br/>
                    <br/>
                    <button type='submit'  class='col s12 btn btn-large waves-effect '>Edit profile</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
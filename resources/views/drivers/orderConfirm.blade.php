@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="row">
    <div class="col s12 m6">
        <div class="card">


            <div class="card-content">
                <form method="POST" action="{{action('DriverController@SubmitConfirmation',['Order'=>$Order->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="idOrder" value="{{$Order->id}}" /> 
                    <b>User name:</b> <p>{{$Order->User->name}}</p>
                    <b>Distance:</b> <p>{{$Order->distance}} km.</p>
                    <b>Start point:</b> <p>{{$Order->start_address}} </p>
                    <b>End point:</b> <p>{{$Order->end_address}} </p>
                    <br>
                    <button id="submit" class="btn" >Confirm order</button>
                    <a class="btn" href="{{action('DriverController@Index')}}">Ignore order</a>
                </form>
            </div>
        </div>
    </div>
</div>


<script>


    function createOrder()
    {
        document.getElementById("submit").submit();
    }
</script>
@endsection
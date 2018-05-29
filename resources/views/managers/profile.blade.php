@extends('layouts.main')
@section('content')
<div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<input type="hidden" id="ajaxurl" value="{{url('/')}}/manager/actualorders">
<audio id="audio" src="//www.soundjay.com/button/beep-07.wav" autostart="false" ></audio>
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">

                <li class="tab"> <a class="active" href="#test6">Drivers </a></li>
                <li class="tab"><a  href="#test4">Orders</a></li>
                <li class="tab">  <a  href="#test5">History </a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <div id="actualOrders" class="collection">
                </div>
            </div>
            <div id="test5">
                <div class="input-field inline col s12 ">
                    From:<input type="date" id="historyFrom" class="datepicker">
                    To:  <input type="date" id="historyTo" class="datepicker">
                    <a class="waves-effect waves-light btn" onclick="showHistory();">Search</a>  
                </div>
                
<div id="actualHistory" class="collection">
                    <!--  @foreach($history as $historyItem)
                      <a href="{{action('ManagerController@Show',['Order'=>$historyItem->id])}}" class="collection-item">{{$historyItem->id}}. Date:{{$historyItem->created_at}} Price: {{$historyItem->price}} </a>
                      @endforeach
                      {{ $history->links() }}-->
                </div>
            </div>
            <div id="test6">
                <div class="collection">
                    @foreach($drivers as $driver)
                    
                    <a href="{{action('ManagerController@DriverOrders',['idDriver'=>$driver->Driver->id_user])}}" class="collection-item">Driver: {{$driver->Driver->User->name}} : {{$driver->Driver->User->phone}}(total:{{$driver->Driver->Orders->where('status',5)->sum('price')}}, in cash:{{$driver->Driver->Orders->where('status',5)->where('payment_type', '=', 1)->sum('price')}}/{{$driver->Driver->DriverOnObject->Object->driver_max_sum}})  </a>
                    
                    @endforeach
                    {{ $drivers->links() }}
                </div>
                <a class="btn-floating halfway-fab waves-effect waves-light red" href="{{action('ManagerController@AddDriver')}}"><i class="material-icons">add_box</i></a>

            </div>
        </div>
    </div>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

      <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgcKGd16xKU5wAgILMgT-w0qnFcqWTxhc"
    type="text/javascript"></script>
    <script>
$(document).ready(function() {
$('.datepicker').pickadate({
});
});
var items = 0;
var sosItems = 0;
show();
function show() {

    var url = $(this).attr('action');
    $.ajax({
        url: document.getElementById("ajaxurl").value,
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
            $('#actualOrders').html(html);

            if (items < document.getElementById("newOrdersCount").value) {
                var sound = document.getElementById("audio");
                sound.play();
            }
            items = document.getElementById("newOrdersCount").value;
            if (sosItems < document.getElementById("sosAlertsCount").value) {
            Materialize.Toast.removeAll();
            for(var j =0; j<document.getElementById("sosAlertsCount").value;j++){
                var sosOrderId =  document.getElementById('sosAlert'+j).value;
                var str = '<a href="{{url("/")}}/order/'+sosOrderId+'" class="btn-flat toast-action">Ok</button>';
             var $toastContent = $("<p>SOS alert from order:"+sosOrderId+"</p>").add($(str));
            Materialize.toast($toastContent, 1000000);
        }
        }
        sosItems = document.getElementById("sosAlertsCount").value;
        }

    });
}
setInterval(show, 5000);



function showHistory() {
    $.ajax({
        url: "actualhistory/"+document.getElementById("historyFrom").value+"/"+document.getElementById("historyTo").value,
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
            $('#actualHistory').html(html);
        }

    });
}


    </script>

    @endsection
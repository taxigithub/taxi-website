@extends('layouts.main')
@section('content')
<div style="position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/profile')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="row">
    <div class="col s12 m6">
        <div class="card">
        <input type="hidden" id="ajaxurl" value="{{url('/')}}/orderdata/{{$Order->id}}">
        <div id='hiddenitems' style="display: none;">
        </div>
            <form method="POST" action="{{action('DriverController@ChangeOrderStatus',['Order'=>$Order->id])}}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="statusId"  value="{{$Order->status}}" /> 
                  <div style="margin-top: 7%; position: absolute; top: 0; right: 0; ">  <a class="btn-floating halfway-fab waves-effect waves-light red" onclick="Materialize.toast('SOS message is sent!', 4000);" href="#"><i class="material-icons">warning</i></a>
            </div>
                <div class="card-content">
                    <b>User name:</b> <p>{{$Order->User->name}}</p>
                    <b>Driver name:</b> <p>{{$Order->Driver->name}}</p>
                    <b>Distance:</b> <p>{{$Order->distance}} km.</p>
                    <b>Price:</b> <p>{{$Order->price}} .</p>
                    @if($Order->real_distance != null)
                    <b>Real distance:</b> <p>{{$Order->real_distance}} km.</p>
                    <b>Real price:</b> <p>{{$Order->real_sum}} .</p>
                    @endIf
                    <b>Status:</b><p> {{$Order->Status->name}}</p>
                    <b>Start point:</b> <p>{{$Order->start_address}} </p>
                    <b>End point:</b> <p>{{$Order->end_address}} </p>
                    <input type="hidden" id="paymentType" name="payment_type" value="{{$Order->payment_type}}" /> 
                    <input type="button" id="paymentTypeButton" class="btn " onclick="changeType();" id="create_order" value="asd"/>
                    <br>
                    <a class="btn-floating halfway-fab waves-effect waves-light red" href="{{action('OrderController@Map',['Order'=>$Order->id])}}"><i class="material-icons">map</i></a>
                </div>
                    
                    
                @if ($Order->Status->id < 5)
                <button class="btn " id="create_order" >Next status</button>
                @endIf
                
            </form>
        </div>
    </div>
</div>
<p>

</p>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script>

if (document.getElementById("statusId").value == 3 || document.getElementById("statusId").value == 4){
get_fb_complete();
}

    function get_fb_complete() {

$.ajax({
type: "GET",
        url: "getrealdistance/" + {{ $Order -> id}},
        cache: false,
        data: {'_token': $('meta[name="csrf-token"]').attr('content')},
        async: true
}).complete(function () {
}).responseText;
}

function changeType()
{
    if (document.getElementById('paymentType').value == 1)
    {
        document.getElementById('paymentType').value = 0;
        
    } else {
        document.getElementById('paymentType').value = 1;
    }
    showType();
}
showType();
 if(document.getElementById('paymentType').value == "")
        {
            document.getElementById('paymentType').value = 0;
        } 
function showType()
{

    if (document.getElementById('paymentType').value == 1) {
            document.getElementById('paymentTypeButton').value = 'Cash payment';
        } else {
            document.getElementById('paymentTypeButton').value = 'Card payment';
        }
    }
    
var flg = 0;
show();
setInterval(show, 5000);

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
            $('#hiddenitems').html(html);

            if ('Canceled' == document.getElementById("status").value && flg == 0) {

                      flg = 1;
                      Materialize.toast('Order:'+ {{$Order->id}} +' closed', 3000, 'rounded');
        
        } 
        }

    });


}
    
    
    
    
</script>
@endsection
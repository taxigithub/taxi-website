@extends('layouts.main')
@section('content')

@foreach ($paymentOptions as $paymentOption)
<div id="payWidget" style="display: none; position: fixed; top: 0; left: 0; z-index: 999999; width: 100%; height: 100%;"> <a  style="background: rgba(0, 0, 0, 0.8); position: fixed; top: 0; right: 0; display:block; white-space:nowrap;" onclick="document.getElementById('payWidget').style.display = 'none'">Закрыть</a> <iframe style="margin: 0 auto; display: block; width: 100%; height: 100%;" src="{{$paymentOption->url}}?amount={{$order->price}}&order_id={{$order->id}}"></iframe>
            </div>
<div class="row">
    <div class="col s12 m6">
        <div class="card">
            <div class="card-image">
                <img src="{{$paymentOption->pic}}">

            </div>
            
            <div class="card-content">


            </div>
            <div class="card-action">
                <a href="#" onclick="document.getElementById('payWidget').style.display='block'">Select</a>
            </div>
        </div>
    </div>

</div>
@endforeach
@endsection
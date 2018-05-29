@if (count($newOrders)>0)
@foreach($newOrders as $key => $value)
@if($value->Orders->status >1 && $value->Orders->status < 5)
<a style="background-color: red;" href="{{action('DriverController@ConfirmOrder',['Order'=>$value->Orders->id])}}" class="collection-item">{{$value->Orders->id}}. Date: {{$value->Orders->created_at}} Address: {{$value->Orders->start_address}} Price: {{$value->Orders->price}} </a>
@elseif($value->Orders->status == 1)
<a href="{{action('DriverController@ConfirmOrder',['Order'=>$value->Orders->id])}}" class="collection-item">{{$value->Orders->id}}. Date: {{$value->Orders->created_at}} Address: {{$value->Orders->start_address}} Price: {{$value->Orders->price}} </a>
@else 
@endIf
@endforeach
@endIf
<input type="hidden" id="newOrdersCount" value="{{count($newOrders)}}">
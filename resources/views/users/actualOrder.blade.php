
@if(count($actualOrders) > 0)
@foreach($actualOrders as $actualOrder)
<form method="POST"  action="{{action('ProfileController@CancelOrder',['Order'=>$actualOrder->id])}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="row collection-item" >
    
        <div class="col s11">
            <a class="collection-item" href="{{action('OrderController@Show',['Order'=>$actualOrder->id])}}" >order: {{$actualOrder->id}} {{$actualOrder->Status->name}}  </a>
        </div> 
        <div class="col s1">
            <input type="submit" class="btn red" value="X" />
        </div>


</div>
    </form>
@endforeach
@endIf

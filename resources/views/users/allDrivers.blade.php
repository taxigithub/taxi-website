<input type="hidden" id="drv_count" value="{{count($allDrivers)}}">

@foreach ($allDrivers as $key => $actDriver)
<input type="hidden" id="drv_latitude{{$key}}" name="drv_latitude{{$key}}" value="{{$actDriver->latitude}}" /> 
<input type="hidden" id="drv_longitude{{$key}}" name="drv_longitude{{$key}}" value="{{$actDriver->longitude}}" /> 
@endforeach


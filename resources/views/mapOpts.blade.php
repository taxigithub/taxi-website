<input type="hidden" id="drv_count" value="{{count($actDrivers)}}">

@foreach ($actDrivers as $key => $actDriver)
<input type="hidden" id="drv_latitude{{$key}}" name="drv_latitude{{$key}}" value="{{$actDriver->Driver->latitude}}" /> 
<input type="hidden" id="drv_longitude{{$key}}" name="drv_longitude{{$key}}" value="{{$actDriver->Driver->longitude}}" /> 
@endforeach


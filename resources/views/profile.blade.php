@extends('layouts.main')

@section('content')
  <div style=" z-index: 999999999999999; position: relative; top: 0; right: 90%; ">  <a class="btn-floating halfway-fab waves-effect waves-light red"  href="{{url('/')}}"><i class="material-icons">arrow_back</i></a></div>
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs ">
                <li class="tab"><a class="active" href="#test4">Profile</a></li>

                <li class="tab"><a  href="#userHistory">History</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="test4">
                <div class="card horizontal">
                    <div class="card-image">
                        <img style="width: 200px; height: 200px;" src="http://www.freeiconspng.com/uploads/profile-icon-9.png">

                        <span class="card-title">Profile</span>
                    </div>

                    <div class="card-content">
                        <p>Name:   {{ $userData->name }}</p>
                        <p>Phone: {{ $userData->phone }}</p>
                        <p>Email: {{ $userData->email }}</p>
                        <br />
                    </div>
                    <div class="card-action">
                        <a href="{{action('ProfileController@EditProfile')}}">Edit profile</a>
                        @if($driverId != NULL)
                        <a href="{{action('DriverController@Index')}}">Driver profile</a>

                        @endIf
                        @if($managerId != NULL)
                        <a href="{{action('ManagerController@Index')}}">Manager profile</a>

                        @endIf

                    </div>
                </div>
                <input type="hidden" id="ajaxurl" value="{{url('/')}}/actual">
                Actual order
                <div id="actualOrder" class="collection">

                </div>
            </div>
            <div id="userHistory">
                <div  class="collection">
                    @foreach($history as $historyItem)
                    <a href = "{{action('OrderController@Show',['Order'=>$historyItem->id])}}" class = "collection-item">{{$historyItem->id}}. Date:{{$historyItem->created_at}} Price: {{$historyItem->price}} </a>
                    @endforeach
                    {{ $history->fragment('userHistory')->links() }}


                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function updateDataOnPage() {
    $.ajax({
        url: document.getElementById("ajaxurl").value,
        dataType: 'html',
        data: {
            ajax: true
        }
        ,
        type: 'GET',
        success: function (html) {
            $('#actualOrder').html(html);
        }

    });


}
    updateDataOnPage();
    setInterval(updateDataOnPage,10000);
</script>

@endsection

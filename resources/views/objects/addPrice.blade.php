@extends('layouts.main')
@section('content')
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Add price</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <form method="POST" action="{{action('AdminController@StorePrice')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    {{--{{action('OrderController@Show',['Order'=>$historyItem->id])}}--}}
                    <input  type='text' id="primary_price" name="primary_price" value="" />
                    <label for='primary_price'>Primary price</label>
                    <input  type='text' id="secondrary_price" name="secondrary_price" value="" />
                    <label for='secondrary_price'>Secondrary price</label>
                    <br/>
                    <br/>
                    <button type='submit'  class='col s12 btn btn-large waves-effect '>Add price</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
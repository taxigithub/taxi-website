@extends('layouts.main')
@section('content')
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Add object</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <form method="POST" action="{{action('AdminController@StoreObject')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input  type='text' id="name" name="name" value="" />
                    <label for='name'>Name</label>
                    <input  type='text' id="description" name="description" value="" />
                    <label for='description'>Description</label>
                    <input  type='text' id="address" name="address" value="" />
                    <label for='address'>Address</label>
                    <input  type='text' id="driver_max_sum" name="driver_max_sum" value="" />
                    <label for='driver_max_sum'>Max sum for driver</label>
                    <div  class="input-field col s12">
                        <select id="id_price" name="id_price">
                            <option value="" disabled selected>Price</option>
                            @foreach($prices as $price)
                            <option value="{{$price->id}}">primary price:{{$price->primary_price}} secondrary price:{{$price->secondrary_price}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <br/>
                    <br/>
                    <button type='submit'  class='col s12 btn btn-large waves-effect '>Add object</button>
                </form>   
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.7.0.min.js"></script>
    <script>
$(document).ready(function () {
    $('select').material_select();
});
    </script>
    @endsection
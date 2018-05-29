@extends('layouts.main')
@section('content')
<div class="col s6 ">
    <div class="card ">
        <div class="card-tabs">
            <ul class="tabs">
                <li class="tab"><a class="active" href="#test4">Add driver</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-5">
            <div id="test4">
                <div class="collection">
                    <form class="form-horizontal" method="POST" action="{{action('ManagerController@StoreDriver')}}">
                        {{ csrf_field() }}
                        <div class='row'>
                            <div class='input-field col s12'>
                                <input type='text' name="phone" value="" required/>
                                <label for='phone'>Enter driver phone</label>
                            </div>

                            <button type='submit'  class='col s12 btn btn-large waves-effect '>Add driver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
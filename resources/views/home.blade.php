@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Seat Configurator</div>

                <div class="panel-body">
                    <form method="post" action="/configure">
                    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="k" class="col-sm-2 form-control-label">K Seats</label>
                            <div class="col-sm-10">
                                <input type="text" name="seats[k]" 
                                class="form-control" id="k" value="{{$seats['k'][0]->seats or 0}}"
                                placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="1st" class="col-sm-2 form-control-label">1st Seats</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$seats['1st'][0]->seats or 0}}" name="seats[1st]" class="form-control" id="1st" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="1st" class="col-sm-2 form-control-label">2nd Seats</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$seats['2nd'][0]->seats or 0}}" name="seats[2nd]" class="form-control" id="2nd" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="3rd" class="col-sm-2 form-control-label">3rd Seats</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$seats['3rd'][0]->seats or 0}}"name="seats[3rd]" class="form-control" id="3rd" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="4th" class="col-sm-2 form-control-label">4th Seats</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$seats['4th'][0]->seats or 0}}" name="seats[4th]" class="form-control" id="4th" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="5th" class="col-sm-2 form-control-label">5th Seats</label>
                            <div class="col-sm-10">
                                <input type="text"   value="{{$seats['5th'][0]->seats or 0}}" name="seats[5th]" class="form-control" id="5th" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="6th"  v class="col-sm-2 form-control-label">6th Seats</label>
                            <div class="col-sm-10">
                                <input type="text"  value="{{$seats['6th'][0]->seats or 0}}" name="seats[6th]" class="form-control" id="6th" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="7th" class="col-sm-2 form-control-label">7th Seats</label>
                            <div class="col-sm-10">
                                <input type="text"  value="{{$seats['7th'][0]->seats or 0}}" name="seats[7th]" class="form-control" id="7th" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="8th" class="col-sm-2 form-control-label">8th Seats</label>
                            <div class="col-sm-10">
                                <input type="text"   value="{{$seats['8th'][0]->seats or 0}}" name="seats[8th]" class="form-control" id="8th" placeholder="# of Seats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-secondary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

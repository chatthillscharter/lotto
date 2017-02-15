@extends('layouts.app')

@section('content')
    <div class="container">
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
    <form method="get" action="/lookup" class="form-inline">
        <div class="form-group">
            <label for="LotteryID">Your Lottery Number:</label>
            <input type="text" class="form-control" id="LotteryID" name="lotto_id" placeholder="555555">
        </div>
        <button type="submit" class="btn btn-primary">Lookup</button>
    </form>
        <div class="row">
            <div class="col-lg-3">
            <h1>Kindergarten</h1>
             @foreach ($lotto['K'] as $student)
                
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['k'][0]->seats+1)
                    active
                @endif">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
                
            @endforeach
            </div>
            <div class="col-lg-3">
            <h1>1st Grade</h1>
             @foreach ($lotto['1st'] as $student)
                
                <li class="list-group-item                 @if($student['pick_order'] < $thresholds['1st'][0]->seats+1)
                    active
                @endif">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
                
            @endforeach
            </div>
            <div class="col-lg-3">
            <h1>2nd Grade</h1>
            @foreach ($lotto['2nd'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['2nd'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>

            @endforeach
            </div>
        <div class="col-lg-3">
        <h1>3rd Grade</h1>
            @foreach ($lotto['3rd'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['3rd'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
        </div>
        <div class="row">

            <div class="col-lg-3">
            <h1>4th Grade</h1>
            @foreach ($lotto['4th'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['4th'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
            <div class="col-lg-3">
            <h1>5th Grade</h1>
            @foreach ($lotto['5th'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['5th'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
        <div class="col-lg-3">
        <h1>6th Grade</h1>
            @foreach ($lotto['6th'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['6th'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
                    <div class="col-lg-3">
                    <h1>7th Grade</h1>
            @foreach ($lotto['7th'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['7th'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
        </div>
        <div class="row">


            <div class="col-lg-3">
            <h1>8th Grade</h1>
            @foreach ($lotto['8th'] as $student)
                <li class="list-group-item 
                @if($student['pick_order'] < $thresholds['8th'][0]->seats+1)
                    active
                @endif
                ">{{$student['pick_order']}} - {{ $student['lotto_id'] }} - {{ $student['notes'] }}</li>
            @endforeach
            </div>
        </div>
    </div>
@endsection

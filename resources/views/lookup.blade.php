@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lookup {{ $lotto->lotto_id }}</div>
                <div class="panel-body">
                    Your lottery number: {{$lotto->lotto_id}} was chosen as #{{$lotto->pick_order}} in the {{$lotto->grade}} grade. There were {{$threshold->seats}}. 
                    @if($threshold->seats >= $lotto->pick_order)
                        Congratulations. Please call the school to get your paperwork in.
                    @else
                        Your child has been placed on our wait list. We will call you if a seat becomes available.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

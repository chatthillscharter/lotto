@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lookup {{ $lotto->lotto_id }}</div>
                <div class="panel-body">
                    Your lottery number: {{$lotto->lotto_id}} was chosen as #{{$lotto->pick_order}} in the {{$lotto->grade}} grade.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

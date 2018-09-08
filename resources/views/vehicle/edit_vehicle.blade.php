<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url' => 'vehicle/'.$vehicle->id, 'class' => 'form-horizontal', 'id'=>'vehicle', 'method'=>'put', 'files'=>true]) !!}
<div class="container-fluid">
    <div class='form-group'>
        {!! Form::label('name', 'Vehicle Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('vehicle_name', $vehicle->vehicle_name, ['class' => 'form-control input-sm required', 'placeholder'=>'Vehicle Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('seat', 'Seat *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('seat', $vehicle->seat, ['class' => 'form-control input-sm required', 'placeholder'=>'Seat']) !!}
        </div>
    </div>

    <div class='form-group'>
        {!! Form::label('rate', 'Rate *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('rate', $vehicle->rate, ['class' => 'form-control input-sm required', 'placeholder'=>'Rate']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}

<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'vehicle', 'class' => 'form-horizontal', 'id'=>'vehicle']) !!}
<div class="container-fluid">
    <div class='form-group'>
        {!! Form::label('name', 'Vehicle Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('vehicle_name', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Vehicle Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('seat', 'Seat *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('seat', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Seat']) !!}
        </div>
    </div>

    <div class='form-group'>
        {!! Form::label('rate', 'Rate/KM *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('rate', null, ['class' => 'form-control input-sm amount required', 'placeholder'=>'Rate/KM']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

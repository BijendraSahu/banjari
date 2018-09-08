<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'tour/'.$tour->id.'/add_vehicle', 'class' => 'form-horizontal', 'id'=>'hotel']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('vehicle_master_id', 'Select Vehicle *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('vehicle_master_id', $vehicles, null,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('comment', 'Comment', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('vehicle_comment', null, ['class' => 'form-control input-sm', 'placeholder'=>'Comment']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

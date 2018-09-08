<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'inclusion', 'class' => 'form-horizontal', 'id'=>'inclusion']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('place_master_id', 'Select Place *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('place_master_id', $places, null,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('name', 'Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('name', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('rate', 'Rate *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('rate', null, ['class' => 'form-control input-sm amount required', 'placeholder'=>'Rate']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('description', null, ['class' => 'form-control input-sm', 'placeholder'=>'Description', 'row'=>'5']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

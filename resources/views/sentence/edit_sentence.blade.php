<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'sentence/'.$sentence->id, 'class' => 'form-horizontal', 'id'=>'place', 'method'=>'put']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('start_location_id', 'Start Location*', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('start_location_id', $places, $sentence->start_location_id,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('end_location_id', 'End Location*', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('end_location_id', $places, $sentence->end_location_id,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('name', 'Sentence*', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('sentence', $sentence->sentence, ['class' => 'form-control input-sm required', 'placeholder'=>'Sentence','row'=>'5']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

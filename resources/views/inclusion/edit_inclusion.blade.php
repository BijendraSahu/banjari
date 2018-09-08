<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url' => 'inclusion/'.$inclusion->id, 'class' => 'form-horizontal', 'id'=>'inclusion', 'method'=>'put']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('place_master_id', 'Select Place *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('place_master_id', $places, $inclusion->place_master_id,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('name', 'Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('name', $inclusion->name, ['class' => 'form-control input-sm required', 'placeholder'=>'Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('rate', 'Rate *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('rate', $inclusion->rate, ['class' => 'form-control input-sm amount required', 'placeholder'=>'Rate']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('description', $inclusion->description, ['class' => 'form-control input-sm', 'placeholder'=>'Description', 'row'=>'5']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}

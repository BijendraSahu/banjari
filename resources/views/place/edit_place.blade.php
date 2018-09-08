<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url' => 'place/'.$place->id, 'class' => 'form-horizontal', 'id'=>'place', 'method'=>'put', 'files'=>true]) !!}
<div class="container-fluid">
    <div class='form-group'>
        {!! Form::label('name', 'Place Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('place_name', $place->place_name, ['class' => 'form-control input-sm required', 'placeholder'=>'Place Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}

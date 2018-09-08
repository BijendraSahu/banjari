<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url' => 'hotel/'.$hotel->id, 'class' => 'form-horizontal', 'id'=>'hotel', 'method'=>'put']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('place_master_id', 'Select Place *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('place_master_id', $places, $hotel->place_master_id,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('name', 'Hotel Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('hotel_name', $hotel->hotel_name, ['class' => 'form-control input-sm required', 'placeholder'=>'Hotel Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('contact', 'Contact *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('contact', $hotel->contact, ['class' => 'form-control input-sm required', 'placeholder'=>'Contact']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('address', 'Address *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::textarea('address', $hotel->address, ['class' => 'form-control input-sm required', 'placeholder'=>'Address', 'row'=>'5']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}

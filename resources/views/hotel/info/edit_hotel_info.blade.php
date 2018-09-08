<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url' => 'hotel_info/'.$hotel_info->id, 'class' => 'form-horizontal', 'id'=>'hotel', 'method'=>'put']) !!}
<div class="container-fluid">
    <div class="form-group">
        {!! Form::label('hotel_master_id', 'Select Hotel *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::select('hotel_master_id', $hotels, $hotel_info->hotel_master_id,['class' => 'form-control requiredDD']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('room_type', 'Room Type *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('room_type', $hotel_info->room_type, ['class' => 'form-control input-sm required', 'placeholder'=>'Room Type']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('rate', 'rate *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('rate', $hotel_info->rate, ['class' => 'form-control input-sm required', 'placeholder'=>'Rate']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>

</div>
{!! Form::close() !!}

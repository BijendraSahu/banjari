<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'tour/'.$tour->id, 'class' => 'form-horizontal', 'id'=>'tour', 'method'=>'put', 'files'=>true]) !!}

<div class="container-fluid">
    <div class='form-group'>
        {!! Form::label('name', 'Tour Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('tour_name', $tour->tour_name, ['class' => 'form-control input-sm required', 'placeholder'=>'Tour Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('start_date', 'Start Date *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('start_date', date_format(date_create($tour->start_date),'d-M-Y'), ['class' => 'form-control input-sm dtp required', 'placeholder'=>'Start Date']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('end_date', 'End Date *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('end_date', date_format(date_create($tour->end_date),'d-M-Y'), ['class' => 'form-control input-sm dtp required', 'placeholder'=>'End Date']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('tour_image', 'Tour Image*',  ['class' => 'col-sm-2 control-label', 'type'=>'file', 'accept'=>'image/*']) !!}
        <div class="col-sm-9">
            {!! Form::file('tour_image', null, ['class' => 'control-label input-sm required', 'type'=>'file', 'accept'=>'image/*']) !!}
        </div>
    </div>

    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
    $(function () {
        $('.dtp').datepicker({
            format: "dd-MM-yyyy",
//            maxViewMode: 5,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

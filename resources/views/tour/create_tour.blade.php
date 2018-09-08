@extends('layout.master.master')

@section('title','Create Tour')

@section('content')
    <style>
        .bigdropdown {
            width: 100% !important;
        }
    </style>
    <a href="{{url('tour')}}" class="btn btn-sm bg-danger btn-primary add-tour btnSet pull-right">
        <span class="fa fa-eye"></span>&nbsp;Tour List</a>
    <h3 class="heading bg-success">Create Tour</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    {!! Form::open(['url' => 'tour', 'class' => 'form-horizontal', 'id'=>'tour', 'files'=>true]) !!}
    <div class="container-fluid">
        <div class="form-group">
            {!! Form::label('lead_master_id', 'Lead Name *', ['class' => 'col-sm-2 control-label']) !!}
            <div class='col-sm-9'>
                {!! Form::select('lead_master_id', $leads, $lead_id,['class' => 'typeDD bigdropdown lead-dd', 'id'=>'lead_master_id']) !!}
            </div>
        </div>
        <p class="clearfix"></p>
        <div class='form-group'>
            {!! Form::label('name', 'Tour Name *', ['class' => 'col-sm-2 control-label']) !!}
            <div class='col-sm-9'>
                {!! Form::text('tour_name', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Tour Name']) !!}
            </div>
        </div>
        <div class='form-group'>
            {!! Form::label('start_date', 'Start Date *', ['class' => 'col-sm-2 control-label']) !!}
            <div class='col-sm-9'>
                {!! Form::text('start_date',$enq_info ? date_format(date_create($enq_info->enquiry_master->travel_date),'d-M-Y'): null, ['class' => 'form-control input-sm dtp required', 'placeholder'=>'Start Date']) !!}
            </div>
        </div>
        <div class='form-group'>
            {!! Form::label('end_date', 'End Date *', ['class' => 'col-sm-2 control-label']) !!}
            <div class='col-sm-9'>
                {!! Form::text('end_date', $enq_info ? date_format(date_create($enq_info->enquiry_master->tour_end_date),'d-M-Y'):null, ['class' => 'form-control input-sm dtp required', 'placeholder'=>'End Date']) !!}
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
                format: "dd-M-yyyy",
//            maxViewMode: 5,
                todayBtn: "linked",
                daysOfWeekHighlighted: "0",
                autoclose: true,
                todayHighlight: true
            });
        });

        $(function () {
            $(".typeDD").select2({
//            placeholder: "SELECT IMEI",
                dropdownAutoWidth: 'true',
                width: 'auto',
                cache: true
            });
        });
    </script>
@stop

{{--@extends('layout.master.master')--}}

{{--@section('title', 'Add Enquiry')--}}

{{--@section('content')--}}
<script src="{{ url('assets/js/validation.js') }}"></script>

{!! Form::open(['url'=>'enquiry', 'id'=>'frEnq']) !!}
<div class="container-fluid">
    <div class="col-sm-6">
        <h3 class="bg-info text-center">Basic Info</h3>
        <p class="clearfix"></p>
        <div class='form-group'>
            {!! Form::label('user_no', 'Enquiry No#', ['class' => 'col-sm-5 control-label']) !!}
            <div class='col-sm-7'>
                <label for="" class="badge">BJINQ-{{$enq_no}}</label>
                <input type="hidden" class="form-control" name="full_enquiry_no" value="BJINQ-{{$enq_no}}"
                       id="user_no">
                <input class="form-control" name="enquiry_no" type="hidden" value="{{$enq_no}}">
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('category', 'Category *', ['class' => 'col-sm-5 control-label']) !!}
            <div class='col-sm-7'>
                {!! Form::select('category_id', $categories, null,['class' => 'form-control requiredDD']) !!}
            </div>
        </div>
        <p class="clearfix"></p>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('name', null, ['class' => 'form-control input-sm input-sm textWithSpace required', 'placeholder'=>'Name']) !!}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('name', 'Contact', ['class'=>'col-sm-5 form-label']) !!}
            <div class="col-sm-7">
                {{ Form::text('contact', null, ['class' => 'form-control input-sm contact numberOnly required', 'placeholder'=>'Contact']) }}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('name', 'Email', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('email', null, ['class' => 'form-control input-sm', 'placeholder'=>'Email']) !!}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('no_of_person', 'No of Person', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('no_of_person', null, ['class' => 'form-control input-sm numberOnly', 'placeholder'=>'No of Person']) !!}
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('no_of_child(6-11)', 'No of Child(6-11)', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('no_of_child_above_5', null, ['class' => 'form-control input-sm numberOnly', 'placeholder'=>'No of Child(6-11)']) !!}
            </div>
        </div>

        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('No of Child(0-5)', 'No of Child(0-5)', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('no_of_child_upto_5', null, ['class' => 'form-control input-sm', 'placeholder'=>'No of Child(0-5)']) !!}
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <h3 class="bg-info text-center">Traveling Info</h3>
        {{--<p class="clearfix"></p>--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('enquiry_date', 'Enquiry Date', ['class' => 'col-sm-5 control-label']) !!}--}}
        {{--<div class="col-sm-7">--}}
        {{--{!! Form::text('enquiry_date', null, ['class' => 'form-control dtp input-sm', 'placeholder'=>'Enquiry Date']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('travel_date', 'Travel Date', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('travel_date', null, ['class' => 'form-control required dtp input-sm', 'placeholder'=>'Travel Date', 'id'=>'traveldate']) !!}
            </div>
        </div>
        {{--<p class="clearfix"></p>--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('departure_date', 'Departure Date', ['class' => 'col-sm-5 control-label']) !!}--}}
        {{--<div class="col-sm-7">--}}
        {{--{!! Form::text('departure_date', null, ['class' => 'form-control dtp input-sm', 'placeholder'=>'Departure Date']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}

        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('tour_start_from', 'Tour Start From', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('tour_start_from', null, ['class' => 'form-control input-sm', 'placeholder'=>'Tour Start From']) !!}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('departure_destination', 'Departure Destination', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('departure_destination', null, ['class' => 'form-control input-sm', 'placeholder'=>'Departure Destination']) !!}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('travel_duration', 'Travel Duration', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('travel_duration', null, ['class' => 'form-control input-sm', 'placeholder'=>'Travel Duration']) !!}--}}
                <select class="form-control requiredDD" name="travel_duration" id="duration">
                    <option value="0">Select</option>
                    <option value="1">1 Day</option>
                    <option value="2">2 Days</option>
                    <option value="3">3 Days</option>
                    <option value="4">4 Day</option>
                    <option value="5">5 Days</option>
                    <option value="6">6 Days</option>
                    <option value="7">7 Day</option>
                    <option value="8">8 Days</option>
                    <option value="9">9 Days</option>
                    <option value="10">10 Day</option>
                    <option value="11">11 Days</option>
                    <option value="12">12 Days</option>
                    <option value="13">13 Days</option>
                    <option value="14">14 Days</option>
                    <option value="15">15 Days</option>
                    <option value="16">16 Days</option>
                    <option value="17">17 Days</option>
                    <option value="18">18 Days</option>
                    <option value="19">19 Days</option>
                    <option value="20">20 Days</option>
                </select>
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('tour_end_date', 'Tour End Date', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::label('-', null, ['class' => 'form-control-label', 'placeholder'=>'Tour End Date', 'id'=>'enddate']) !!}
                {!! Form::text('tour_end_date', null, ['class' => 'form-control-label enddate hidden', 'placeholder'=>'Tour End Date', 'id'=>'enddate']) !!}
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('current_location', 'Current Location', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('current_location', null, ['class' => 'form-control input-sm', 'placeholder'=>'Current Location']) !!}
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('any_requirement', 'Remark', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::text('any_requirement', null, ['class' => 'form-control input-sm', 'placeholder'=>'Remark']) !!}
            </div>
        </div>

    </div>
    <p class="clearfix"></p>
    <p class="clearfix"></p>
    <div class="col-sm-12">
        <div class="form-group">
            <div class="">
                {{ Form::submit('Submit',['class'=>'btn btn-primary btn-xs btn-block','id'=>"commitBtn"]) }}
            </div>
        </div>
    </div>

</div>
{!! Form::close() !!}
{{--@stop--}}
<script>
    $(function () {
        $('.dtp').datepicker({
            format: "dd-MM-yyyy",
            maxViewMode: 2,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true,
//            minDate: 0,
            minDate: new Date()
        });
    });


    (function ($, window, document, undefined) {
        $("#duration").on("change", function () {
            var date = new Date($("#traveldate").val()),
                duration = parseInt($("#duration").val(), 10);
            if (!isNaN(date.getTime())) {
                date.setDate(date.getDate() + duration - 1);
                $(".enddate").val(date.toInputFormat());
                $("#enddate").html(date.toInputFormat());
            } else {
                alert("Invalid Tour End Date");
            }
        });
        //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
        Date.prototype.toInputFormat = function () {
            var yyyy = this.getFullYear().toString();
            var MM = (this.getMonth() + 1).toString(); // getMonth() is zero-based
            var dd = this.getDate().toString();
            return (dd[1] ? dd : "0" + dd[0]) + "-" + (MM[1] ? MM : "0" + MM[0]) + "-" + yyyy; // padding
        };
    })(jQuery, this, document);
</script>
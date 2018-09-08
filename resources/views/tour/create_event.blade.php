@extends('layout.master.master')

@section('title','Create Event')

@section('content')
    <style>
        .bigdropdown {
            width: 100% !important;
        }
    </style>
    <h3 class="heading bg-success">Create Tour Planning</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    {!! Form::open(['url' => 'event', 'class' => 'form-horizontal', 'id'=>'event']) !!}
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="bg-info text-center">Basic Info</h3>
            <p class="clearfix"></p>
            <div class='form-group'>
                {!! Form::label('name', 'Category*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('tour_info_id', $id, ['class' => 'form-control hidden input-sm required', 'placeholder'=>'Tour Name']) !!}
                    <select class="form-control category" name="category" id="category">
                        <option value="Activity">Activity</option>
                        <option value="Lodging">Lodging</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Other Info">Other Info</option>
                    </select>
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('type', 'Type *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-5'>
                    <p id="type1">
                        <select class="form-control" name="type">
                            <option value="Check-in">Check-in</option>
                            <option value="Check-out">Check-out</option>
                        </select>
                    </p>

                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('published_at', 'Publish On') !!}--}}
                    {{--{!! Form::input('date','published_at', Carbon\Carbon::now()->toDateTimeString(), ['class' => 'form-control']) !!}--}}
                    {{--<input class="form-control" name="published_at" type="date" value="15:58" id="published_at">--}}
                    {{--</div>--}}

                    {{--<p id="type2">--}}
                        {{--<select class="form-control" name="type">--}}
                            {{--<option value="Arrival">Arrival</option>--}}
                            {{--<option value="Departure">Departure</option>--}}
                        {{--</select>--}}
                    {{--</p>--}}
                </div>
                <div class='col-sm-4'>
                    {!! Form::text('time', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Time']) !!}

                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('title', 'Title *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('title', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Title']) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('notes', 'Notes', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('notes', null, ['class' => 'form-control input-sm', 'placeholder'=>'Notes']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="bg-info text-center">Other Info</h3>
            {{--<div class='form-group'>--}}
            {{--{!! Form::label('date', 'Date *', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class='col-sm-9'>--}}
            {{--{!! Form::text('date', null, ['class' => 'form-control input-sm dtp required', 'placeholder'=>'Date']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class='form-group'>
                {!! Form::label('duration', 'Duration', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::text('duration', null, ['class' => 'form-control input-sm', 'placeholder'=>'Duration']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('vehicle_master_id', 'Vehicle *', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('vehicle_master_id', $vehicles, null,['class' => 'form-control requiredDD']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('hotel_master_id', 'Hotel', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-9'>
                    {!! Form::select('hotel_master_id', $hotels, null,['class' => 'typeDD bigdropdown hotel-dd', 'id'=>'hotel_master_id']) !!}
                </div>
            </div>
            {{--<div class="form-group">--}}
            {{--{!! Form::label('hotel_info_id', 'Select Rooms', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class='col-sm-9'>--}}
            {{--{!! Form::select('hotel_info_id[]', [], null,['class' => 'form-control typeDD wdd requiredDD', 'multiple'=>'multiple', 'id'=>'room_id']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class='form-group'>
                {!! Form::label('hotel_info_id', 'Select Rooms', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    <div id='chkBoxContainer'>

                    </div>
                </div>
            </div>

        </div>
        <div class='form-group'>
            <div class='col-sm-offset-6 col-sm-6'>
                {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary btn-block']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    {{--<link rel="stylesheet" href="{{ url('assets/css/select2.css')}}">--}}

    {{--<script src="{{ url('assets/js/select2.js') }}"></script>--}}
    <script>

        $(function () {
            $(".typeDD").select2({
//            placeholder: "SELECT IMEI",
                dropdownAutoWidth : 'true',
                width: 'auto',
                cache: true
            });
        });

        $(document).ready(function () {
            $(".hotel-dd").val('0');

        });

        {{--$(".hotel-dd").change(function () {--}}
    {{--//        $(".dd_imei").val('0');--}}
    {{--//        if ($(".hotel-dd").val() == '0') {--}}
    {{--//            $('#room_id').html('');--}}
    {{--//        }--}}
    {{--//        else {--}}
            {{--var id = $("#hotel_master_id").val();--}}
            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--contentType: "application/json; charset=utf-8",--}}
                {{--url: "{{ url('_groom') }}",--}}
                {{--data: '{"data":"' + id + '"}',--}}
                {{--success: function (data) {--}}
                    {{--console.log(data);--}}
                    {{--var obj = jQuery.parseJSON(data);--}}
                    {{--//alert(obj.id);--}}
                    {{--var listItems = '';--}}
                    {{--for (var i = 0; i < obj.arr.length; i++) {--}}
                        {{--listItems += "<option value='" + obj.arr[i].id + "'>" + obj.arr[i].room_type + "</option>";--}}
                    {{--}--}}
                    {{--$("#room_id").html(listItems);--}}
                {{--},--}}
                {{--error: function (xhr, status, error) {--}}
                    {{--alert('xhr.responseText');--}}
                {{--}--}}
            {{--});--}}
    {{--//        }--}}
        {{--});--}}

    $(".hotel-dd").change(function () {
            var id = $("#hotel_master_id").val();
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_groom') }}",
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#chkBoxContainer').html(data);
                },
                error: function (xhr, status, error) {
                    alert('xhr.responseText');
                }
            });
        });
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
//        $(function() {
//            $('#type1').hide();
//            $('#type2').hide();
//            $('#category').change(function(){
//                if($("#category").val() == 'Transportation') {
//                    $('#type2').show();
//                    $('#type1').hide();
//                } else {
//                    $('#type1').show();
//                    $('#type2').hide();
//                }
//            });
//        });
    </script>
@stop
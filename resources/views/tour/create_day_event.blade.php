@extends('layout.master.master')

@section('title','Create Event')

@section('content')
    <style>
        .bigdropdown {
            width: 100% !important;
        }
    </style>
    <h3 class="heading bg-success">Create Tour Event</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    {!! Form::open(['url' => 'itinerary', 'class' => 'form-horizontal', 'id'=>'itinerary']) !!}
    <div class="container-fluid">
        <div class="col-sm-12">
            <h3 class="bg-info text-center">Basic Info</h3>
            <p class="clearfix"></p>
            <div class='form-group'>
                {!! Form::label('name', 'Start Location*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-6'>
                    {!! Form::text('tour_info_id', $id, ['class' => 'form-control hidden input-sm required', 'placeholder'=>'Tour Info Id']) !!}
                    {!! Form::select('start_location_id', $places, null,['class' => 'typeDD bigdropdown start-dd', 'id'=>'start']) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('name', 'End Location*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-6'>
                    {!! Form::select('end_location_id', $places, null,['class' => 'typeDD bigdropdown end-dd', 'id'=>'end']) !!}

                </div>
                <div class='col-sm-3'>
                    <a href="#" class="btn btn-sm btn-xs bg-danger btn-primary add-sentence">
                        <span class="fa fa-plus"></span>&nbsp;Create New</a>
                </div>
            </div>

            <div class='form-group'>
                <div class='form-group'>
                    {!! Form::label('hotel_info_id', 'Select Sentences', ['class' => 'col-sm-2 control-label']) !!}
                    <div class='col-sm-10'>
                        <div id='sentence'>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <h3 class="bg-info text-center">Other Info</h3>

                <div class="form-group">
                    {!! Form::label('hotel_master_id', 'Hotel', ['class' => 'col-sm-2 control-label']) !!}
                    <div class='col-sm-9'>
                        {!! Form::select('hotel_master_id', $hotels, null,['class' => 'typeDD bigdropdown hotel-dd', 'id'=>'hotel_master_id']) !!}
                    </div>
                </div>

                <div class='form-group'>
                    {!! Form::label('hotel_info_id', 'Select Rooms', ['class' => 'col-sm-2 control-label']) !!}
                    <div class='col-sm-10'>
                        <div id='chkBoxContainer'>

                        </div>
                    </div>
                </div>

            </div>
            <div class='form-group'>
                <div class='col-sm-offset-3 col-sm-6'>
                    <input class="floatright btn btn-sm btn-primary btnSubmit btn-block" type="submit" value="Submit"/>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    {{--<link rel="stylesheet" href="{{ url('assets/css/select2.css')}}">--}}

    {{--<script src="{{ url('assets/js/select2.js') }}"></script>--}}
    <script>
        $(function () {
            $('form#itinerary').submit(function () {
                var c = confirm("Are you sure to continue?");
                return c;
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

        $(document).ready(function () {
            $(".hotel-dd").val('0');
            $(".end-dd").val('0');

        });

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

        $(".end-dd").change(function () {
            var startid = $("#start").val();
            var endid = $("#end").val();
//            alert(endid);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gsentence') }}",
//                data: '{"data":"' + endid + '"}',
//                data: {startid: startid, endid: endid},
                data: '{"data1":"' + startid + '", "data2":"' + endid + '"}',
                success: function (data) {
                    $('#sentence').html(data);
                },
                error: function (xhr, status, error) {
                    alert('xhr.responseText');
                }
            });
        });

        $(".add-sentence").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Sentence');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('sentence/create') }}",
                success: function (data) {
                    $('.modal-body').html(data);
//            $('#modelBtn').visible(disabled);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });

        });

        //        $(function () {
        //            $('.dtp').datepicker({
        //                format: "dd-MM-yyyy",
        ////            maxViewMode: 5,
        //                todayBtn: "linked",
        //                daysOfWeekHighlighted: "0",
        //                autoclose: true,
        //                todayHighlight: true
        //            });
        //        });
    </script>
@stop
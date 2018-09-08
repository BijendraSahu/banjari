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
                {!! Form::label('name', 'Pickup From*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-5'>
                    {!! Form::text('tour_info_id', $id, ['class' => 'form-control hidden input-sm required', 'placeholder'=>'Tour Name']) !!}
                    {!! Form::select('pickup_from_id', $places, null,['class' => 'typeDD bigdropdown', 'id'=>'pickup_from_id']) !!}
                </div>
                <div class='col-sm-5'>
                    {!! Form::text('pickup_from_text', null, ['class' => 'form-control input-sm pickupfromtext', 'placeholder'=>'Optional Text', 'id'=>'pickup_from_text']) !!}
                </div>
            </div>

            <div class='form-group'>
                {!! Form::label('name', 'Transfer To*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-5'>
                    {!! Form::select('transfer_to_id', $places, null,['class' => 'typeDD bigdropdown', 'id'=>'transfer_to_id']) !!}
                </div>
                <div class='col-sm-5'>
                    {!! Form::text('transfer_to_text', null, ['class' => 'form-control input-sm transfertotext', 'placeholder'=>'Optional Text']) !!}
                </div>
            </div>


            <div class='form-group'>
                {!! Form::label('name', 'Full Day*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-5'>
                    {!! Form::select('full_day_inclusion_id', $inclusions, null,['class' => 'typeDD bigdropdown', 'id'=>'full_day_inclusion_id']) !!}
                </div>
                <div class='col-sm-5'>
                    {!! Form::text('full_day_text', null, ['class' => 'form-control input-sm', 'placeholder'=>'Optional Text']) !!}
                </div>
            </div>


            <div class='form-group'>
                {!! Form::label('name', 'Night Stay*', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-5'>
                    {!! Form::select('night_stay_id', $places, null,['class' => 'typeDD bigdropdown', 'id'=>'night_stay_id']) !!}
                </div>
                <div class='col-sm-5'>
                    {!! Form::text('night_stay_text', null, ['class' => 'form-control input-sm', 'placeholder'=>'Optional Text']) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::label('other_text', 'Other Text', ['class' => 'col-sm-2 control-label']) !!}
                <div class='col-sm-10'>
                    {!! Form::text('other_text', null, ['class' => 'form-control input-sm', 'placeholder'=>'Other Text']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <h3 class="bg-info text-center">Other Info</h3>
            {{--<div class='form-group'>--}}
            {{--{!! Form::label('date', 'Date *', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class='col-sm-9'>--}}
            {{--{!! Form::text('date', null, ['class' => 'form-control input-sm dtp required', 'placeholder'=>'Date']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('vehicle_master_id', 'Vehicle *', ['class' => 'col-sm-2 control-label']) !!}--}}
            {{--<div class='col-sm-9'>--}}
            {{--{!! Form::select('vehicle_master_id', $vehicles, null,['class' => 'form-control requiredDD']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
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
            <div class='col-sm-offset-3 col-sm-6'>
{{--                {!! Form::button('Submit', ['class' => 'btn btn-sm btn-primary btnSubmit btnsbmt btn-block']) !!}--}}
                <input class="floatright btn btn-sm btn-primary btnSubmit btn-block" type="submit" value="Submit" />
                {{--<button type="button" id="{{ $tour->id }}"--}}
                        {{--class="btn btn-sm btn-danger btn-xs btnDelete" title="Delete"><span--}}
                            {{--class="fa fa-trash-o" aria-hidden="true"></span>Remove--}}
                {{--</button>--}}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    {{--<link rel="stylesheet" href="{{ url('assets/css/select2.css')}}">--}}

    {{--<script src="{{ url('assets/js/select2.js') }}"></script>--}}
    <script>
        $(function() {
            $('form#itinerary').submit(function() {
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

        });

        $(document).on('focus', '.pickupfromtext', function () {
            $(this).autocomplete({
                source: '{{url('gpdetail')}}',
                minLength: 1,
                autoFocus: true,
            });
        });

        $(document).on('focus', '.transfertotext', function () {
            $(this).autocomplete({
                source: '{{url('transfersearch')}}',
                minLength: 1,
                autoFocus: true,
//                select: function (e, ui) {
//                    id_arr = $(this).attr('id');
//                    id = id_arr.split("_");
//                    $('#itemName_' + id[1]).val(ui.item.item_name);
//                }
            });
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
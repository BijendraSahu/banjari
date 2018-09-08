@extends('layout.master.master')

@section('title','Create Itinerary')

@section('content')
    <style>
        .badgedate {
            margin-top: 8px;
            font-size: 13px;
            background-color: #734028;
        }
    </style>
    @if(session()->has('message'))
        <script type="text/javascript">
            setTimeout(function () {
                ShowSuccessPopupMsg('{{ session()->get('message') }}');
            }, 500);
        </script>
    @endif
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="{{url('tour')}}" class="btn btn-sm bg-danger btnSet btn-primary add-tour btnSet pull-right">
        <span class="fa fa-eye"></span>Back To Tour List</a>
    <h3 class="heading bg-success">Create Tour Itinerary For {{$tour->lead_master->name}}</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    {{--<div class="container-fluid">--}}

    {{--</div>--}}
    <div class="row">
        <div class="col-sm-4">
            <!--left col-->
            <?php $counter = 1; ?>
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">
                    <h4><strong>Trip Information</strong>
                        <button class="btn btn-primary btn-xs" onclick="add_days({{$tour->id}});" id="add_days">Add
                            Day
                        </button>
                        <button class="btn btn-danger btn-xs" onclick="remove_days({{$tour->id}});" id="add_days">Remove
                            Day
                        </button>
                    </h4>

                </li>
                @foreach($tour_info as $info)
                    <li class="list-group-item" style="font-size: 13px;">
                        <strong class="badge badgedate">Day {{$counter}} {{$nameOfDay = date('l', strtotime($info->date))}} {{date_format(date_create($info->date), "d-M-Y") }}</strong>
                        @if($info->is_event_created == 1)
                            <a href="#" id="{{$info->id}}"
                               class="btn btn-primary btn-xs  view-hotel date">
                                <span class="fa fa-eye" aria-hidden="true"></span> View Event
                            </a>
                            @if($info->hotel_master_id != null)
                                <p class="h4">{{$info->hotel_master->hotel_name}}</p>
                            @endif
                        @else
                            -
                        @endif
                    </li>
                    <?php $counter++ ?>
                @endforeach
                <li class="list-group-item text-left" style="font-size: 13px;">
                    @if($tour->vehicle_master_id == null)
                        <a href="#" id="{{$tour->id}}"
                           class="btn btn-success btn-xs create-vehicle">
                            <i class="fa fa-plus"></i>Add Transportation</a>
                    @else
                        <a href="#" id="{{$tour->id}}"
                           class="btn btn-primary btn-xs view-vehicle">
                            <i class="fa fa-eye"></i>View Transportation</a>
                        {{--<a href="#" id="{{$tour->id}}"--}}
                        {{--class="btn btn-danger btn-xs remove-vehicle">--}}
                        {{--<i class="fa fa-trash-o"></i>Remove</a>--}}
                        <button type="button" id="{{ $tour->id }}"
                                class="btn btn-sm btn-danger btn-xs btnDelete" title="Delete"><span
                                    class="fa fa-trash-o" aria-hidden="true"></span>Delete
                        </button>
                    @endif
                </li>
                <li class="list-group-item text-left" style="font-size: 13px;">
                    @if($tour->is_inclusion_added == 0)
                        <a href="#" id="{{$tour->id}}"
                           class="btn btn-success btn-xs create-inclusion">
                            <i class="fa fa-plus"></i>Add Inclusions</a>
                    @else
                        <a href="#" id="{{$tour->id}}"
                           class="btn btn-primary btn-xs view-inclusion">
                            <i class="fa fa-eye"></i>View Inclusions</a>
                        {{--<a href="#" id="{{$tour->id}}"--}}
                        {{--class="btn btn-danger btn-xs remove-vehicle">--}}
                        {{--<i class="fa fa-trash-o"></i>Remove</a>--}}
                        <button type="button" id="{{ $tour->id }}"
                                class="btn btn-sm btn-danger btn-xs btninclusion" title="Delete"><span
                                    class="fa fa-trash-o" aria-hidden="true"></span>Delete
                        </button>
                    @endif
                </li>
            </ul>

            <h4>Sub Total : <i class="fa fa-inr"></i> {{$grand_total}}
                <br>Markup({{round($tour->lead_master->enquiry_master->enquiry_category->percent)}}%) : <i
                        class="fa fa-inr"></i> {{$grand_total * $tour->lead_master->enquiry_master->enquiry_category->percent /100}}
                <br>Grand Total: <i
                        class="fa fa-inr"></i>{{$grand_total * (100 + $tour->lead_master->enquiry_master->enquiry_category->percent) /100}}
            </h4>

        </div>

        <div class="col-sm-8" style="" contenteditable="false">
            <div class="panel panel-default target">
                <a href="#" id="{{$tour->lead_master->enquiry_master_id}}"
                   class="btn btn-info btn-xs pull-right view-enquiry_">View Enquiry</a>
                <a href="{{url('itinerary').'/'.$tour->id}}/print" target="_blank"
                   class="btn btn-primary btn-xs bg-danger btn-primary pull-right">
                    <span class="fa fa-print"></span>Print Itinerary</a>
                <div class="panel-heading" contenteditable="false"><h4>{{$tour->tour_name}}</h4>

                </div>
                {{--<div class="panel-body" id='chkBoxContainer'>--}}

                {{--</div>--}}
                <div class="panel-body" id='chkBoxContainer'>
                    <?php $counter = 1; ?>
                    @foreach($tour_info as $info)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="thumbnail">
                                    <div class="caption">
                                        @if($info->is_event_created == 1)
                                            <button type="button" id="{{ $info->id }}"
                                                    class="btn btn-sm btn-danger btn-xs btnSet deleteinfo pull-right"
                                                    title="Delete"><span
                                                        class="fa fa-trash-o" aria-hidden="true"></span>Delete
                                            </button>
                                        @else
                                            <a href="{{url('itinerary')}}/{{$info->id}}/create" id="{{$info->id}}"
                                               class="btn btn-sm btn-primary btn-xs btnSet pull-right"
                                               style="margin-left: 10px;">
                                                <i class="fa fa-plus"></i>Create</a>
                                        @endif
                                        <h3 class="bg-info text-center">
                                            @if($info->sentence_master_id != null)
                                                {{$info->sentence_master->start_location->place_name}}
                                                - {{$info->sentence_master->end_location->place_name}}
                                            @else
                                                Day Description
                                            @endif
                                        </h3>
                                        <p class="clearfix"></p>
                                        <h5><b>DAY {{$counter}}:</b>
                                            @if($info->sentence_master_id != null)  {{$info->sentence_master->sentence}}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $counter++ ?>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="push"></div>
    </div>
    <script>

        function add_days(dis) {
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Add Itinerary Day');
            $('#myModal .modal-body').html('<h5>Are you sure want to add one more day<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('itinerary_day') }}/' + dis +
                '"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }

        function remove_days(dis) {
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Remove Itinerary Day');
            $('#myModal .modal-body').html('<h5>Are you sure want to remove day<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('itinerary_day') }}/' + dis +
                '/remove"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        }
        $(".view-hotel").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Day Information');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/itinerary/" + id + "/hotel";
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                }
            });
        });
        $(".view-vehicle").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Vehicle Information');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
//            console.log(id);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gvehicle') }}",
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                }
            });
        });
        $(".view-inclusion").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Inclusion Information');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
//            console.log(id);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_ginclusion') }}",
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                }
            });
        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Remove');
            $('#myModal .modal-body').html('<h5>Are you sure want to remove transportation<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('vehicle') }}/' + id +
                '/remove"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $('.btninclusion').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Remove');
            $('#myModal .modal-body').html('<h5>Are you sure want to remove inclusions<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('inclusion') }}/' + id +
                '/remove"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $('.deleteinfo').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Remove');
            $('#myModal .modal-body').html('<h5>Are you sure want to remove selected day info<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('itinerary') }}/' + id +
                '/remove"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $(".create-vehicle").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add Vehicle');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/tour/" + id + "/vehicle";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });
        $(".create-inclusion").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add Inclusion');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/tour/" + id + "/inclusion";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });

        $(".create-event").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Create Event');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/event/" + id + "/create";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });

        $(".view-enquiry_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('View Enquiry Details');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/enquiry/" + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });


    </script>
@stop

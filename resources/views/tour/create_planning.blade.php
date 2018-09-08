@extends('layout.master.master')

@section('title','Create Planning')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="{{url('tour')}}" class="btn btn-sm bg-danger btnSet btn-primary add-tour btnSet pull-right">
        <span class="fa fa-eye"></span>Back To Tour List</a>
    <h3 class="heading bg-success">Create Tour Planning</h3>
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
                <li class="list-group-item text-muted" contenteditable="false"><h4><strong>Trip Information</strong>
                    </h4></li>
                @foreach($tour_info as $info)

                    <li class="list-group-item text-right" style="font-size: 13px;"><span class="pull-left"><strong
                                    class="">Day {{$counter}} <p
                                        class="">{{$nameOfDay = date('l', strtotime($info->date))}}</p></strong></span>
                        {{--                        <a href="#" id="{{$info->id}}" class="btn btn-info btn-xs create-event">--}}
                        <a href="{{url('event')}}/{{$info->id}}/create" id="{{$info->id}}"
                           class="btn btn-info btn-xs create-">
                            <i class="fa fa-plus"></i>New Event</a>
                        <strong>
                            {{--<a href="/tour/{{$info->id}}/event" class="a_txt date" >--}}
                            {{--{{date_format(date_create($info->date), "d-M-Y") }} <i--}}
                            {{--class="fa fa-arrow-right"></i></a>--}}
                            <a href="#" id="{{$info->id}}" class="a_txt date">
                                {{date_format(date_create($info->date), "d-M-Y") }} <i
                                        class="fa fa-arrow-right"></i></a>
                        </strong>

                    </li>
                    <?php $counter++ ?>
                @endforeach
            </ul>

        </div>
        <!--/col-3-->


        <div class="col-sm-8" style="" contenteditable="false">
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">Starfox221's Bio</div>--}}
            {{--<div class="panel-body"> A long description about me.--}}

            {{--</div>--}}
            {{--</div>--}}
            <div class="panel panel-default target">
                <div class="panel-heading" contenteditable="false"><h4>{{$tour->tour_name}}</h4>

                </div>
                <div class="panel-body" id='chkBoxContainer'>
                    {{--<div class="row">--}}
                    {{--@if(count($tour_info_details) != 0)--}}
                    {{--@foreach($tour_info_details as $details)--}}
                    {{--{{$details->category}}--}}
                    {{--@endforeach--}}
                    {{--@foreach($tour_event as $event)--}}
                    {{--{{$event->hotel_master_id}}--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--<div class="col-md-12">--}}
                    {{--<div class="thumbnail">--}}
                    {{--<img alt="300x200" src="http://lorempixel.com/600/200/sports">--}}
                    {{--<div class="caption">--}}
                    {{--<h3>--}}
                    {{--Rocky--}}
                    {{--</h3>--}}
                    {{--<p>--}}
                    {{--Loves catnip and naps. Not fond of children.--}}
                    {{--</p>--}}
                    {{--<p>--}}

                    {{--</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>


        <div id="push"></div>
    </div>
    <script>

        $(".date").click(function () {
            var id = $(this).attr('id');
            console.log(id);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gevent') }}",
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#chkBoxContainer').html(data);
                },
                error: function (xhr, status, error) {
                    alert('xhr.responseText');
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
    </script>
@stop

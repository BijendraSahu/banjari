@extends('layout.master.master')

@section('title','Lead Lists')

@section('head')
    <style>
        .notifyLinks {
            margin-top: 0 !important;
        }

        .headMargin {
            margin-bottom: 10px !important;
        }

        .notifyRed {
            background-color: #d9534f !important;
        }
    </style>
@stop

@section('content')
    <h3 class="bg-success text-center">Lead List</h3><p class="clearfix"></p>
    <div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="panel panel-body panel-danger">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="h5 pull-left"><strong>Filter Table Records:</strong></div>
                    {{--<label> {{ Form::radio('filter','all', true) }} &nbsp;<span class="badge">All</span></label>--}}
                    {{--<label> {{ Form::radio('filter','fresh') }} &nbsp;<span class="badge">Fresh</span></label>--}}
                    {{--<label> {{ Form::radio('filter','assigned') }} &nbsp;<span class="badge">Assigned</span></label>--}}
                    {{--<label> {{ Form::radio('filter','followup') }} &nbsp;<span class="badge">Follow-up</span></label>--}}
                    {{--<label> {{ Form::radio('filter','converted') }} &nbsp;<span class="badge">Converted</span></label>--}}
                    {{--<label> {{ Form::radio('filter','completed') }} &nbsp;<span class="badge">Closed</span></label>--}}
                    {{--<label> {{ Form::radio('filter','not_interested') }} &nbsp;<span class="badge">Not Interested</span></label>--}}

                    {{-- Button group filter --}}
                    <div class="btn-group pull-right" data-toggle="buttons">
                        <label class="btn btn-default notifyLinks active" onclick="window.location.href='{{url('lead/1/filter')}}'" id="1">
                            <input type="radio" name="filter" id="1" value="all"/>All
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(1)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/6/filter')}}'" id="6">
                            <input type="radio" name="filter" id="6" value="fresh"/>Fresh
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(6)}}</span>
                        </label>
                        {{--<label class="btn btn-default notifyLinks">--}}
                        {{--<input type="radio" name="filter" id="2" value="assigned"/>Assigned--}}
                        {{--<span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(2)}}</span>--}}
                        {{--</label>--}}
                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/3/filter')}}'" id="3">
                            <input type="radio" name="filter" id="3" value="followup"/>Follow up
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(3)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/4/filter')}}'" id="4">
                            <input type="radio" name="filter" id="4" value="converted"/>Converted
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(4)}}</span>
                        </label>

                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/5/filter')}}'" id="5">
                            <input type="radio" name="filter" id="5" value="completed"/>Completed
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(5)}}</span>
                        </label>

                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/7/filter')}}'" id="7">
                            <input type="radio" name="filter" id="7" value="not_interested"/>Not Interested
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(7)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks" onclick="window.location.href='{{url('lead/8/filter')}}'" id="8">
                            <input type="radio" name="filter" id="8" value="not_interested"/>Today Followup
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(8)}}</span>
                        </label>
                    </div>
                    {{-- Button group filter --}}

                </div>
            </div>
            <div class="col-md-2">
                <div>
                    {{--<h4>Add New</h4>--}}
                    {{--<a href="{{ url('lead/create') }}" type="button" class="btn btn-sm btn-success">--}}
                    {{--<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Add New Lead</a>--}}

                    {{--<a href="#" type="button" class="btn btn-sm btn-primary add-lead_">--}}
                    {{--<span class="glyphicon glyphicon-plus"></span>&nbsp;Add New Lead</a>--}}
                </div>
            </div>
        </div>

    </div>
    <p class="clearfix"></p>
    <p class="clearfix"></p>
    <div>
        <div id="leadTable">

        </div>
    </div>

    <script>
        function getLeadsbyid(dis) {
            var btnId = $(dis).attr('id');
            $('#leadTable').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
//            var btnId = this.id;
            var formData = '_token=' + $('.token').val();
            var send_to_url = '{{ url('/') }}' + "/lead/" + btnId + "/filter";
//            alert(send_to_url);
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: send_to_url,
//                data: '{"formData":"' + formData + '"}',
                data: {pageno: 20, btn: btnId},
                beforeSend: function () {
                    $('#leadTable').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
                },
                success: function (data) {
                    $("#leadTable").html(data);
                },
                error: function (xhr, status, error) {
                    //alert('Error occurred');
                    $("#leadTable").html(xhr.responseText);
                }
            });
        }


        $(document).ready(function () {
//            $(window).on('load', function () {
            var formData = '_token=' + $('.token').val();
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: '{{ url('/') }}' + "/lead/1/filter",
                data: {pageno: 20, btn: 20},
                beforeSend: function () {
                    $('#leadTable').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
                },
                success: function (data) {
                    $("#leadTable").html(data);
                },
                error: function (xhr, status, error) {
                    //alert('Error occurred');
                    $("#leadTable").html(xhr.responseText);
                }
            });
//            });
        });
    </script>
@stop
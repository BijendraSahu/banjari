{{--<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" media='all' rel='stylesheet'/>--}}
{{--<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>--}}

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
                        <label class="btn btn-default notifyLinks active"
                               onclick="window.location.href='{{url('lead/1/filter')}}'" id="1">
                            <input type="radio" name="filter" id="1" value="all"/>All
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(1)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/6/filter')}}'" id="6">
                            <input type="radio" name="filter" id="6" value="fresh"/>Fresh
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(6)}}</span>
                        </label>
                        {{--<label class="btn btn-default notifyLinks">--}}
                        {{--<input type="radio" name="filter" id="2" value="assigned"/>Assigned--}}
                        {{--<span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(2)}}</span>--}}
                        {{--</label>--}}
                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/3/filter')}}'" id="3">
                            <input type="radio" name="filter" id="3" value="followup"/>Follow up
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(3)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/4/filter')}}'" id="4">
                            <input type="radio" name="filter" id="4" value="converted"/>Converted
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(4)}}</span>
                        </label>

                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/5/filter')}}'" id="5">
                            <input type="radio" name="filter" id="5" value="completed"/>Completed
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(5)}}</span>
                        </label>

                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/7/filter')}}'" id="7">
                            <input type="radio" name="filter" id="7" value="not_interested"/>Not Interested
                            <span class="badge notifyRed">{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount(7)}}</span>
                        </label>
                        <label class="btn btn-default notifyLinks"
                               onclick="window.location.href='{{url('lead/8/filter')}}'" id="8">
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
            <table id="" class="table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr class="bg-info">
                    <th class="text-center">Id#</th>
                    <th class="text-center">Enquiry#</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Contact Info</th>
                    <th class="text-center">Created On</th>
                    <th class="text-center">Last Visited</th>
                    <th class="text-center">Next Followup Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Allocated To</th>
                    <th class="text-center">Operations</th>
                </tr>
                </thead>
                <tbody>
                <?php $counter = 1; ?>
                @foreach($lead as $item)
                    <tr class="{{ ($item->is_completed == 1 && $item->is_converted == 1) ? 'bg-success' : '' }} text-center">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->enquiry_master->full_enquiry_no }}</td>
                        <td>@if($item->enquiry_master->enquiry_category_id != null){{ $item->enquiry_master->enquiry_category->category_name }}@else
                                - @endif</td>
                        <td title="Remark- {{$item->enquiry_master->any_requirement}}">{{ $item->name }}</td>
                        <td>{{ $item->contact }}, {{ $item->email }}
                            , {{ is_null($item->address)? " - " : $item->address }}</td>
                        <td>{{ ($item->created_date == null)? " - " :  date_format(date_create($item->created_date),"d-M-Y h:i A") }}</td>
                        <td>{{ ($item->last_visited_date == null)? " - " : date_format(date_create($item->last_visited_date), "d-M-Y") }}</td>
                        <td>{{ ($item->next_followup_date == null)? " - " : date_format(date_create($item->next_followup_date), "d-M-Y") }}</td>
                        <td>{{ ($item->lead_status_id == null)? " - " : $item->lead_status->status }}</td>
                        <td>{{ ($item->user_master_id != null)? $item->user_master->name :  " - "}}</td>

                        <td id="{{ $item->id  }}">
                            @if($item->is_completed == 0 & $role_master_id == 1)
                                <a href="#" class="btn-sm btn-danger btn-xs glyphicon glyphicon-eye-close delete_lead"
                                   title="Close Lead" onclick="close_lead(this);"></a>
                                {{--@else--}}
                                {{--<button type="button" id="{{ $item->id }}" class="btn-sm btn-danger btn-xs btnDelete"><span--}}
                                {{--class="glyphicon glyphicon-trash" title="Delete Lead" aria-hidden="true"></span>--}}
                                {{--</button>--}}
                            @endif
                            {{--<a href="#" class="btn-sm btn-warning btn-xs glyphicon glyphicon-pencil edit-lead_" title="Edit"></a>--}}
                            {{--@if($item->is_assigned != 1 && $item->is_converted != 1 && $item->is_completed == 1)--}}
                            <a id="{{$item->enquiry_master_id}}"
                               class="btn-sm btn-info btn-xs glyphicon glyphicon-eye-open view-enquiry_"
                               onclick="view_inquiry(this);" title="View Enquiry"></a>
                            <a href="{{url('tour').'/'.$item->id.'/create'}}"
                               class="btn-sm btn-info btn-xs glyphicon glyphicon-plus"
                               title="Generate Tour">
                            </a>
                            <a class=" btn-sm btn-success btn-xs glyphicon glyphicon-comment view-comment"
                               title="View Communication"
                               onclick="getCommunication({{$item->id}});"><strong></strong></a>
                            <a href="#" id="{{$item->enquiry_master_id}}" onclick="edit_inquiry(this);"
                               class="btn-sm btn-success btn-xs edit-enquiry_ glyphicon glyphicon-pencil"
                               title="Edit Enquiry"></a>
                            {{--<div id="comment" class="comments hidden">{!!$item->communication!!}</div>--}}
                            @if($_SESSION['user_master']->role_master_id == 1)
                                <a href="#" class="btn-sm btn-primary assign btn-xs glyphicon glyphicon-share-alt"
                                   data-toggle="modal" onclick="assign_to_executive(this);"
                                   title="Assign To Executive"></a>
                            @else
                                <a href="#" class="btn-sm btn-primary btn-xs glyphicon glyphicon-cloud btnFollowUp"
                                   title="Need Followup" onclick="getfollowup({{$item->id}});">
                                </a>
                                <a href="#" class="btn-sm btn-success btn-xs glyphicon glyphicon-check btnConvert"
                                   title="Converted" onclick="getConverted({{$item->id}});">
                                </a>
                                <a href="#" class="btn-sm btn-danger btn-xs glyphicon glyphicon-cloud btnNoReponse"
                                   title="No Response" onclick="getNoResponse({{$item->id}});">
                                </a>
                            @endif
                            @if($item->is_itinerary_created == 1)
                                <a href="{{url('tour').'/'.$item->id.'/itinerary_by_lead'}}"
                                   class="btn-sm btn-primary btn-xs glyphicon glyphicon-italic"
                                   title="View Itinerary Tour"></a>
                            @endif

                            {{--@endif--}}
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
                </tbody>
            </table>
            <div align="center">
                {{$lead->links()}}
            </div>
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


        {{--$(document).ready(function () {--}}
        {{--//            $(window).on('load', function () {--}}
        {{--var formData = '_token=' + $('.token').val();--}}
        {{--$.ajax({--}}
        {{--type: "get",--}}
        {{--contentType: "application/json; charset=utf-8",--}}
        {{--url: '{{ url('/') }}' + "/lead/1/filter",--}}
        {{--data: {pageno: 20, btn: 20},--}}
        {{--beforeSend: function () {--}}
        {{--$('#leadTable').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');--}}
        {{--},--}}
        {{--success: function (data) {--}}
        {{--$("#leadTable").html(data);--}}
        {{--},--}}
        {{--error: function (xhr, status, error) {--}}
        {{--//alert('Error occurred');--}}
        {{--$("#leadTable").html(xhr.responseText);--}}
        {{--}--}}
        {{--});--}}
        {{--//            });--}}
        {{--});--}}
    </script>
    <script>
        {{--function getmorepost() {--}}
        {{--cp = 20;--}}
        {{--cp += parseFloat($('#pageno').val());--}}
        {{--$('#pageno').val(cp);--}}
        {{--var btn_id = $('#btn_id').val();--}}
        {{--var send_to_url = '{{ url('/') }}' + "/lead/" + btn_id + "/filter";--}}
        {{--$.ajax({--}}
        {{--type: "get",--}}
        {{--contentType: "application/json; charset=utf-8",--}}
        {{--url: send_to_url,--}}
        {{--//                data: '{"currentpage":"' + cp + '", "category_id":"' + category_id + '"}',--}}
        {{--data: {pageno: cp, btn: btn_id},--}}
        {{--beforeSend: function () {--}}
        {{--$('#leadTable').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');--}}
        {{--},--}}
        {{--success: function (data) {--}}
        {{--$("#leadTable").html(data);--}}
        {{--},--}}
        {{--error: function (xhr, status, error) {--}}
        {{--//alert('Error occurred');--}}
        {{--$("#leadTable").html(xhr.responseText);--}}
        {{--}--}}
        {{--});--}}
        {{--}--}}
        {{--$(document).ready(function () {--}}
        {{--$(window).scroll(function (event) {--}}
        {{--if ($(window).scrollTop() + $(window).height() == $(document).height()) {--}}
        {{--if (parseFloat($('#pageno').val()) <= parseFloat($('#total').val())) {--}}
        {{--getmorepost();--}}
        {{--}--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}


        function getCommunication(dis) {
            $('#myModal').modal('show');
            $('.modal-title').html('Communication Process');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = dis;
            var editurl = '{{ url('/') }}' + "/lead/" + id + "/add";
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
        }

        function assign_to_executive(dis) {
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Assign To Executive');
            var id = $(dis).parent().attr('id');
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_cLeadAssgn') }}",
                data: '{"data":"' + id + '"}',
                //dataType: "json",
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (result) {
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
                }
            });
        }

        function edit_inquiry(dis) {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Enquiry');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/enquiry/" + id + "/edit";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
//                $('.modal-body').html(xhr.responseText);
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");

                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }

        function view_inquiry(dis) {
            $('#myModal').modal('show');
            $('.modal-title').html('View Enquiry Details');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(dis).attr('id');
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
//                $('.modal-body').html(xhr.responseText);

                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }

        function close_lead(dis) {
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = $(dis).parent().attr('id');
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_clsLead') }}",
                data: '{"data":"' + id + '"}',
                //dataType: "json",
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (result) {
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
//                $('.modal-body').html("Technical Error Occurred");
                }
            });
        }

        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "columnDefs": [
                    {"width": "20px", "targets": 0}
                ],
                "order": [[0, "desc"]]
            });

            $('.datatable-col').on('keyup change', function () {
                table.column($(this).attr('id')).search($(this).val()).draw();
            });
        });

        function getfollowup(dis) {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = dis;
            $.ajax({
                type: "post",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gflwupfrm') }}",
                data: '{"id":"' + id + '"}',
                //dataType: "json",
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (result) {
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
//                $('.modal-body').html("Error Occurred");
                }
            });
        }

        //    $(".btnConvert").click(function () {
        function getConverted(dis) {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = dis;
            $.ajax({
                type: "post",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gCnvtFrm') }}",
                data: '{"id":"' + id + '"}',
                //dataType: "json",
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (result) {
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
//                $('.modal-body').html("Error Occurred");
                }
            });

        }

        //    $(".btnNoReponse").click(function () {
        function getNoResponse(dis) {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = dis;
            $.ajax({
                type: "post",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('_gNRF') }}",
                data: '{"id":"' + id + '"}',
                //dataType: "json",
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (result) {
                    $('.modal-body').html("Internet connection failed...Please refresh the page again");
//                $('.modal-body').html("Error Occurred");
                }
            });
        }

    </script>



    <input type="hidden" id="btn_id" value="{{$btn}}"/>
    <input type="hidden" id="pageno" value="{{$pageno}}"/>
    <input type="hidden" id="total" value="{{\App\Http\Controllers\LeadMaster\LeadMasterController::getCount($btn)}}"/>
    {{-- assign lead to counsellor --}}

@stop



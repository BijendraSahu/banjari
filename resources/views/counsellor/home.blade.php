@extends('layout.master.master')

@section('title','List of Lead')

@section('content')
    <div>
        <h3>Lead Lists</h3>
        <p>
            <a href="#" type="button" class="btn btn-sm btn btn-success add-lead_">
                <span class="glyphicon glyphicon-plus-sign"></span> Create New Lead</a>
        </p>
        <table class="table table-bordered">
            <tr>
                <th>Operations</th>
                <th>Name</th>
                <th>Contact Info</th>
                {{--<th>Email</th>--}}
                <th>Address</th>
                <th>Created On</th>
                <th>Last Visited</th>
                <th>Next Followup Date</th>
                <th>Communication</th>
                {{--<th>Assigned Yet</th>--}}
                {{--<th>Converted Yet</th>--}}
                {{--<th>Completed Yet</th>--}}
                {{--<th>Lead Status</th> <!-- lead status (fresh, surveyed etc) -->--}}
            </tr>
            @foreach($lead as $item)
                <tr>
                    <td id="{{ $item->id  }}">
                        <a href="#" class="btn btn-sm btn-primary btnFollowUp">
                            <span class="glyphicon glyphicon-cloud"></span> Need FollowUp
                        </a>
                        <a href="#" class="btn btn-sm btn-primary btnConvert">
                            <span class="glyphicon glyphicon-check"></span> Converted
                        </a>
                        <a href="#" class="btn btn-sm btn-primary btnNoReponse">
                            <span class="glyphicon glyphicon-cloud"></span> No Response
                        </a>
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->contact }},<br/>{{$item->email}},<br/>{{$item->address}}</td>
                    {{--<td>{{ $item->email }}</td>--}}
                    <td>{{ ($item->address == null)? " - " : $item->address }}</td>
                    <td>{{ ($item->created_date == null)? " - " :  date_format(date_create($item->created_date),"d-m-Y") }}</td>
                    <td>{{ ($item->last_visited_date == null)? " - " : date_format(date_create($item->last_visited_date), "d-m-Y") }}</td>
                    <td>{{ ($item->next_followup_date == null)? " - " : date_format(date_create($item->next_followup_date), "d-m-Y") }}</td>
                    <td> <a href="#" class="text-success btn-sm btn-success glyphicon glyphicon-eye-open view-comment"
                            title="View Communication"><strong></strong></a>
                        <div id="comment" class="comments hidden">{!!$item->communication!!}</div></td>

                    {{--<td>{{ ($item->is_converted === null)? "Yes" : "No" }}</td>--}}
                    {{--<td>{{ ($item->is_completed === null)? "Yes" : "No" }}</td>--}}
                    {{--<td></td>--}}
                </tr>
            @endforeach
        </table>
    </div>
    <script>
        $(".btnFollowUp").click(function () {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = $(this).parent().attr('id');
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
                    $('.modal-body').html("Error Occurred");
                }
            });
        });
        $(".btnConvert").click(function () {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = $(this).parent().attr('id');
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
                    $('.modal-body').html("Error Occurred");
                }
            });
        });
        $(".btnNoReponse").click(function () {
            $("#myModal").modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            var id = $(this).parent().attr('id');
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
                    $('.modal-body').html("Error Occurred");
                }
            });
        });

        $(".add-lead_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add Lead');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('lead/create') }}",
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
        $(".view-comment").click(this, function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Communication Process');
            $('.modal-body').html($(this).parent().find('.comments').html());

        });

    </script>
@stop
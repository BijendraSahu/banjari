@extends('layout.master.master')

@section('title','List of Itineraries')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="{{url('tour/0/create')}}" class="btn btn-sm bg-danger btnSet btn-primary add-tour btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Tour</a>
    <h3 class="heading bg-success">List of Tour</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    <div class="row fa-border">
        <div class="container-fluid">
            <table id="" class="display compact" cellspacing="0" width="100%">
                <thead>
                <tr class="bg-info">
                    <th class="hidden">Id</th>
                    <th class="options">Options</th>
                    <th>Lead Info</th>
                    <th>Tour Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Days</th>
                    {{--<th>Booking Status</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($tours)>0)
                    @foreach($tours as $tour)
                        <tr>
                            <td class="hidden">{{$tour->id}}</td>
                            <td id="{{$tour->id}}">
                                <div class="btn-group action">
                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">Options
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul id="{{$tour->id}}" class="dropdown-menu">
                                        <li><a href="tour/{{$tour->id}}/itinerary" class="view-list"><i class="fa fa-plus
                                        text-info">&nbsp;</i>Generate Itinerary</a>
                                        </li>
                                        <li><a href="{{url('itinerary').'/'.$tour->id}}/print" target="_blank"
                                               class="">
                                                <span class="fa fa-print"></span> Print Itinerary</a>
                                        </li>
                                        <li><a href="#" class=""><span class="fa fa-envelope"></span> Mail Itinerary</a>
                                        </li>
                                        {{--<li><a href="tour/{{$tour->id}}/planning" class="view-list"><i class="fa fa-eye--}}
                                        {{--text-info">&nbsp;</i> Create Planning</a>--}}
                                        {{--</li>--}}
                                        {{--<li><a href="#" class="edit-tour_" id="{{$tour->id}}"><i class="fa fa-edit--}}
                                        {{--text-warning">&nbsp;</i>Edit</a>--}}
                                        {{--</li>--}}
                                        {{--<li><a href="#" class="btnDelete" id="{{ $tour->id }}"><i class="fa fa-trash-o--}}
                                        {{--text-success">&nbsp;</i> Delete</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                </div>
                                {{--@if($tour->is_booked == 0)--}}
                                {{--<button type="button" id="{{ $tour->id }}"--}}
                                {{--class="btn btn-sm btn-success btnBook" title="Book"><span--}}
                                {{--class="fa fa-check" aria-hidden="true"></span></button>--}}
                                {{--@else--}}
                                {{--<button type="button" id="{{ $tour->id }}"--}}
                                {{--class="btn btn-sm btn-primary btnAvailable" title="Make it Avaialble"><span--}}
                                {{--class="fa fa-reply-all" aria-hidden="true"></span></button>--}}
                                {{--@endif--}}
                            </td>
                            <td>{{$tour->lead_master->name}}, {{$tour->lead_master->contact}}
                                , {{$tour->lead_master->email}}</td>
                            <td>{{$tour->tour_name}}</td>
                            <td>{{date_format(date_create($tour->start_date), "d-M-Y") }}</td>
                            <td>{{date_format(date_create($tour->end_date), "d-M-Y") }}</td>
                            <td>{{$tour->total_days}}</td>
                            {{--<td>@if($tour->is_booked == 1) <p class="bg-danger">Booked</p>--}}
                            {{--@else--}}
                            {{--<p class="bg-success">Available</p>--}}
                            {{--@endif--}}
                            {{--</td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <br/>
    <script>
        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Deletion');
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this tour<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('tour') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        {{--$(".add-tour").click(function () {--}}
            {{--$('#myModal').modal('show');--}}
            {{--$('.modal-title').html('Add New Tour');--}}
            {{--$('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');--}}
            {{--//alert(id);--}}
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--contentType: "application/json; charset=utf-8",--}}
                {{--url: "{{ url('tour/create') }}",--}}
                {{--success: function (data) {--}}
                    {{--$('.modal-body').html(data);--}}
{{--//            $('#modelBtn').visible(disabled);--}}
                {{--},--}}
                {{--error: function (xhr, status, error) {--}}
                    {{--$('.modal-body').html(xhr.responseText);--}}
                    {{--//$('.modal-body').html("Technical Error Occured!");--}}
                {{--}--}}
            {{--});--}}

        {{--});--}}
        $(".edit-tour_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Tour');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/tour/" + id + "/edit";
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

        $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                "columnDefs": [
                    {"width": "20px", "targets": 0}
                ]
            });

            $('.datatable-col').on('keyup change', function () {
                table.column($(this).attr('id')).search($(this).val()).draw();
            });
        });
    </script>
@stop

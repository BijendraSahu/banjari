@extends('layout.master.master')

@section('title','List of Vehicle')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="#" class="btn btn-sm bg-danger btnSet btn-primary add-vehicle btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Vehicle</a>
    <h3 class="heading bg-success">List of Vehicle</h3>
    <hr/>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    <div class="row fa-border">
        <div class="container-fluid">
            <table id="dataTable" class="display compact" cellspacing="0" width="100%">
                <thead>
                <tr class="bg-info">
                    <th class="hidden">Id</th>
                    <th class="options">Options</th>
                    <th>Vehicle Name</th>
                    <th>Seat</th>
                    <th>Rate/KM</th>
                    {{--<th>Booking Status</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($vehicles)>0)
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="hidden">{{$vehicle->id}}</td>
                            <td id="{{$vehicle->id}}">
                                <a href="#" id="{{$vehicle->id}}" class="btn btn-sm btn-default edit-vehicle_"
                                   title="Edit User">
                                    <span class="fa fa-pencil"></span></a>
                                <button type="button" id="{{ $vehicle->id }}"
                                        class="btn btn-sm btn-danger btnDelete" title="Delete"><span
                                            class="fa fa-trash-o" aria-hidden="true"></span></button>
                                {{--@if($vehicle->is_booked == 0)--}}
                                {{--<button type="button" id="{{ $vehicle->id }}"--}}
                                {{--class="btn btn-sm btn-success btnBook" title="Book"><span--}}
                                {{--class="fa fa-check" aria-hidden="true"></span></button>--}}
                                {{--@else--}}
                                {{--<button type="button" id="{{ $vehicle->id }}"--}}
                                {{--class="btn btn-sm btn-primary btnAvailable" title="Make it Avaialble"><span--}}
                                {{--class="fa fa-reply-all" aria-hidden="true"></span></button>--}}
                                {{--@endif--}}
                            </td>
                            <td>{{$vehicle->vehicle_name}}</td>
                            <td>{{$vehicle->seat}}</td>
                            <td>{{$vehicle->rate}}</td>
                            {{--<td>@if($vehicle->is_booked == 1) <p class="bg-danger">Booked</p>--}}
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
        $('.btnBook').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Booking');
            $('#myModal .modal-body').html('<h5>Are you sure want to book this vehicle<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('vehicle') }}/' + id +
                '/booked"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $('.btnAvailable').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Make It Available');
            $('#myModal .modal-body').html('<h5>Are you sure want to make this available<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('vehicle') }}/' + id +
                '/available"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Deletion');
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this vehicle<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('vehicle') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-vehicle").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Vehicle');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('vehicle/create') }}",
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
        $(".edit-vehicle_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Vehicle');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/vehicle/" + id + "/edit";
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

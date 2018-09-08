@extends('layout.master.master')

@section('title','List of Hotels')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="#" class="btn btn-sm bg-danger btnSet btn-primary add-hotel btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Hotel</a>
    <h3 class="heading bg-success">List of Hotel</h3>
    <hr/>
    @if(session()->has('message'))
        <script type="text/javascript">
            setTimeout(function () {
                ShowSuccessPopupMsg('{{ session()->get('message') }}');
            }, 500);
        </script>
    @endif
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
                    <th>Hotel Name</th>
                    <th>Place Name</th>
                    <th>Contacts</th>
                    <th>Address</th>
                    {{--<th>Booking Status</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($hotels)>0)
                    @foreach($hotels as $hotel)
                        <tr>
                            <td class="hidden">{{$hotel->id}}</td>
                            <td id="{{$hotel->id}}">
                                <a href="#" id="{{$hotel->id}}" class="btn btn-sm btn-default fa fa-pencil edit-hotel_"
                                   title="Edit Hotel">
                                </a>
                                {{--<a href="#" id="#" class="btn btn-sm btn-success fa fa-plus add-hotel-info"--}}
                                {{--title="Add Details"></a>--}}
                                <button type="button" id="{{ $hotel->id }}"
                                        class="btn btn-sm btn-danger btnDelete fa fa-trash-o" title="Delete"></button>
                                {{--@if($hotel->is_booked == 0)--}}
                                {{--<button type="button" id="{{ $hotel->id }}"--}}
                                {{--class="btn btn-sm btn-success btnBook" title="Book"><span--}}
                                {{--class="fa fa-check" aria-hidden="true"></span></button>--}}
                                {{--@else--}}
                                {{--<button type="button" id="{{ $hotel->id }}"--}}
                                {{--class="btn btn-sm btn-primary btnAvailable" title="Make it Avaialble"><span--}}
                                {{--class="fa fa-reply-all" aria-hidden="true"></span></button>--}}
                                {{--@endif--}}
                            </td>
                            <td>
                                <a href="{{url('hotel_info').'/'.$hotel->id. '/info'}}">{{$hotel->hotel_name}}</a>
                            </td>
                            <td>@if($hotel->place_master_id != null){{$hotel->place_master->place_name}}@endif</td>
                            <td>{{$hotel->contact}}</td>
                            <td>{{$hotel->address}}</td>
                            {{--<td>@if($hotel->is_booked == 1) <p class="bg-danger">Booked</p>--}}
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
            $('#myModal .modal-body').html('<h5>Are you sure want to book this hotel<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('hotel') }}/' + id +
                '/booked"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $('.btnAvailable').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Make It Available');
            $('#myModal .modal-body').html('<h5>Are you sure want to make this available<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-success" href="{{ url('hotel') }}/' + id +
                '/available"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Deletion');
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this hotel<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('hotel') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-hotel").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Hotel');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('hotel/create') }}",
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
        $(".edit-hotel_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Hotel');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/hotel/" + id + "/edit";
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

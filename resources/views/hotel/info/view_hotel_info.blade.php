@extends('layout.master.master')

@section('title','List of Hotels Details')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="/hotel" class="btn btn-sm bg-danger btnSet btn-primary btnSet pull-right">
        <span class="fa fa-backward"></span> Back To Hotels List</a>
    <a href="#" id="{{$hotel->id}}" class="btn btn-sm bg-danger btnSet btn-primary btnSet add-hotel pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Room</a>
    <h3 class="heading bg-success">{{$hotel->hotel_name}}</h3>
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
                    <th>Room Type</th>
                    <th>Rate</th>
                    {{--<th>Booking Status</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($hotel_info)>0)
                    @foreach($hotel_info as $info)
                        <tr>
                            <td class="hidden">{{$info->id}}</td>
                            <td id="{{$info->id}}">
                                <a href="#" id="{{$info->id}}" class="btn btn-sm btn-default fa fa-pencil edit-hotel_"
                                   title="Edit Hotel Info">
                                </a>
                                <button type="button" id="{{ $info->id }}"
                                        class="btn btn-sm btn-danger btnDelete fa fa-trash-o" title="Delete"></button>
                            </td>
                            <td>{{$info->room_type}}</td>
                            <td>{{$info->rate}}</td>
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
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this room<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('hotel_info') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-hotel").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Room');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/hotel_info/" + id + "/create";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
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
            $('.modal-title').html('Edit Room');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/hotel_info/" + id + "/edit";
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

@extends('layout.master.master')

@section('title','List of Inclusions')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="#" class="btn btn-sm bg-danger btnSet btn-primary add-inclusion btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Inclusion</a>
    <h3 class="heading bg-success">List of Inclusion</h3>
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
                    <th>Place</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Descripiton</th>
                    {{--<th>Booking Status</th>--}}
                </tr>
                </thead>
                <tbody>
                @if(count($inclusions)>0)
                    @foreach($inclusions as $inclusion)
                        <tr>
                            <td class="hidden">{{$inclusion->id}}</td>
                            <td id="{{$inclusion->id}}">
                                <a href="#" id="{{$inclusion->id}}" class="btn btn-sm btn-default edit-inclusion_"
                                   title="Edit User">
                                    <span class="fa fa-pencil"></span></a>
                                <button type="button" id="{{ $inclusion->id }}"
                                        class="btn btn-sm btn-danger btnDelete" title="Delete"><span
                                            class="fa fa-trash-o" aria-hidden="true"></span></button>
                                {{--@if($inclusion->is_booked == 0)--}}
                                {{--<button type="button" id="{{ $inclusion->id }}"--}}
                                {{--class="btn btn-sm btn-success btnBook" title="Book"><span--}}
                                {{--class="fa fa-check" aria-hidden="true"></span></button>--}}
                                {{--@else--}}
                                {{--<button type="button" id="{{ $inclusion->id }}"--}}
                                {{--class="btn btn-sm btn-primary btnAvailable" title="Make it Avaialble"><span--}}
                                {{--class="fa fa-reply-all" aria-hidden="true"></span></button>--}}
                                {{--@endif--}}
                            </td>
                            <td>{{$inclusion->place_master->place_name}}</td>
                            <td>{{$inclusion->name}}</td>
                            <td>{{$inclusion->rate}}</td>
                            <td>{{$inclusion->description}}</td>
                            {{--<td>@if($inclusion->is_booked == 1) <p class="bg-danger">Booked</p>--}}
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
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this inclusion<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('inclusion') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-inclusion").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Inclusion');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('inclusion/create') }}",
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
        $(".edit-inclusion_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Inclusion');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/inclusion/" + id + "/edit";
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

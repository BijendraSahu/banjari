@extends('layout.master.master')

@section('title','List of Enquiry Categories')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="#" class="btn btn-sm bg-danger btnSet btn-primary add-category btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Enquiry Category</a>
    <h3 class="heading bg-success">List of Enquiry Categories</h3>
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
                    <th>Enquiry Category Name</th>
                    <th>Percent</th>
                </tr>
                </thead>
                <tbody>
                @if(count($categories)>0)
                    @foreach($categories as $category)
                        <tr>
                            <td class="hidden">{{$category->id}}</td>
                            <td id="{{$category->id}}">
                                <a href="#" id="{{$category->id}}" class="btn btn-sm btn-default edit-category_"
                                   title="Edit User">
                                    <span class="fa fa-pencil"></span></a>
                                <button type="button" id="{{ $category->id }}"
                                        class="btn btn-sm btn-danger btnDelete" title="Delete"><span
                                            class="fa fa-trash-o" aria-hidden="true"></span></button>
                            </td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->percent}}</td>
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
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this category<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('category') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-category").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Enquiry Category');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('category/create') }}",
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
        $(".edit-category_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Enquiry Category');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/category/" + id + "/edit";
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

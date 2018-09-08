@extends('layout.master.master')

@section('title','List of Sentences')

@section('content')
    {{--<script src="{{ url('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--<link href="{{ url('assets/css/jquery.dataTables.min.css') }}" rel='stylesheet'/>--}}
    <a href="#" class="btn btn-sm bg-danger btnSet btn-primary add-sentence btnSet pull-right">
        <span class="fa fa-plus"></span>&nbsp;Create New Sentence</a>
    <h3 class="heading bg-success">List of Sentences</h3>
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
                    <th>Start Location</th>
                    <th>End Location</th>
                    <th>Sentence</th>
                </tr>
                </thead>
                <tbody>
                @if(count($sentences)>0)
                    @foreach($sentences as $sentence)
                        <tr>
                            <td class="hidden">{{$sentence->id}}</td>
                            <td id="{{$sentence->id}}">
                                <a href="#" id="{{$sentence->id}}"
                                   class="btn btn-sm btn-default fa fa-pencil edit-sentence_"
                                   title="Edit Sentence">
                                </a>
                                <button type="button" id="{{ $sentence->id }}"
                                        class="btn btn-sm btn-danger fa fa-trash-o btnDelete" title="Delete"></button>
                            </td>
                            <td>{{$sentence->start_location->place_name}}</td>
                            <td>{{$sentence->end_location->place_name}}</td>
                            <td>{{$sentence->sentence}}</td>
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
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this sentence<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('sentence') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });
        $(".add-sentence").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Sentence');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('sentence/create') }}",
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
        $(".edit-sentence_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Sentence');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/sentence/" + id + "/edit";
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

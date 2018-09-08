@extends('layout.master.master')

@section('title','List of Enquiries')

@section('content')
    <a href="#" type="button"
       class="btn btn-primary pull-right add-enq bg-danger btnSet">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Create New Enquiry</a>
    <h3 class="heading bg-danger">List of Enquires</h3>
    <p class="clearfix"></p>
    @if($errors->any())
        <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
    @endif
    <table id="dataTable" class="display compact" cellspacing="0" width="100%">
        <thead>
        <tr class="bg-info">
            <th>Enquiry No.</th>
            <th>Category</th>
            <th>Enquiry Date</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            {{--<th>Assigned Yet</th>--}}
            <th>Proceed To Lead</th>
            <th>Operations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($enquiry as $item)
            <tr>
                <td>{{ $item->full_enquiry_no }}</td>
                <td>@if($item->enquiry_category_id != null){{ $item->enquiry_category->category_name }}@else
                        - @endif</td>
                <td>{{ date_format(date_create($item->enquiry_date), 'd-M-Y') }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->contact }}</td>
                <td>{{ $item->email }}</td>
                {{--                    <td>{{ ($item->comment == null)? " - " : $item->comment }}</td>--}}
                {{--                    <td>{{ ($item->is_assigned == 1)? "Yes" : "No" }}</td>--}}
                <td>{{ ($item->is_proceed_to_lead === 1)? "Yes" : "No" }}</td>
                <td id="{{ $item->id  }}">
                    {{--                    <a href="#" id="{{ $item->id }}" class="btn btn-sm btn-danger btn-xs glyphicon glyphicon-trash"--}}
                    {{--title="Delete Enquiry"></a>&nbsp;--}}
                    <a href="#" class="btn btn-sm btn-success btn-xs edit-enquiry_" title="Edit Enquiry">
                        <span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="#" class="btn btn-sm btn-info btn-xs view-enquiry_" title="View Enquiry">
                        <span class="glyphicon glyphicon-eye-open"></span></a>
                    <a href="#" class="btn btn-sm btn-primary btn-xs edit-to_lead">
                        <span class="glyphicon glyphicon-share-alt" title="Convert To Lead"></span> Convert To
                        Lead</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- delete --}}
    <script>

        $(".add-enq").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Create New Enquiry');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('enquiry/create') }}",
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

        $('.glyphicon-trash').click(function () {
            var id = $(this).attr('id');
            $('#myModal').modal('show');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{ url('assets/img/loading.gif') }}"/>');
            $('#myModal .modal-title').html('Confirm Deletion');
            $('#myModal .modal-body').html('<h5>Are you sure want to delete this enquiry<h5/>');
            $('#modalBtn').html('<a class="btn btn-sm btn-danger" href="{{ url('enquiry') }}/' + id +
                '/delete"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirm</a>'
            );
        });

        $(".edit-enquiry_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Enquiry');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).parent().attr('id');
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
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });
        $(".view-enquiry_").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('View Enquiry Details');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).parent().attr('id');
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
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });
        $(".edit-to_lead").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Covert To Lead');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).parent().attr('id');
            var editurl = '{{ url('/') }}' + "/_enqToLead/" + id;
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


    {{-- convert to lead --}}


@stop
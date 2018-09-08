<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'tour/'.$tour->id.'/add_inclusion', 'class' => 'form-horizontal', 'id'=>'hotel']) !!}
<div class="container-fluid">
    <div class="form-group">
        <table id="dtTable" class="display table">
            <thead>
            <tr class="bg-info">
                <th>Option</th>
                <th>Select Inclusion Name</th>
                <th>Rate</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inclusions as $list)
                <tr>
                    <td><input type="checkbox" value="{{ $list->id }}" name="inclusion[]"/></td>
                    <td>{{$list->name}}</td>
                    <td><i class="fa fa-inr"></i> {{$list->rate}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary btn-block']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
    $(document).ready(function () {
        $('#dtTable').DataTable(
            {
                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,

                }]
            });
        $('.dtTable').DataTable(
            {
                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,

                }],
                //scrollY: '25v',
                //"iDisplayLength": 5,
                "lengthMenu": [5, 10, 25]

            });
    });
</script>

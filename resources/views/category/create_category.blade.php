<script src="{{ url('assets/js/validation.js') }}"></script>
@if($errors->any())
    <div role='alert' id='alert' class='alert alert-danger'>{{$errors->first()}}</div>
@endif
{!! Form::open(['url' => 'category', 'class' => 'form-horizontal', 'id'=>'category']) !!}
<div class="container-fluid">
    <div class='form-group'>
        {!! Form::label('name', 'Category Name *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('category_name', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Enquiry Category Name']) !!}
        </div>
    </div>
    <div class='form-group'>
        {!! Form::label('percent', 'Percent *', ['class' => 'col-sm-2 control-label']) !!}
        <div class='col-sm-9'>
            {!! Form::text('percent', null, ['class' => 'form-control input-sm amount required', 'placeholder'=>'Percent']) !!}
        </div>
    </div>
    <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-9'>
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

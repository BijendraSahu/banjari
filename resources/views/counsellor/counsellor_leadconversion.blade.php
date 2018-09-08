{!! Form::open(['url'=>'_gldcnvr/'.$lead->id, 'id'=>'frmConversion']) !!}

@include('includes.communication_modal')
<div class="container">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Send Response', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
    </div>
{!!Form::close()!!}
<script src="{{ URL::asset('js/validation.js') }}"></script>

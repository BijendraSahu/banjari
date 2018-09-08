<div class="container">
    {!! Form::open(['url' => 'lead/'.$lead->id.'/update', 'id' => 'frmUpadte', 'method' => 'POST']) !!}

    <div class="row">
        <div class="form-groups">
            {!! Form::label('name', 'Select Executive',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                @if(!is_null($counsellor))
                    {!! Form::select('user_master_id', $counsellor, null,['class' => 'form-control requiredDD']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-groups">
            {!! Form::label('name', 'Communication', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('communication', null, ['class' => 'form-control', 'placeholder'=>'Communication', 'size'=>'50x4']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-groups">
            <div class="col-offset-10 col-sm-12">
                {{ Form::submit('Submit',['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>

<script src="{{ url('assets/js/validation.js') }}"></script>


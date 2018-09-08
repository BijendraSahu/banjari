<div class="container-fluid">
    <div class="col-sm-6">
        <h3 class="bg-info text-center">Basic Info</h3>
        <p class="clearfix"></p>
        <div class='form-group'>
            {!! Form::label('user_no', 'Enquiry No#', ['class' => 'col-sm-5 control-label']) !!}
            <div class='col-sm-7'>
                <label for="" class="badge">{{$enquiry->full_enquiry_no}}</label>
            </div>
        </div>
        <p class="clearfix"></p>
        <p class="clearfix"></p>
        <div class='form-group'>
            {!! Form::label('user_no', 'Enquiry Category', ['class' => 'col-sm-5 control-label']) !!}
            <div class='col-sm-7'>
                <label for="">@if($enquiry->enquiry_category_id != null){{$enquiry->enquiry_category->category_name}}@else
                        - @endif</label>
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--{!! Form::text('name', $enquiry->name, ['class' => 'form-control input-sm input-sm textWithSpace required', 'placeholder'=>'Name']) !!}--}}
                <label for="">{{$enquiry->name}}</label>
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('name', 'Contact', ['class'=>'col-sm-5 form-label']) !!}
            <div class="col-sm-7">
                {{--{{ Form::text('contact', $enquiry->contact, ['class' => 'form-control input-sm contact numberOnly required', 'placeholder'=>'Contact']) }}--}}
                <label for="">{{$enquiry->contact}}</label>

            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('name', 'Email', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('email', $enquiry->email, ['class' => 'form-control input-sm', 'placeholder'=>'Email']) !!}--}}
                <label for="">{{$enquiry->email}}</label>

            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('no_of_person', 'No of Person', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('no_of_person', $enquiry->no_of_person, ['class' => 'form-control input-sm', 'placeholder'=>'No of Person']) !!}--}}
                <label for="">{{$enquiry->no_of_person}}</label>

            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('no_of_child(6-11)', 'No of Child(6-11)', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('no_of_child_above_5', $enquiry->no_of_child_above_5, ['class' => 'form-control input-sm', 'placeholder'=>'No of Child(6-11)']) !!}--}}
                <label for="">{{$enquiry->no_of_child_above_5}}</label>

            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('No of Child(0-5)', 'No of Child(0-5)', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--{!! Form::text('no_of_child_upto_5',  $enquiry->no_of_child_upto_5, ['class' => 'form-control input-sm', 'placeholder'=>'No of Child(0-5)']) !!}--}}
                <label for="">{{$enquiry->no_of_child_upto_5}}</label>

            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <h3 class="bg-info text-center">Traveling Info</h3>
        {{--<p class="clearfix"></p>--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('enquiry_date', 'Enquiry Date', ['class' => 'col-sm-5 control-label']) !!}--}}
        {{--<div class="col-sm-7">--}}
        {{--                {!! Form::text('enquiry_date',  date_format(date_create( $enquiry->departure_date),'d-M-Y'), ['class' => 'form-control dtp input-sm', 'placeholder'=>'Enquiry Date']) !!}--}}
        {{--<label for="">{{date_format(date_create( $enquiry->enquiry_date),'d-M-Y')}}</label>--}}

        {{--</div>--}}
        {{--</div>--}}
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('travel_date', 'Travel Date', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--{!! Form::text('travel_date',  date_format(date_create( $enquiry->departure_date),'d-M-Y'), ['class' => 'form-control dtp input-sm', 'placeholder'=>'Travel Date']) !!}--}}
                <label for="">{{date_format(date_create( $enquiry->travel_date),'d-M-Y')}}</label>

            </div>
        </div>
        {{--<p class="clearfix"></p>--}}

        {{--<div class="form-group">--}}
        {{--{!! Form::label('departure_date', 'Departure Date', ['class' => 'col-sm-5 control-label']) !!}--}}
        {{--<div class="col-sm-7">--}}
        {{--{!! Form::text('departure_date', date_format(date_create( $enquiry->departure_date),'d-M-Y'), ['class' => 'form-control dtp input-sm', 'placeholder'=>'Departure Date']) !!}--}}
        {{--<label for="">{{date_format(date_create( $enquiry->departure_date),'d-M-Y')}}</label>--}}

        {{--</div>--}}
        {{--</div>--}}
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('tour_start_from', 'Tour Start From', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('tour_start_from', $enquiry->tour_start_from, ['class' => 'form-control input-sm', 'placeholder'=>'Tour Start From']) !!}--}}
                <label for="">{{$enquiry->tour_start_from}}</label>
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('tour_start_from', 'Departure Destination', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('tour_start_from', $enquiry->tour_start_from, ['class' => 'form-control input-sm', 'placeholder'=>'Tour Start From']) !!}--}}
                <label for="">{{$enquiry->departure_destination}}</label>
            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('travel_duration', 'Travel Duration', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--{!! Form::text('travel_duration', $enquiry->travel_duration, ['class' => 'form-control input-sm', 'placeholder'=>'Travel Duration']) !!}--}}
                <label for="">{{$enquiry->travel_duration}}</label>
            </div>
        </div>

        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('travel_date', 'Tour End Date', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--{!! Form::text('travel_date',  date_format(date_create( $enquiry->departure_date),'d-M-Y'), ['class' => 'form-control dtp input-sm', 'placeholder'=>'Travel Date']) !!}--}}
                <label for="">{{date_format(date_create( $enquiry->tour_end_date),'d-M-Y')}}</label>

            </div>
        </div>
        <p class="clearfix"></p>

        <div class="form-group">
            {!! Form::label('current_location', 'Current Location', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('current_location', $enquiry->current_location, ['class' => 'form-control input-sm', 'placeholder'=>'Current Location']) !!}--}}
                <label for="">{{$enquiry->current_location}}</label>
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="form-group">
            {!! Form::label('any_requirement', 'Remark', ['class' => 'col-sm-5 control-label']) !!}
            <div class="col-sm-7">
                {{--                {!! Form::text('any_requirement',  $enquiry->any_requirement, ['class' => 'form-control input-sm', 'placeholder'=>'Any Requirement']) !!}--}}
                <label for="">{{$enquiry->any_requirement}}</label>
            </div>
        </div>

    </div>
</div>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Itinerary</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

    <script src="{{ url('assets/js/jquery.js') }}"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
    <script src="{{ url('assets/js/jspdf.min.js') }}"></script>
    <script src="{{ url('assets/js/from_html.js') }}"></script>
    <script src="{{ url('assets/js/split_text_to_size.js') }}"></script>
    <script src="{{ url('assets/js/standard_fonts_metrics.js') }}"></script>
    <script src="{{ url('assets/js/html2canvas.js') }}"></script>
    <link href="{{ url('assets/css/font-awesome.min.css') }}" rel="stylesheet">

</head>

<style>

    @import url('https://fonts.googleapis.com/css?family=Indie+Flower');

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
    }

    body {
        margin: 0 auto;
        font-family: 'Open Sans', sans-serif;
        /*font-size: 16px;*/
        background-color: #FFFFFF;
    }

    .pad20 {
        padding: 10px 20px;
    }

    .wrapper {
        width: 100%;
        margin: 0 auto;
        padding: 20px 1%;
    }

    .nopadding {
        padding: 0px;
    }

    .brdrblck {
        border: solid 1px #000;
    }

    .brdrblue {
        border: solid 5px #231571;
        padding: 0px 22px;
    }

    .cerhead {
        padding: 7px;
        border-bottom: solid thin #000;
        border-top: solid thin #000;
        background: #eae8f9;
        font-size: 26px;
        font-weight: bold;
    }

    .cername {
        font-family: 'Indie Flower', cursive;
        letter-spacing: 5px;
        font-size: 28px;
    }

    .nofont {
        font-size: 16px;
        margin-right: 5px;
    }

    .formstyle {
        outline: none;
        border: none;
        border-bottom: dotted 2px #000;
        border-radius: 0px;
        box-shadow: none;
    }
</style>
<body>
<div class="container-fluid nopadding pad20">
    <div class="wrapper">
        <div class="col-sm-12 brdrblck pad20">
            <div class="col-sm-12 nopadding pad20 brdrblue text-center">
                <h3 class="cerhead">BANJARI TOURS & TRAVELS</h3>
                <p class="clearfix"></p>

                {{--<h3 class="cername">INSPIRING LOGIN SERVICES PVT. LTD</h3>--}}
                <div class="col-xs-12 nopadding">
                    <div class="col-xs-6 text-left"><span class="nofont">Dear Sir/Mam, </span>
                        <span class="nofont"></span>
                        <p class="clearfix"></p>
                        <p class="clearfix"></p>
                        <h5 class="text-left">Greeting from Banjari MP Tours. Thanks for your valuable inquiry. We are
                            pleasure to offer you our best possible quotation for your required itinerary.</h5>
                        <p class="clearfix"></p>
                        <p><b>Enquiry No:</b> {{$tour->lead_master->enquiry_master->full_enquiry_no }}</p>
                        <p><b>Travel
                                Date:</b> {{date_format(date_create($tour->lead_master->enquiry_master->travel_date), "d-M-Y") }}
                        </p>
                        <p><b>No. of Days:</b> {{$tour->total_days}} Days</p>
                        <p><b>Guests traveling:</b> {{$tour->lead_master->enquiry_master->no_of_person}} Person</p>
                        {{--                        <p><b>Guests traveling:</b> {{$tour->lead_master->enquires->no_of_person}}  </p>--}}
                        <p class="clearfix"></p>
                        <p class="clearfix"></p>
                    </div>
                    {{--<div class="col-xs-6 text-right"><span class="nofont">DATE:</span> <span--}}
                    {{--class="nofont"> </span>--}}
                    {{--</div>--}}
                </div>
                <h3>{{$tour->tour_name}}</h3>
                <hr>
                {{--<img src="{{url('assets/img/bg.jpg')}}" width="800px" height="400px" alt="">--}}
                @if($tour->tour_image != null)
                    <img src="{{ url($tour->tour_image)}}" width="800px" height="400px"/>
                @else
                    <img src="{{url('assets/tours/EEPw3H_trip.jpg')}}" width="800px" height="400px"/>
                @endif
                <hr>
                <p class="clearfix"></p>
                <h4 class="text-left">Suggested Itinerary: <h5 class="text-left">
                        Please note below is a tentative itinerary for your trip. the actual may vary depending on the
                        inclusions selected in the trip.</h5></h4>
                <p class="clearfix"></p>
                <hr>
                <form class="form-horizontal">
                    <?php $counter = 1; ?>
                    @foreach($tour_info as $details)
                        <div class="form-group">
                            <div class="col-sm-12 text-left"><b>Day {{$counter}}:</b>
                                @if($details->sentence_master_id != null){{$details->sentence_master->sentence}}@endif
                            </div>
                            <br>
                        </div>
                        <?php $counter++ ?>
                    @endforeach
                </form>

                <hr>
                <h4 class="pull-left">Inclusions:</h4>
                <p class="clearfix"></p>
                <form class="form-horizontal">
                    @if(count($tour_inclusion)>0)
                        @foreach($tour_inclusion as $incl)
                            <div class="form-group">
                                <div class="col-sm-12 text-left"><i class="fa fa-hand-o-right"
                                                                    style="font-size:20px;color:red"></i>@if($incl->inclusion_master_id != null)
                                        {{$incl->inclusion_master->name}}
                                    @endif
                                </div>
                                <p></p>
                            </div>
                        @endforeach
                    @endif
                </form>

                <hr>
                <h4 class="pull-left">Hotel Used <i class="fa fa-bed" style="font-size:20px;color:blue"></i></h4>
                <p class="clearfix"></p>
                <form class="form-horizontal">
                    <?php $counter = 1; ?>
                    @foreach($tour_info as $info)
                        <div class="form-group">
                            <div class="col-sm-12 text-left">
                                @if($info->hotel_master_id != null) <b>{{$counter}}
                                    . </b>{{$info->hotel_master->place_master->place_name}} {{$info->hotel_master->hotel_name}}
                                @endif
                            </div>
                        </div>
                        <?php $counter++ ?>
                    @endforeach
                </form>


                @if($tour->vehicle_master_id != null)
                    <hr>
                    <h4 class="pull-left">Transportation Description <i class="fa fa-truck"
                                                                        style="font-size:20px;color:#0e90d2"></i></h4>
                    <p class="clearfix"></p>
                    <form class="form-horizontal">
                        <div class="form-group">
                            {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                            <div class="col-sm-12 text-left">
                                {{$tour->total_days}} Days
                                {{$tour->vehicle_master->vehicle_name}}, {{$tour->vehicle_comment}}
                            </div>
                        </div>
                    </form>
                @endif

                <hr>
                <h4 class="pull-left">Grand Total: &#8377 {{$grand_total}}</h4>
                <p class="clearfix"></p>
                <form class="form-horizontal">
                    <div class="form-group">
                        {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                        <div class="col-sm-12 text-left">

                        </div>
                    </div>
                </form>


                <hr>
                <h4 class="pull-left">CANCELLATION POLICY <i class="fa fa-trash" style="font-size:20px;color:red"></i>
                </h4>
                <p class="clearfix"></p>
                <form class="form-horizontal">
                    <div class="form-group">
                        {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                        @if(count($policy) > 0)
                            @foreach($policy as $p)
                                <div class="col-sm-12 text-left">{{$p->policy}}
                                </div>
                            @endforeach
                        @else
                            {{'No Policy'}}
                        @endif
                    </div>
                </form>

                <hr>

                <h4 class="pull-left">BANK DETAILS <i class="fa fa-money" style="font-size:20px;color:#007edb"></i></h4>
                <p class="clearfix"></p>
                <form class="form-horizontal">
                    <div class="form-group">
                        {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                        <div class="col-sm-12 text-left">Bank Name : HDFC Bank 
                        </div>
                        <div class="col-sm-12 text-left">Name : BANJARI TOUR AND TRAVELS
                        </div>
                        <div class="col-sm-12 text-left">Account Type : Current Account
                        </div>
                        <div class="col-sm-12 text-left">Number : 50200009536204 
                        </div>
                        <div class="col-sm-12 text-left">IFSC/RTGS Code : HDFC0000224
                        </div>
                    </div>
                </form>
                <hr>
                <form class="form-horizontal">
                    <div class="form-group">
                        {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                        <div class="col-sm-12 text-left">Bank Name : SBI Bank
                        </div>
                        <div class="col-sm-12 text-left">Name : BANJARI TOUR AND TRAVELS
                        </div>
                        <div class="col-sm-12 text-left">Account Type : Current
                        </div>
                        <div class="col-sm-12 text-left">Number : 35557600607 
                        </div>
                        <div class="col-sm-12 text-left">IFSC/RTGS Code : SBIN0007665
                        </div>
                    </div>
                </form>

                <form class="form-horizontal">
                    <div class="form-group">
                        {{--<label class="col-sm-12 pull-left" for="name">Day {{$counter}}:</label>--}}
                        {{--<div class="col-sm-12 text-left"><h4>With Regards </h4>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 text-left"><h4>{{$_SESSION['user_master']->name}}</h4>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 text-left"><h4>Banjari MP Tours</h4>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 text-left"><h5>Mob:{{$_SESSION['user_master']->contact}}</h5>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 text-left"><h5>Yatayat Tiraha Gurudwara Jabalpur(M.P.)</h5>--}}
                        {{--</div>--}}
                        <div class="col-xs-12">
                            <h4 class="text-left">With Regards <br> {{$_SESSION['user_master']->name}}
                                <h5 class="text-left">Mob:{{$_SESSION['user_master']->contact}}
                                    <br>
                                    7489333222, 7440333222 </h5>
                                <h4 class="text-left">Banjari MP Tours</h4>
                                <h5 class="text-left">Yatayat Tiraha Gurudwara Jabalpur(M.P.) <br>
                                    www.mptourpackages.com</h5></h4>
                            <h5 class="text-left"><p></p></h5>
                        </div>
                    </div>
                </form>
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-12"><h4 class="text-left">With Regards <br> {{$_SESSION['user_master']->name}} <br>Banjari MP Tours--}}
                {{--<br> <h5 class="text-left "><b>Mob:{{$_SESSION['user_master']->contact}} <br> Yatayat Tiraha Gurudwara Jabalpur(M.P.)</b></h5></h4></div>--}}
                {{--                <div class="col-xs-12"><h4 class="text-left">{{$_SESSION['user_master']->name}}</h4></div>--}}
                {{--<div class="col-xs-12"><h4 class="text-left">Banjari MP Tours</h4></div>--}}
                {{--<div class="col-xs-12"><h5 class="text-left">Mob:{{$_SESSION['user_master']->contact}}</h5></div>--}}
                <p class="clearfix"></p>

            </div>
        </div>
    </div>
</div>
<br/><br/>
{{--<input type="button" style="padding:8px; background-color: #3c763d; color: #fff; width:100%" id="printPdf"--}}
{{--value="Convert PDF"/>--}}
<script>
    $(document).ready(function () {

        $('#printPdf').click(function () {
            $(this).hide();
            var pdf = new jsPDF('landscape');
            pdf.addHTML($('body')[0], function () {
                pdf.save('BANJARI_ITINERARY.pdf');
            });
        });
    });
</script>
</body>
</html>

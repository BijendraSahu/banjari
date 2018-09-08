<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ url('dashboard') }}">
            <img src="{{ URL::asset('img/logo-AF_small.png') }}">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="pull-left">
            <h3 class="form-control"><strong>{{$_SESSION['selectedFirm']->name}}</strong></h3>
        </li>
        <li class="divider"></li>
        <li><a href="{{ url('client_report') }}"><i class="fa fa-fw fa-cog"></i>&nbsp;Client Expense Report</a></li>
        {{--<li><a href="{{ url('client_report') }}"><i class="fa fa-fw fa-cog"></i>&nbsp;Site Expense Report</a></li>--}}
        <li><a href="{{ url('emp_report') }}"><i class="fa fa-fw fa-cog"></i>&nbsp;Employee Expense Report</a></li>
        {{--<li><a href="{{ url('user') }}"><i class="fa fa-fw fa-cog"></i>&nbsp;Report 4</a></li>--}}
        <li class="divider"></li>
        {{--<li><a href="#" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i--}}
        {{--class="fa fa-bar-chart-o"></i>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<p class="dropdown dropdown-header"--}}
        {{--style="padding-top: 8%;">--}}
        {{--{!! Form::select('ddFirmMaster', $firm_master, $_SESSION['selectedFirm']->id, ['class' => 'form-control input-sm requiredDD select-firm']) !!}--}}
        {{--<select name="ddFirm" id="ddFirm" class="form-control input-sm requiredDD select-firm">--}}
        {{--@foreach($_SESSION['all_firms'] as $key=>$value)--}}
        {{--<option value="{{$key}}">{{$value}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        {{--</p>--}}
        {{--</li>--}}
        {{--<li><a href="{{url('_switchFirm')}}"><i class="fa fa-fw fa-user"></i>&nbsp;Switch Firm</a></li>--}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Hi, {{$_SESSION['login']->name}} <b class="fa
            fa-angle-down"></b></a>
            <ul class="dropdown-menu">
                {{--<li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>--}}
                <li><a href="{{ url('user') }}"><i class="fa fa-fw fa-cog"></i> Manage Users </a></li>
                {{--<li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>--}}
                <li class="divider"></li>
                <li class="dropdown-header">Select Firms</li>
                @foreach($_SESSION['all_firms'] as $key=>$value)
                    <li><a href="{{url('_switchFirm/'.$key)}}"><i class="fa fa-fw fa-building-o"></i>&nbsp;{{$value}}
                        </a></li>
                @endforeach
                <li class="divider"></li>
                <li><a href="{{ url('logout') }}"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            {{-- Enquiry, Lead & Service --}}
            <li>
                <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-building"></i>
                    Enquiry, Lead & Service
                    <i
                            class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="submenu-1" class="collapse">
                    <li><a href="{{ url('enquiry') }}"><i class="fa fa-angle-double-right"></i> Enquiry </a></li>
                    <li><a href="{{ url('lead') }}"><i class="fa fa-angle-double-right"></i> Lead </a></li>
                    <li><a href="{{ url('servicetype') }}"><i class="fa fa-angle-double-right"></i> Service Type </a>
                    </li>
                    {{--<li><a href="{{ url('servicemaster') }}"><i class="fa fa-angle-double-right"></i> Manage Service</a></li>--}}
                </ul>
            </li>
            {{-- Modules --}}
            <li>
                <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-fw fa-search"></i>
                    Modules <i
                            class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="submenu-2" class="collapse">
                    <li><a href="{{ url('firm') }}"><i class="fa fa-angle-double-right"></i> Firm </a></li>
                    <li><a href="{{ url('client') }}"><i class="fa fa-angle-double-right"></i> Client </a></li>
                    <li><a href="{{ url('employee') }}"><i class="fa fa-angle-double-right"></i> Employee </a></li>
                </ul>
            </li>

            {{-- Inventory --}}
            <li>
                <a href="#" data-toggle="collapse" data-target="#submenu-3"><i class="fa fa-fw fa-shopping-cart"></i>
                    Inventory <i
                            class="fa fa-fw fa-angle-down pull-right"></i></a>
                <ul id="submenu-3" class="collapse">
                    <li><a href="{{ url('category') }}"><i class="fa fa-angle-double-right"></i>&nbsp;Category</a></li>
                    <li><a href="{{ url('product') }}"><i class="fa fa-angle-double-right"></i>&nbsp;Product</a></li>
                    <li><a href="{{ url('vendor') }}"><i class="fa fa-angle-double-right"></i>&nbsp;Vendor</a></li>
                    <li><a href="{{ url('staff_category') }}"><i class="fa fa-angle-double-right"></i>&nbsp;
                            Staff Category</a></li>
                    <li><a href="{{ url('staff_product') }}"><i class="fa fa-angle-double-right"></i>&nbsp;
                            Staff Product</a></li>
                </ul>
            </li>


            {{--  --}}
            {{--<li>--}}
            {{--<a href="#" data-toggle="collapse" data-target="#submenu-4"><i class="fa fa-fw fa-exchange"></i>--}}
            {{--Manage Expense <i--}}
            {{--class="fa fa-fw fa-angle-down pull-right"></i></a>--}}
            {{--<ul id="submenu-4" class="collapse">--}}
            {{--<li><a href="#"><i class="fa fa-angle-double-right"></i> Site Expns. </a></li>--}}
            {{--<li><a href="{{ url('emp_expense') }}"><i class="fa fa-angle-double-right"></i> Employee Expns.--}}
            {{--</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}

            {{-- Employee Management --}}
            <li>
                <a href="{{ url('employee') }}"><i class="fa fa-fw fa-users"></i> Manage Employee </a>
            </li>

            {{-- Client Management --}}
            <li>
                <a href="{{ url('client') }}"><i class="fa fa-fw fa-sitemap"></i> Manage Clients </a>
            </li>

            {{-- Site Management --}}
            <li>
                <a href="{{ url('site') }}"><i class="fa fa-fw fa-sitemap"></i> Manage Sites </a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<!-- Navigation -->

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $(".side-nav .collapse").on("hide.bs.collapse", function () {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
        });
        $('.side-nav .collapse').on("show.bs.collapse", function () {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
        });
    })

</script>
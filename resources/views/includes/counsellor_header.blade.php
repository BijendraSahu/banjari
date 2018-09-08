{{--<header>--}}
{{--<nav class="navbar navbar-default navbar-fixed-top">--}}
{{--<div class="container pull-right">--}}
{{--<ul class="nav navbar-nav">--}}
{{--<li><a href="{{ url('home_counsellor') }}">Home</a></li>--}}
{{--<li><a href="{{ url('roles') }}">Roles</a></li>--}}
{{--<li><a href="{{ url('enquiry') }}">Enquiry</a></li>--}}
{{--            <li><a href="{{ url('servicetype') }}">Service Type</a></li>--}}
{{--<li><a href="{{ url('lead') }}">LeadMaster</a></li>--}}
{{--<li><a href="{{ url('servicemaster') }}">Service Master</a></li>--}}
{{--<li><a href="{{ url('#') }}">UserMaster</a></li>--}}
{{--<li><a href="{{ url('logout') }}">Logout</a></li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</nav>--}}
{{--</header>--}}

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
            <img src="{{ URL::asset('img/-text.png') }}" alt="LOGO">
        </a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>

        </li>
        <li>
            <a><b class="fa fa-user"></b>&nbsp;Hi, {{$_SESSION['login']->name}} </a>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            {{-- Counsellor --}}
            <li>
                <a href="{{ url('home_counsellor') }}"><i class="fa fa-fw fa-users"></i>&nbsp;Counsellor Home</a>
            </li>
            {{-- Enquiry --}}
            <li>
                <a href="{{ url('enquiry') }}"><i class="fa fa-fw fa-sitemap"></i>&nbsp;Manage Enquiry</a>
            </li>
            {{-- Logout --}}
            <li>
                <a href="{{ url('logout') }}"><i class="fa fa-fw fa-sitemap"></i>&nbsp;Logout</a>
            </li>
        </ul>
    </div>
    <!-- navbar-collapse -->
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
<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container pull-right">
            <ul class="nav navbar-nav">

                <li role="presentation" class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">Inventory</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('category') }}">Category</a></li>
                        <li><a href="{{ url('product') }}">Product</a></li>
                        <li><a href="{{ url('vendor') }}">Vendor</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">Modules</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('firm') }}">Firm</a></li>
                        <li><a href="{{ url('client') }}">Client</a></li>
                        <li><a href="{{ url('lead') }}">Lead</a></li>
                        <li><a href="{{ url('employee') }}">Employee</a></li>
                        <li><a href="{{ url('site') }}">Site Master</a></li>
                    </ul>
                </li>
                <li role="presentation" class="dropdown">
                    <a href="#" class="dropdown-toggle"
                       data-toggle="dropdown">Admin</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('user') }}">User Master</a></li>
                        <li><a href="{{ url('enquiry') }}">Enquiry</a></li>
                        <li><a href="{{ url('servicetype') }}">Service Type</a></li>
                        <li><a href="{{ url('servicemaster') }}">Service Master</a></li>
                        <li><a href="{{ url('firm') }}">Firms</a></li>
                        <li><a href="{{ url('logout') }}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
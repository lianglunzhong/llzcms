@include('admin.layouts.header')

<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true" id="userProfileDropdown">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" aria-labelledby="userProfileDropdown">
                            <li>
                                <a href="">Profile</a>
                            </li>
                            <li>
                                <a href="/admin/logout" target="_self">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" ng-class="{active: mainUrl == 'dashboard'}">
                <a ui-sref="dashboard">Dashboard</a>
            </li>
            <li role="presentation" ng-class="{active: mainUrl == 'users'}">
                <a ui-sref="users.lists">Users</a>
            </li>
            <li role="presentation" ng-class="{active: mainUrl == 'posts'}">
                <a >Post</a>
            </li>
            <li role="presentation">
                <a href="#">Gallery</a>
            </li>
        </ul>
    </div>

    <div id="page-wrapper">
        <div ui-view="master"></div>
    </div>
    
</div>

@include('admin.layouts.footer')
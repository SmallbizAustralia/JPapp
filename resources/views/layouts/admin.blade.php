<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('admin.dash') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>Elite</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>IAmElite</b></span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="http://via.placeholder.com/100x100" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="http://via.placeholder.com/100x100" class="img-circle" alt="User Image">

                                        <p>
                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}"
                                               class="btn btn-default btn-flat"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MAIN NAVIGATION</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li>
                            <a href="{{ route('admin.dash.weekly', ['type' => 'overview']) }}"><i class="fa fa-calendar-o"></i> <span>Weekly Overview</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dash.weekly', ['type' => 'workout']) }}"><i class="fa fa-calendar-o"></i> <span>Weekly Workouts</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dash.weekly', ['type' => 'training-split']) }}"><i class="fa fa-calendar-o"></i> <span>Weekly Training Splits</span></a>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-calendar-o"></i> <span>Weekly Nutrition</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{ route('admin.dash.mealPlan') }}">Meal Plan</a></li>
                                <li><a href="{{ route('admin.dash.recipes') }}">Recipes</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.dash.education') }}"><i class="fa fa-book"></i> <span>Education</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dash.exerciseDemo') }}"><i class="fa fa-youtube-play"></i> <span>Exercise Demonstration</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dash.becomingElite') }}"><i class="fa fa-trophy"></i> <span>Becoming Elite</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>User Management</span></a>
                        </li>
                        <li>
                            <a href="{{ route('admin.media') }}"><i class="fa fa-cloud-upload"></i> <span>Upload Media</span></a>
                        </li>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    I am Elite Men's Trainer
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2017 <a href="https://www.jaypigginfitness.com/" target="_blank">Jay Piggin</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->
        <script src="/js/manifest.js"></script>
        <script src="/js/vendor.js"></script>
        <script src="/js/plugins.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
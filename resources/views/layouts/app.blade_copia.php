<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--meta name="csrf-token" content="{{ Session::token() }}"-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> @yield('title' , 'Fidelizalos')</title>


     <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ URL::asset('vendor/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::asset('dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ URL::asset('vendor/morrisjs/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- bootstrap -->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"-->
    <!--Datepicker-bootstrap -->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css"-->

    <link href="{{ URL::asset('css/jquery-ui.min.css ') }}">

    <!--link href="{{ URL::asset('css/bootstrap-grid.min.css') }}" rel="stylesheet" type="text/css"-->
    
    <link href="https://fonts.googleapis.com/css?family=Kreon" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Overpass" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Telex" rel="stylesheet">

    <link href="{{ URL::asset('css/datepicker/bootstrap-datepicker.min.css ') }}" rel="stylesheet">

    <!--link href="{{ asset('css/bootstrap.min.css ') }}">
    <link href="{{ asset('css/bootstrap-reboot.min.css ') }}">
    <link href="{{ asset('css/bootstrap-grid.min.css ') }}"-->

    <style>
        body {
            /*font-family: 'Kreon', serif;*/
            /*font-family: 'Overpass', sans-serif;*/
            font-family: 'Telex', sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Fidelizalos</a>
            </div>
            <!-- /.navbar-header -->
                <!-- /.dropdown -->
                @if (Auth::guest())
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="/login">
                            Ingresar<i class="fa fa-user fa-fw"></i>
                        </a>
                    </li>
                </ul>
                @else
                <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->name }}<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                </ul>
                @endif
                <!-- /.dropdown -->
            <!-- /.navbar-top-links -->
            @if (Auth::guest())

            @else
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <!--li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Buscar...">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </span>
                                </div>
                                < /input-group>
                            </li-->
                            <br>
                            <br>
                            <li>
                                <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li-->
                            <li>
                                <a href="/ventas"><i class="fa fa-table fa-fw"></i> Ventas</a>
                            </li>
                            <li>
                                <a href="/alertas"><i class="fa fa-edit fa-fw"></i>Alertas</a>
                            </li>
                            <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Configuración<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Nosotros</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <!--<li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
            @endif
            <!-- /.navbar-static-side -->
        </nav>
        @if (Auth::guest())
            <div id="page-wrapper" style="border-left:0px; margin-left: 5%">
                <div class="row" >
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('titlecontent')</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-md-12">
                         @yield('content')
                    </div>
                </div>
            </div>
        @else
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('titlecontent')</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-md-12">
                         @yield('content')
                    </div>
                </div>
            </div>
        @endif
        <!-- /#page-wrapper -->
    </div>



    <!-- JavaScripts -->
     <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script-->
    <!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script-->
    <script src=" {{ URL::asset('js/jquery/jquery-3.3.1.min.js ') }}"></script>
    <!--script src=" {{ URL::asset('js/jquery/jquery.js ') }}"></script-->
    <!--script src=" {{ URL::asset('js/jquery-ui.min.js ') }}"></script-->
    <script src=" {{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src=" {{ URL::asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src=" {{ URL::asset('js/vue/vue.js ') }}"></script>
    <!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script-->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script-->
    <!--script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script-->
    <!--<script src="../js/bootstrap.min.js"></script-->
    <!--script type="text/javascript" href="https://code.jquery.com/jquery-3.3.1.min.js"></script-->
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script-->
    <!--script src=" {{ URL::asset('vendor/jquery/jquery.min.js ') }}"></script-->
    <!-- Bootstrap Core JavaScript -->
    <!--script src=" {{ URL::asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script-->
    <!-- Metis Menu Plugin JavaScript -->
    <script src=" {{ URL::asset('vendor/metisMenu/metisMenu.min.js ') }}"></script>
    <!-- Morris Charts JavaScript -->
    <script src=" {{ URL::asset('vendor/raphael/raphael.min.js') }}"></script>
    <script src=" {{ URL::asset('vendor/morrisjs/morris.min.js') }}"></script>
    <script src=" {{ URL::asset('data/morris-data.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src=" {{ URL::asset('dist/js/sb-admin-2.js') }}"></script>
    @yield('scripts')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

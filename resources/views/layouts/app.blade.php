<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="">
    
    <meta name="author" content="">
    
    <link rel="icon" href="./images/fidelio3.png">

    <title>Fidelio</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
    <!-- Icons -->
    <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    @yield('sectionstyle')

    <style type="text/css">

        .labelNegoSize{
            font-size: 16px;
        }

        .labelUserSize{
            font-size: 10px;
        }
    </style>

</head>
<body id="all">
    <div class="container-fluid" id="wrapper">
        <div class="row" id="menu">

            <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2 bg-faded sidebar-style-1">
                <h1 class="site-title"><a href="/"><img src="./images/fidelio2.png" width="100%;" height="60px;"> </a></h1>
                @if (Auth::guest())
                    
                @else
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
                    <ul class="nav nav-pills flex-column sidebar-nav">
                        <!--li class="nav-item"><a class="nav-link active" href="index.html"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a></li-->
                        <!--li class="nav-item"><a class="nav-link" href="/ventas"><em class="fa fa-calendar-o"></em>Nueva Venta</a></li-->
                        <!--li class="nav-item"><a class="nav-link" href="/alertas"><em class="fa fa-bar-chart"></em> Alerta</a></li-->
                        <div class="nav-item"><a class="nav-link" href="#" data-toggle="collapse" data-target="#menuventa" data-parent="#sidenav01" class="collapsed"><em class="fa fa-bar-chart"></em> Ventas </a>
                            <div id="menuventa" class="collapse"  aria-labelledby="dropdownMenuLink" style="top:auto; padding: 0px; width: 100%;">
                                <li class="nav-item"><a class="nav-link" href="/ventas">Nueva</a></li>
                                <li class="pointerCur"><a class="nav-link dropdown-item" href="/ventas-list">Listar</a></li>
                                <!--li><a class="nav-link dropdown-item" href="#">Something else here</a></li-->
                            </div>
                        </div>
                        <div class="nav-item"><a class="nav-link" href="#" data-toggle="collapse" data-target="#menuclient" data-parent="#sidenav01" class="collapsed"><em class="fa fa-user-o"></em> Clientes </a>
                            <div id="menuclient" class="collapse"  aria-labelledby="dropdownMenuLink" style="top:auto; padding: 0px; width: 100%;">
                                <li class="nav-item"><a class="nav-link" href="/clientes">Nuevo</a></li>
                                <!--li class="pointerCur"><a class="nav-link dropdown-item" href="/clientes/list">Listar</a></li>
                                <!--li><a class="nav-link dropdown-item" href="#">Something else here</a></li-->
                            </div>
                        </div>
                        <div class="nav-item"><a class="nav-link" href="#" role="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="fa fa-envelope"></em> Enviados </a>
                        </div>
                        <div class="nav-item"><a class="nav-link" href="#" data-toggle="collapse" data-target="#menuparam" data-parent="#sidenav01" class="collapsed"><em class="fa fa-cog"></em> Parametros </a>
                            <div id="menuparam" class="collapse" aria-labelledby="dropdownMenuLinkParam" style="top:auto; padding: 0px; width: 100%;">
                                <li class="nav-item"><a class="nav-link" href="/params-sms">SMS</a></li>
                                <!--li class="pointerCur"><a class="nav-link dropdown-item" href="/clientes/list">Listar</a></li>
                                <!--li><a class="nav-link dropdown-item" href="#">Something else here</a></li-->
                            </div>
                        </div>
                        <!--li class="nav-item"><a class="nav-link" href="elements.html"><em class="fa fa-hand-o-up"></em> UI Elements</a></li-->
                        <!--li class="nav-item"><a class="nav-link" href="cards.html"><em class="fa fa-clone"></em> Cards</a></li-->
                    </ul>
                    <!--a class="logout-button" onclick="logout();"><em class="fa fa-power-off"></em> Salir</a-->
                @endif 
            </nav>



            @if (Auth::guest())

                <main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
                    <header class="page-header row justify-center">
                        <div class="col-md-6 col-lg-8" >
                            <h1 class="float-left text-center text-md-left">Ingresar</h1>
                        </div>
                        
                   
                        <div class="clear"></div>
                    </header>
                    
                    <section class="row">
                        <div class="col-sm-12">
                            <section class="row">
                                @yield('content')
                            </section>
                        </div>
                    </section>
                </main>
            @else
            <main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-10 offset-xl-2 pt-3 pl-4">
                <header class="page-header row justify-center">
                    <div class="col-md-6 col-lg-8" >
                        <h1 class="float-left text-center text-md-left"> @yield('titlecontent')</h1>
                    </div>
                    
                    <div  class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!--img src="images/profile-pic.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto"-->
                        
                        <div class="" >
                            <span class="labelNegoSize">{{ Auth::user()->negocio->nombreNegocios }}</span>
                            <h6 class="text-muted labelUserSize">{{ Auth::user()->name }}</h6>
                        </div>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink"><!--a class="dropdown-item" href="#"><em class="fa fa-user-circle mr-1"></em> View Profile</a-->
                             <!--a class="dropdown-item" href="#"><em class="fa fa-sliders mr-1"></em>Configuracion</a-->
                             <a class="dropdown-item" href="/selectNego"><em class="fa fa-industry mr-1"></em>Cambiar de Negocio</a>
                             <a class="dropdown-item" onclick="logout();" v-model="salir" href="/logout"><em class="fa fa-power-off mr-1"></em>Salir</a>
                         </div>
                    </div>
               
                    <div class="clear"></div>
                </header>
                
                <section class="row">
                <!--section class="row" style="background: url(./images/fidelio1.png);
                    opacity: 0.5;
                    "-->
                    <div class="col-sm-12" style="opacity: 1;">
                        <section class="row" style="">
                            <div class="col-md-12 col-lg-12">
                                <div class="" style="margin-left: 20px;">
                                @yield('content')
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </main>
            @endif
        </div>
    </div>

    <!--<div class="" >
        <section class="row">
            <div class="col-sm-12 offset-sm-4">
                <section class="row" style="">
                    <div class="col-md-12 col-lg-8">
                        <div class="offset-sm-2">
                           <footer class="blockquote-footer">Someone famous in<cite title="Source Title">Source Title</cite></footer>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div-->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('dist/js/bootstrap.min.js') }}"></script>
    <script src=" {{ URL::asset('js/vue/axios.js') }}"></script>
    <script src=" {{ URL::asset('js/vue/vue.js') }}"></script>
    <script src=" {{ URL::asset('js/moment.js') }}"></script>


    <script src="{{ URL::asset('js/chart.min.js') }}"></script>
    <script src="{{ URL::asset('js/chart-data.js') }}"></script>
    <script src="{{ URL::asset('js/easypiechart.js') }}"></script>
    <script src="{{ URL::asset('js/easypiechart-data.js') }}"></script>
    <script src="{{ URL::asset('js/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!--script src="{{ URL::asset('js/datepicker/jquery-ui.min.js') }}"></script-->
    <script src="{{ URL::asset('js/custom.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

    <script>
        window.onload = function () {
    var chart1 = document.getElementById("line-chart").getContext("2d");
    window.myLine = new Chart(chart1).Line(lineChartData, {
    responsive: true,
    scaleLineColor: "rgba(0,0,0,.2)",
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleFontColor: "#c5c7cc"
    });
};


   
    </script>


    @yield('scripts')
        
        <script>
            //function alert(){}
            function logout(){
                $.ajax({
                  type: "GET",
                  url: "/logout/negocioDefect",
                });

               /* $.ajax({
                    type:"POST",
                    url: "/logout"
                })*/
            }
        </script>
    
      </body>
</html>

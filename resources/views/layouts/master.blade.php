<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Mapeo de Decisiones MP</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/app.css">

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <div class="wrapper" id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-blue">
                <a class="navbar-brand" href="/home">
                    <img src="/img/assets/Logo- Login 2.png" style="width:16em;" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link text-primary" style="margin-left: 4em; font-size:1.5em;" href="#"><span class="font-weight-bold">Herramientas de Mapero </span></a>
                        </li> --}}
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link to="/home" class="nav-link d-block d-lg-none">
                                <span class="m-0 p-0">Inicio</span>
                            </router-link>
                        </li>
                        @if(!Gate::check('isINL'))
                        <li class="nav-item pointer" style="margin-top: 8px;" v-show="$route.params.key">
                            <a @click="documentaryInfoLink" class="nav-link" style="border-right: solid 1.5px lightgray;">
                                <span class="mr-3 ml-3" id="documental-menu">Documental</span>
                            </a>
                        </li>
                        @endif
                        @if(!Gate::check('isINL'))
                        <li class="nav-item pointer" style="margin-top: 8px;" v-show="$route.params.key">
                            <a @click="quantitativeSourcesLink" class="nav-link" style="border-right: solid 1.5px lightgray;">
                                <span class="mr-3 ml-3" id="cuantitative-menu">Cuantitativa</span>
                            </a>
                        </li>
                        @endif
                        @if(!Gate::check('isINL'))
                        <li class="nav-item pointer" style="margin-top: 8px;" v-show="$route.params.key">
                            <a @click="qualitativeSourcesLink" class="nav-link" style="border-right: solid 1.5px lightgray;">
                                <span class="mr-3 ml-3" id="cualitative-menu">Cualitativa</span>
                            </a>
                        </li>
                        @endif
                        @if(Gate::check('isDirector'))
                        <li class="nav-item pointer mr-4" style="margin-top: 8px;" v-show="$route.params.key">
                            <a @click="detailedReportLink" class="nav-link">
                                <span class="mr-3 ml-3" id="reports-menu">Reportes</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img style="width:40px; border-radius:50%;" src="/img/profile.png" alt="profile">
                                {{Auth::user()->name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <router-link to="/profile" class="dropdown-item" style="color:black !important" id="profile-menu">
                                <i class="fas fa-user-cog"></i> Ver perfil
                            </router-link>
                            @if(Gate::check('isDirector'))
                            <router-link to="/users" class="dropdown-item" style="color:black !important" id="users-menu">
                                <i class="fas fa-users"></i> Usuarios
                            </router-link>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="color:black !important" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Cerrar sesión') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                                </form>
                            </a>
                            </div>
                        </li>
                        <li class="nav-item" style="margin-top: 8px;" v-if="'{{Auth::user()->type}}' != 'readonly'">
                            <a href="/document-repository">
                                <img src="/img/02.8_icon_info.png" alt="">
                            </a>

                        </li>
                        {{-- <li class="nav-item" style="margin-top: 8px;">
                            <a class="nav-link pointer" data-toggle="tooltip" data-placement="bottom" title="Video Tutorial">
                                <i class="fas fa-question" @click="openVideo"></i>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </nav>
            <div class="mh-90">
                <div class="content">
                    <div class="container-fluid">
                        <router-view></router-view>
                        <!-- Modal -->
                        <div class="modal fade" id="Video" tabindex="-1" role="dialog" aria-labelledby="VideoLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 id="VideoLabel" class="font-weight-bolder text-uppercase">Video Tutorial</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>

                                <div class="modal-body">
                                    <youtube class="max-width:100%" :video-id="videoId" @ready="ready" @playing="playing"></youtube>
                                </div>
                            </div>
                            </div>
                        </div>
                        <vue-progress-bar></vue-progress-bar>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer-inl bg-secondary text-center">
            <strong>&copy; 2019 <a href="http://c-230.com">C230 Consultores S.C.</a></strong>
        </footer>
        @auth
            <script>
                window.user = @json(auth()->user())

            </script>
        @endauth
        <script>
            window.onload = function() {
                const languaje = localStorage.getItem("languaje");
                if (languaje === 'es') {
                    $('#documental-menu').text('Documental');
                    $('#cuantitative-menu').text("Cuantitativa");
                    $('#cualitative-menu').text('Cualitativa');
                    $('#reports-menu').text('Reportes');
                    $('#profile-menu').text('Ver perfil');
                    $('#users-menu').text('Usuarios');
                } else{
                    $('#cuantitative-menu').text("Quantitative");
                    $('#documental-menu').text('Documentary');
                    $('#cualitative-menu').text('Qualitative');
                    $('#reports-menu').text('Reports');
                    $('#profile-menu').text('View profile');
                    $('#users-menu').text('Users');

                }
            }
        </script>
        <script src="/js/app.js"></script>
    </body>
</html>

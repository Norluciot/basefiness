<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('/style.css') }}" rel="stylesheet"> --}}


    <link href="{{asset('/css/lib/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/lib/menubar/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset("css/lib/bootstrap.min.css")}}" rel="stylesheet">

    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<boady>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POSdT" class="-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
{{-- aside --}}
<div class="row">

    <div class="col-lg-2">
        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures bg-white shadow-sm ounded-3" style="width: 13%;margin-top:4.5%">
            <div class="nano">
                <div class="nano-content">
                    <ul>
                        <div class="logo bg-white">
                               <span>
                                <img class="" width="150" src="{{ asset('/images/fitlogo.png')}}" alt="">
                            </span></div>
                            <hr>
                        <li class="label">Page</li>
                        <li><a class="sidebar-sub-toggle bg-white text-dark fw-bold"><i class=" text-danger ">
                            <svg width="17" class="text-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                              </svg>


                        </i> Membres <span
                                    class="badge bg-dark text-danger">2</span> <span
                                    class="sidebar-collapse-icon ti-angle-down"></span></a>

                            <ul>
                                <li><a href="{{url('/membres')}}"> Membre </a></li>
                                {{-- <li><a href="index.html">Suivi visiteur </a></li> --}}

                            </ul>
                        </li>
                        <li class="label">Page visiteur</li>


                        <li><a class="sidebar-sub-toggle fw-bold text-dark bg-white"><i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 0 1 1.5 10.875v-3.75Zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 0 1-1.875-1.875v-8.25ZM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 0 1 3 18.375v-2.25Z" clip-rule="evenodd" />
                              </svg>

                        </i> Visiteur <span
                            class="badge bg-dark text-white ">2</span> <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/visiteurs')}}" > Visiteur </a></li>
                        <li><a href="{{url('/suivi-seances-visiteurs')}}">Suivi visiteur </a></li>

                    </ul>
                </li>
                <li class="label">Page activité</li>


                        <li><a class="sidebar-sub-toggle fw-bold text-dark bg-white"><i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" data-slot="icon" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 0 1 1.5 10.875v-3.75Zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 0 1-1.875-1.875v-8.25ZM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 0 1 3 18.375v-2.25Z" clip-rule="evenodd" />
                              </svg>

                        </i> Activité <span
                            class="badge bg-dark text-danger ">2</span> <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{url('/tarifs')}}" >Activité </a></li>


                    </ul>
                </li>
                <li class="label ">Page produit</li>
                        <li><a class="sidebar-sub-toggle fw-bold text-dark bg-white"><i class="ti-files"></i> Produit <span
                                    class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="{{url('/produits')}}">Produit</a></li>

                            </ul>
                        </li>

                <li class="label">Page d'opérations</li>


                <li><a class="sidebar-sub-toggle fw-bold text-dark bg-white"><i class="">
                    <svg xmlns="http://www.w3.org/2000/svg" class=" bg-dark rounded-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>



                </i> Opérations <span
                    class="badge  text-white bg-dark">2</span> <span
                    class="sidebar-collapse-icon ti-angle-down"></span></a>
            <ul>
                <li><a href="{{url('/payer')}}">Paiement </a></li>
                <li><a href="{{url('/achats')}}">Achat</a></li>
                <li><a href="{{url('/rapport')}}">Rapport Journalier</a></li>

                    </ul>
                </li>

                </div>
            </div>
    </div>
    </div>
    <div class="col-lg-10">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>





     <!-- jquery vendor -->
  <script src="{{asset('js/lib/jquery.min.js')}}"></script>
  <script src="{{asset("js/lib/jquery.nanoscroller.min.js")}}"></script>
  <script src="{{asset('js/lib/menubar/sidebar.js')}}"></script>
  <script src="{{asset('js/lib/preloader/pace.min.js')}}"></script>
  <script src="{{asset('js/scripts.js')}}"></script>


  <!--  flot-chart js -->
  <script src="{{asset('js/lib/flot-chart/excanvas.min.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.pie.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.time.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.stack.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.resize.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/jquery.flot.crosshair.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/curvedLines.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/flot-tooltip/jquery.flot.tooltip.min.js')}}"></script>
  <script src="{{asset('js/lib/flot-chart/flot-chart-init.js')}}"></script>
</body>
</html>

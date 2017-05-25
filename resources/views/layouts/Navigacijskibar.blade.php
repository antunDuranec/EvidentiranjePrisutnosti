<nav class="navbar navbar-fixed-top navbar-default" id="white-navbar">
    <div class="container-fluid" id="container-navbar-all">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}" style="padding: 5px 0px 15px 0px; height: 40px; margin: 0px;">
                <img src="{{URL::asset('picture/logo-org.ico') }}" alt="studenti.upecajstan.com" id='logo' />
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav" >

                @if (Auth::guest())
                    <li id="logo-tekstall" style="margin-top: 1%">STUDENTI-EVIDENCIJA</li>

                @else

                    @if(Auth::user())
                    <li id="logo-tekstall" style="margin-top: 1%">STUDENTI-EVIDENCIJA</li>
                    @endif

                    @if(Auth::user()->razina_prava==1)
                        <li id="logo-tekstadmin"><a href="{{ url('/admin') }}" id="logo-tekstadmin">ADMINISTRATOR</a></li>
                    @endif

                @endif

            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right a-navbar">
                <li></li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}" id="navbar-slovaall">PRIJAVI SE</a></li>
                    <li><a href="{{ url('/register') }}" id="nav-bar-registerall">REGISTRIRAJ SE</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="navbar-slovaall" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->ime }} <span class="caret" id="navbar-slovaall"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu" style="font-family: 'Open Sans', sans-serif; ">
                            @if(Auth::user()->razina_prava==3)
                            <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/') }}"><i class="fa fa-btn fa-user"></i>Moj profil</a></li>
                            <li><a href="{{ url('/prijava-prisutnosti') }}"><i class="fa fa-btn fa-plus-square"></i>Prijava prisutnosti</a></li>
                            <li><a href="{{ url('/moja-prisutnost') }}"><i class="fa fa-btn fa-folder-open"></i>Moja evidencija</a></li>
                            <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit') }}"><i class="fa fa-btn fa-user"></i>Uredi profil</a></li>
                            <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit-password') }}"><i class="fa fa-btn fa-cog"></i>Izmjena lozinke</a></li>

                            @elseif(Auth::user()->razina_prava==1)
                                <li><a href="{{ url('/termin') }}"><i class="fa fa-btn fa-folder-open"></i>Evidencija studenata</a></li>
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/') }}"><i class="fa fa-btn fa-user"></i>Moj profil</a></li>
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit') }}"><i class="fa fa-btn fa-user"></i>Uredi profil</a></li>
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit-password') }}"><i class="fa fa-btn fa-cog"></i>Izmjena lozinke</a></li>
                                <li><a href="{{ url('admin') }}"><i class="fa fa-btn fa-male"></i>Admin panel</a></li>

                            @elseif(Auth::user()->razina_prava==2)
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/') }}"><i class="fa fa-btn fa-user"></i>Moj profil</a></li>
                                <li><a href="{{ url('/termin') }}"><i class="fa fa-btn fa-folder-open"></i>Evidencija studenata</a></li>
                                <li><a href="{{ url('/student-kolegij') }}"><i class="fa fa-btn fa-folder-open"></i>Prikaz studenata po kolegiju</a></li>
                                <li><a href="{{ url('/termin/create') }}"><i class="fa fa-btn fa-folder-open"></i>Dodaj novi termin</a></li>
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit') }}"><i class="fa fa-btn fa-user"></i>Uredi profil</a></li>
                                <li><a href="{{ url('/korisnik/'.Auth::user()->sifra_korisnika.'/edit-password') }}"><i class="fa fa-btn fa-cog"></i>Izmjena lozinke</a></li>

                            @endif

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Odjava

                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </li>
                    <li>
                        @if(Auth::user()->razina_prava==1)
                        <a href="{{ url('/termin') }}" class="navbar-plusic-all" title="Pregled prisutnosti studenata" style="padding-top: 15px; margin-bottom: 0px; padding-bottom: 5px;">
                            <p id="navbar-izradi-oglas-all">+ EVIDENCIJA PRISUTNOST</p><p id="navbar-izradi-oglas-off-all">+</p>
                        </a>
                        @elseif(Auth::user()->razina_prava==2)
                        <a href="{{ url('/termin') }}" class="navbar-plusic-all" title="Prijavi prisutnosti studenata" style="padding-top: 15px; margin-bottom: 0px; padding-bottom: 5px;">
                            <p id="navbar-izradi-oglas-all">+ EVIDENCIJA PRISUTNOST</p><p id="navbar-izradi-oglas-off-all">+</p>
                        </a>
                        @elseif(Auth::user()->razina_prava==3)
                        <a href="{{ url('/prijava-prisutnosti') }}" class="navbar-plusic-all" title="Prijavi prisutnost na nastavi" style="padding-top: 15px; margin-bottom: 0px; padding-bottom: 5px;">
                            <p id="navbar-izradi-oglas-all">+ PRIJAVI PRISUTNOST</p><p id="navbar-izradi-oglas-off-all">+</p>
                        </a>
                        @endif
                    </li>
                @endif
            </ul>
        </div>
    </div>

</nav>
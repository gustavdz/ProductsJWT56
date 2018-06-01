<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">

                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>

                @else
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->profilepicture_filename) }}" alt="">
                            {{ Auth::user()->name }}
                            <span class=" fa fa-angle-down"></span>

                        </a>

                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="{{ route('editUserweb') }}"><i class="fas fa-user pull-right"></i> Perfil de Usuario</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt pull-right"></i>  Cerrar Sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ url('/') }} </form>
                            </li>
                        </ul>
                    </li>
                @endguest


                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge bg-green">{{Auth::user()->comunicadoslecturas()->count()}}</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @foreach(Auth::user()->comunicadoslecturas()->get()->slice(0, 4) as $comunicadoslecturanoti)
                        <li>
                            <a>
                                <span class="image"><img src="{{asset('img/logo.png')}}" alt="EcuaBill" /></span>
                                <span>
                                    <span>{{Auth::user()->comunicadoslecturas_comunicados($comunicadoslecturanoti->comunicado_id)->title}}</span>
                                    <span class="time">{{Auth::user()->comunicadoslecturas_comunicados($comunicadoslecturanoti->comunicado_id)->created_at->diffForHumans()}}</span>
                                </span>
                                        <span class="message">
                                    {{str_limit(Auth::user()->comunicadoslecturas_comunicados($comunicadoslecturanoti->comunicado_id)->detail,$limit=100,$end='... Ver más')}}
                                </span>
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>Ver todos los comunicados </strong>
                                    <i class="fa fa-angle-right pull-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
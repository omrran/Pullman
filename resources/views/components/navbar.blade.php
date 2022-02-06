<div style="height: 68px;background-color: #040a5a">this div will suitable under navbar to prevent img to go up</div>
<nav class="navbar   mx-auto navbar-expand-lg navbar-dark bg-blue shadow fixed-top pt-1 pb-1 ">
    <div class="container-fluid ">
        <a class="navbar-brand p-0" href="/home">
            {{--            <img src="{{asset('photos/logo.png')}}" alt="" width="90" height="40">--}}
            <img src="{{asset('photos/admin.png')}}" alt="" class="rounded-circle m-0 p-0" width="60" height="100%">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

                @if(Session::has('LoggedCompany'))
                    <li class="nav-item px-3">
                        <a class="nav-link fs-5" aria-current="page" href="/company-profile"><i
                                class="fa fa-home fs-5"></i> Company Profile</a>
                    </li>
                @elseif(Session::has('LoggedPassenger'))
                    <li class="nav-item px-3">
                        <a class="nav-link fs-5" aria-current="page" href="/passenger-profile"><i
                                class="fa fa-home fs-5"></i>Passenger Profile</a>
                    </li>
                @else
                    <li class="nav-item px-3">
                        <a class="nav-link fs-5" aria-current="page" href="/home"><i class="fa fa-home fs-5"></i>
                            Home</a>
                    </li>
                @endif


                <li class="nav-item px-3">
                    <a class="nav-link fs-5" aria-current="page" href="/whatpullman">what's PULLMAN <i
                            class="fa fa-question fs-3"></i></a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link fs-5" href="/companies"><i class="fa fa-handshake-o fs-5"></i> Companies</a>
                </li>

                @if(Session::has('LoggedPassenger') || Session::has('LoggedCompany') ||Session::has('LoggedAdmin'))

                    {{--                <li class="nav-item bg-primary">--}}
                    {{--                    <a class="nav-link" href="/log-out"><i class="fa fa-handshake-o"></i> log out</a>--}}
                    {{--                </li>--}}
                @else
                    <div class="d-flex justify-content-end">

                        <li class="nav-item dropdown bg-dark rounded-pill-left-custom">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                login
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/login-admin">As Admin</a></li>
                                <li><a class="dropdown-item" href="/login-company">As Company</a></li>
                                <li><a class="dropdown-item" href="/login-passenger">As Passenger</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown bg-secondary rounded-pill-right-custom">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                join us
                            </a>
                            <ul class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/joinUs-company">As Company</a></li>
                                <li><a class="dropdown-item" href="/joinUs-passenger">As Passenger</a></li>
                            </ul>
                        </li>
                    </div>
                @endif
            </ul>

        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background:#6f42c1;">
    <div class="container-fluid p-3">
        <a class="navbar-brand" href="{!! route('Ripple::dashboard') !!}"><i class="fab fa-laravel fa-2x"></i> Ripple</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav pl-3 ml-auto ">
                <li class="nav-item">
                    <a class="nav-link " href="{!! route('Ripple::breadModule') !!}" id="navbarDropdown">
                        <i class="fa fa-database"></i> Bread Module
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{!! route('Ripple::databaseModule') !!}" id="navbarDropdown" role="button">
                        <i class="fa fa-database"></i> Database Module
                    </a> 
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{!! route('Ripple::settingModule') !!}" id="navbarDropdown" role="button">
                        <i class="fa fa-cog"></i> Setting Module
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt "></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>

            </ul>
        </div>
    </div>
</nav>


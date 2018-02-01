<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid p-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0);">Ripple</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-database"></i> Bread Module
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{!! route('Ripple::adminCreateTable') !!}"><i class="fa fa-plus"></i> Create Table</a>
                        <a class="dropdown-item" href="{!! route('Ripple::adminDatabase') !!}"><i class="fa fa-list"></i>  List Tables</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-database"></i> Database Module
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{!! route('Ripple::adminCreateTable') !!}"><i class="fa fa-plus"></i> Create Table</a>
                        <a class="dropdown-item" href="{!! route('Ripple::adminDatabase') !!}"><i class="fa fa-list"></i>  List Tables</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog"></i> Setting Module
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'general']) !!}"><i class="fa fa-globe"></i>  General Settings</a>
                        <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}"><i class="fa fa-info-circle"></i>  Bread Settings</a>
                        <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'sco']) !!}"><i class="fa fa-info-circle"></i>  SCO Settings</a>
                        <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'social']) !!}"><i class="fa fa-info-circle"></i>  Social Settings</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav> 

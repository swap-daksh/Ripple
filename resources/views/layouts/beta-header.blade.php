<nav class="navbar navbar-expand-lg navbar-dark" style="background:#6f42c1;">
    <div class="container-fluid p-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0);">Ripple</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

        </div>
        <ul class="navbar-nav px-3 ">
          <li class="nav-item">
              <a class="nav-link " href="{!! route('Ripple::breadModule') !!}" id="navbarDropdown">
                  <i class="fa fa-database"></i> Bread Module
              </a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link" href="{!! route('Ripple::databaseModule') !!}" id="navbarDropdown" role="button">
                  <i class="fa fa-database"></i> Database Module
              </a>
              <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{!! route('Ripple::adminCreateTable') !!}"><i class="fa fa-plus"></i> Create Table</a>
                  <a class="dropdown-item" href="{!! route('Ripple::adminDatabase') !!}"><i class="fa fa-list"></i>  List Tables</a>
                  <a class="dropdown-item" href="{!! route('Ripple::databaseTableRelationship') !!}"><i class="fa fa-list"></i>  Table Relations</a>
              </div>-->
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link" href="{!! route('Ripple::settingModule') !!}" id="navbarDropdown" role="button">
                  <i class="fa fa-cog"></i> Setting Module
              </a>
              <!--<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'general']) !!}"><i class="fa fa-globe"></i>  General Settings</a>
                  <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}"><i class="fa fa-info-circle"></i>  Bread Settings</a>
                  <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'sco']) !!}"><i class="fa fa-info-circle"></i>  SCO Settings</a>
                  <a class="dropdown-item" href="{!! route('Ripple::adminSettings', ['type'=>'social']) !!}"><i class="fa fa-info-circle"></i>  Social Settings</a>
              </div>-->
          </li>
      </ul>
    </div>
</nav>


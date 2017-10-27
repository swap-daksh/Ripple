{{-- Sidebar --}}
<aside class="col-md-2 side-bar-left no-padding">
    <div class="sidebar-inner">
        <ul class="nav-main">
            <li>
                <a class="active" href="{!! url('/admin') !!}"><i class="fa fa-dashboard"></i><span class="sidebar-mini-hide">Dashboard</span></a>
            </li>
            <li>
                <a class="" href="{!! route('Ripple::adminUserIndex') !!}"><i class="fa fa-users"></i><span class="sidebar-mini-hide">Users</span></a>
            </li>
            <li>
                <a class="" href="{!! route('Ripple::adminPostIndex') !!}"><i class="fa fa-file-text"></i><span class="sidebar-mini-hide">Posts</span></a>
            </li>
            <li>
                <a class="" href="{!! route('Ripple::adminPageIndex') !!}"><i class="fa fa-file"></i><span class="sidebar-mini-hide">Pages</span></a>
            </li>
            <li>
                <a href="{!! route('Ripple::adminSettings') !!}"><i class="fa fa-cog"></i><span class="sidebar-mini-hide">Settings</span></a>
            </li>
            <li>
                <a href="{!! route('Ripple::adminDatabase') !!}"><i class="fa fa-database"></i><span class="sidebar-mini-hide">Database</span></a>
            </li>
        </ul>
    </div>
</aside>
{{-- END Sidebar --}}
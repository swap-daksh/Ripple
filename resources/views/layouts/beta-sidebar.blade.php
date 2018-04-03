            <aside class="col-md-2 px-0 bg-dark rpl-sidebar" style="padding-top: 6.3rem;">
                <ul class="list-group list-group-flush ">
                    
                    
                    <li class="list-group-item">
                        <a class="list-link " href="{!! route('Ripple::adminIndexCategories') !!}" id="navbarDropdown">
                            <i class="fas fa-tags  "></i> Categories
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="list-link " href="{!! route('Ripple::adminPostIndex') !!}">
                            <i class="fas fa-newspaper "></i> News &amp; Blog
                        </a>
                    </li>
                    <li class="list-group-item" data-toggle="modal" data-target="#bread-module-pop">
                        <a class="list-link" href="javascript:void(0);">
                             <i class="fas fa-folder-open "></i> 
                            Bread Modules
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::databaseModule') !!}" role="button">
                            <i class="fa fa-database"></i> Database Tools
                        </a> 
                    </li>
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::settingModule') !!}" role="button">
                            <i class="fa fa-cog"></i> Global Settings
                        </a> 
                    </li>
                </ul>
            </aside>
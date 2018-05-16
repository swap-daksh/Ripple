            <aside class="col-md-2 px-0 bg-dark rpl-sidebar" style="padding-top: 6.3rem;">
                <ul class="list-group list-group-flush ">
                    
                    
                    <li class="list-group-item">
                        <a class="list-link " href="{!! route('Ripple::dealer.create') !!}" id="navbarDropdown">
                            <i class="far fa-plus-square"></i> Add Old Cars
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::dealergallery.index') !!}" role="button">
                            <i class="far fa-images"></i> Old Car Gallery
                        </a> 
                    </li>
                    <li class="list-group-item">
                        <a class="list-link " href="{!! route('Ripple::dealerUnapproved') !!}">
                            <i class="fas fa-car"></i> UnApproved Cars
                        </a>
                    </li>
                    
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::dealerApproved') !!}" role="button">
                            <i class="far fa-thumbs-up"></i> Approved Cars
                        </a> 
                    </li>
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::dealerSold') !!}" role="button">
                            <i class="far fa-money-bill-alt"></i> Sold Cars
                        </a> 
                    </li>
                    <li class="list-group-item">
                        <a class="list-link" href="{!! route('Ripple::editProfile') !!}" role="button">
                            <i class="fa fa-cog"></i> Edit Profile
                        </a> 
                    </li>
                </ul>
            </aside>
{{-- Side Overlay--}}
<aside id="side-overlay">
    {{-- Side Overlay Scroll Container --}}
    <div id="side-overlay-scroll">
        {{-- Side Header --}}
        <div class="side-header side-content">
            {{-- Layout API, functionality initialized in App() -> uiLayoutApi() --}}
            <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times"></i>
            </button>
            <span class="font-w600 push-10-l">Admin</span>
        </div>
        {{-- END Side Header --}}

        {{-- Side Content --}}
        <div class="side-content remove-padding-t">
            {{-- Block --}}
            <div class="block pull-r-l">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                        <li>
                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Quick Links</h3>
                </div>
                <div class="block-content">
                    <ul class="nav-users">
                        <li>
                            <a href="{!! route('Ripple::adminSettings') !!}">
                                <img class="img-avatar" src="{!! ripple_asset('/img/icons/setting.png') !!}" alt="">
                                <i class="fa fa-cog text-warning"></i> Settings
                                <div class="font-w400 text-muted"><small>Website settings.</small></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- END Block --}}
        </div>
        {{-- END Side Content --}}
    </div>
    {{-- END Side Overlay Scroll Container --}}
</aside>
{{-- END Side Overlay --}}
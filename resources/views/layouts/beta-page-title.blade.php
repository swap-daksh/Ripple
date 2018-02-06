<div class="col">
    <div class="d-flex align-items-center p-3 mt-3 text-white-50 rounded box-shadow bg-dark">
        <img class="mr-3" src="https://getbootstrap.com/assets/brand/bootstrap-outline.svg" alt="" width="48" height="48">
        <!--<img class="mr-3" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="48" height="48">-->
        <div class="lh-100">
            <h5 class="mb-0 text-white lh-100">@yield('page-title', 'Page Title')</h5>
            <small class="text-white">@yield('page-description', "Page Description")</small>
        </div>
        @yield('btn-add-new', '')
    </div>
</div>
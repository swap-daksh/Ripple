<footer class="footer row text-white" style="background: #6f42c1;">
    <div class="container p-3 align-middle text-center">
        <span class=" text-white">&copy; Yash Pal.</span>
    </div>
</footer>


{{-- Bread Modules Modal --}}
<div class="modal fade" id="bread-module-pop" tabindex="-1" role="dialog" aria-labelledby="bread-module-pop" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bread-module-pop-title"><a href="" class="rpl-links"><i class="fas fa-link"></i> &nbsp;Bread Modules </a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="list-group ">
                @forelse(DB::table(prefix('breads'))->where('status', 1)->get() as $bread)
                <a href="{!! route('Ripple::adminBreadBrowse', ['slug'=>$bread->slug]) !!}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        @if($bread->icon !== '')
                            <i class="fa fa-{!! $bread->icon !!}"></i>
                        @else
                            <i class="fas fa-th"></i>
                        @endif
                        {!! ucfirst($bread->display_plural) !!}
                    </h5>
                    <small><i class="fas fa-angle-double-right"></i></small>
                    </div>
                </a>
                @empty
                <div class="alert alert-danger col" role="alert">
                    <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Oops!</h4>
                    <p>Aww, seems that you have not created any bread modules yet.</p>
                    <hr>
                    <p class="mb-0"><a href="{!! route('Ripple::databaseTableBreads') !!}" class="alert-link">Click here</a> to create new bread module or click to <strong>Add New Bread</strong> button in page title bar.</p>
                </div>
                @endforelse
            </div>
      </div>
    </div>
  </div>
</div>
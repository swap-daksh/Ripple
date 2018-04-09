@extends('Ripple::layouts.beta-app')
@section('page-title') Database Table Breads @stop
@section('buttons')
<div class="buttons">
    <a href="{!! route('Ripple::databaseModule') !!}" class="btn btn-primary btn-sm"><i class="fa fa-database"></i> Database Modules</a>
    <a href="{!! route('Ripple::adminSettings', ['type'=>'bread']) !!}" class="btn btn-info btn-sm"><i class="fa fa-cogs"></i> Enable/Disable Bread</a>
</div>
@stop
@section('page-content')
<div class="container-fluid p3 mt-3">
    <div class="row mb-5">
        <div class="col">
            <div class="card rounded-0 h-100">
                <div class="card-header">Bread Tables</div>
                <div class="card-body">
                @forelse($tables as $table)
                
                @if(substr($table, 0, 3) !== 'rpl' && $table !== 'migrations')
                @if(DB::table('rpl_breads')->where('table', $table)->exists())
                    @php $bread = DB::table('rpl_breads')->where('table', $table)->first(); @endphp
                    <div class="card mb-2">
                        <div class="card-header">
                            @if($bread->icon !== '')
                            <i class="fa fa-{!! $bread->icon !!}"></i> 
                            @else
                            <i class="fas fa-list-alt"></i> 
                            @endif
                            {!! $table !!}
                            <div class="float-right">
                                <a href="{!! route('Ripple::adminEditBread', ['table' => $table]) !!}" class="badge badge-primary p-2"><i class="fas fa-edit"></i> Update</a> 
                                <a href="javascript:void(0);" onClick="deleteBread(this);" data-url="{!! route('Ripple::adminDeleteBread', ['table' => $table]) !!}" data-toggle="modal" data-target="#delete-bread-confirmation" class="badge badge-danger p-2"><i class="fas fa-trash"></i> Delete</a> 
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                @empty
                    <p>You haven't created any Bread Modules yet.</p>
                @endforelse
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card rounded-0 h-100">
                <div class="card-header">
                    Create Bread Table
                </div>
                <div class="card-body">
                @forelse($tables as $table)
                
                @if(substr($table, 0, 3) !== 'rpl' && $table !== 'migrations')
                @if(!DB::table('rpl_breads')->where('table', $table)->exists())
                    <div class="card mb-2">
                        <div class="card-header">
                            <i class="far fa-list-alt"></i> {!! $table !!}
                            <div class="float-right">
                                <a href="{!! route('Ripple::adminCreateBread', ['table'=>$table]) !!}" class="badge badge-success p-2"><i class="fas fa-plus-circle"></i> Create</a> 
                            </div>
                        </div>
                    </div>
                @endif
                @endif
                @empty
                    <p>There are no Table to create new Bread Module.</p>
                @endforelse
                </div>
            </div>
        </div>
    </div> 
</div>


<!-- Modal -->
<div class="modal fade" id="delete-bread-confirmation" tabindex="-1" role="dialog" aria-labelledby="delete-bread-confirmation" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete this bread?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="javascript:void(0);" id="yes-delete-bread" class="btn btn-primary">Yes</a>
      </div>
    </div>
  </div>
</div>
<script>
    function deleteBread(event){
        var url = event.getAttribute('data-url');
        document.getElementById('yes-delete-bread').setAttribute('href', url);
    }
</script>
@stop
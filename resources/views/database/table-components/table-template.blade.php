@section('table-template')
<form method="post" action="">
    {!! csrf_field() !!}
    <input type="hidden" value="zzz" name="create-table">
    <input type="hidden" value="" name="table-columns">
    <div class="table-responsive">
        <table class="table table-striped table-borderless text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">
                        Type
                    </th>
                    <th class="text-center">
                        Length
                    </th>
                    <th class="text-center">
                        Index
                    </th>
                    <th class="text-center">
                        Default
                    </th>
                    <th class="text-center">
                        unsigned
                    </th>
                    <th class="text-center">
                        NotNull
                    </th>
                    <th class="text-center">
                        Increment
                    </th>
                    <th class="text-center">
                        <i class="fa fa-bolt"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
            <table-columns v-for='(column, index) in columns' :index='index' :key="index" :column="column" @columnDeleted="deleteColumn"></table-columns>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 text-center margin-bottom">
        <button class="btn btn-primary" @click="addColumns" type="button"><i class="fa fa-plus"></i> Add New Column</button>
        <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Timestamps</button>
        <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add Soft Deletes</button>
    </div>
    <div class="col-md-12 text-center margin-bottom no-padding">

        <hr>
        <div class="col-md-6 no-padding">
            <input type="text" name="table" class="form-control" placeholder="Table Name">
        </div>
        <div class="col-md-6 no-padding">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Create Table</button>
        </div>
    </div>
</form>
@stop
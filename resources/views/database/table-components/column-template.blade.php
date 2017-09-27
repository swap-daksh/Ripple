
@section('table-column-template')
<tr>
    <td>
        <input type="text" v-model="column.name"  class="form-control table-input">
    </td>
    <td>
        <select class="form-control table-input datatypes" :value="column.type" >
            <optgroup v-for="(dataVal, dataName) in dataTypes" :label="dataName">
                <option v-for="(typeVal, typeName) in dataVal"  :value="typeName">@{{typeVal}}</option>
            </optgroup>
        </select>
    </td>
    <td>
        <input type="number" v-model="column.length" class="form-control table-input" placeholder="Length">
    </td>
    <td>
        <select class="form-control table-input"  :value="column.index" >
            <option value=""></option> 
            <option value="INDEX">INDEX</option> 
            <option value="UNIQUE">UNIQUE</option> 
            <option value="PRIMARY">PRIMARY</option>
        </select>
    </td>
    <td>
        <input type="number" v-model="column.default" class="form-control table-input"  >
    </td>
    <td>
        <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
            <input  v-if="column.unSigned" checked="" type="checkbox"  :value="column.unSigned" >
            <input  v-else type="checkbox"  :value="column.unSigned" >
            <span></span>
        </label>
    </td>
    <td>
        <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
            <input checked="" type="checkbox" v-if="column.notnull"  :value="column.notnull" >
            <input v-else type="checkbox"  :value="column.notnull" >
            <span></span>
        </label>
    </td>
    <td>
        <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
            <input checked="" v-if="column.autoincrement" type="checkbox"  :value="column.autoincrement" >
            <input v-else type="checkbox"  :value="column.autoincrement" >
            <span></span>
        </label>
    </td>
    <td><button class="btn btn-danger" type="button" @click="deleteColumn"><i class="fa fa-trash"></i></button></td>
</tr>
@stop

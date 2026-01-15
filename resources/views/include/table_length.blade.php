<div class="col-sm-12 col-md-3">
    @php($table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10)
    <select style="width: 100px" name="table_length" aria-controls="user_table"
            class="custom-select custom-select-sm form-control form-control-sm">
        @php($filter_name_parameter = url()->current() == url()->full()?url()->current().'?': url()->full(). '&')
        <option value="{{ $filter_name_parameter }}table_length=10"
                @if($table_length == 10) selected @endif>10
        </option>
        <option value="{{ $filter_name_parameter }}table_length=25"
                @if($table_length == 25) selected @endif>25
        </option>
        <option value="{{ $filter_name_parameter }}table_length=50"
                @if($table_length == 50) selected @endif>50
        </option>
        <option value="{{ $filter_name_parameter }}table_length=100"
                @if($table_length == 100) selected @endif>100
        </option>
    </select>


</div>

<div class="col-sm-12 col-md-3">
    <select v-model="perPage" @change="loadBranches()" class="custom-select custom-select-sm form-control form-control-sm" style="width: 100px">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>

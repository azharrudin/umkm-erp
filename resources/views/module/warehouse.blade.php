@extends('layouts.app')
@section('content')

<!-- Basic Tables start -->
<div class="modal" id="dialog">
    <div class="mb-0">
        <div class="form-body container">
            <div class="form-group ">
                <span class="text-small text-muted d-flex justify-content-start mb-1">Item Code</span>
                <input type="text" class="form-control" id="item_code" placeholder="e.g. HP-S674">
                <div class="text-start mb-0"><span class="text-secondary text-left text-sm mt-0 mb-0">item code must should have structure and without whitespaces</span></div>
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Name</h5>

                <input class="form-control" id="item_name" placeholder="e.g. Headphone Series 6-V74">
                <div class="text-start mb-0"><span class="text-secondary text-left text-sm mt-0 mb-0">item name should be related with item code</span></div>

            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Price (per unit)</h5>
                <input class="form-control" id="item_price" type="number" placeholder="e.g. 100000">
                <div class="text-start mb-0"><span class="text-secondary text-left text-sm mt-0 mb-0">pricing default set in rupiah, you can change this on settings</span></div>

            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Description</h5>

                <textarea class="form-control" id="item_name" placeholder="Ex, Long Tunic Dress With Shimmer Material"></textarea>
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Stocking Unit</h5>
                <select name="item_stocking_unit" id="item_stocking_unit" class="form-control">
                    <option value="pcs">pcs</option>
                    <option value="set">set (12 pcs)</option>
                    <option value="bundle">bundle (custom)</option>
                </select>
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Select Supplier</h5>
                <select class="form-control">
                    <option value="">Local Manufacturer</option>
                </select>
            </div>
            <div class="justify-content-start">
                <button class="btn btn-primary me-1 mb-1" onclick="insertData(this)">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="dialogedit">
    <div class="mt-2 mb-0 p-3">

        <div class="form-body">

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Code</h5>
                <input type="text" class="form-control" id="item_code" placeholder="Ex, T-202">
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Name</h5>

                <input class="form-control" id="item_name" placeholder="Ex, Long Tunic Dress">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Price (per unit)</h5>
                <input class="form-control" id="item_price" placeholder="Ex, 100000">
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Description</h5>

                <textarea class="form-control" id="item_name" placeholder="Ex, Long Tunic Dress With Shimmer Material"></textarea>
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Coming Date</h5>

                <input type="date" class="form-control" id="item_since" placeholder="Item Inserted Date">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Stocking Unit</h5>
                <select name="item_stocking_unit" id="item_stocking_unit" class="form-control">
                    <option value="pcs">pcs</option>
                    <option value="set">set (12 pcs)</option>
                    <option value="bundle">bundle (custom)</option>
                </select>
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Quantity</h5>

                <input id="item_quantity" type="number" class="form-control" placeholder="Ex, 100">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Vendor Name</h5>

                <input id="vendor_name" class="form-control" placeholder="Item Inserted Date">
            </div>

            <div class="justify-content-start">
                <button class="btn btn-primary me-1 mb-1" onclick="editData(this)">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editWarehouseLogModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Warehouse Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editWarehouseLogForm">
                    <input type="hidden" id="log_id">
                    <div class="mb-3">
                        <label for="edit_item_id" class="form-label">Item</label>
                        <select class="form-select" id="edit_item_id" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_branch_id" class="form-label">Branch</label>
                        <select id="edit_branch_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="edit_tags" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_actions" class="form-label">Actions</label>
                        <select class="form-select" id="edit_actions" required>
                            <option value="added">Added</option>
                            <option value="removed">Removed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="edit_quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="edit_notes" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="main mt-3" id="main" style="padding-top: 0px;">
    <div class="mb-1 p-3">
        <h3 class="text-danger mb-1">Warehouse</h3>
        <span class="mt-0">Dashboard > Warehouse > <span class="text-muted">List</span></span>
    </div>
    <div class="card p-3">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Master Data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false" onclick="table_logs.ajax.reload()">Logs / Movements</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Archived Products</button>
            </li> -->
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="w-100 card p-0 mb-2" style="box-shadow: none;">
                    <div class="card" style="box-shadow: none;">
                        <div class="w-100 card p-0 mb-0" style="box-shadow: none;border: none">
                            <div class="card-body p-0 m-0">
                                <div class="buttons p-0 m-0">
                                    <div class="btn-group btn-group-sm p-2 pb-0 m-0" role="group" aria-label="Basic example" style="box-shadow: none;">
                                        <button type="button" class="btn btn-outline-primary" onclick="showDialog(this)">CREATE ITEM</button>
                                        <button type="button" class="btn btn-outline-secondary">ADD STOCK</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr class="mt-0 ">
                        <div class="card-body">
                            <table id="example" class="table table-striped table-sm" style="width:100%;">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="card p-3">
                    <table id="example2" class="table table-sm table-striped" style="width:100%;">

                    </table>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }


    $(document).on("click", ".editProductLogBtn", function() {
        let logId = $(this).data("id");
        let url = "{{ route('warehouse.products.logs.get_id', ':id') }}"
        url = url.replace(":id", logId)
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                $("#log_id").val(response.id);
                $("#edit_tags").val(response.tags);
                $("#edit_actions").val(response.actions);
                $("#edit_quantity").val(response.quantity);
                $("#edit_notes").val(response.notes);


                $('#edit_item_id').select2({
                    placeholder: "Select a Product",
                    theme: "bootstrap",
                    dropdownParent: $('#editWarehouseLogModal'),
                    ajax: {
                        url: "/api/fetch/warehouse/items",
                        dataType: "json",
                        delay: 250,
                        data: function(params) {
                            console.log(params)
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            console.log(data.results)

                            return {
                                results: data.results.map(dat => ({
                                    id: dat.id,
                                    text: dat.item_code
                                })),
                                pagination: {
                                    more: data.pagination.more,
                                }
                            };
                        }
                    },
                    allowClear: true
                });
                let option = new Option(response.item.item_code, response.item.id, true, true);
                $('#edit_item_id').append(option).trigger('change');

                $('#edit_branch_id').select2({
                    placeholder: "Select a branch",
                    theme: "bootstrap",
                    dropdownParent: $('#editWarehouseLogModal'),
                    ajax: {
                        url: "/api/fetch/warehouse/branches",
                        dataType: "json",
                        delay: 250,
                        data: function(params) {
                            console.log(params)
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function(data, params) {
                            params.page = params.page || 1;
                            console.log(data.results)

                            return {
                                results: data.results.map(branch => ({
                                    id: branch.id,
                                    text: branch.name
                                })),
                                pagination: {
                                    more: data.pagination.more,
                                }
                            };
                        }
                    },
                    allowClear: true
                });
                option = new Option(response.branch.name, response.branch.id, true, true);
                $('#edit_branch_id').append(option).trigger('change');
                $("#editWarehouseLogModal").modal("show");
            },
            error: function() {
                alert("Failed to fetch log data.");
            }
        });
    });


    var table_logs = $('#example2').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
            url: "{{ route('warehouse.products.logs.get') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
        },

        "columns": [{
                "data": "id",
                "name": "id",
                "title": "id"
            },
            {
                "data": "item.item_code",
                "name": "item.item_code",
                "title": "Product Code"
            },
            {
                "data": "item.item_price",
                "name": "item.item_price",
                "title": "Product Price",

                render: function(data, type) {


                    return rupiah(data);
                }
            },

            {
                "data": "quantity",
                "name": "quantity",
                "title": "Quantity",

            },
            {
                "title": "Stocking Unit",
                "data": "item.item_stocking_unit",
                "name": "item.item_stocking_unit"

            },
            {
                "title": "Action Type",
                "data": "actions",
                "name": "actions"

            },
            {
                "title": "Branch Name",
                "data": "branch.name",
                "name": "branch.name"

            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                title: 'Actions'
            }


        ]
    });

    var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
            url: "{{ url('api/warehouse') }}",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
        },

        "columns": [{
                data: 'item.id',
                name: 'item.id',
                title: 'Item ID'
            },
            {
                data: 'item.item_code',
                name: 'item.item_code',
                title: 'Item Code'
            },
            {
                data: 'item.item_name',
                name: 'item.item_name',
                title: 'Item Name'
            },
            {
                data: 'item.item_price',
                name: 'item.item_price',
                title: 'Item Price',
                render: function(nr) {
                    return nr < 0 ? "<i class='text text-danger'>" + rupiah(nr) + "</i>" : rupiah(nr)
                }

            },


            {
                data: 'total_quantity',
                name: 'total_quantity',
                title: 'Total Quantity',
                render: function(nr) {
                    return nr < 0 ? "<i class='text text-danger'>" + nr + "</i>" : nr
                }

            },
            {
                data: 'branch_names',
                name: 'branch_names',
                title: 'Branch Name',
                render: function(nr) {
                    let s = nr.split(",").map((x) => x.trim())
                    if (s.length > 2) {
                        return s[0] + ", " + s[1] + ', ...'
                    } else
                        return nr
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                title: 'Actions'
            }

        ]
    });

    function showDialog() {
        Swal.fire({
            html: $("#dialog").html(),
            showConfirmButton: false,

        })
    }

    function deleteItem(id) {
        $.ajax({
            url: "/api/warehouse/delete",
            type: 'POST',
            data: {
                "id": id

            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data, status) {
                table.ajax.reload();
            },
            error: function(xhr, desc, err) {
                console.log("error");
            }
        });
    }

    function showDialogEdit(v) {
        $n = $($("#dialogedit").html())

        $n.find("#item_code").val($($(v).parent().parent().find("td")[1]).html())
        $n.find("#item_price").val($($(v).parent().parent().find("td")[2]).html())
        $n.find("#item_quantity").val($($(v).parent().parent().find("td")[3]).html())
        $n.find("#item_stocking_unit").val($($(v).parent().parent().find("td")[4]).html())
        $n.find("#item_since").val($($(v).parent().parent().find("td")[5]).html())
        $n.find("#item_name").val($($(v).parent().parent().find("td")[6]).html())
        $n.find("#vendor_name").val($($(v).parent().parent().find("td")[7]).html())
        Swal.fire({
            html: $n,
            showConfirmButton: false,
        })
    }

    function insertData(c) {
        var x = $(c).parent().parent()
        $.ajax({
            url: "/api/warehouse",
            type: 'POST',
            data: {
                "item_code": x.find('#item_code').val(),
                "item_stocking_unit": x.find('#item_stocking_unit').val(),
                "item_price": x.find('#item_price').val(),
                "item_since": x.find('#item_since').val(),
                "item_name": x.find('#item_name').val(),
                "quantity": x.find('#item_quantity').val(),
                "vendor_name": x.find('#vendor_name').val(),
                "confirmed": 0
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data, status) {

                table.ajax.reload();
            },
            error: function(xhr, desc, err) {
                console.log("error");
            }
        });
    }

    function editData(c) {
        var x = $(c).parent().parent()
        $.ajax({
            url: "/api/warehouse/edit",
            type: 'POST',
            data: {
                "item_code": x.find('#item_code').val(),
                "item_stocking_unit": x.find('#item_stocking_unit').val(),
                "item_price": x.find('#item_price').val(),
                "item_since": x.find('#item_since').val(),
                "item_name": x.find('#item_name').val(),
                "quantity": x.find('#item_quantity').val(),
                "vendor_name": x.find('#vendor_name').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data, status) {
                table.ajax.reload();
                Swal.close();
            },
            error: function(xhr, desc, err) {
                console.log("error");
            }
        });
    }
</script>

<!-- Basic Tables end -->
@endsection
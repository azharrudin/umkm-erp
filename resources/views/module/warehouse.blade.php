@extends('layouts.app')
@section('content')

<!-- Basic Tables start -->

<div class="modal" id="dialog">

    <div class="mb-0">

        <div class="form-body">

            <div class="form-group">
                <span class="text-small text-muted d-flex justify-content-start mb-1">Item Code</span>
                <input type="text" class="form-control" id="item_code" placeholder="Ex, T-202">
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Name</h5>

                <input class="form-control" id="item_name" placeholder="Ex, Long Tunic Dress">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Price (per unit)</h5>
                <input class="form-control" id="item_price" type="number" placeholder="Ex, 100000">
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Description</h5>

                <textarea class="form-control" id="item_name" placeholder="Ex, Long Tunic Dress With Shimmer Material"></textarea>
            </div>

            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Coming Date</h5>

                <input type="date" class="form-control" id="item_since">
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

                <input id="item_quantity" type="number" class="form-control" placeholder="Ex, 130">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Vendor Name</h5>

                <input id="vendor_name" class="form-control" placeholder="Ex, TZR Manufacture">
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
<div class="main" id="main" style="padding-top: 0px;">
    @section("action_button")
    @endsection
    @section("navigation")
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Master Data</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">History</button>
        </li>

    </ul>
    @endsection
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="w-100 card p-0 mb-2" style="box-shadow: none;">

                <div class="card" style="box-shadow: none;">
                    <div class="w-100 card p-0 mb-0" style="box-shadow: none;border: none">
                        <div class="card-body p-0 m-0">
                            <div class="buttons p-0 m-0">
                                <div class="btn-group btn-group-sm p-2 pb-0 m-0" role="group" aria-label="Basic example" style="box-shadow: none;">
                                    <button type="button" class="btn" onclick="showDialog(this)">Left</button>
                                    <button type="button" class="btn btn-primary">Middle</button>
                                    <button type="button" class="btn">Right</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr class="mt-0 ">
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Stocking Unit</th>
                                    <th>Date Entered</th>
                                    <th>Item Description</th>
                                    <th>Vendor</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                <div class="card-header">
                    Warehouse Data
                    </button>

                </div>
                <div class="card-body">
                    <table id="example2" class="display table" style="width:100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Stocking Unit</th>
                                <th>Date Entered</th>
                                <th>Item Description</th>
                                <th>Vendor</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
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

            var table = $('#example2').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    url: "{{ url('api/warehouse/history') }}",

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
                },

                "columns": [{
                        "data": "id",
                        "name": "id"
                    },
                    {
                        "data": "item_code",
                        "name": "item_code"
                    },
                    {
                        "data": "item_price",
                        "name": "item_price",
                        render: function(data, type) {


                            return rupiah(data);
                        }
                    },

                    {
                        "data": "quantity",
                        "name": "quantity"
                    },
                    {
                        "data": "item_stocking_unit",
                        "name": "item_stocking_unit"
                    },

                    {
                        "data": "item_since",
                        "name": "item_since"
                    },

                    {
                        "data": "item_name",
                        "name": "item_name"
                    },
                    {
                        "data": "vendor_name",
                        "name": "vendor_name"
                    },
                    {
                        "data": "action",
                        "name": "action"
                    },
                ]
            });

            var table = $('#example').DataTable({
                "processing": true,
                "serverSide": true,

                "ajax": {
                    url: "{{ url('api/warehouse') }}",

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
                },

                "columns": [{
                        "data": "id",
                        "name": "id"
                    },
                    {
                        "data": "item_code",
                        "name": "item_code"
                    },
                    {
                        "data": "item_price",
                        "name": "item_price",
                        render: function(data, type) {


                            return rupiah(data);
                        }
                    },

                    {
                        "data": "mqty",
                        "name": "mqty"
                    },
                    {
                        "data": "item_stocking_unit",
                        "name": "item_stocking_unit"
                    },

                    {
                        "data": "item_since",
                        "name": "item_since"
                    },

                    {
                        "data": "item_name",
                        "name": "item_name"
                    },
                    {
                        "data": "vendor_name",
                        "name": "vendor_name"
                    },
                    {
                        "data": "action",
                        "name": "action"
                    },
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
    </div>
    <!-- Basic Tables end -->
    @endsection
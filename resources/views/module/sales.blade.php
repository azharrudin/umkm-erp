@extends('layouts.app')
@section('content')

<!-- Basic Tables start -->
<div class="modal" id="dialog">
    <div class="mt-2 mb-0 p-3">

        <div class="form-body">


            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-1">Item Code</h5>
                <select name="item_code" id="item_code" class="form-control">

                </select>
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-0">Amount of selling</h5>

                <input type="number" class="form-control" id="totalcount" placeholder="Amount of unit selling">
            </div>


            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-0">Selling Date</h5>

                <input id="selldate" type="date" class="form-control" placeholder="Selling Date">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-0">Invoices No</h5>

                <input id="invoice" class="form-control" placeholder="Invoices No">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-0">Discount (%)</h5>
                <input id="discount" class="form-control" placeholder="Discount">
            </div>
            <div class="form-group">
                <h5 class="text-small d-flex justify-content-start mb-0">Total Tax (%)</h5>
                <input id="tax" class="form-control" placeholder="Total Tax">
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

        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-1">Item Code</h5>
            <select name="item_code" id="e_item_code" class="form-control">

            </select>
        </div>
        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-0">Amount of selling</h5>

            <input type="number" class="form-control" id="totalcount" placeholder="Amount of unit selling">
        </div>


        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-0">Selling Date</h5>

            <input id="selldate" type="date" class="form-control" placeholder="Selling Date">
        </div>
        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-0">Invoices No</h5>

            <input id="invoice" class="form-control" placeholder="Invoices No">
        </div>
        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-0">Discount (%)</h5>
            <input id="discount" class="form-control" placeholder="Discount">
        </div>
        <div class="form-group">
            <h5 class="text-small d-flex justify-content-start mb-0">Total Tax (%)</h5>
            <input id="tax" class="form-control" placeholder="Total Tax">
        </div>
        <input id="id" class="form-control" type="hidden">

        <div class="justify-content-start">
            <button class="btn btn-primary me-1 mb-1" onclick="editData(this)">Submit</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
        </div>
    </div>
</div>
<div class="main" id="main">
    <div class="container row">
        <div class="col mb-2">
            <button class="btn btn-primary" onclick="showDialog(this)">New Data</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Warehouse Data
            </button>
        </div>
        <div class="card-body">
            <table id="example" class="display compact table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item Code</th>
                        <th>Item Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>

                        <th>Discount</th>
                        <th>Total Tax</th>
                        <th>Net Price</th>
                        <th>Sell Date</th>

                        <th>Invoices</th>

                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
        <script>
            var table = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ url('api/sales') }}",

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
                        "name": "item_price"
                    },
                    {
                        "data": "totalcount",
                        "name": "totalcount"
                    },
                    {
                        "data": "totalprice_before",
                        "name": "totalprice_before"
                    },
                    {
                        "data": "discount",
                        "name": "discount"
                    },
                    {
                        "data": "tax",
                        "name": "tax"
                    },
                    {
                        "data": "total_price",
                        "name": "total_price"
                    },

                    {
                        "data": "selldate",
                        "name": "selldate"
                    },
                    {
                        "data": "invoice",
                        "name": "invoice"
                    },
                    {
                        "data": "action",
                        "name": "action"
                    },
                ]
            });

            async function showDialog() {
                var o = $($("dialog").html())
                var m = await getPost()
                $.each(m.data, function(i, item) {
                    $('#item_code').append($('<option>', {
                        value: item.item_code,
                        text: item.item_code
                    }));
                });
                Swal.fire({
                    html: $("#dialog").html(),
                    showConfirmButton: false
                })
            }
            const getPost = async () => {
                const response = await fetch('{{ url("/api/warehouse") }}');
                console.log(response);
                const data = response.json();
                return data;
            };


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

            async function showDialogEdit(v) {
                var m = await getPost()
                $.each(m.data, function(i, item) {
                    $('#e_item_code').append($('<option>', {
                        value: item.item_code,
                        text: item.item_code
                    }));

                });
                $n = $($("#dialogedit").html())
                $n.find("#e_item_code").val($($(v).parent().parent().find("td")[1]).html())
                $n.find("#totalcount").val($($(v).parent().parent().find("td")[3]).html())
                $n.find("#selldate").val($($(v).parent().parent().find("td")[8]).html())
                $n.find("#discount").val($($(v).parent().parent().find("td")[5]).html().replace("%",""))
                $n.find("#invoice").val($($(v).parent().parent().find("td")[9]).html())
                $n.find("#tax").val($($(v).parent().parent().find("td")[6]).html())
                $n.find("#id").val($($(v).parent().parent().find("td")[0]).html())
                console.log($n.find("#id").val())

                Swal.fire({
                    html: $n,
                    showConfirmButton: false
                })
            }


            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            function editData(c) {
                var x = $(c).parent().parent()
                console.log("0")
                $.ajax({
                    url: "/api/sales",
                    type: 'POST',
                    data: {
                        'item_code': x.find('#e_item_code').find(":selected").val(),
                        'totalcount': x.find('#totalcount').val(),
                        'totalprice': 0,
                        'selldate': x.find('#selldate').val(),
                        'invoice': x.find('#invoice').val(),
                        'discount': x.find('#discount').val(),
                        "confirmed": 0
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data, status) {
                        if (x.find('#totalcount').val() > data.quantity) {
                            alert("[ES-001]: Invalid quantity (cause: quantity higher than available in inventory)")
                            return
                        }
                        var tax = (x.find('#tax').val() / 100) * (data.item_price * x.find('#totalcount').val())

                        Swal.close()
                        Swal.fire({
                            html: "<div class='text-start'>Confirmation(" + x.find('#e_item_code').find(":selected").val() + ")<hr>Item Price: " + rupiah(data.item_price) + "<hr>Quantity: " + x.find('#totalcount').val() + " " + data.item_stocking_unit + "<hr>Total Price: " + rupiah(data.item_price * x.find('#totalcount').val()) + "<hr>Discount: " + x.find('#discount').val() + "%<hr>Tax: " + x.find('#tax').val() + "%<hr>Net Price: <b>" + rupiah((data.item_price * x.find('#totalcount').val()) - ((x.find('#discount').val() / 100) * (data.item_price * x.find('#totalcount').val())) + tax) + "</b>",
                            showConfirmButton: true,
                            showCancelButton: true,

                        }).then((obj) => {
                            
                            if (obj.isConfirmed)
                                $.ajax({
                                    url: "/api/sales/edit",
                                    type: 'POST',
                                    data: {
                                        'item_code': x.find('#e_item_code').find(":selected").val(),
                                        'totalcount': x.find('#totalcount').val(),
                                        'totalprice': (data.item_price * x.find('#totalcount').val()) - ((x.find('#discount').val() / 100) * data.item_price * x.find('#totalcount').val()) + tax,
                                        'selldate': x.find('#selldate').val(),
                                        'tax': x.find('#tax').val(),
                                        'invoice': x.find('#invoice').val(),
                                        'discount': x.find('#discount').val(),
                                        "confirmed": 1,
                                        "id":  x.find('#id').val()
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
                            table.ajax.reload();

                        })
                    },
                    error: function(xhr, desc, err) {
                        console.log("error");
                    }
                });
            }

            function insertData(c) {
                var x = $(c).parent().parent()
                $.ajax({
                    url: "/api/sales",
                    type: 'POST',
                    data: {
                        'item_code': x.find('#item_code').find(":selected").val(),
                        'totalcount': x.find('#totalcount').val(),
                        'totalprice': 0,
                        'selldate': x.find('#selldate').val(),
                        'invoice': x.find('#invoice').val(),
                        'discount': x.find('#discount').val(),
                        "confirmed": 0
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data, status) {
                        if (x.find('#totalcount').val() > data.quantity) {
                            alert("[ES-001]: Invalid quantity (cause: quantity higher than available in inventory)")
                            return
                        }
                        var tax = (x.find('#tax').val() / 100) * (data.item_price * x.find('#totalcount').val())

                        Swal.close()
                        Swal.fire({
                            html: "<div class='text-start'>Confirmation(" + x.find('#item_code').find(":selected").val() + ")<hr>Item Price: " + rupiah(data.item_price) + "<hr>Quantity: " + x.find('#totalcount').val() + " " + data.item_stocking_unit + "<hr>Total Price: " + rupiah(data.item_price * x.find('#totalcount').val()) + "<hr>Discount: " + x.find('#discount').val() + "%<hr>Tax: " + x.find('#tax').val() + "%<hr>Net Price: <b>" + rupiah((data.item_price * x.find('#totalcount').val()) - ((x.find('#discount').val() / 100) * (data.item_price * x.find('#totalcount').val())) + tax) + "</b>",
                            showConfirmButton: true,
                            showCancelButton: true,

                        }).then((obj) => {
                            if (obj.isConfirmed)
                                $.ajax({
                                    url: "/api/sales",
                                    type: 'POST',
                                    data: {
                                        'item_code': x.find('#item_code').find(":selected").val(),
                                        'totalcount': x.find('#totalcount').val(),
                                        'totalprice': (data.item_price * x.find('#totalcount').val()) - ((x.find('#discount').val() / 100) * data.item_price * x.find('#totalcount').val()) + tax,
                                        'selldate': x.find('#selldate').val(),
                                        'tax': x.find('#tax').val(),
                                        'invoice': x.find('#invoice').val(),
                                        'discount': x.find('#discount').val(),
                                        "confirmed": 1
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
                            table.ajax.reload();

                        })
                    },
                    error: function(xhr, desc, err) {
                        console.log("error");
                    }
                });
            }

            function _editData(c) {
                var x = $(c).parent().parent()
                $.ajax({
                    url: "/api/warehouse/edit",
                    type: 'POST',
                    data: {
                        "item_code": x.find('#item_code').val(),
                        "item_stocking_unit": x.find('#item_stocking_unit').val(),
                        "item_price": x.find('#item_price').val(),
                        "item_since": x.find('#item_since').val(),
                        "item_description": x.find('#item_description').val(),
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
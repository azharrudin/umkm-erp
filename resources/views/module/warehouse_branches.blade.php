@extends('layouts.app')
@section('content')

<!-- Basic Tables start -->
<!-- Supplier Modal -->
<div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supplierModalLabel">Add Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Supplier Form -->
                <form id="supplierForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="sector" class="form-label">Sector</label>
                        <input type="text" class="form-control" id="sector" name="sector" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">Status</label>
                        <select class="form-control" id="active" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end"><button type="submit" class="btn btn-success btn-sm">Save Supplier</button></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit Supplier Form -->
                <form id="editSupplierForm">
                    @csrf
                    @method('POST') <!-- For PUT method for Laravel -->
                    <input type="hidden" id="edit_supplier_id" name="id">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="edit_contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_sector" class="form-label">Sector</label>
                        <input type="text" class="form-control" id="edit_sector" name="sector" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label">Address</label>
                        <textarea class="form-control" id="edit_address" name="address" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="edit_notes" name="notes" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_active" class="form-label">Status</label>
                        <select class="form-control" id="edit_active" name="active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
                <div id="editSuccessMessage" style="display:none; color: green;"></div>
                <div id="editErrorMessage" style="display:none; color: red;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!------->
<div class="main mt-3" id="main" style="padding-top: 0px;">
    <div class="mb-1 p-3">
        <h3 class="text-danger mb-1">Warehouse</h3>
        <span class="mt-0">Dashboard > Warehouse > <span class="text-muted">Branches</span></span>
    </div>
    <div class="card p-3">
        <ul class="nav nav-tabs mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Master Data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">History</button>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active mt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="w-100 card p-0 mb-2" style="box-shadow: none;">
                    <div class="card" style="box-shadow: none;">
                        <div class="w-100 card p-0 mb-0" style="box-shadow: none;border: none">
                            <div class="card-body p-0 m-0">
                                <div class="buttons p-0 m-0">
                                    <div class="btn-group btn-group-sm p-2 pb-0 m-0" role="group" aria-label="Basic example" style="box-shadow: none;">
                                        <button type="button" class="btn btn-outline-primary" onclick="openAddSupplierModal(this)">CREATE ITEM</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr class="mt-0 ">
                        <div class="card-body">
                            <table id="example" class="table table-striped" style="width:100%;">
                                <thead>
                                    <tr>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="card p-3">

            </div>
        </div>
    </div>

</div>

<script>
    function openAddSupplierModal() {
        $('#supplierModal').modal('show');
    }

    // Trigger the modal
    $('#openModalButton').click(function() {
        openAddSupplierModal();
    });

    $('#supplierForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Collect form data

        $.ajax({
            url: "{{ route('warehouse.branches.add') }}", // Your Laravel route
            type: 'POST',
            data: formData,
            success: function(response) {
                // If successful, show a success message and clear the form
                $('#successMessage').text('Supplier added successfully!').show();
                $('#supplierForm')[0].reset();
                setTimeout(function() {
                    $('#successMessage').fadeOut();
                    $('#supplierModal').modal('hide');
                }, 2000);
                table.ajax.reload()
            },
            error: function(xhr, status, error) {
                // If an error occurs, show the error message
                $('#errorMessage').text('There was an error adding the supplier. Please try again.').show();
                setTimeout(function() {
                    $('#errorMessage').fadeOut();
                }, 3000);
            }
        });
    });

    function openEditSupplierModal(supplierId) {
        var url = "{{ route('warehouse.supplier.get_id', ':id') }}";
        url = url.replace(':id', supplierId);
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Populate the modal with the supplier data
                $('#edit_supplier_id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_contact').val(response.contact);
                $('#edit_sector').val(response.sector);
                $('#edit_address').val(response.address);
                $('#edit_notes').val(response.notes);
                $('#edit_active').val(response.active);

                // Show the modal
                $('#editSupplierModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log('Error fetching supplier data.');
            }
        });
    }

    // Submit the Edit Supplier Form via AJAX
    $('#editSupplierForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission
        var formData = $(this).serialize(); // Collect form data
        var supplierId = $('#edit_supplier_id').val(); // Get supplier ID
        var url = "{{ route('warehouse.supplier.edit') }}";
        $.ajax({
            url: url, // Your route to update supplier by ID
            type: 'POST',
            data: formData,
            success: function(response) {
                // If successful, show a success message and close the modal
                $('#editSuccessMessage').text('Supplier updated successfully!').show();
                setTimeout(function() {
                    $('#editSuccessMessage').fadeOut();
                    $('#editSupplierModal').modal('hide');
                }, 2000);
                table.ajax.reload()
            },
            error: function(xhr, status, error) {
                // If an error occurs, show the error message
                $('#editErrorMessage').text('There was an error updating the supplier. Please try again.').show();
                setTimeout(function() {
                    $('#editErrorMessage').fadeOut();
                }, 3000);
            }
        });
    });

    function openDeleteSupplierModal(supplierId) {
        Swal.fire({
            title: "This data can be deleted, but it is not recommended",
            text: "You can label this data as 'inactive' to avoid database errors.",
            icon: "warning",
            showCancelButton: true,
            showDenyButton: true,
            confirmButtonText: "Deactivate it",
            denyButtonText: "Force Delete",
            cancelButtonText: "Close"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deactivated!", "The data has been marked as inactive.", "success");
            } else if (result.isDenied) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "Please ask your DB administrator first!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, force delete",
                    cancelButtonText: "Cancel"
                }).then((confirmResult) => {
                    if (confirmResult.isConfirmed) {
                        Swal.fire("Deleted!", "The data has been permanently deleted.", "error");
                    }
                });
            }
        });

    }
    // Event listener for Edit button (trigger the edit modal)
    $('body').on('click', '.editSupplierBtn', function() {
        var supplierId = $(this).data('id'); // Get the supplier ID
        openEditSupplierModal(supplierId); // Open the modal with the supplier's data
    });
    $('body').on('click', '.deleteSupplierBtn', function() {
        var supplierId = $(this).data('id'); // Get the supplier ID
        openDeleteSupplierModal(supplierId); // Open the modal with the supplier's data
    });
    var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "ajax": {
            url: "{{ route('warehouse.branches.get') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },

        "columns": [{
                data: 'id',
                title: 'ID'
            },
            {
                data: 'name',
                title: 'Branch Name'
            },
            {
                data: 'maximum_capacity',
                title: 'Maximum Capacity'
            },
        
            {
                data: 'address',
                title: 'Location'
            },
            {
                data: 'notes',
                title: 'Notes'
            },
            {
                data: 'active',
                title: 'Status',
                render: function(data, type, row) {
                    return data ? "<span class='badge bg-success'>Active</span>" : "<span class='badge bg-danger'>Inactive</span>";
                }
            },
            {
                data: 'created_at',
                title: 'Created At',
                render: function(data) {
                    return new Date(data).toLocaleString();
                }
            },
            {
                data: 'updated_at',
                title: 'Updated At',
                render: function(data) {
                    return new Date(data).toLocaleString();
                }
            },
            {
                data: 'action',
                title: 'Actions',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return data;
                }
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
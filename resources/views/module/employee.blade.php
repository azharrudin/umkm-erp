@extends('layouts.app')
@section('content')

<!-- Basic Tables start -->
<div class="modal" id="dialog">
    <div class="mt-2 mb-0 p-3 text-start">

        <div class="form-body">

            <div class="form-group">
                <h5>Name</h5>
                <input type="text" class="form-control" id="name" name="name" value="Ex, Aditya">
            </div>
            <div class="form-group">
                <h5>Email</h5>
                <input type="email" class="form-control" id="email" name="email" value="Ex, aditya@mitazfsh.com">
            </div>
            <div class="form-group">
                <h5>Position</h5>
                <input class="form-control" id="position" name="position">
            </div>
            <div class="form-group">
                <h5>Address</h5>
                <input type="text" class="form-control" id="address" name="address" value="Ex, Malang">
            </div>
            <div class="form-group">
                <h5>Date Joined</h5>
                <input type="date" class="form-control" id="date_joined" name="date_joined">
            </div>

            <div class="form-group">
                <h5>Salary</h5>
                <input type="number" class="form-control" id="salary" name="salary">
                <small class="text-muted">set fixed & non-fixed salary</small>
            </div>
            <div class=" form-group">
                <h5>Salary Type</h5>
                <select class="form-control" id="salary_method" name="salary_method">
                    <option value="fixed" selected>Fixed</option>
                    <option value="non-fixed">Non-Fixed</option>
                </select>
                <small class="text-muted">if set to non-fixed the number in salary field will become minimum salary</small>
            </div>
            <div class=" form-group">
                <h5>Salary Period</h5>
                <select class="form-control" id="salary_period" name="salary_period">
                    <option value="weekly">Weekly</option>

                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
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

    <div class="mt-2 mb-0 p-3 text-start">
        <div class="form-body">

            <div class="form-group">
                <h5>ID</h5>
                <input type="text" class="form-control" id="id" name="id" disabled>
            </div>
            <div class="form-group">
                <h5>Name</h5>
                <input type="text" class="form-control" id="name" name="name" value="Ex, Aditya">
            </div>
            <div class="form-group">
                <h5>Email</h5>
                <input type="email" class="form-control" id="email" name="email" value="Ex, aditya@mitazfsh.com">
            </div>
            <div class="form-group">
                <h5>Position</h5>
                <input class="form-control" id="position" name="position">
            </div>
            <div class="form-group">
                <h5>Address</h5>
                <input type="text" class="form-control" id="address" name="address" value="Ex, Malang">
            </div>
            <div class="form-group">
                <h5>Date Joined</h5>
                <input type="date" class="form-control" id="date_joined" name="date_joined">
            </div>

            <div class="form-group">
                <h5>Salary</h5>
                <input type="number" class="form-control" id="salary" name="salary">
                <small class="text-muted">set fixed & non-fixed salary</small>
            </div>
            <div class=" form-group">
                <h5>Salary Type</h5>
                <select class="form-control" id="salary_method" name="salary_method">
                    <option value="fixed" selected>Fixed</option>
                    <option value="non-fixed">Non-Fixed</option>
                </select>
                <small class="text-muted">if set to non-fixed the number in salary field will become minimum salary</small>
            </div>
            <div class=" form-group">
                <h5>Salary Period</h5>
                <select class="form-control" id="salary_period" name="salary_period">
                    <option value="weekly">Weekly</option>

                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>

            <div class="justify-content-start">
                <button class="btn btn-primary me-1 mb-1" onclick="editData(this)">Submit</button>
                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
            </div>
        </div>
    </div>
</div>
<div class="main" id="main">
    @section("navigation")

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">EMPLOYEE</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">PENDING SALARY</button>
        </li>


    </ul>
    @endsection
    <div class="container row">

    </div>
    <div class="card">
        <div class="w-100 card p-0 mb-2" style="box-shadow: none; border: none">
            <div class="card-body p-2 pb-1">
                <div class="buttons p-0 m-0">
                    <div class="btn-group btn-group-sm mb-0 pb-0" role="group" aria-label="Basic example" style="box-shadow: none;">
                        <button type="button" class="btn btn-primary mb-0" onclick="showDialog(this)">ADD</button>
                        <button type="button" class="btn btn-secondary mb-0">Regex Delete</button>
                        <button type="button" class="btn btn-secondary mb-0">Reset Table</button>
                    </div>

                </div>
            </div>
        </div>
        <hr class="mt-0 pt-0">
        <div class="card-body">
            <table id="example" class="display compact table table-striped" style="width:100%;box-shadow: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Salary Period</th>
                        <th>Salary Method</th>
                        <th>Date Joined</th>
                        <th>Active</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
        <script>
            const rupiah = (number) => {
                return new Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR"
                }).format(number);
            }

            var table = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "{{ url('api/employee') }}",

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
                },


                "columns": [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'salary',
                        name: 'salary',
                        render: function(data, type) {
                            return rupiah(data);
                        }
                    },
                    {
                        data: 'salary_period',
                        name: 'salary_period'
                    },
                    {
                        data: 'salary_method',
                        name: 'salary_method'
                    },

                    {
                        data: 'date_joined',
                        name: 'date_joined'
                    },

                    {
                        data: 'active',
                        name: 'active'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

            async function showDialog() {

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

            function showDialogEdit(v) {
                $n = $($("#dialogedit").html())

                $n.find("#id").val($($(v).parent().parent().find("td")[0]).html())
                $n.find("#name").val($($(v).parent().parent().find("td")[1]).html());
                $n.find("#email").val($($(v).parent().parent().find("td")[2]).html());
                $n.find("#address").val($($(v).parent().parent().find("td")[3]).html());
                $n.find("#position").val($($(v).parent().parent().find("td")[4]).html());
                $n.find("#salary").val($($(v).parent().parent().find("td")[5]).html());
                $n.find("#salary_period").val($($(v).parent().parent().find("td")[6]).html());
                $n.find("#salary_method").val($($(v).parent().parent().find("td")[7]).html());
                $n.find("#date_joined").val($($(v).parent().parent().find("td")[8]).html());


                Swal.fire({
                    html: $n,
                    showConfirmButton: false
                })
            }

            function insertData(c) {
                var x = $(c).parent().parent()
                $.ajax({
                    url: "/api/employee",
                    type: 'POST',
                    data: {
                        "name": x.find('#name').val(),
                        "email": x.find('#email').val(),
                        "address": x.find('#address').val(),
                        "position": x.find('#position').val(),
                        "date_joined": x.find('#date_joined').val(),
                        "salary": x.find('#salary').val(),
                        "salary_method": x.find('#salary_method').val(),
                        "salary_period": x.find('#salary_period').val()
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
                    url: "/api/employee/edit",
                    type: 'POST',
                    data: {
                        "id": x.find('#id').val(),

                        "name": x.find('#name').val(),
                        "email": x.find('#email').val(),
                        "address": x.find('#address').val(),
                        "position": x.find('#position').val(),
                        "date_joined": x.find('#date_joined').val(),
                        "salary": x.find('#salary').val(),
                        "salary_method": x.find('#salary_method').val(),
                        "salary_period": x.find('#salary_period').val()
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
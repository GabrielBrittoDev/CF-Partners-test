<?php $this->extend('template') ?>

<?php $this->section('title') ?>
    Users list
<?php $this->endSection() ?>

<?php $this->section('menuTags') ?>user list<?php $this->endSection() ?>

<?php $this->section('content') ?>
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">List</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-globe'></i> User
            <span class='fw-300'>list</span>
        </h1>
    </div>
    <table id="example" class="display responsive nowrap" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Last access</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="modal fade" id="default-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Confirm action
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button onclick="deleteUser()" type="button" data-dismiss="modal" class="btn btn-danger">Delete User</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let userId = null;
        let dataTable = null;

        function deleteUser() {
            $.ajax({
                url: `/api/user/${userId}`,
                method: 'DELETE',
                success: function (data) {
                    toastr.success(data.message);

                    dataTable.ajax.reload();
                },
                error: function (data) {
                    toastr.error(data.error);
                }
            });
        }

        function changeUserStatus(id) {
            $.ajax({
                url: `/api/user/change-status/${id}`,
                method: 'PUT',
                success: function (data) {
                    toastr.success(data.message);
                },
                function (data) {
                    toastr.error(data.error);
                }
            });
        }


        $(document).ready(function () {
            $.noConflict();

            dataTable = $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                searchDelay: 1500,
                rowId: function (row) {
                    return `user-row-${row.id}`;
                },
                ajax: {
                    url: '/api/user',
                    type: 'GET'
                },
                columnDefs: [{
                    'defaultContent': '-',
                    'targets': '_all'
                }],
                fnServerParams: function(data) {
                    data['order'].forEach(function (items, index) {
                        console.log(items, index);
                        const column =  data['columns'][items.column];
                        data['order'][index]['column_name'] = column['data'] ?? column['name'];
                    });
                },
                columns: [
                    {data: 'first_name'},
                    {data: 'username'},
                    {data: 'email'},
                    {data: 'mobile'},
                    {
                        data: null,
                        name: 'last_access_at',
                        mRender: function (data) {
                            if (!data.last_access_at) {
                                return null;
                            }

                            const localDate = new Date(data.last_access_at);
                            return localDate.toLocaleDateString() + ' ' + localDate.toLocaleTimeString();
                        },
                    },
                    {
                        data: null,
                        orderable: false,
                        mRender: function (data) {
                            return `<div class="custom-control custom-switch">
                                        <input ${Number(data.active) ? 'checked' : ''} id="customSwitch${data.id}" onchange="changeUserStatus(${data.id})" type="checkbox" class="custom-control-input" >
                                        <label class="custom-control-label" for="customSwitch${data.id}"></label>
                                    </div>`;
                        },
                    },
                    {
                        data: null,
                        orderable: false,
                        mRender: function (data) {
                            return `<a href="/user/edit/${data.id}" class="btn btn-warning btn-sm btn-icon rounded-circle mr-2">
                                        <i class="fal fa-pencil"></i>
                                    </a>
                                    <button data-toggle="modal" onclick="userId = ${data.id}" data-target="#default-example-modal-center" class="btn btn-danger btn-sm btn-icon rounded-circle mr-2">
                                        <i class="fal fa-trash"></i>
                                    </button>`;
                        }
                    }

                ],
            });
        });
    </script>
<?php $this->endSection() ?>
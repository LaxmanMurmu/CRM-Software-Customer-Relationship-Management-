<?php
include 'includes/_header.php';
include 'includes/_navbar.php';
include 'includes/_sidebar.php';
?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- ============================================START================================ -->



    <div class="row1 container mt-4">
        <h3 class="text-center text-success">Company Data Table List</h3>
    </div>

    <div class="row2 container mt-5" style="display: flex; justify-content: space-between;">
        <div>
            <h4>All Users in the Data Base</h4>
        </div>
        <div>
            <!-- Register Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
                Add Company
            </button>
        </div>
    </div>

    <!-- ========================================Table=============================================== -->
    <div class="container border pt-3 mt-3">
        <table id="userTable" class="display">
            <thead class="text-center">
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Website</th>
                    <th class="text-center">Update</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody id="tableBody" class="text-center">
                <!-- Table rows will be dynamically added here*********************************** -->
            </tbody>
        </table>
    </div>
    <!--================================================= Modal============================================ -->
    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success d-none" id="alert" role="alert">
                        Added Successfully
                    </div>
                    <!-- Form -->
                    <form id="input_form" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input placeholder="Name" name="name" type="text" class="form-control" id="name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input placeholder="E-mail" name="email" type="email" class="form-control" id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input placeholder="logo" name="logo" type="file" class="form-control" id="logo">
                        </div>
                        <div class="mb-3">
                            <input placeholder="Web-site" name="website" type="text" class="form-control" id="website"
                                aria-describedby="emailHelp">
                        </div>
                        <button type="submit" id="submit" value="submit" name="submit"
                            class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--========================================================= 2 UPDATE Modal================================================= -->
    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Company</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="mb-3">
                            <input placeholder="Name" name="name" type="text" class="form-control" id="update_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="E-mail" name="email" type="email" class="form-control" id="update_email"
                                required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="Phone" name="logo" type="file" class="form-control" id="update_logo"
                                required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="Web-site" name="website" type="text" class="form-control"
                                id="update_website" aria-describedby="emailHelp">
                        </div>



                        <input type="hidden" id="update_id" name="id">
                        <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- *********************************************************SCRIPT*************************************************************** -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>









</div>



<!-- Main Footer -->
<footer class="main-footer">

    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>
</div>

<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>


<script>
        $(document).ready(function() {
            var responseData; // Define a global variable to store the response data

            // Load the table data on page load
            loadTableData();

            // Function to load table data
            function loadTableData() {
                $.ajax({
                    type: "GET",
                    url: "company_controller.php",
                    success: function(response) {
                        console.log(response);
                        responseData = response; // Store the response data in the global variable

                        // Clear the table body
                        $('#tableBody').empty();

                        // Loop through the data and append rows to the table
                        $.each(response, function(index, company) {
                            var row = `<tr>
                                <td>${company.id}</td>
                                <td>${company.name}</td>
                                <td>${company.email}</td>
                                <td><img src="${company.logo}" alt="Logo" width="100px" height="100px"></td>
                                <td>${company.website}</td>
                                <td><a data-id="${company.id}" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-success update-btn" href="#">Update</a></td>
                                <td><a data-id="${company.id}" class="btn btn-danger delete-btn" href="#">Delete</a></td>
                            </tr>`;
                            $('#tableBody').append(row);
                        });

                        // Attach click event handler to the update buttons
                        $('.update-btn').click(function() {
                            var companyId = $(this).data('id');
                            var company = responseData.find(c => c.id == companyId);
                            if (company) {
                                $('#update_id').val(company.id);
                                $('#update_name').val(company.name);
                                $('#update_email').val(company.email);
                                $('#update_website').val(company.website);
                                $('#update_logo_preview').attr('src', company.logo);
                            }
                        });

                        // Initialize the DataTable after loading the data
                        $('#userTable').DataTable();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }


            // ==========================================INSERT
            // Insert form submission
            $('#input_form').submit(function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'company_controller.php?type=insert',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        loadTableData();
                        clearFormFields();
                        $('#alert').removeClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });


            // ============================================UPDATE
            // Update form submission
            $('#update_form').submit(function(event) {
                event.preventDefault();

                var companyId = $('#update_id').val();
                var updatedCompany = {
                    name: $('#update_name').val(),
                    email: $('#update_email').val(),
                    website: $('#update_website').val()
                };

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: 'company_controller.php?type=update&id=' + companyId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        loadTableData();
                        $('#updateModal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // =========================================================DELETE
            // Delete button click event
            $(document).on('click', '.delete-btn', function() {
                var companyId = $(this).data('id');

                if (confirm('Are you sure you want to delete this company?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'company_controller.php?type=delete',
                        data: { id: companyId },
                        success: function(response) {
                            console.log(response);
                            loadTableData();
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Function to clear the form fields
            function clearFormFields() {
                $('#name').val('');
                $('#email').val('');
                $('#logo').val('');
                $('#website').val('');
            }
        });
    </script>



<!-- ===============================================END======================================== -->


</body>

</html>
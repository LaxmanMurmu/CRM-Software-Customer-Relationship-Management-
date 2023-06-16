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
                    <h1 class="m-0">Employee Table</h1>
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
        <h3 class="text-center text-success">Employee Data Table List</h3>
    </div>

    <div class="row2 container mt-5" style="display: flex; justify-content: space-between;">
        <div>
            <h4>All Users in the Data Base</h4>
        </div>
        <div>
            <!-- Register Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">
                Add Employee
            </button>
        </div>
    </div>

    <!-- ========================================Table=============================================== -->
    <div class="container border pt-3 mt-3">
        <table id="userTable" class="display" >
            <thead class="text-center">
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">Company -ID</th>
                    <th class="text-center">firstname</th>
                    <th class="text-center">lastname</th>
                    <th class="text-center">email</th>
                    <th class="text-center">phone</th>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success d-none" id="alert" role="alert">
                        Registered Successfully
                    </div>
                    <!-- Form -->
                    <form id="input_form">
                        <div class="mb-3">
                            <input placeholder="First Name" name="firstname" type="text" class="form-control" id="firstname"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="mb-3">
                            <input placeholder="Last Name" name="lastname" type="text" class="form-control" id="lastname"
                                aria-describedby="emailHelp">
                        </div>

                                                <?php
                        include "partials/_dbconnect.php";

                        $sql = "SELECT id, name FROM company;";
                        $result = mysqli_query($conn, $sql);
                        ?>

                        <select class="form-select mb-3 py-2 col-md-12" id="company_id" name="company_id" aria-label="Default select example">
                            <option selected value="null">Select Company</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            $companyId = $row['id'];
                            $companyName = $row['name'];
                            echo "<option value='$companyId'>$companyName</option>";
                        }
                        ?>
                        </select>



                       
                        <div class="mb-3">
                            <input placeholder="E-mail" name="email" type="email" class="form-control" id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input placeholder="phone" name="phone" type="text" class="form-control" id="phone">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_form">
                        <div class="mb-3">
                            <input placeholder="Name" name="firstname" type="text" class="form-control"
                                id="update_firstname" required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="Name" name="lastname" type="text" class="form-control"
                                id="update_lastname" required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="E-mail" name="email" type="email" class="form-control" id="update_email"
                                required>
                        </div>
                        <div class="mb-3">
                            <input placeholder="Phone" name="phone" type="text" class="form-control" id="update_phone"
                                required>
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
        // Load the table data on page load
        loadTableData();

        // *************************************************Display*********************************************
        function loadTableData() {
            $.ajax({
                type: "GET",
                url: "employee_controller.php",
                success: function(response) {
                    console.log(response); // Display the response in the browser console

                    // Clear the table body
                    $('#tableBody').empty();

                    // Loop through the data and append rows to the table
                    var i = 0;
                    while (i < response.length) {
                        var row = `<tr>
                                        <td>${response[i].id}</td>
                                        <td>${response[i].company_id}</td>
                                        <td>${response[i].firstname}</td>
                                        <td>${response[i].lastname}</td>
                                        <td>${response[i].email}</td>
                                        <td>${response[i].phone}</td>
                                        <td><a id="${response[i].id}" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-success update-btn" href="#">Update</a></td>
                                        <td><a id="${response[i].id}" class="btn btn-danger delete delete-btn" data-name="delete" href="#">Delete</a></td>
                                      </tr>`;
                        // Append the row to the table body
                        $('#tableBody').append(row);
                        i++;
                    }


                    // Attach click event handler to the update buttons
                    $(".update-btn").click(function() {
                        var userId = $(this).attr('id');
                        var user = response.find(u => u.id == userId);
                        if (user) {
                            $("#update_firstname").val(user.firstname);
                            $("#update_lastname").val(user.lastname);
                            $("#update_email").val(user.email);
                            $("#update_phone").val(user.phone);
                            $("#update_id").val(userId);
                        }
                    });

                    // Initialize the DataTable after loading the data
                    $('#userTable').DataTable();

                },
                error: function(xhr, status, error) {
                    console.log(xhr
                        .responseText); // Display any error message in the browser console
                }
            });
        }



        // Function to clear the form fields
        function clearFormFields() {
            $('#firstname').val('');
            $('#lastname').val('');
            $('#email').val('');
            $('#phone').val('');
        }

        // *************************************************Insert form data*********************************************
        $("#input_form").submit(function(event) {
            event.preventDefault(); // Prevent form submission

            $.ajax({
                type: "POST",
                url: "employee_controller.php?type=insert",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response); // Display the response in the browser console
                    loadTableData(); // Reload the table data
                    clearFormFields(); // Clear the form fields
                    $('#alert').removeClass('d-none'); // Show the alert message
                },
                error: function(xhr, status, error) {
                    console.log(xhr
                        .responseText); // Display any error message in the browser console
                }
            });
        });

        // *************************************************Update form current data display*********************************************
        $(".update-btn").click(function() {
            var userId = $(this).attr('id');
            var user = response.find(u => u.id == userId);
            if (user) {
                $("#update_firstname").val(user.firstname);
                $("#update_lastname").val(user.lastname);
                $("#update_email").val(user.email);
                $("#update_phone").val(user.phone);
                $("#update_id").val(userId);
            }
        });

        // *************************************************Update query*********************************************
        $("#update_form").submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var userId = $("#update_id").val();
            var updatedUser = {
                firstname: $("#update_firstname").val(),
                lastname: $("#update_lastname").val(),
                email: $("#update_email").val(),
                phone: $("#update_phone").val()
            };

            $.ajax({
                type: "POST",
                url: "employee_controller.php?type=update",
                data: {
                    id: userId,
                    ...updatedUser
                },
                success: function(response) {
                    console.log(response);
                    loadTableData();
                    $("#updateModal").modal("hide");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        // *************************************************Delete query*********************************************
        $(document).on('click', '.delete-btn', function() {
            var userId = $(this).attr('id');

            // Confirm the deletion
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    type: "POST",
                    url: "employee_controller.php?type=delete",
                    data: {
                        id: userId
                    },
                    success: function(response) {
                        console.log(response);
                        loadTableData(); // Reload the table data
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

    });
    </script>




    <!-- ===============================================END======================================== -->

</body>

</html>
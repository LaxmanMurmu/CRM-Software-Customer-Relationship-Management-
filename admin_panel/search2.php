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
          <h1 class="m-0">Search</h1>
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

  <!-- ===========================================START=================================================== -->

  <div class="container">
    <div class="mb-3">
      <input type="text" id="searchInput" class="form-control" placeholder="Search...">
    </div>
    <table id="myTable" class="table">
      <thead>
        <tr>
          <th class="text-center">s.no</th>
          <th class="text-center">Employee Name</th>
          <th class="text-center">E-mail</th>
          <th class="text-center">Phone</th>
          <th class="text-center">Company</th>
          <th class="text-center">Company Logo</th>
        </tr>
      </thead>
      <tbody class="text-center" id="table_body">
        <?php
        include "partials/_dbconnect.php";

        $sql = "SELECT company.name, company.logo, company.website, employee.firstname, employee.lastname, employee.email, employee.phone
                FROM company, employee
                WHERE company.id = employee.company_id";

        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        $n = 1;

        if ($num > 0) {
          while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr class="data-row" style="display: none;">
              <td><?php echo $n ?></td>
              <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
              <td><?php echo $row['email'] ?></td>
              <td><?php echo $row['phone'] ?></td>
              <td><?php echo $row['name'] ?></td>
              <td><img src="<?php echo $row['logo'] ?>" alt="" width="100px"></td>
            </tr>
            <?php
            $n = $n + 1;
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- ==================================================END============================================== -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>

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
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    var table = $('#myTable').DataTable();

    $('#searchInput').on('keyup', function() {
      var searchValue = this.value.toLowerCase();
      if (searchValue.trim() !== '') {
        $('.data-row').hide();
        $('.data-row').each(function() {
          var employeeName = $(this).find('td:nth-child(2)').text().toLowerCase();
          if (employeeName.includes(searchValue)) {
            $(this).show();
          }
        });
      } else {
        $('.data-row').show();
      }
    });
  });
</script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

</body>
</html>

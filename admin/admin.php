<?php
	require_once('../nav.php'); 
  require_once('../login_required.php');
  require_once('../admin_only.php');
?>

<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="jumbotron">
        <h1>Admin Setings</h1>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <h2>Delete Users</h2>
          <p>Remove user accounts.  </p>
          <p><a class="btn btn-primary" href="../admin/deactivate_users.php" role="button">View Users </a></p>
        </div>
        <div class="col-lg-4">
          <h2>Change Status</h2>
          <p>Give other users staff privileges. </p>
          <p><a class="btn btn-primary" href="../admin/staff_users.php" role="button">View Users </a></p>
       </div>
        <div class="col-lg-4">
          <h2>Export Data</h2>
          <p>Download database info into csv file</p>
          <p><a class="btn btn-primary" href="../admin/export_data.php" role="button">Export here </a></p>
        </div>
      </div>
    </div>
</body>
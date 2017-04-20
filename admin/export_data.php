<?php
	require_once('../nav.php'); 
  require_once('../login_required.php');
  require_once('../admin_only.php');
?>
<body data-gr-c-s-loaded="true">
  <div class="container"> <!-- container -->
    <div class="jumbotron">
      <h1>Download Database Data</h1>
    </div>
  
    <div class="row"> <!-- row -->
    <div class="col-lg-4"> <!-- col -->
        <h2>Choose a Table</h2>
       
          <form action="export_data_helper.php" method="post">
          <select class="form-control" name="table">
            <option>Constituent</option>
            <option value="Bill">Bills</option>
            <option>Committees</option>
            <option value="Congressperson">Congresspeople</option>
          </select>            
            </br>
            </br>
            <input class='btn btn-primary btn-sm' type='submit' value='Download Table'>
          </form>
  </div> <!-- row -->
  </div> <!-- container -->
</body>
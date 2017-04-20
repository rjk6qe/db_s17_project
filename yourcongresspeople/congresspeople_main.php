<?php
	require_once('../nav.php'); 
  require_once('../login_required.php');
?>

<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="jumbotron">
        <h1>Congresspeople</h1>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <h2>Your Congresspeople</h2>
          <p>View the congresspeople for your state and district.  </p>
          <p><a class="btn btn-primary" href="../yourcongresspeople/congresspeople.php" role="button">View </a></p>
        </div>
        <div class="col-lg-4">
          <h2>Search Congresspeople</h2>
          <p>Search all congresspeople to see their information. </p>
          <p><a class="btn btn-primary" href="../yourcongresspeople/congresspeople_search.php" role="button">Search </a></p>
       </div>
    </div>
</body>
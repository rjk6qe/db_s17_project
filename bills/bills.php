<?php
  require_once('../login_required.php');
  require_once('../nav.php');
?>

<body data-gr-c-s-loaded="true">
  <div class="container">
    <div class="jumbotron">
      <h3>View and Search Bills</h3>
    </div>
    <div class="row">
    <?php
      require_once('bills_include.php');
    ?>
    </div>
  </div>
</body>
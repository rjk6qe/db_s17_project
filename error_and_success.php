<?php
  if(isset($_SESSION['error_msg'])){
    echo "<div class='alert alert-danger alert-dismissable fade in'>
      <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Oops!</strong> ". $_SESSION['error_msg'] ." </div>";
    unset($_SESSION['error_msg']);
  }
  if(isset($_SESSION['success_msg'])){
    echo "<div class='alert alert-success alert-dismissable fade in'>
      <a class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Success!</strong> ". $_SESSION['success_msg'] ." </div>";
    unset($_SESSION['success_msg']);
  }
?>
<?php
  require_once('../nav.php');
  require_once('../login_required.php');  
  require_once('../db_conn.php');
?>

<body>
<?php 
  session_start();
  $username = $_SESSION['user'];
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
?>

<div class="container">
<div class="jumbotron">
  <h2>Add a Bill to This Group</h2>
</div>

<div class="row">
<form action="follow_bill_helper.php?id=<?php echo "{$id}" ?>" method="post">
 <div class='form-group'>
  <label for="inputbillid"> Bill ID:</label>
  <input type ="text" class="form-control" id="inputbillid" name="inputbillid">
 </div>
 <input type="submit" class="btn btn-default">
 </form>

 <?php
  require_once('../bills/bills_include.php');
 ?>
 <label>Click a row to select</label>

 <script type="text/javascript">
  $(document).ready(function(){
    $("#search_param_div").attr("style", "display:none");
    $("#search_select").val('bill_id');
    $("#search_select").trigger('input');

    $("#inputbillid").on('input', function(){
      $("#search").val($(this).val());
      $("#search").trigger('input');
    })
  });
</script>
</div>
</div>
</body>
</html>

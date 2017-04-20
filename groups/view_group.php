<?php
  require_once('../db_conn.php');
  require_once('../login_required.php');
  require_once('../nav.php');
  session_start();
  $username = $_SESSION['user'];
  
  $db =DbUtil::create();
  $stmt = $db->prepare("SELECT group_name,topic FROM InterestGroup WHERE group_name=?");
  if(!$stmt){ echo $db->error;}
  $stmt->bind_param("s", $id);
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  if(!$stmt->execute()){ echo $stmt->error;}
  $stmt -> bind_result($group, $topic);
  $stmt -> store_result();
  $stmt -> fetch();
?>

<body data-gr-c-s-loaded="true">
    <div class="container">
      <div class="masthead">
      <div class="jumbotron">
        <h1> <?php echo "{$id}" ?> </h1>
      </div>    
        <?php
          if(isset($_SESSION['error_msg'])){
            echo "<div class='alert alert-danger'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Oops!</strong> ". $_SESSION['error_msg'] ." </div>";
            unset($_SESSION['error_msg']);
          }
          if(isset($_SESSION['success_msg'])){
            echo "<div class='alert alert-success'>
              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
              <strong>Success!</strong> ". $_SESSION['success_msg'] ." </div>";
            unset($_SESSION['success_msg']);
          }
        ?>
      <div>
	<?php 
		echo "<h2> Topic </h2>";
		echo "{$topic}";
	?>
      </div>
      <div>
	<?php
		echo "<h2> Bills this Group Follows </h2>";
	?>
      <table class="table table-bordered">
<?php
    $db = DbUtil::create();
    session_start();
    $username = $_SESSION['user'];
    $stmt = $db->prepare("SELECT  Bill.bill_id, Bill.title FROM Follow INNER JOIN Bill WHERE Follow.group_name = ? AND Follow.bill_id = Bill.bill_id");
    if(!$stmt){ 
      echo $db->error;
    }
    $stmt->bind_param("s", $group);
    if(!$stmt->execute()){ 
      echo $stmt->error; 
    }
    $stmt -> bind_result($billid, $bill_title);
    $stmt -> store_result();
    $numrows = $stmt->num_rows;
    if($numrows == 0){
      echo "This group is not following any bills! Follow some bills by clicking the button below.";
    } else{
      echo "<thead><tr><th> Bill ID </th> <th> Title </th> <th>Stop Following</th></thead>";
      while($stmt->fetch()){
        echo '<tr><td name="bill_click" title="'. $bill_title . '">' . $billid . '</td> <td> '. $bill_title . ' </td><td> <a href="unfollow_bill.php?id='. $billid . '&group=' . $group . '"> unfollow </a> </td></tr>';
      }
    }
?>
      </table>
        <a role="button" class="btn btn-default" href="follow_bill.php?id=<?php echo "{$group}" ?>">Follow a bill</a> 
      </div>
    </div>
<br><br><br>
</body>

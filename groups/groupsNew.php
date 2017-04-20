<?php
  require_once('../login_required.php');
  require_once('../nav.php');
?>

<body>
<div class="container">
<form action="groupsNew_helper.php" method="post">
 <div class='form-group'>
  <label for="inputgroupname"> Group name:</label>
  <input type ="text" class="form-control" id="groupname" name="inputGroupname">
 </div>

 <div class='form-group'>
  <label for="topic"> Topic:</label>
  <input type ="text" class="form-control" id="topic" name="inputTopic">
 </div>
 <input type="submit" class="btn btn-default">


   <a role="button" class="btn btn-primary" href="groups.php">Back</a>

</div>
</body>

<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Home Page">
    <meta name="author" content="3 Free Riders and Richard">
    <link href="website_theme.css" rel="stylesheet">
    <title>LHome</title>

  </head>
  <body>

  <div class="page-header" id="login-page-header">
  </div>

<div class="page-content" id="login-page-content">
</div>

<script type="text/javascript">
function loadPage(){
  var page_name = "home";
  var page_title = "Welcome, <?php echo $_SESSION["username"]; ?> You made it!";
  // page header
  var page_header = document.getElementById("login-page-header");
  var header_p = document.createElement("p");
  var header_text = document.createTextNode(page_title);
  header_p.appendChild(header_text);
  page_header.appendChild(header_p);

}
loadPage();
</script>
</body>
</html>

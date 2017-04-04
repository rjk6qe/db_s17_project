<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Login Page">
    <meta name="author" content="3 Free Riders and Richard">
    <link href="website_theme.css" rel="stylesheet">
    <title>Login Page</title>

  </head>
  <body>
  <?php
    // remove all session variables
  session_unset();
  // destroy the session
  session_destroy();
  ?>

  <div class="page-header" id="login-page-header">
  </div>

<div class="page-content" id="login-page-content">
</div>

<script type="text/javascript">
function loadPage(){
  var page_name = "login"
  var page_title = "Please Login";
  var user = "Username: ";
  var pass = "Password: ";

  // page header
  var page_header = document.getElementById("login-page-header");
  var header_p = document.createElement("p");
  var header_text = document.createTextNode(page_title);
  header_p.appendChild(header_text);
  page_header.appendChild(header_p);

  // page content
  var page_content = document.getElementById("login-page-content");
  var form = document.createElement("form");
  var user_input_p = document.createElement("p");
  var pass_input_p = document.createElement("p");
  var submit_p = document.createElement("p");
  var user_input_text = document.createTextNode(user);
  var pass_input_text = document.createTextNode(pass);
  var user_input_box = document.createElement("input");
  var pass_input_box = document.createElement("input");
  var submit = document.createElement("input");

  form.setAttribute("id", "login-form");
  form.setAttribute("action", "/loadlogin.php");
  form.setAttribute("method", "post");
  user_input_box.setAttribute("type", "text");
  user_input_box.setAttribute("name", "username-input");
  user_input_box.setAttribute("id", "username-input");
  pass_input_box.setAttribute("type", "text");
  pass_input_box.setAttribute("id", "password-input");
  pass_input_box.setAttribute("name", "password-input");
  submit.setAttribute("class", "btn");
  submit.setAttribute("type", "button");
  submit.setAttribute("value", "Submit");
  submit.setAttribute("onclick", "login()");

  user_input_p.appendChild(user_input_text);
  user_input_p.appendChild(user_input_box);
  pass_input_p.appendChild(pass_input_text);
  pass_input_p.appendChild(pass_input_box);
  submit_p.appendChild(submit);
  form.appendChild(user_input_p);
  form.appendChild(pass_input_p);
  form.appendChild(submit);
  page_content.appendChild(form);
}
function login(){
  document.getElementById("login-form").submit();
}
loadPage();
</script>
</body>
</html>

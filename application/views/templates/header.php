<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8"></meta>
  <meta content="IE=edge" http-equiv="X-UA-Compatible"></meta>
  <title>Grant Management System - Global Health Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/grantsmanship.css') ?>">

  <!-- Latest compiled and minified CSS with bootswatch theme 'Paper' - http://bootswatch.com/paper/ -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css" rel="stylesheet" integrity="sha256-hMIwZV8FylgKjXnmRI2YY0HLnozYr7Cuo1JvRtzmPWs= sha512-k+wW4K+gHODPy/0gaAMUNmCItIunOZ+PeLW7iZwkDZH/wMaTrSJTt7zK6TGy6p+rnDBghAxdvu1LX2Ohg0ypDw==" crossorigin="anonymous">

  

  <script type="text/javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li><a href="http://localhost/grantsmanship/index.php/create-project">New Project <span class="glyphicon glyphicon-plus-sign"></a></span></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://localhost/grantsmanship/index.php/projects">Projects</a></li>
        <li><a href="http://localhost/grantsmanship/index.php/repository">Repository</a></li>
        <?php 
          if($this->ion_auth->is_admin()) {
            echo '<li><a href="http://localhost/grantsmanship/index.php/index">Index</a></li>';
          }
        ?>
        <li><a href="http://localhost/grantsmanship/index.php/login">Login</a></li>
        <li><a href="http://localhost/grantsmanship/index.php/auth/logout">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
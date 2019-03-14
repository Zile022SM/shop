<?php  $login=isset($login)?$login:"";?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link href="admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="routes.php?page=adminIndex">Start Bootstrap</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <ul class="nav pull-right">
        
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="fas fa-user"> <?php if (!empty($login['email'])){ echo $login['email'];}?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <?php if (!empty($login['email'])){
            ?>
            	<a class="dropdown-item" href="routes.php?page=logoutAdmin"><b>Logout</b> <i class="fas fa-sign-out-alt" style="color:black;"></i></a>
            <?php 	
                  }else{
            ?> 
                <a class="dropdown-item" href="routes.php?page=showLogin"><b>Login</b> <i class="fas fa-sign-in-alt"></i></a>
            <?php        	
                  }
            ?>
            
          </div>
        </li>
      </ul>

    </nav>

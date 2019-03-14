<?php  $login=isset($login)?$login:"";?>
<!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="routes.php?page=adminIndex">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <?php if (!empty($login)){?>
          <li class="nav-item active">
            <a class="nav-link" href="routes.php?page=logoutAdmin">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
            </a>
          </li>
        <?php }else{?>
          <li class="nav-item active">
            <a class="nav-link" href="routes.php?page=showLogin">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login</span>
            </a>
          </li>
        <?php }?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Users :</h6>
            <a class="dropdown-item" href="routes.php?page=insertUser"><i class="fas fa-user-plus" style="color:green;"></i> Insert user</a>
            <a class="dropdown-item" href="routes.php?page=list"><i class="fas fa-clipboard-list" style="color:blue;"></i> Users list</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-list-ol"></i>
            <span>Categories</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Categories :</h6>
            <a class="dropdown-item" href="routes.php?page=showInsertCategory"><i class="fas fa-plus-square" style="color:green;"></i> Insert category</a>
            <a class="dropdown-item" href="routes.php?page=categoriesList"><i class="far fa-list-alt" style="color:blue;"></i> Categories list</a>
          </div>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-file-alt"></i>
            <span>Subcategories</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Subcategories :</h6>
            <a class="dropdown-item" href="routes.php?page=showInsertSubcategory"><i class="fas fa-plus-square" style="color:green;"></i> Insert Subcategory</a>
            <a class="dropdown-item" href="routes.php?page=SubcategoriesList"><i class="far fa-list-alt" style="color:blue;"></i> Subcategories list</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-briefcase"></i>
            <span>Products</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Products :</h6>
            <a class="dropdown-item" href="routes.php?page=showInsertProduct"><i class="fas fa-plus-square" style="color:green;"></i> Insert product</a>
            <a class="dropdown-item" href="routes.php?page=ProductsList"><i class="far fa-list-alt" style="color:blue;"></i> Products list</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Orders :</h6>
            <a class="dropdown-item" href="routes.php?page=ordersList"><i class="fas fa-clipboard-list" style="color:blue;"></i> Orders list</a>
            
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fas fa-pencil-alt"></i>
            <span>Rewiews</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Rewiews :</h6>
            <a class="dropdown-item" href="routes.php?page=reviewsList"><i class="fas fa-clipboard-list" style="color:blue;"></i> Reviews list</a>
            
          </div>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <i class="fab fa-blogger-b"></i>
            <span>Blog</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Blog :</h6>
            <a class="dropdown-item" href="routes.php?page=showInsertBlog"><i class="fas fa-pencil-alt" style="color:blue;"></i> Insert blog</a>
            <a class="dropdown-item" href="routes.php?page=showBlogsList"><i class="fas fa-clipboard-list" style="color:blue;"></i> Blogs list</a>
            
          </div>
        </li>
        
      </ul>
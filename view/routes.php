<?php

require_once '../controller/Controller.php';



$controller = new Controller();

if($_SERVER['REQUEST_METHOD']==='POST'){
	$page=$_POST['page'];
	
	switch ($page){
		
		case'login':
			$controller->login();
		break;
		
		case'register':
			$controller->register();
		break;
		
		case'Buy':
			$controller->Purchase();
		break;
		
		case'Send email':
			$controller->SendEmail();
		break;
		
/********************************** ADMIN ROUTES ********************************************************/
/********************************** ADMIN ROUTES ********************************************************/
		
		case'Submit':
			$controller->Submit();
		break;
		
		case'Edit user':
			$controller->EditUser();
		break;
		
		case'Delete user':
			$controller->deleteUser();
		break;
		
		case'Cancel':
			$controller->Cancel();
		break;
		
		case'Login admin':
			$controller->LoginAdmin();
		break;
		
		case'Insert category':
			$controller->InsertCategory();
		break;
		
		case'Edit category':
			$controller->EditCategory();
		break;
		
		case'Insert Subcategory':
			$controller->InsertSubcategory(); 
		break;
		
		case'Edit Subcategory':
			$controller->EditSubcategory();
		break;
		
		case'Submit review':
			$controller->SubmitReview();
		break;
		
		case'Insert Product':
			$controller->insertProduct();
		break;
		
		case'Edit Product':
			$controller->updateProduct();
		break;
		
		case'Delete product':
			$controller->deleteProduct();
		break;
		
		case'Cancel deleting product':
			$controller->cancelDltProduct();
		break;
		
		case'Insert Blog':
			$controller->insertBlog();
		break;
		
		case'Edit blog':
			$controller->editBlog();
		break;
		
		case'Go!':
			$controller->Go();
		break;
	}		
	
}else{
	$page=$_GET['page'];  
	
    switch ($page){
		case'itemsType':
			$controller->itemsType();
		break;	
		case'productDetail':
			$controller->productDetail();
		break;
		case'productsBySubId':
			$controller->productsBySubId();
		break;
		case'pagination':
			$controller->pagination();
		break;
		case'addToCart':
			$controller->addToCart();
		break;
		
		case'increment':
			$controller->increment();
		break;
		
		case'decrement':
			$controller->decrement();
		break;
		
		case'deleteItem':
			$controller->deleteItem();
		break;
		
		case'empty':
			$controller->emptyCart();
		break;
		
		case'checkPage':
			$controller->checkPage();
		break;
		
		case'logout':
			$controller->logout();
		break;
		
		case'ViewCart':
			$controller->ViewCart();
		break;
		
		case'ContinueShopping':
			$controller->ContinueShopping();
		break;
		
		case'Products':
			$controller->Products();
		break;
		
		case'backToCart':
			$controller->backToCart();
		break;
		
		case'showContact':
			$controller->showContact();
		break;
		
		case'go':
			$controller->go();
		break;
		
		case'showBlogList':
			$controller->showBlogList();
		break;
		
		case'showBlogDetail':
			$controller->showBlogDetail();
		break;
		
		
/********************************** ADMIN ROUTES ********************************************************/
/********************************** ADMIN ROUTES ********************************************************/
		
		
		case'showLogin':
			$controller->showLogin();
		break;
		
		case'adminIndex':
			$controller->adminIndex();
		break;
		
		case'list':
			$controller->listUser();
		break;
		
		case'tables':
			$controller->tables();
		break;
		
		case'insertUser':
			$controller->insertUser();
		break;
		
		case'ShowEditUser':
			$controller->ShowEditUser();
		break;
		
		case'showDeleteUser':
			$controller->showDeleteUser();
		break;
		
		case'logoutAdmin':
			$controller->logoutAdmin();
		break;
		
		case'showInsertCategory':
			$controller->showInsertCategory();
		break;
		
		case'categoriesList':
			$controller->categoriesList();
		break;
		
		case'ShowEditCategory':
			$controller->ShowEditCategory();
		break;
		
		case'deleteCategory':
			$controller->deleteCategory();
		break;
		
		case'showInsertSubcategory':
			$controller->showInsertSubcategory();
		break;
		
		case'SubcategoriesList':
			$controller->SubcategoriesList();
		break;
		
		case'ShowEditSubcategory':
			$controller->ShowEditSubcategory();
		break;
		
		case'deleteSubcategory':
			$controller->deleteSubcategory();
		break;
		
		case'showInsertProduct':
			$controller->showInsertProduct();
		break;
		
		case'ProductsList':
			$controller->ProductsList();
		break;
		
		case'ShowEditProduct':
			$controller->ShowEditProduct();
		break;
		
		case'showDeleteProduct':
			$controller->showDeleteProduct();
		break;
		
		case'ordersList':
			$controller->ordersList();
		break;
		
		case'updateOrder':
			$controller->updateOrder();
		break;
		
		case'deleteOrder':
			$controller->deleteOrder();
		break;
		 
		case'reviewsList':
			$controller->reviewsList();
		break;
		
		case'approveReview':
			$controller->approveReview();
		break;
		
		case'deleteReview':
			$controller->deleteReview();
		break;
		
		case'showInsertBlog':
			$controller->showInsertBlog();
		break;
		
		case'showBlogsList':
			$controller->showBlogsList();
		break;
		
		case'showUpdateBlog':
			$controller->showUpdateBlog();
		break;
		
		case'deleteBlog':
			$controller->deleteBlog();
		break;
		
		case'ordersByDate':
			$controller->ordersByDate();
		break;
	}
}


<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../model/DAO.php';
require_once 'PHPMailerAutoload.php'; 

class Controller{

	public function register(){
			$name=isset($_POST['name'])?$_POST['name']:"";
			$lastName=isset($_POST['last_name'])?$_POST['last_name']:"";
			$address=isset($_POST['address'])?$_POST['address']:"";
			$email=isset($_POST['email'])?$_POST['email']:"";
			$phone=isset($_POST['phone'])?$_POST['phone']:"";
			$password=isset($_POST['password'])?$_POST['password']:"";
			$repeatPassword=isset($_POST['repeat-password'])?$_POST['repeat-password']:"";
			
			$errors=array();
			
			if(empty($name)){
			  $errors['name'][]="Name can't be empty";
		    }
			if(empty($lastName)){
			  $errors['last_name'][]="Last name can't be empty";
			}
	        if(empty($address)){
			  $errors['address'][]="Address can't be empty";
			}
			if(empty($email)){
				$errors['email'][]="Email can't be empty";
			}else{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errors['email'][]="Invalid email format";
				} 
			}
	        if(empty($phone)){
				$errors['phone'][]="phone can't be empty";
			}else{
				if(mb_strlen($phone)<9){
					$errors['phone'][]="Phone number must be longer than 9 characters";
				}
			}
			if(empty($password)){
				$errors['password'][]="Password can't be empty";
			}else{
				if(mb_strlen($password)<=8){
					$errors['password'][]="Password must be longer than 8 characters";
				}
			}
	        if(empty($repeatPassword)){
				$errors['repeat-password'][]="Repeat password can't be empty";
			}else{
				if(mb_strlen($repeatPassword)<=8){
					$errors['repeat-password'][]="Password must be longer than 8 characters";
				}
				if ($repeatPassword!==$password){
					$errors['repeat-password'][]="repeat password doesn't match with password input field";
				}
			}	
				
   			if(count($errors)==0){
   				
   			  $dao=new DAO();
   			  $status=$dao->checkUser($email,$password);
			  if($status){
				$msgError="usermane or password already exist";
				include 'login.php';
				die();
			  }else{
	   				$dao->register($name, $lastName, $address, $email, $password, $phone);
	   				$name="";
					$lastName="";
					$address="";
					$email="";
					$phone="";
	   				$msgSuccess="Registered successfully please login";
	   				include_once 'login.php';
			  }
   			}else{
   				$msgError="Must fill out all input field correctly";
   				include 'login.php';
   				
   			}
			
	}
	
	
	public function login(){
		
		$email=isset($_POST['email'])?$_POST['email']:"";
		$password=isset($_POST['password'])?$_POST['password']:"";
		
		if(!empty($email)&&!empty($password)){
			$dao=new DAO();
			$user=$dao->getUser($email, $password);
			if($user){
				session_start();
				$_SESSION['loggedIn']=serialize($user);
				$_SESSION['time']=time();
				$msgSuccess="User : ".$user['name']." is logged in successfully";
				$login=unserialize($_SESSION['loggedIn']);
				$email="";
				
				include 'index.php';
			}else{
				$email="";
				$msgError="Username or password is wrong or doesn't exist";
				include 'login.php';
			}
		}else{
			$email="";
			$msgError="Please fill out all input fields correctly.";
			include 'login.php';
		}
	}
	
	
	public function logout(){
			if(!isset($_SESSION)){
			    session_start();
			}
				
			if(!empty($_SESSION['cart']) || !empty($_SESSION['loggedIn'])){
			    session_destroy();
			    include 'index.php';
			}
	}
	
	
	public function Purchase(){
		session_start();
		$loggedIn=unserialize($_SESSION['loggedIn']);
		//var_dump($loggedIn);
		$userId=$loggedIn['userId'];
		//var_dump($userId);
		
		$postUsername=isset($_POST['name'])?$_POST['name']:"";
		$postLastname=isset($_POST['last_name'])?$_POST['last_name']:"";
		$postAddress=isset($_POST['address'])?$_POST['address']:"";
		$postEmail=isset($_POST['email'])?$_POST['email']:"";
		$postPhone=isset($_POST['phone'])?$_POST['phone']:"";	
		
		$cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
		
		$products=array();
		
	    $errors=array();
	    
			if(empty($postUsername)){
				$errors['name'][]="Name can't be empty";
			}
			if(empty($postLastname)){
				$errors['last_name'][]="Last name can't be empty";
			}
			
	        if(empty($postAddress)){
				$errors['address'][]="Address can't be empty";
			}
			if(empty($postEmail)){
				$errors['email'][]="Email can't be empty";
			}else{
					if (filter_var($postEmail, FILTER_VALIDATE_EMAIL)) {
					  
					} else {
					  $errors['email'][]="Invalid format";
			        }
			}
			
			if(empty($postPhone)){
					$errors['phone'][]="Phone can't be empty";
			}
			
			if(count($errors)==0){
				
                foreach ($cart as $value){
                	
                	$itemId=$value['id_product'];
                	
                	$name=$value['name'];
                	
                	if (!isset($value['discount_price'])|| $value['discount_price']==0){
                		$price=$value['price'];
                	}else{
                		$price=$value['discount_price'];
                	}
                	
                	if (isset($value['discount'])&& !empty($value['discount'])){
                		$discount=$value['discount'];
                	}else{
                		$discount=NULL;
                	}
                	
                	$quantity=$value['cart_quantity'];
                	$totalByItem=$quantity*$price;
                	
                	$image=$value['img'];
                	
                	$products[$value['id_product']]['id_product'] =$itemId;
	                $products[$value['id_product']]['name']=$name;
	                $products[$value['id_product']]['price']=$price;
	                $products[$value['id_product']]['quantity']=$quantity;
	                $products[$value['id_product']]['totalByItem']=$totalByItem;
	                $products[$value['id_product']]['discount']=$discount;
	                $products[$value['id_product']]['image']=$image;
	                
                }
                $dao=new DAO();
                $time=date("Y-m-d");
				$orderId=$dao->insertOrder($userId, $postUsername, $postLastname, $postAddress, $postEmail, $postPhone, $time);
                $orderItems=serialize($products);
                $dao->InsertOrderItems($orderId, $orderItems);
                
				if(isset($_SESSION['cart'])){
					$_SESSION['cart']=array();//setujemo korpu na prazan niz
					
			    }
			        $login=unserialize($_SESSION['loggedIn']);
					$cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
					$msgOrderSuccess=$dao->getLastOrder($orderId); 
		            include 'index.php';
			}else{
				$msgError="Must fill out all input fields correctly";
				include 'checkPage.php';
			}
			
	}	

	
	public function addToCart(){
	    session_start();
		//data for index page
		$idItem=isset($_GET['idItem'])?$_GET['idItem']:"";
		//var_dump($idItem);
		$from=isset($_GET['from'])?$_GET['from']:"";
		//var_dump($from);
		$type=isset($_GET['type'])?$_GET['type']:"";
		//var_dump($type);
		$numberOfPagesByType=isset($_GET['numberofPages'])?$_GET['numberofPages']:"";
		$numberOfPagesByType=(int)$numberOfPagesByType;
	    //var_dump($numberOfPagesByType);
	    $pageByType=isset($_GET['currentPage'])?$_GET['currentPage']:"";
	    //var_dump($pageByType);
	    $pageByType=(int)$pageByType;
	    $subId=isset($_GET['subId'])?$_GET['subId']:"";
	    //var_dump($subId);
	    
		if (!empty($from) && $from=='index'){
			
			
			if (!empty($_SESSION['loggedIn'])){
				
				$dao=new DAO();
				$ItemById=$dao->getProductForCart($idItem);
				//var_dump($ItemById);
				
				if($ItemById){
					
					if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
						
						$_SESSION['cart']=array();
						$_SESSION['cart'][]=$ItemById;
					    if(!empty($type)&&!empty($numberOfPagesByType)&&!empty($pageByType)){
							$totalNumberOfRowsByType=$dao->countProductsByType($typeOfProducts=$type);
						
						    $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
						
						    $itemsByType=$dao->getProductsByType($type, $numberOfPagesByType, $pageByType);
						}
						$cart=$_SESSION['cart'];
						$login=unserialize($_SESSION['loggedIn']);
						$msgCartSuccess=">> ".$ItemById['name']. " << just added to cart";
						
				        include 'index.php';	
					}else{
						
					function searchForId($id, $array) {
					   foreach ($array as $key => $val) {
					       if ($val['id_product'] === $id) {
					       	   //echo "imaaaa";
					           return true;
					       }
					   }       
					           //echo "nemaaaa";
					           return false;
					}
					$id=$ItemById['id_product'];
					$array=$_SESSION['cart'];
					$test=searchForId($id, $array);
					//var_dump($test);
					
					if($test===false) {
						  $_SESSION['cart'][]=$ItemById;
						  
						  if(!empty($type)&&!empty($numberOfPagesByType)&&!empty($pageByType)){
						  	
							$totalNumberOfRowsByType=$dao->countProductsByType($typeOfProducts=$type);
						    $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
						    $itemsByType=$dao->getProductsByType($type, $numberOfPagesByType, $pageByType);
						  }
						  $login=unserialize($_SESSION['loggedIn']);
						  $cart=$_SESSION['cart'];
						  $msgCartSuccess=">> ".$ItemById['name']. " << just added to cart";
						  
					      include 'index.php';
						
						
						
					} else {
						  if(!empty($type)&&!empty($numberOfPagesByType)&&!empty($pageByType)){
						 	
						    $totalNumberOfRowsByType=$dao->countProductsByType($typeOfProducts=$type);
						    $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
						    $itemsByType=$dao->getProductsByType($type, $numberOfPagesByType, $pageByType);
						  }
						  $login=unserialize($_SESSION['loggedIn']);
						  $cart=$_SESSION['cart'];  
						  $msgCartError=">> ".$ItemById['name']." <<  is already in the cart please increase the quantity";
						  
						  include 'cart.php';
					}
							
					}
				}else{
					    $msgCartError="the product does not exist in the cart";
					    $login=unserialize($_SESSION['loggedIn']);
						$cart=$_SESSION['cart'];
					    include 'index.php';
				}
	
			}else{
				$msgError="Must be logged in for this action,please login";
				include 'login.php';
			}
			
		}elseif (!empty($from) && $from =='products'){
			
    		
    		
			if (!empty($_SESSION['loggedIn'])){
				
			 $dao=new DAO();
			$ItemById=$dao->getProductForCart($idItem);
			if($ItemById){
				
				if(!isset($_SESSION['cart'])|| empty($_SESSION['cart'])){
					$_SESSION['cart']=array();
					$_SESSION['cart'][]=$ItemById;
					
					$totalNumberOfRowsByType=$dao->getCountProductsBySubId($subId);
			        //var_dump($totalNumberOfRowsByType);
			        $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
			        // var_dump($totalNumberOfPagesByType);
			        
		
				    $productsBySubId=$dao->getProductBySubId($subId,$numberOfPagesByType,$pageByType);
				    //var_dump($productsBySubId);
					$msgCartSuccess=">> ".$ItemById['name']." << just added to cart";
					$login=unserialize($_SESSION['loggedIn']);
					$cart=$_SESSION['cart'];		
			        include 'products.php';	
			        //header('Location:routes.php?page=Products');
					
				}else{
					function searchForId($id, $array) {
					   foreach ($array as $key => $val) {
					       if ($val['id_product'] === $id) {
					       	   //echo "imaaaa";
					           return true;
					       }
					   }       
					           //echo "nemaaaa";
					           return false;
					}
					
					$id=$ItemById['id_product'];
					$array=$_SESSION['cart'];
					$test=searchForId($id, $array);
					//var_dump($test);
				
				if($test===false) {
					    $_SESSION['cart'][]=$ItemById;//ako vec postoji korpa,na vec postojecu korpu dodaj novi proizvod
						$totalNumberOfRowsByType=$dao->getCountProductsBySubId($subId);
				        //var_dump($totalNumberOfRowsByType);
				        $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
				        // var_dump($totalNumberOfPagesByType);
				        
			
					    $productsBySubId=$dao->getProductBySubId($subId,$numberOfPagesByType,$pageByType);
					    //var_dump($productsBySubId);
						$msgCartSuccess=">> ".$ItemById['name']." << just added to cart";
						$login=unserialize($_SESSION['loggedIn']);
					    $cart=$_SESSION['cart'];		
				        include '/home/shopprob/public_html/SHOP/view/products.php';	
					    //header('Location:routes.php?page=Products');
					
					
				} else {
					
					    $totalNumberOfRowsByType=$dao->getCountProductsBySubId($subId);
				        //var_dump($totalNumberOfRowsByType);
				        $totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
				        // var_dump($totalNumberOfPagesByType);
				        
			
					    $productsBySubId=$dao->getProductBySubId($subId,$numberOfPagesByType,$pageByType);
					    //var_dump($productsBySubId);
						$msgCartError=">> ".$ItemById['name']." <<  is already in the cart please increase the quantity";
						$login=unserialize($_SESSION['loggedIn']);
					    $cart=$_SESSION['cart'];
				        include 'cart.php';	
				}
					
				}
			}else{
				    $msgCartError="the product does not exist in the cart";
				    $login=unserialize($_SESSION['loggedIn']);
					$cart=$_SESSION['cart'];
				    include 'products.php';
			}
				
			}else{
				$msgError="Must be logged in for this action,please login";
				include 'login.php';
			}
		}
		
	}
	
    public function increment(){
    	$idItem=isset($_GET['id'])?$_GET['id']:"";
    	//var_dump($id);
    	$quantity=isset($_GET['quantity'])?$_GET['quantity']:"";
    	$dao=new DAO();
    	$Item=$dao->getProductForCart($idItem);
    	session_start();
    	
       	if(!empty($_SESSION['cart'])){
       		foreach ($_SESSION['cart'] as $key=>$value) {
       			if($idItem==$value['id_product']){
       				//na kljucu u sesiji gde se podudaraju ajdijevi dodajemo vrednost uvecanu za jedan
               		$_SESSION['cart'][$key]['cart_quantity']=$quantity+1; 
       			}
       		}
       	}
        $_SESSION['item']=$Item;
        $login=unserialize($_SESSION['loggedIn']);
        $cart=$_SESSION['cart'];
    	include 'cart.php';
    }
    
    public function decrement(){
    	
        $idItem=isset($_GET['id'])?$_GET['id']:"";
    	//var_dump($id);
    	$quantity=isset($_GET['quantity'])?$_GET['quantity']:"";
    	
    	$dao=new DAO();
    	$ItemById=$dao->getProductForCart($idItem);
    	$deletedItem=$dao->getProductForCart($idItem);
    	
    	session_start();
       	if(!empty($_SESSION['cart'])){
       		foreach ($_SESSION['cart'] as $key=>$value) {
       			if($idItem==$value['id_product']&&$_SESSION['cart'][$key]['cart_quantity']>=1){
       				//na kljucu u sesiji gde se podudaraju ajdijevi dodajemo vrednost uvecanu za jedan
               		$_SESSION['cart'][$key]['cart_quantity']=$quantity-1; 
       			}
       			if($idItem==$value['id_product']&&$_SESSION['cart'][$key]['cart_quantity']<1){
       				unset($_SESSION['cart'][$key]);
       				$msgCartSuccess=">> ".$deletedItem['name']." << successfully deleted from cart";
       				if (empty($_SESSION['cart'])){
       					$msgCartError="Cart is empty";
		       			if(!isset($_SESSION)){
				           session_start();
			            }
			
						if (!empty($_SESSION['cart'])){
							$cart=$_SESSION['cart'];
						}
						if (!empty($_SESSION['loggedIn'])){
							$login=unserialize($_SESSION['loggedIn']);
						}
       					include 'index.php';
       				}
       			}
       		}
       	}
       	$cart=$_SESSION['cart'];
    	$login=unserialize($_SESSION['loggedIn']);
    	include 'cart.php';
    }
    
    public function deleteItem(){
    	$idItem=isset($_GET['id'])?$_GET['id']:"";
    	//var_dump($id);
    	$dao=new DAO();
    	$deletedItem=$dao->getProductForCart($idItem);
    	session_start();
    	
    	if(!empty($_SESSION['cart'])){    		
    		//$_SESSION['cart']=array();za ne daj Boze
    		foreach ($_SESSION['cart'] as $key=>$value){
    			if ($value['id_product']==$idItem){
    				unset($_SESSION['cart'][$key]);
    				$msgCartSuccess=">> ".$deletedItem['name']." << successfully deleted from cart";
    			if (empty($_SESSION['cart'])){
       					$msgCartError="Cart is empty";
       					$login=unserialize($_SESSION['loggedIn']);
       					include 'index.php';
       			}
    			}
    		}
    		
    	}
    	$login=unserialize($_SESSION['loggedIn']);
        $cart=$_SESSION['cart'];
    	include 'cart.php';
    }
    
   public function ViewCart(){
       if(!isset($_SESSION['cart']) || !isset($_SESSION['loggedIn'])){
		    session_start();
	   }
	   if (!empty($_SESSION['cart'])){
		  $cart=$_SESSION['cart'];
	   }
	   if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
	   }
	   $_SESSION['time'];
	   include 'cart.php';
   }
    
   public function ContinueShopping(){
	   if(!isset($_SESSION)){
		  session_start();
	   }
	   
        if (!empty($_SESSION['cart'])){
			$cart=$_SESSION['cart'];
		}
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		if (!empty($_SESSION['time'])){
			$_SESSION['time'];
		}
		
		 include 'index.php';
   } 
   
	public function emptyCart(){
			$dao=new DAO();
			$empty=isset($_GET['emptyCart'])?$_GET['emptyCart']:"";
			//var_dump($empty);
			
			if(isset($empty)){
				session_start();
				if(empty($_SESSION['cart'])){
					$msgCartError="Cart is empty";
					$login=unserialize($_SESSION['loggedIn']);
					include 'index.php';
					//header("Location:index.php");
				}
				if(isset($_SESSION['cart'])){
					$_SESSION['cart']=array();//setujemo korpu na prazan niz
					$msgCartError="Cart is empty";
					$login=unserialize($_SESSION['loggedIn']);
					include 'index.php';
					//header("Location:index.php");
				}
			}else{
				$msgCartError="Wrong action";
				include 'index.php';
			}
		}
    
	public function productsBySubId(){
		if(!isset($_SESSION)){
			session_start();
		}
		$subId=isset($_GET['subId'])?$_GET['subId']:"";
		//var_dump($subId);
		$pageByType=isset($_GET['pageByType'])?$_GET['pageByType']:"";
		//var_dump($pageByType);
		$dao=new DAO();
		$subName=$dao->subCatName($subId);
		//var_dump($subName);
		
		
		/** PAGINATION FOR PRODUCTS PAGE **/
			if(isset($pageByType)){
			    $pageByType = $pageByType;
			    // cast u integer
			    $pageByType = (int) $pageByType;
			    if(!is_numeric($pageByType)){
			        $pageByType = 1;
			    }
			}else{
			    // default 
			    $pageByType = 1;
			}
			//var_dump($pageByType);
			$numberOfPagesByType=6;
			$totalNumberOfRowsByType=$dao->getCountProductsBySubId($subId);
			//var_dump($totalNumberOfRowsByType);
			$totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
			//var_dump($totalNumberOfPagesByType);
			if($totalNumberOfPagesByType < $pageByType || $pageByType <= 0){
			    $pageByType = 1;
			}
		
		    $productsBySubId=$dao->getProductBySubId($subId,$numberOfPagesByType,$pageByType);
		    //var_dump($productsBySubId);
		    
	        if(!isset($_SESSION)){
			  session_start();
		    }
		   
	        if (!empty($_SESSION['cart'])){
				$cart=$_SESSION['cart'];
			}
			if (!empty($_SESSION['loggedIn'])){
				$login=unserialize($_SESSION['loggedIn']);
			}
			
	        if (!empty($_SESSION['time'])){
					$_SESSION['time'];
			}
			
		    include 'products.php';
	}
	
    public function productDetail(){
      $idProduct=isset($_GET['idproduct'])?$_GET['idproduct']:"";
      //var_dump($idProduct);
      $dao=new DAO();
      $oneProduct=$dao->getProducDetailById($idProduct);
      //var_dump($oneProduct);
      $reviewsById=$dao->selectReviewsById($idProduct);
      //var_dump($reviewsById);
      
      //if(!isset($_SESSION)){
	     //session_start();
	  //}
		   
      if (!empty($_SESSION['cart'])){
		$cart=$_SESSION['cart'];
	  }
	  if (!empty($_SESSION['loggedIn'])){
		$login=unserialize($_SESSION['loggedIn']);
	  }
	  
      if (!empty($_SESSION['time'])){
		  $_SESSION['time'];
	  }
      include 'products-detail.php';
    }
    
	public function itemsType(){
	   
		$type=isset($_GET['Type'])?$_GET['Type']:"";
	    //var_dump($type);
		$pageByType=isset($_GET['pageNumber'])?$_GET['pageNumber']:"";
		//var_dump($pageByType);
		
		/** PAGINATION START **/
			if(isset($pageByType)){
			    //$pageByType = $pageByType;
			    // cast u integer
			    $pageByType = (int) $pageByType;
			    if(!is_numeric($pageByType)){
			        $pageByType = 1; 
			    }
			    if($pageByType==0){
			         $pageByType = 1; 
			    }
			}else{
			    // default 
			    $pageByType = 1;
			}
			
			$dao=new DAO();
			//var_dump($pageByType);
			$numberOfPagesByType=4;
			$totalNumberOfRowsByType=$dao->countProductsByType($typeOfProducts=$type);
			//var_dump($totalNumberOfRowsByType);
			$totalNumberOfPagesByType= ceil( $totalNumberOfRowsByType / $numberOfPagesByType );
			//var_dump($totalNumberOfPagesByType);
			if($totalNumberOfPagesByType < $pageByType || $pageByType <= 0){
			    $pageByType = 1;
			}
			
		    $itemsByType=$dao->getProductsByType($type,$numberOfPagesByType,$pageByType);
		    //var_dump($itemsByType);
		    
		    if(!isset($_SESSION)){
			  //session_start();
		    }
		   
	        if (!empty($_SESSION['cart'])){
				$cart=$_SESSION['cart'];
			}
			if (!empty($_SESSION['loggedIn'])){
				$login=unserialize($_SESSION['loggedIn']);
			}
			
			if (!empty($_SESSION['time'])){
					$_SESSION['time'];
			}
		    include 'index.php'; 
	}
	
	public function checkPage(){
		session_start();
		$login=unserialize($_SESSION['loggedIn']);
		$userId=$login['userId'];
		$dao=new DAO();
		$loginUser=$dao->User($userId);
		
		include 'checkPage.php';
	}
	public function Products(){
		
		if(!isset($_SESSION)){
			session_start();
		}
		if (!empty($_SESSION['cart'])){
			$cart=$_SESSION['cart'];
		}
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
	    if (!empty($_SESSION['time'])){
		    $_SESSION['time'];
		}
		include 'products.php';
	}
	
	public function backToCart(){
	    if(!isset($_SESSION)){
			session_start();
		}
	    if (!empty($_SESSION['cart'])){
			$cart=$_SESSION['cart'];
		}
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		include 'cart.php';
	}
	
	public function showContact(){
		session_start();
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		$msg="stigla";
		include 'contact.php';
	}
	
	public function SendEmail(){
		if(!isset($_SESSION)){
		   session_start();
		}
		
		$name=isset($_POST['name'])?$_POST['name']:"";
		//var_dump($name);
		$email=isset($_POST['email'])?$_POST['email']:"";
		//var_dump($email);
		$subject=isset($_POST['subject'])?$_POST['subject']:"";
		//var_dump($subject);
		$message=isset($_POST['message'])?$_POST['message']:"";
		//var_dump($message);
		
	    if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		/*
		 * proba.proba506@gmail.com
		 * Proba!Proba@022SM
		 * header("Location:routes.php?page=svivozaci");
		 */
	    $mail=new PHPMailer();
		//$mail->isSMTP();
		$mail->SMTPAuth=true;
		$mail->SMTPSecure='tls';
		$mail->Host='smtp.gmail.com';
		$mail->Port='587';
		$mail->Username='proba.proba506@gmail.com';
		$mail->Password='Proba!Proba@022SM';
		$mail->setFrom($email,$name);
		$mail->Subject=$subject;
		$mail->Body=$message;
		$mail->addAddress('proba.proba506@gmail.com');
		$mail->addReplyTo($email, 'Sender :');
		
		if(!$mail->send()) {
		    $msgError='Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
	    } else {
	        $msgSuccess="Message has been sent,let's stay in touch";
	    }
		include 'contact.php';
	}
	
	public function SubmitReview(){
		$name=isset($_POST['name'])?$_POST['name']:"";
		//var_dump($name);
		$email=isset($_POST['email'])?$_POST['email']:"";
		//var_dump($email);
		$text=isset($_POST['review'])?$_POST['review']:"";
		//var_dump($text);
		$time=date("h:i:sa");
		//var_dump($time);
		$date=date("Y-m-d");
		//var_dump($date);
		$idProduct=isset($_POST['productId'])?$_POST['productId']:"";
		//var_dump($idProduct);
        
		$errors=array();
		
	    /*********** filtriranje i validacija polja ****************/
        if (isset($name)) {
			//Filtering 1
			$name= trim($name);
	        $name= strip_tags($name);
			
			//Validation - if required
			if ($name=== "") {
				$errors["name"][] = "Field name is required";
			}else{
	            if(mb_strlen($name) <= 3 || mb_strlen($name) > 20){
	                $errors["name"][] = "Field must be longer than 3 and less than 20 characters";
	            }
	        }
		
	    } else {
		    $errors["name"][] = "Field name must be sent";
	    }
    
        /*********** filtriranje i validacija polja ****************/
        if (isset($email)) {
			//Filtering 1
			$email= trim($email);
	        $email= strip_tags($email);
			
			//Validation - if required
			if ($email=== "") {
				$errors["email"][] = "Field email can't be empty";
			} else{
	            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
	                $errors["email"][] = "Invalid email format";
	            } 
	        }
		
	    } else {
		  $errors["email"][] = "Field email must be sent";
	    }
	    
	    if(mb_strlen($text) <= 3 || mb_strlen($text) > 30){
	                $errors["review"][] = "Field must be longer than 3 and less than 30 characters";
	    }
		
	    if (count($errors)==0){
	    	$dao=new DAO();
		    $dao->insertReview($name, $email, $text, $time, $date, $idProduct);
	        $oneProduct=$dao->getProducDetailById($idProduct);
	        $reviewsById=$dao->selectReviewsById($idProduct);
	        //var_dump($reviewsById);
	        $msgSuccess="Review has been sent";
	        include 'products-detail.php';
	    }else{
	    	$dao=new DAO();
	    	 $oneProduct=$dao->getProducDetailById($idProduct);
	         $reviewsById=$dao->selectReviewsById($idProduct);
	         //var_dump($reviewsById);
	         include 'products-detail.php';
	    }

	}
	
    public function showBlogList(){
        if(!isset($_SESSION)){
		  session_start();
	    }
	   
        if (!empty($_SESSION['cart'])){
			$cart=$_SESSION['cart'];
		}
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		if (!empty($_SESSION['time'])){
			$_SESSION['time'];
		}
		
        $page=isset($_GET['pageNumber'])?$_GET['pageNumber']:"";
		//var_dump($page);
		
        $dao= new DAO();
        
		/** PAGINATION START **/
			if(isset($page)){
			    $page = $page;
			    // cast u integer
			    $page = (int) $page;
			    if(!is_numeric($page)){
			        $page = 1; 
			    }
			}else{
			    // default 
			    $page = 1;
			}
			
			$numberOfPages=3;
			$totalNumberOfRows=$dao->countBlog();
			//var_dump($totalNumberOfRows);
			$totalNumberOfPages= ceil( $totalNumberOfRows / $numberOfPages );
			//var_dump($totalNumberOfPages);
			
			if($totalNumberOfPages < $page || $page <= 0){
			    $page = 1;
			}
			
		$blogList=$dao->blogList($numberOfPages, $page);
		include 'blog.php';
	}
	
	public function showBlogDetail(){
	    if(!isset($_SESSION)){
		  session_start();
	    }
	   
        if (!empty($_SESSION['cart'])){
			$cart=$_SESSION['cart'];
		}
		if (!empty($_SESSION['loggedIn'])){
			$login=unserialize($_SESSION['loggedIn']);
		}
		if (!empty($_SESSION['time'])){
			$_SESSION['time'];
		}
		$blogId=isset($_GET['blogId'])?$_GET['blogId']:"";
		//var_dump($blogId);
		$dao=new DAO();
		$blogDetail=$dao->blogDetail($blogId);
		include 'blog-detail.php';
	} 
	
	
	
	
/************************************** ADMIN CONTROLLER *****************************************************/
/************************************** ADMIN CONTROLLER *****************************************************/
	
	
	
	public function adminIndex(){
		if(!isset($_SESSION)){
			session_start();
		}
	    if (!empty($_SESSION['loggedInAdmin'])){
	       $login=unserialize($_SESSION['loggedInAdmin']);
	    }
	    if (!empty($login)){
			$dao=new DAO();
		    $users=$dao->Users();
		    $products=$dao->ProductsList();
		    $page=1;
			$numberOfPages=3;
		    $orders=$dao->ordersList($numberOfPages, $page);
		    $ordersDate=$dao->orderDate();
		    $countNewOrders=$dao->countNewOrders();
		    $reviews=$dao->reviewsList();
		    include 'admin/index.php'; 
	    }else{
	    	include 'admin/login.php';
	    }
	}
	
	public function showLogin(){
		include 'admin/login.php';
	}
	
	public function LoginAdmin(){
		$email=isset($_POST['email'])?$_POST['email']:"";
	  	//var_dump($email);
	  	$password=isset($_POST['password'])?$_POST['password']:"";
	  	//var_dump($password);
	  	
	  	if(!empty($email)&&!empty($password)){
	  		$dao=new DAO();
			$user=$dao->getAdminUserForLogin($email, $password);
			//var_dump($user);
			    if ($user){
				if(!isset($_SESSION)){
			      session_start();
	        	}
				$_SESSION['loggedInAdmin']=serialize($user);
				$login=unserialize($_SESSION['loggedInAdmin']);
		        $users=$dao->Users();
		        $products=$dao->ProductsList();
		        $page=1;
			    $numberOfPages=3;
		        $orders=$dao->ordersList($numberOfPages, $page);
		        $countNewOrders=$dao->countNewOrders();
		        $reviews=$dao->reviewsList();
				$msgSuccess="User : ".$user['name']." is logged in successfully";
				include 'admin/index.php';
			}else{
				$email=isset($_POST['email'])?$_POST['email']:"";
				$msgError="Incorrect email or password or doesn't exist.";
				include 'admin/login.php';
			}
	  	}else{
	  	  
	  	  $msgError="Please fill out all input fields correctly.";
	  	  include 'admin/login.php';
	  	}
	}
	
	public function logoutAdmin(){
		if(!isset($_SESSION)){
			session_start();
		}
		unset($_SESSION['loggedInAdmin']);
		include 'admin/login.php';
	}
	
    public function listUser(){
        if(!isset($_SESSION)){
			session_start();
		}
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao=new DAO();
	    	$users=$dao->Users();
			include 'admin/users/usersList.php';
		}else{
			include 'admin/login.php';
		}
    	
	}
	
	public function insertUser(){
		if(!isset($_SESSION)){
			session_start();
		}
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			if ($login['role']!="Moderator"){
				$dao=new DAO();
				$users=$dao->Users();
				
				include 'admin/users/insertUser.php';
			}else{
				$dao=new DAO();
				$users=$dao->Users();
    		    $products=$dao->ProductsList();
    		    $page=1;
    			$numberOfPages=3;
    		    $orders=$dao->ordersList($numberOfPages, $page);
    		    $ordersDate=$dao->orderDate();
    		    $countNewOrders=$dao->countNewOrders();
    		    $reviews=$dao->reviewsList();
    		    
				$msgError="Must have *ADMIN* priviledges for this action";
				
				include 'admin/index.php';
			}
		}else{
			include 'admin/login.php';
		} 
			
	}
	
    public function Submit(){
        if(!isset($_SESSION)){
			session_start();
		}
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		
	  	$name=isset($_POST['name'])?$_POST['name']:"";
	  	//var_dump($name);
	  	$lastName=isset($_POST['last_name'])?$_POST['last_name']:"";
	  	//var_dump($lastName);
	  	$email=isset($_POST['email'])?$_POST['email']:"";
	  	//var_dump($email);
	  	$password=isset($_POST['password'])?$_POST['password']:"";
	  	//var_dump($password);
	  	$role=isset($_POST['Role'])?$_POST['Role']:"";
	  	//var_dump($role);
	  	
	  	$errors=array();
	  	
	    if(empty($name)){
		   $errors['name']="Name can't be empty";
	    }
	    if(empty($lastName)){   
		   $errors['last_name']="Last name can't be empty";
	    }
	    if(empty($email)){
		   $errors['email']="Email can't be empty";
	    }else{
		   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						  
		} else {
		   $errors['email']="Invalid email format";
		}
	    }
	    
	    if(empty($password)){
		   $errors['password']="Password can't be empty";
		}else{
			if(mb_strlen($password)<=4){
			 $errors['password']="Enter more than 4 characters";
			}
		}
	  	if ($role==""){
	  		$errors['Role']="Choose role";
	  	}
	  	
	  	if(count($errors)==0){
	  	    $dao=new DAO();
	  		$status=$dao->checkAdminUser($email);       
	  		if (!$status){
	  			$dao->insertUser($name, $lastName, $email, $password, $role);
		  		$users=$dao->Users();
		  		$msgSuccess="User inserted successfully";
		  		include 'admin/users/usersList.php';
	  		}else{
	  			$msgError="User already exists in a list";
	  			$users=$dao->Users();
	  			include 'admin/users/usersList.php';
	  		}
	  	}else{
	  		$name=isset($_POST['name'])?$_POST['name']:"";
		  	//var_dump($name);
		  	$lastName=isset($_POST['last_name'])?$_POST['last_name']:"";
		  	//var_dump($lastName);
		  	$email=isset($_POST['email'])?$_POST['email']:"";
		  	//var_dump($email);
		  	$password=isset($_POST['password'])?$_POST['password']:"";
		  	//var_dump($password);
		  	$role=isset($_POST['Role'])?$_POST['Role']:"";
		  	//var_dump($role);
	  		$msgError="Must fill out all input field correctly";
	   	    include 'admin/users/insertUser.php';
	  	}
	  	
	  	
	}
	
	
    public function showDeleteUser(){
    	   
    	   session_start();
		   $login=unserialize($_SESSION['loggedInAdmin']);
		   if (!empty($login) && $login['email']=="zile.zile@gmail.com"){
		   	   $userId=isset($_GET['userId'])?$_GET['userId']:"";
			   $dao=new DAO();
			   $user=$dao->AdminUser($userId);
			   //var_dump($userId);
			   include 'admin/users/deleteUser.php';
		   }else{
		   	   $dao=new DAO();
		   	   $users=$dao->Users();
		   	   $msgError="Must have *MAIN ADMIN* priviledges for this action";
		       include 'admin/users/usersList.php';
		   }
	}
	
	public function deleteUser(){
		
		session_start();
		$login=unserialize($_SESSION['loggedInAdmin']);
		
		$delete=isset($_POST['Delete user'])?$_POST['Delete user']:"";
		//var_dump($delete);
		$userId=isset($_POST['userId'])?$_POST['userId']:"";
        //var_dump($userId);
	    if (isset($delete)&&isset($userId)){
			$dao=new DAO();
			$one=$dao->AdminUser($userId);
			$dao->deleteAdminUser($userId);
			$msgSuccess=$one['name']." ".$one['last_name']." deleted successfully";
			$users=$dao->Users();
			include 'admin/users/usersList.php'; 
		}
	}
	
	public function Cancel(){
		session_start();
		$login=unserialize($_SESSION['loggedInAdmin']);
		
		$cancel=isset($_POST['Cancel'])?$_POST['Cancel']:"";
		$userId=isset($_POST['userId'])?$_POST['userId']:"";
		if (isset($cancel)&&isset($userId)){
			$dao=new DAO();
			$users=$dao->Users();
			include 'admin/users/usersList.php';
		}
	}
	
    public function ShowEditUser(){
	       session_start();
		   if (!empty($_SESSION['loggedInAdmin'])){
				$login=unserialize($_SESSION['loggedInAdmin']);
				//var_dump($login);
		   }
		   
		   $userId=isset($_GET['userId'])?$_GET['userId']:"";
		   //var_dump($userId);
		   $dao= new DAO();
		   $user=$dao->AdminUser($userId);
		   //var_dump($user);
		if($user){
			    if (!empty($login) && $login['role']!="Moderator"){
				    if ($login['email']!=$user['email'] && $user['email']!="zile.zile@gmail.com" && $user['role']!="Admin" || $login['email']=="zile.zile@gmail.com"){
					   	 $user=$dao->AdminUser($userId);
					     include 'admin/users/editUser.php';
				    }else{
					   	 $users=$dao->Users();
				  	     $msgError="You can't not edit main admin user or all other admin users";
					     include 'admin/users/usersList.php';
				    }
			    }else{
			    	$dao= new DAO();
			    	$users=$dao->Users();
			    	$msgError="Must have *ADMIN* priviledges for this action";
			        //include 'admin/index.php';
			        include 'admin/users/usersList.php';
			    }
		}else{
		   $dao= new DAO();
		   $users=$dao->Users();
	  	   $msgError="User doesn't exist in users list";
		   include 'admin/users/usersList.php';
		}
	}
	
	public function EditUser(){
		
		session_start();
		$login=unserialize($_SESSION['loggedInAdmin']);
		
		$name=isset($_POST['name'])?$_POST['name']:"";
	  	//var_dump($name);
	  	$lastName=isset($_POST['last_name'])?$_POST['last_name']:"";
	  	//var_dump($lastName);
	  	$email=isset($_POST['email'])?$_POST['email']:"";
	  	//var_dump($email);
	  	$password=isset($_POST['password'])?$_POST['password']:"";
	  	//var_dump($password);
	  	$role=isset($_POST['Role'])?$_POST['Role']:"";
	  	//var_dump($role);
	  	$userId=isset($_POST['userId'])?$_POST['userId']:"";
	  	//var_dump($userId);
	  	$errors=array();
	  	
	    if(empty($name)){
		   $errors['name']="Name can't be empty";
	    }
	    if(empty($lastName)){
		   $errors['last_name']="Last name can't be empty";
	    }
	    if(empty($email)){
		   $errors['email']="Email can't be empty";
	    }else{
		   if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						  
		} else {
			//moramo upucati greske da ne bi prosao email u bazu
		   $errors['email']="Invalid email format";
		}
	    }
	    
	    if(empty($password)){
		   $errors['password']="Password can't be empty";
		}else{
			if(mb_strlen($password)<=4){
			 $errors['password']="Enter more than 4 characters";
			}
		}
	  	if ($role==""){
	  		$errors['Role']="Choose role";
	  	}
	  	//var_dump($errors);
	  	if(count($errors)==0){
	  		$dao= new DAO();
	  		$user=$dao->UpdateAdminUser($name, $lastName, $email, $password, $role, $userId);
	  		$users=$dao->Users();
	  		$one=$dao->AdminUser($userId);
	  		$msgSuccess=$one['name']." ".$one['last_name']." updated successfully";
	  		include 'admin/users/usersList.php';
	  	}else{
	  		$userId=isset($_POST['userId'])?$_POST['userId']:"";
	  		var_dump($userId);
	  		$dao= new DAO();
	  		$one=$dao->AdminUser($userId);
	  		//var_dump($one);
	  		$role=$one['role'];
	  		var_dump($role);
	  		$msgError="Must fill out all input field correctly";
	  		include 'admin/users/editUser.php';
	  	}
	}
	
	public function showInsertCategory(){
		 session_start();
		 if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		 }
		 if (!empty($login)){
		    include 'admin/categories/insertCategory.php';
		 }else{
		 	include 'admin/login.php';
		 }
	}
	
	public function InsertCategory(){
	    session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
	    if (!empty($login)){
		    $categoryName=isset($_POST['category_name'])?$_POST['category_name']:"";
		  	//var_dump($categoryName);
		  	
		  	$errors=array();
		  	
		    if(empty($categoryName)){
			   $errors['category_name']="Name can't be empty";
		    }
		   
		    //var_dump($errors);
		  	if(count($errors)==0){
		  	    $dao=new DAO();
		  	    $categoryName= strtoupper($categoryName);
		  	    $dao->insertCategory($categoryName);
		  	    $categories=$dao->getCategoriesList();
		  	    $msgSuccess="Category inserted successfully";
		  	    include 'admin/categories/categoriesList.php';
		  	}else{
		  		$msgError="Must fill out all input field correctly";
		  		include 'admin/categories/insertCategory.php';
		  	}
	    }else{
	    	include 'admin/login.php';
	    }
	}
	
	public function categoriesList(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao=new DAO();
			$categories=$dao->getCategoriesList();
			include 'admin/categories/categoriesList.php';
		}else{
			include 'admin/login.php';
		}
		
	}
	
	public function ShowEditCategory(){
	    session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$categoryId=isset($_GET['categoryId'])?$_GET['categoryId']:"";
			//var_dump($categoryId);
			$dao= new DAO();
			$category=$dao->categoryById($categoryId);
			include 'admin/categories/editCategory.php';
		}else{
			include 'admin/login.php';
		}
		
	}
	
	public function EditCategory(){
		$categoryName=isset($_POST['category_name'])?$_POST['category_name']:"";
		//var_dump($categoryName);
		$categoryId=isset($_POST['categoryId'])?$_POST['categoryId']:"";
		//var_dump($categoriId);
		
		$errors=array();
		
	    if(empty($categoryName)){
		   $errors['category_name']="Category name can't be empty";
	    }
	    //var_dump($errors);
	    
	    if(count($errors)==0){
	  		$dao= new DAO();
	  		$dao->updateCategory($categoryName, $categoryId);
	  		$one=$dao->categoryById($categoryId);
	  		$categories=$dao->getCategoriesList();
	  		$msgSuccess=$one['cat_name']."  updated successfully";
	  		include 'admin/categories/categoriesList.php';
	    }else{
	    	$msgError="Must fill out all input field correctly";
	  		include 'admin/categories/editCategory.php';
	    }
		
	}
	
	public function deleteCategory(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$categoryId=isset($_GET['categoryId'])?$_GET['categoryId']:"";
			//var_dump($categoryId);
			$dao= new DAO();
			$test=$dao->testIfEmptyCategory($categoryId);
			//var_dump($test);
			if ($test===false){
		        //$dao= new DAO();
				$dao->deleteCategory($categoryId);
				$categories=$dao->getCategoriesList();
				$msgSuccess="Category deleted successfully";
				include 'admin/categories/categoriesList.php';
			}else{
				$dao= new DAO();
				$categories=$dao->getCategoriesList();
				$msgError="You can't delete category because is not empty";
			    include 'admin/categories/categoriesList.php';
			}
		}else{
			$msgError="Must have *ADMIN* priviledges for this action";
			$dao= new DAO();
			$categories=$dao->getCategoriesList();
			include 'admin/categories/categoriesList.php';
		}
		
	}
	
	public function showInsertSubcategory(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
	    if (!empty($login)){
	    	$dao= new DAO();
			$categories=$dao->getCategoriesList();
			include 'admin/subcategories/insertSubcategory.php';
	    }else{
	    	include 'admin/login.php';
	    }
		
		
	}
	
	public function InsertSubcategory(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
	    if (!empty($login)){
		    $subCatName=isset($_POST['subcategory_name'])?$_POST['subcategory_name']:"";
		  	//var_dump($subCatName);
		  	$catId=isset($_POST['catgory_id'])?$_POST['catgory_id']:"";
		  	//var_dump($catId);
		  	
		    $errors=array();
		  	
		    if(empty($subCatName)){
			    $errors['subcategory_name']="subcategory can't be empty";
		    }
		    if ($catId==""){
		  		$errors['catgory_id']="Choose category";
		  	}
		  	
		  	if(count($errors)==0){
		  		$dao= new DAO();
		  		$dao->insertSubcategory($subCatName, $catId);
		  		$categories=$dao->getCategoriesList();
		  		$msgSuccess="Subcategory inserted successfully";
		  		include 'admin/subcategories/insertSubcategory.php';
		  	}else{
		  		$dao= new DAO();
				$categories=$dao->getCategoriesList();
				$msgError="Must fill out all input field correctly";
				include 'admin/subcategories/insertSubcategory.php';
		  	}
	    }else{
	    	include 'admin/login.php';
	    }
	}
	
	public function SubcategoriesList(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao= new DAO();
			$subcategories=$dao->subactegoriesList();
			include 'admin/subcategories/subcategoriesList.php';
		}else{
			include 'admin/login.php';
		}
		
	}
	
	public function ShowEditSubcategory(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$subId=isset($_GET['subId'])?$_GET['subId']:"";
			//var_dump($subId);
			$catId=isset($_GET['catId'])?$_GET['catId']:"";
			//var_dump($catId);
			$dao= new DAO();
			$subcategoryById=$dao->subcategoryById($subId);
			$categories=$dao->getCategoriesList();
			include 'admin/subcategories/editSubcategory.php';
		}else{
			include 'admin/login.php';
		}
	    
	}
	
	public function EditSubcategory(){
		
		$subCatName=isset($_POST['subcategory_name'])?$_POST['subcategory_name']:"";
	  	//var_dump($subCatName);
	  	$catId=isset($_POST['catgory_id'])?$_POST['catgory_id']:"";
	  	//var_dump($catId);
	  	$subId=isset($_POST['subcategoryId'])?$_POST['subcategoryId']:"";
	  	//var_dump($catId);
	  	
	    $errors=array();
	  	
	    if(empty($subCatName)){
		    $errors['subcategory_name']="subcategory can't be empty";
	    }
	    if ($catId==""){
	  		$errors['catgory_id']="Choose category";
	  	}
	  	
	  	if(count($errors)==0){
	  		$dao= new DAO();
	  		$dao->updateSubcategory($subCatName, $catId, $subId);
	  		$subcategories=$dao->subactegoriesList();
	  		$msgSuccess="Subcategory edited successfully";
	  		include 'admin/subcategories/subcategoriesList.php';
	  	}else{
	  		$dao= new DAO();
	  		$categories=$dao->getCategoriesList();
	  		$msgError="Must fill out all input field correctly";
	  		include 'admin/subcategories/editSubcategory.php';
	  	}
	}
	
	public function deleteSubcategory(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$subcatId=isset($_GET['subId'])?$_GET['subId']:"";
			//var_dump($subcatId);
			$dao= new DAO();
			$test=$dao->testIfEmptySubCategory($subcatId);
			//var_dump($test);
			if ($test===false){
				//$dao= new DAO();
				$dao->deleteSubCategory($subcatId);
				$subcategories=$dao->subactegoriesList();
				$msgSuccess="Subcategory deleted successfully";
				include 'admin/subcategories/subcategoriesList.php';
			}else{
				$dao= new DAO();
				$subcategories=$dao->subactegoriesList();
				$msgError="You can't delete subcategory because is not empty";
			    include 'admin/subcategories/subcategoriesList.php';
			}
		}else{
			$dao= new DAO();
			$categories=$dao->getCategoriesList();
			$subcategories=$dao->subactegoriesList();
			$msgError="Must have *ADMIN* priviledges for this action";
			include 'admin/subcategories/subcategoriesList.php';
		}
	}
	
	public function showInsertProduct(){
	    session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			
			if ($login['role']!="Moderator"){
				$dao=new DAO();
		        $subcategories=$dao->selectSubcategriesForInsert();
		        include 'admin/products/insertProduct.php';
			}else{
				$dao=new DAO();
				$users=$dao->Users();
				$products=$dao->ProductsList();
				$msgError="Must have *ADMIN* priviledges for this action";
				include 'admin/index.php';
			}
		}else{
			include 'admin/login.php';
		}
	}
	
	public function insertProduct(){
	    session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			
			if ($login['role']!="Moderator"){
                
				
				$submit=isset($_POST['page'])?$_POST['page']:"";
		        //var_dump($submit);
		        $name=isset($_POST['name'])?$_POST['name']:"";
	  	        //var_dump($name);
	  	        $price=isset($_POST['price'])?$_POST['price']:"";
	  	        //var_dump($price);
	  	
	  	        $discount=isset($_POST['discount'])?$_POST['discount']:"";
	  	        //var_dump($discount);
			  	if (isset($discount) && !empty($discount)){
			  		$discountPrice=ceil($price - $price * $discount / 100);
			  	}else{
			  		$discountPrice=NULL;
			  	}
			  	$description=isset($_POST['description'])?$_POST['description']:"";
			  	//var_dump($description);
			  	$type=isset($_POST['type'])?$_POST['type']:"";
			  	//var_dump($type);
	  	
			  	$subcategoryId=isset($_POST['subcategoryId'])?$_POST['subcategoryId']:"";
			  	//var_dump($subcategoryId);
			  	$typePossibleValues= array("shoes","t-shirts","cap","sweatsuit");
			  	$dao=new DAO();
				$subcategories=$dao->selectSubcategriesForInsert();
				//var_dump($subcategories);
				
				//pravimo novi   niz koji ce da sadrzi samo ideve iz niza subcategories zbog poredjenja
				$subid=array();
				foreach ($subcategories as $key=>$value){
					$subid[$value['sub_id']]=$value['sub_id'];
				}

				
	  			$errors=array();
	  	
	  	       if (isset($submit) && $submit=="Insert Product"){
	  		
		  	   /*********** filtriranje i validacija polja ****************/
	           // name
			   if (isset($name)) {
					//Filtering 1
					$name= trim($name);
			        $name= strip_tags($name);
			
					//Validation - if required
					if ($name=== "") {
						 $errors['name'][]= "Field name is required!!!";
					}else{
			            if(mb_strlen($name)>100){
			                $errors['name'][]= "Field name can not have more then 10 characters!!!";
			            }
			        }
			
		       } else {
	             //if required
			     $errors['name'][] = "Field name must be sent!!!";
		       }
		   
		       /*********** filtriranje i validacija polja ****************/
               // price
		       if (isset($price)) {
				    //Filtering 1
					$price= trim($price);
			        $price= strip_tags($price);
					
					//Validation - if required
					if ($price=== "") {
						$errors["price"][] = "Field price is required!!!";
					}else{
			            if(!is_numeric($price)){
			               $errors["price"][] = "Field price can only be a number!!!";
			            }else{
			                if($price <= 0){
			                   $errors["price"][] = "Price must be greater then 0!!!";
			                }
			            }
			        }		
		       } else {
	             //if required
			     $errors["price"][] = "Field price must be sent!!!";
		       }
		  
	  	       /*********** filtriranje i validacija polja ****************/
	           // discount
               if (isset($discount)) {   
				   //Filtering 1
				   $discount= trim($discount);
	
			
					//Validation - if required
					if ($discount === "") {
						$discount=NULL; 
					}else{
			            if(!is_numeric($discount)){
			                $errors["discount"][] = "Field discount can only be a number!!!";
			            }else{
			                if($discount <= 0 || $discount > 100){
			                    $errors["discount"][] = "Field discount must be greater then 0 and smaller then 100!!!";
			                }
			            }
			        }		
	           }
	     
	  	       /*********** filtriranje i validacija polja ****************/
               // image
               if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
					if (empty($_FILES["image"]["error"])) {
						//filtering
						$imageFileTmpPath = $_FILES["image"]["tmp_name"];
						$imageFileName = basename($_FILES["image"]["name"]);
						$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
						$imageFileSize = $_FILES["image"]["size"];
						
						//validation
						$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
						$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
						
						if (!in_array($imageFileMime, $imageFileAllowedMime)) {
							$errors["image"][] = "Image can only have .png, .gif or .jpeg extension!!!";
						}
						
						if ($imageFileSize > $imageFileMaxSize) {
							$errors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
						}
						
					} else {
						$errors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
					}
	          }
	      
	  	      /*********** filtriranje i validacija polja ****************/
              // description
	          if (isset($description)) {
				//Filtering 1
				$description= trim($description);
		        $description= strip_tags($description, "<br><br/>");
		      }
		   
	  	      /*********** filtriranje i validacija polja ****************/
              // type
	          if (isset($type)) {
			        //Filtering 1
					$type= trim($type);
			        $type= strip_tags($type);
					
					//Validation - if required
					if ($type=== "") {
						$errors["type"][] = "Field type is required!!!";
					}else{
			            if (!in_array($type, $typePossibleValues)) {
			                $formErrors["type"][] = "Please choose type!!!";
			            }
			        }
			
	           }
	    
	  	      /*********** filtriranje i validacija polja ****************/
             // subcategoryId
             if (isset($subcategoryId)) {
			        //Filtering 1
					$subcategoryId= trim($subcategoryId);
			        $subcategoryId= strip_tags($subcategoryId);
				    
					
					//Validation - if required
					if ($subcategoryId==="") {
						$errors["subcategoryId"][] = "Please choose subcategory!!!";
					}
					//ovde ispitujemo da li niz koji stize iz posta postoji u nizu
					if (!array_key_exists($subcategoryId, $subid)) {
						$errors["subcategoryId"][] = "Wrong subcategory!!!";
					}
				
			  } else {
				  $errors["subcategoryId"][] = "Field subcategory must be sent!!!";
		      }
	  	      
			  if (count($errors)==0) {
					//Uradi akciju koju je korisnik trazio
			        $image = NULL;
			        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
			                if (empty($_FILES["image"]["error"])) {
			                    $destinationPath = __DIR__ . "/../partials/images/products/" . $imageFileName;		
			                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
			                    $formErrors["image"][] = "Something is wrong with image move_uploaded_file";
			                }else{
			                    $image =$imageFileName;
			                }
			            }
			        }
			        
			        if (count($errors)==0) {
			        	$dao=new DAO();
			        	$lastProduct=$dao->lastInsertedProduct($name, $price, $image, $type, $subcategoryId);
			        	if (!$lastProduct){
			        		//INSERT PRODUCT
			        		$dao->insertProduct($name, $price, $discountPrice, $discount, $image, $description, $type, $subcategoryId);
			        	    $products=$dao->ProductsList();
			        	    $msgSuccess="Product successfully inserted";
			        	    include 'admin/products/productsList.php';
			        	}else{
			        		$dao=new DAO();
				        	$products=$dao->ProductsList();
				        	$msgError="Product already exists in a list";
				        	include 'admin/products/productsList.php';
			        	}
			        	
		             }
		      }else{
		        	$msgError="Must fill out all required input fields";
		        	include 'admin/products/insertProduct.php';
		      }
		     
	         }
					
			}else{
				$dao=new DAO();
				$users=$dao->Users();
				$products=$dao->ProductsList();
				$msgError="Must have *ADMIN* priviledges for this action";
				include 'admin/index.php';
			}
		}else{
			include 'admin/login.php';
		}

	 }
	 
	 public function ProductsList(){
	 	session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao=new DAO();
		 	$products=$dao->ProductsList();
		 	include 'admin/products/productsList.php';
		}else{
			include 'admin/login.php';
		}
	 	
	 }
	 
	 public function ShowEditProduct(){
	 	
	 	session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			
			$idProduct=isset($_GET['productId'])?$_GET['productId']:"";
		 	//var_dump($idProduct);
		 	$idProduct=(int)$idProduct;
		 	
		 	$dao=new DAO();
		 	$product=$dao->getProducDetailById($idProduct);
		 	//var_dump($product);
		 	$subcategories=$dao->selectSubcategriesForInsert();
		 	if ($product){
		 		$product=$dao->getProducDetailById($idProduct);
		 		include 'admin/products/editProduct.php';
		 	}else{
		 		$dao= new DAO();
			    $products=$dao->ProductsList();
		  	    $msgError="Product doesn't exist in products list";
			    include 'admin/products/productsList.php';
		 	}
			
		}else{
			include 'admin/login.php';
		}
	 }
	 
	 public function updateProduct(){
	 	
	 	session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			
			   $submit=isset($_POST['page'])?$_POST['page']:"";
	           $name=isset($_POST['name'])?$_POST['name']:"";
			   $price=isset($_POST['price'])?$_POST['price']:"";
			   $discount=isset($_POST['discount'])?$_POST['discount']:"";
			   if (isset($discount) && !empty($discount) && isset($price) && !empty($price)){
			  		$discountPrice=ceil($price - $price * $discount / 100);
			   }else{
			  		$discountPrice=NULL;
			   }
			   $description=isset($_POST['description'])?$_POST['description']:"";
			   $type=isset($_POST['type'])?$_POST['type']:"";
			   $subcategoryId=isset($_POST['subcategoryId'])?$_POST['subcategoryId']:"";
			   $idProduct=isset($_POST['productId'])?$_POST['productId']:"";
			   $productImage=isset($_POST['productImage'])?$_POST['productImage']:"";
			   $typePossibleValues= array("shoes","t-shirts","cap","sweatsuit");
			   
			   $dao=new DAO();
			   $subcategories=$dao->selectSubcategriesForInsert();
			   //var_dump($subcategories);
				
			   //pravimo novi   niz koji ce da sadrzi samo ideve iz niza subcategories zbog poredjenja
			   $subid=array();
			   
			   foreach ($subcategories as $key=>$value){
					$subid[$value['sub_id']]=$value['sub_id'];
			   }
			   
	  	       $errors=array();
	  	
	  	       if (isset($submit) && $submit=="Edit Product"){
	  		
	  		   /*********** filtriranje i validacija polja ****************/
               // NAME
		  	   if (isset($name)) {
					//Filtering 1
					$name= trim($name);
			        $name= strip_tags($name);
			
					//Validation - if required
					if ($name=== "") {
						 $errors['name'][]= "Field name is required!!!";
					}else{
			            if(mb_strlen($name)>100){
			                $errors['name'][]= "Field name can not have more then 10 characters!!!";
			            }
			        }
			
		       } else {
			      $errors['name'][] = "Field name must be sent!!!";
		       }
		   
		       /*********** filtriranje i validacija polja ****************/
               // PRICE
		       if (isset($price)) {
				    //Filtering 1
					$price= trim($price);
			        $price= strip_tags($price);
					
					//Validation - if required
					if ($price=== "") {
						$errors["price"][] = "Field price is required!!!";
					}else{
			            if(!is_numeric($price)){
			               $errors["price"][] = "Field price can only be a number!!!";
			            }else{
			                if($price <= 0){
			                   $errors["price"][] = "Price must be greater then 0!!!";
			                }
			            }
		            }		
		       } else {
				   $errors["price"][] = "Field price must be sent!!!";
		       }
		  
	  	       /*********** filtriranje i validacija polja ****************/
	           // DISCOUNT
               if (isset($discount)) {   
			        //Filtering 1
				    $discount= trim($discount);
		
					//Validation - if required
					if ($discount === "") {
						$discount=NULL; 
					}else{
			            if(!is_numeric($discount)){
			                $errors["discount"][] = "Field discount can only be a number!!!";
			            }else{
			                if($discount <= 0 || $discount > 100){
			                    $errors["discount"][] = "Field discount must be greater then 0 and smaller then 100!!!";
			                }
			            }
			        }		
	            }
	     
	  	        /*********** filtriranje i validacija polja ****************/
                // IMAGE
                if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
					if (empty($_FILES["image"]["error"])) {
						//filtering
						$imageFileTmpPath = $_FILES["image"]["tmp_name"];
						$imageFileName = basename($_FILES["image"]["name"]);
						$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
						$imageFileSize = $_FILES["image"]["size"];
						
						//validation
						$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
						$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
						
						if (!in_array($imageFileMime, $imageFileAllowedMime)) {
							$errors["image"][] = "Image can only have .png, .gif or .jpeg extension!!!";
						}
						
						if ($imageFileSize > $imageFileMaxSize) {
							$errors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
						}
						
					} else {
						$errors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
					}
	            }
	      
	  	        /*********** filtriranje i validacija polja ****************/
                // DESCRIPTION
                if (isset($description)) {
					//Filtering 1
					$description= trim($description);
			        $description= strip_tags($description, "<br><br/>");
	            }
		   
	  	        /*********** filtriranje i validacija polja ****************/
                // TYPE
	            if (isset($type)) {
			        //Filtering 1
					$type= trim($type);
			        $type= strip_tags($type);
					
					//Validation - if required
					if ($type=== "") {
						$errors["type"][] = "Field type is required!!!";
					}else{
			            if (!in_array($type, $typePossibleValues)) {
			                $formErrors["type"][] = "Please choose type!!!";
			            }
			        }
	             }
	    
	  	         /*********** filtriranje i validacija polja ****************/
                 // SUBCATEGORYID
                 if (isset($subcategoryId)) {
			        //Filtering 1
					$subcategoryId= trim($subcategoryId);
			        $subcategoryId= strip_tags($subcategoryId);
				    
					
					//Validation - if required
					if ($subcategoryId==="") {
						$errors["subcategoryId"][] = "Please choose subcategory!!!";
					}
					//ovde ispitujemo da li niz koji stize iz posta postoji u nizu
					if (!array_key_exists($subcategoryId, $subid)) {
						$errors["subcategoryId"][] = "Wrong subcategory!!!";
					}
			
		         } else {
			            $errors["subcategoryId"][] = "Field subcategory must be sent!!!";
	             }
	             
			     if (count($errors)==0) {
				        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				                if (empty($_FILES["image"]["error"])) {
				                    $destinationPath = __DIR__ . "/../partials/images/products/" . $imageFileName;		
				                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
				                    $formErrors["image"][] = "Something is wrong with image move_uploaded_file";
				                }else{
				                    $image =$imageFileName;
				                }
				            }
				        }else{
				        	$image =$productImage;
				        }
				        
				        if (count($errors)==0) {
				        	// save product
				        	$dao=new DAO();
				        	$dao->updateProduct($name, $price, $discountPrice, $discount, $image, $description, $type, $subcategoryId, $idProduct);
				            $products=$dao->ProductsList();
				        	$msgSuccess="Product updated successfully";
				        	include 'admin/products/productsList.php';
				        }
		          }else{
			        	$msgError="Must fill out all required input fields";
			        	include 'admin/products/editProduct.php';
		          }
		     
	           }

		}else{
			include 'admin/login.php';
		}

	 }
	 
	 public function showDeleteProduct(){
	 	session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$idProduct=isset($_GET['productId'])?$_GET['productId']:"";
			$dao=new DAO();
			$oneProduct=$dao->getProducDetailById($idProduct);
			include 'admin/products/deleteProduct.php';
		}else{
			$dao= new DAO();
			$products=$dao->ProductsList();
			$msgError="Must have *ADMIN* priviledges for this action";
	        include 'admin/products/productsList.php';
		}
	 }
	 
	 public function deleteProduct(){
	    session_start();
		$login=unserialize($_SESSION['loggedInAdmin']);
		
		$delete=isset($_POST['Delete product'])?$_POST['Delete product']:"";
		//var_dump($delete);
		$idProduct=isset($_POST['productId'])?$_POST['productId']:"";
        //var_dump($idProduct);
	    if (isset($delete)&&isset($idProduct)){
			$dao=new DAO();
			$one=$dao->getProducDetailById($idProduct);
			$dao->deleteProduct($idProduct);
			$products=$dao->ProductsList();
			$msgSuccess=$one['name']." deleted successfully";
			include 'admin/products/productsList.php';
		}
	 }

     public function cancelDltProduct(){
     	session_start();
		$login=unserialize($_SESSION['loggedInAdmin']);
		
		$cancel=isset($_POST['Cancel deleting product'])?$_POST['Cancel deleting product']:"";
		$productId=isset($_POST['productId'])?$_POST['productId']:"";
		if (isset($cancel)&&isset($productId)){
			$dao=new DAO();
			$products=$dao->ProductsList();
			include 'admin/products/productsList.php';
		}
	}
	
	public function ordersList(){
		session_start();
	    if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			
			$dao=new DAO();
			
		    /** PAGINATION FIX FOR INDEX PAGE **/
			if(isset($_GET['currentPage'])){
			    $page = $_GET['currentPage'];
			    //var_dump($page);
			    // cast u integer
			    $page = (int) $page;
			    
			    if(!is_numeric($page)){
			        $page = 1;
			    }
			}else{
			    // default 
			    $page = 1;
			}
			//var_dump($page);
			$numberOfPages=3;
			$totalNumberOfRows=$dao->countOrders();
			//var_dump($totalNumberOfRows);
			$totalNumberOfPages= ceil( $totalNumberOfRows / $numberOfPages );
			//var_dump($totalNumberOfPagesFix);
			if($totalNumberOfPages < $page || $page <= 0){
			    $page = 1;
			}
			
			$orders=$dao->ordersList($numberOfPages, $page);
			$ordersDate=$dao->orderDate();
			include 'admin/orders/ordersList.php';
		}else{
			include 'admin/login.php';
		}
		
	}
	
	public function updateOrder(){
		if(!isset($_SESSION)){
			session_start();
		}
	    if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		$orderId=isset($_GET['orderId'])?$_GET['orderId']:"";
		$numberOfPages=isset($_GET['numberOfPages'])?$_GET['numberOfPages']:"";
		$numberOfPages=(int)$numberOfPages;
		$page=isset($_GET['currentPage'])?$_GET['currentPage']:"";
		$page=(int)$page;
		$totalNumberOfRows=isset($_GET['totalRows'])?$_GET['totalRows']:"";
		$totalNumberOfPages=isset($_GET['totalPages'])?$_GET['totalPages']:"";
		
		$status="delivered";
		//var_dump($orderId);
		$dao=new DAO();
		$dao->updateOrder($status, $orderId);
		$orders=$dao->ordersList($numberOfPages, $page);
		$ordersDate=$dao->orderDate();
		include 'admin/orders/ordersList.php';
	}
	
	public function deleteOrder(){
		if(!isset($_SESSION)){
			session_start();
		}
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$orderId=isset($_GET['orderId'])?$_GET['orderId']:"";
			$numberOfPages=isset($_GET['numberOfPages'])?$_GET['numberOfPages']:"";
			$numberOfPages=(int)$numberOfPages;
			$page=isset($_GET['currentPage'])?$_GET['currentPage']:"";
			$page=(int)$page;
			$totalNumberOfRows=isset($_GET['totalRows'])?$_GET['totalRows']:"";
			$totalNumberOfPages=isset($_GET['totalPages'])?$_GET['totalPages']:"";
		
			$dao= new DAO();
			$dao->deleteOrder($orderId);
			$dao->deleteOrderItems($orderId);
			$orders=$dao->ordersList($numberOfPages, $page);
			$ordersDate=$dao->orderDate();
			$msgSuccess="Order successfully deleted";
			
	        include 'admin/orders/ordersList.php';
		}else{
			$orderId=isset($_GET['orderId'])?$_GET['orderId']:"";
			$numberOfPages=isset($_GET['numberOfPages'])?$_GET['numberOfPages']:"";
			$page=isset($_GET['currentPage'])?$_GET['currentPage']:"";
			$totalNumberOfRows=isset($_GET['totalRows'])?$_GET['totalRows']:"";
			$totalNumberOfPages=isset($_GET['totalPages'])?$_GET['totalPages']:"";
			
			$dao= new DAO();
			$orders=$dao->ordersList($numberOfPages, $page);
			$msgError="Must have *ADMIN* priviledges for this action";
			
	        include 'admin/orders/ordersList.php';
		}
		
	}
	
	public function reviewsList(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao=new DAO();
		    $reviewsList=$dao->reviewsList();
		    include 'admin/reviews/reviewsList.php';
		}else{
			include 'admin/login.php';
		}
		
	}
	
	public function approveReview(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$reviewId=isset($_GET['reviewId'])?$_GET['reviewId']:"";
			//var_dump($reviewId);
			$ProductId=isset($_GET['productId'])?$_GET['productId']:"";
			//var_dump($ProductId);
			$status="approved";
			
			$dao=new DAO();
			$dao->updateReview($status, $ProductId, $reviewId);
			$reviewsList=$dao->reviewsList();
			$msgSuccess="Review approved successfuly";
			
			include 'admin/reviews/reviewsList.php';
		}else{
			$dao=new DAO();
			$reviewsList=$dao->reviewsList();
			$msgError="Must have *ADMIN* priviledges for this action";
			include 'admin/reviews/reviewsList.php';
		}
	}
	
	public function deleteReview(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$reviewId=isset($_GET['reviewId'])?$_GET['reviewId']:"";
			//var_dump($reviewId);
			$dao=new DAO();
			$dao->deleteReview($reviewId);
			$reviewsList=$dao->reviewsList();
			$msgSuccess="Review deleted successfuly";
			
			include 'admin/reviews/reviewsList.php';
		}else{
			$dao=new DAO();
			$reviewsList=$dao->reviewsList();
			$msgError="Must have *ADMIN* priviledges for this action";
			include 'admin/reviews/reviewsList.php';
		}
	}
	
	public function showInsertBlog(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			include 'admin/blog/insertBlog.php';
		}else{
			include 'admin/login.php';
		}
	}
	
	public function insertBlog(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$name=isset($_POST['name'])?$_POST['name']:"";
			//var_dump($name);
			$title=isset($_POST['title'])?$_POST['title']:"";
			//var_dump($title);
			$time=date("h:i:sa");
			//var_dump($time);
			$date=date("Y-m-d");
			//var_dump($date);
			$blogContent=isset($_POST['text'])?$_POST['text']:"";
			//var_dump($blogContent);
			
			$errors=array();
			
		    /*********** filtriranje i validacija polja ****************/
	        // name
		    if (isset($name)) {
				//Filtering 1
				$name= trim($name);
		        $name= strip_tags($name);
		
				//Validation - if required
				if ($name=== "") {
					 $errors['name'][]= "Field name is required!!!";
				}else{
		            if(mb_strlen($name)>100){
		                $errors['name'][]= "Field name can not have more then 100 characters!!!";
		            }
		        }
		
	        } else {
	             //if required
		     $errors['name'][] = "Field name must be sent!!!";
	        }
			
		    /*********** filtriranje i validacija polja ****************/
	        // title
		    if (isset($title)) {
				//Filtering 1
				$title= trim($title);
		        $title= strip_tags($title);
		
				//Validation - if required
				if ($title=== "") {
					 $errors['title'][]= "Field name is required!!!";
				}else{
		            if(mb_strlen($name)>100){
		                $errors['title'][]= "Field title can not have more then 100 characters!!!";
		            }
		        }
		
	         } else {
		       $errors['title'][] = "Field title must be sent!!!";
	         }
	        
		     /*********** filtriranje i validacija polja ****************/
	         // text
	         if (isset($blogContent)) {
	         	if ($blogContent=== "") {
					 $errors['text'][]= "Field text is required!!!";
	         	}
			 //Filtering 1
				$blogContent= trim($blogContent);
		        $blogContent= strip_tags($blogContent, "<br><br/><p></p><strong></strong><i></i><em></em>");
		        
		     }
		     
		     /*********** filtriranje i validacija polja ****************/
	         // image
	         if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {    
				if (empty($_FILES["image"]["error"])) {
					//filtering
					$imageFileTmpPath = $_FILES["image"]["tmp_name"];
					$imageFileName = basename($_FILES["image"]["name"]);
					$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
					$imageFileSize = $_FILES["image"]["size"];
					
					//validation
					$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
					$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
					
					if (!in_array($imageFileMime, $imageFileAllowedMime)) {
						$errors["image"][] = "Image can only have .png, .gif or .jpeg extension!!!";
					}
					
					if ($imageFileSize > $imageFileMaxSize) {
						$errors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
					}
					
				} else {
					$errors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
				}
		     }
		     
		     if (count($errors)==0) {
				        $image = NULL;
				        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				                if (empty($_FILES["image"]["error"])) {
				                    $destinationPath = __DIR__ . "/../partials/images/blog/" . $imageFileName;		
				                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
				                    $formErrors["image"][] = "Something is wrong with image move_uploaded_file";
				                }else{
				                    $image =$imageFileName;
				                }
				            }
				        }
				        
				        if (count($errors)==0) {
				        	$dao=new DAO();
			        		//INSERT Blog
			        		$dao->insertBlog($name, $title, $time, $date, $blogContent, $image);
			        		$blogsList=$dao->blogListAdmin();
			        	    $msgSuccess="Blog successfully inserted";
			        	    include 'admin/blog/blogsList.php';
				        	
			             }
			 }else{
	        	$msgError="Must fill out all required input fields";
	        	include 'admin/blog/insertBlog.php';
			 } 
		}else{
			include 'admin/login.php';
		}
		
	} 
	
	public function showBlogsList(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$dao= new DAO();
			$blogsList=$dao->blogListAdmin();
			include 'admin/blog/blogsList.php';
		}else{
			include 'admin/login.php';
		}
	}
	
	public function showUpdateBlog(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
			$blogId=isset($_GET['blogId'])?$_GET['blogId']:"";
			$dao= new DAO();
			$oneBlog=$dao->blogById($blogId);
			include 'admin/blog/editBlog.php';
		}else{
			include 'admin/login.php';
		}
	}
	
	public function editBlog(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)){
		    $name=isset($_POST['name'])?$_POST['name']:"";
			//var_dump($name);
			$title=isset($_POST['title'])?$_POST['title']:"";
			//var_dump($title);
			$time=date("h:i:sa");
			//var_dump($time);
			$date=date("Y-m-d");
			//var_dump($date);
			$blogContent=isset($_POST['text'])?$_POST['text']:"";
			//var_dump($blogContent);
			$blogImage=isset($_POST['blogImage'])?$_POST['blogImage']:"";
			//var_dump($blogImage);
			$blogId=isset($_POST['blogId'])?$_POST['blogId']:"";
			//var_dump($blogId);
			
			$errors=array();
			
		    /*********** filtriranje i validacija polja ****************/
	        // name
		    if (isset($name)) {
				//Filtering 1
				$name= trim($name);
		        $name= strip_tags($name);
		
				//Validation - if required
				if ($name=== "") {
					 $errors['name'][]= "Field name is required!!!";
				}else{
		            if(mb_strlen($name)>100){
		                $errors['name'][]= "Field name can not have more then 100 characters!!!";
		            }
		        }
		
	        } else {
	             //if required
		     $errors['name'][] = "Field name must be sent!!!";
	        }
			
		    /*********** filtriranje i validacija polja ****************/
	        // title
		    if (isset($title)) {
				//Filtering 1
				$title= trim($title);
		        $title= strip_tags($title);
		
				//Validation - if required
				if ($title=== "") {
					 $errors['title'][]= "Field name is required!!!";
				}else{
		            if(mb_strlen($name)>100){
		                $errors['title'][]= "Field title can not have more then 100 characters!!!";
		            }
		        }
		
	         } else {
		       $errors['title'][] = "Field title must be sent!!!";
	         }
	        
		     /*********** filtriranje i validacija polja ****************/
	         // text
	         if (isset($blogContent)) {
	         	if ($blogContent=== "") {
					 $errors['text'][]= "Field text is required!!!";
	         	}
			 //Filtering 1
				$blogContent= trim($blogContent);
		        $blogContent= strip_tags($blogContent, "<br><br/><p></p><strong></strong><i></i><em></em>");
		        
		     }
		     
		     /*********** filtriranje i validacija polja ****************/
	         // image
	         if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				if (empty($_FILES["image"]["error"])) {
					//filtering
					$imageFileTmpPath = $_FILES["image"]["tmp_name"];
					$imageFileName = basename($_FILES["image"]["name"]);
					$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
					$imageFileSize = $_FILES["image"]["size"];
					
					//validation
					$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
					$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
					
					if (!in_array($imageFileMime, $imageFileAllowedMime)) {
						$errors["image"][] = "Image can only have .png, .gif or .jpeg extension!!!";
					}
					
					if ($imageFileSize > $imageFileMaxSize) {
						$errors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
					}
					
				} else {
					$errors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
				}
		     }
		     
		     if (count($errors)==0) {
				        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				                if (empty($_FILES["image"]["error"])) {
				                    $destinationPath = __DIR__ . "/../partials/images/blog/" . $imageFileName;		
				                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
				                    $formErrors["image"][] = "Something is wrong with image move_uploaded_file";
				                }else{
				                    $image =$imageFileName;
				                }
				            }
				        }else{
				        	$image =$blogImage;
				        }
				        
				        if (count($errors)==0) {
				        	$dao=new DAO();
			        		//Edit Blog
			        		$dao->updateBlog($name, $title, $time, $date, $blogContent, $image, $blogId);
			        		$oneBlog=$dao->blogById($blogId);
			        		$blogsList=$dao->blogListAdmin();
			        	    $msgSuccess=$oneBlog['title']." successfully edited";
			        	    include 'admin/blog/blogsList.php';
				        	
			             }
			 }else{
	        	$msgError="Must fill out all required input fields";
	        	include 'admin/blog/editBlog.php';
			 }
			
			
			
		}else{
			include 'admin/login.php';
		}
	}
	
	public function deleteBlog(){
		session_start();
		if (!empty($_SESSION['loggedInAdmin'])){
			$login=unserialize($_SESSION['loggedInAdmin']);
		}
		if (!empty($login)&& $login['role']=="Admin"){
			$blogId=isset($_GET['blogId'])?$_GET['blogId']:"";
			//var_dump($blogId);
			$dao=new DAO();
			$dao->deleteBlog($blogId);
			$blogsList=$dao->blogListAdmin();
			$msgSuccess="Blog successfully deleted";
			include 'admin/blog/blogsList.php';
		}else{
			$dao=new DAO();
			$blogsList=$dao->blogListAdmin();
			$msgError="Must have *ADMIN* priviledges for this action";
			include 'admin/blog/blogsList.php';
		}
	}
	
    public function Go(){
	        session_start();
		    if (!empty($_SESSION['loggedInAdmin'])){
				$login=unserialize($_SESSION['loggedInAdmin']);
			}
			$date=isset($_POST['date'])?$_POST['date']:"";
			
			$dao=new DAO();
			
		    /** PAGINATION FIX FOR INDEX PAGE **/
			if(isset($_GET['currentPage'])){
			    $page = $_GET['currentPage'];
			    //var_dump($page);
			    // cast u integer
			    $page = (int) $page;
			    
			    if(!is_numeric($page)){
			        $page = 1;
			    }
			}else{
			    // default 
			    $page = 1;
			}
			//var_dump($page);
			$numberOfPages=2;
			$totalNumberOfRows=$dao->countOrdersByDate($date);
			//var_dump($totalNumberOfRows);
			$totalNumberOfPages= ceil( $totalNumberOfRows / $numberOfPages );
			//var_dump($totalNumberOfPages);
			if($totalNumberOfPages < $page || $page <= 0){
			    $page = 1;
			}
		   $ordersByDate=$dao->ordersByDate($date, $numberOfPages, $page);
		   include 'admin/orders/ordersbydate.php';
		   
   }
   
   public function ordersByDate(){
   	    session_start();
		    if (!empty($_SESSION['loggedInAdmin'])){
				$login=unserialize($_SESSION['loggedInAdmin']);
			}
			$date=isset($_GET['date'])?$_GET['date']:"";
			//var_dump($date);
			
			$dao=new DAO();
			
		    /** PAGINATION FIX FOR INDEX PAGE **/
			if(isset($_GET['currentPage'])){
			    $page = $_GET['currentPage'];
			    //var_dump($page);
			    // cast u integer
			    $page = (int) $page;
			    
			    if(!is_numeric($page)){
			        $page = 1;
			    }
			}else{
			    // default 
			    $page = 1;
			}
			//var_dump($page);
			$numberOfPages=2;
			$totalNumberOfRows=$dao->countOrdersByDate($date);
			//var_dump($totalNumberOfRows);
			$totalNumberOfPages= ceil( $totalNumberOfRows / $numberOfPages );
			//var_dump($totalNumberOfPages);
			if($totalNumberOfPages < $page || $page <= 0){
			    $page = 1;
			}
		   $ordersByDate=$dao->ordersByDate($date, $numberOfPages, $page);
		   include 'admin/orders/ordersbydate.php';
   }
   
}
		
	
	
	

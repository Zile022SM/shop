<?php
require_once '../config/db.php';

class DAO{
	
	private $db;
	
	private $REGISTER="INSERT INTO `user` (`name`, `last_name`, `address`, `email`,`password`, `phone`) VALUES (?,?,?,?,?,?)";
	
	private $CHECK_USER="SELECT * FROM user WHERE email=:email OR password=:password";
	
	private $GET_USER="SELECT * FROM user WHERE email=? AND password=?";
	
	private $USER="SELECT * FROM `user` WHERE userId=?";
	
	private $NEW_PRODUCTS="SELECT * FROM `product` ORDER BY id_product DESC LIMIT 6";
	
	private $PRODUCT_TYPE="SELECT DISTINCT type FROM product";
	
	private $GET_PRODUCTS_BY_TYPE="SELECT * FROM `product` WHERE type=:tip ORDER BY id_product DESC LIMIT :postrani OFFSET :strana";
	
	private $PRODUCTS_BY_TYPE_FIX="SELECT * FROM `product` WHERE type='shoes' ORDER BY id_product DESC LIMIT :number_of_rows_per_page OFFSET :offset";
	
	private $GET_CATEGORIES="SELECT categories.cat_name,subcategories.sub_id,subcategories.sub_name,COUNT(subcategories.sub_name)as total FROM `subcategories` JOIN categories ON categories.id=subcategories.category_id JOIN product ON product.sub_cat_id=subcategories.sub_id  GROUP BY subcategories.sub_id, subcategories.sub_name";
	
	private $GET_RANDOM_PRODUCTS="SELECT * FROM product ORDER BY RAND() LIMIT 3";
	
	private $GET_ONE_PRODUCT_DETAIL_BY_ID="SELECT categories.cat_name,subcategories.sub_name,product.* FROM product  
	                                       JOIN subcategories ON product.sub_cat_id=subcategories.sub_id
                                           JOIN categories ON subcategories.category_id=categories.id
                                           WHERE id_product=?";
	
	private $GET_PRODUCT_BY_SUB_ID="SELECT * FROM product WHERE sub_cat_id=:subId ORDER BY id_product DESC LIMIT :number_of_products_per_page_by_subcat OFFSET :ofset";
	
	private $GET_PRODUCT_BY_SUB_ID_FIX="SELECT * FROM `product` WHERE sub_cat_id=1 ORDER BY id_product DESC LIMIT :number_of_products_per_page_by_subcat OFFSET :offset";
	
	private $GET_SUB_CAT_NAME="SELECT sub_name FROM subcategories WHERE sub_id=?";
	
	private $GET_COUNT_PRODUCTS_BY_TYPE="SELECT COUNT(*) as total FROM product WHERE type=?";
	
	private $GET_COUNT_PRODUCTS_BY_SUB_ID_FIX="SELECT COUNT(name) as total FROM product WHERE sub_cat_id=1";
	
	private $GET_COUNT_PRODUCTS_BY_SUB_ID="SELECT COUNT(name) as total FROM product WHERE sub_cat_id=?";
	
	private $GET_PRODUCTS_ON_SALE="SELECT * FROM `product` WHERE discount_price IS NOT NULL AND discount_price>0 ORDER BY RAND()";
	
	private $GET_ONE_PRODUCT_FOR_CART="SELECT * FROM product WHERE id_product=?";
	
	private $GET_SUBCAT_ID_FIX="SELECT sub_id FROM `subcategories` WHERE sub_name='nike'";
	
	private $INSERT_ORDER_ITEMS="INSERT INTO `orderitems` (`orderItemId`, `orderItems`) VALUES (?,?);";
	
	private $INSERT_ORDER="INSERT INTO `orders` (`user_id`, `name`, `last_name`, `address`, `email`, `phone`,`time`) VALUES (?,?,?,?,?,?,?);";
	
	private $UPDATE_ORDER="UPDATE orders SET orderStatus=? WHERE orderId=?";
	
	private $GET_LAST_ORDER="SELECT * FROM `orders` WHERE orderId=?";
	
	private $COUNT_ORDERS="SELECT COUNT(*) as total FROM orders";
	
	private $COUNT_NEW_ORDERS="SELECT COUNT(*) as total FROM `orders` WHERE orderStatus='pending'";
	
	private $COUNT_ORDERS_BY_DATE="SELECT COUNT(*) as total FROM `orders` WHERE time=?";
	
	private $INSERT_REVIEW="INSERT INTO `reviews` (`user_name`, `email`, `comment`, `time`, `date`, `product_id`) VALUES (?,?,?,?,?,?);";
	
	private $SELECT_REVIEWS_BY_ID_PRODUCT="SELECT * FROM `reviews` WHERE product_id=?";
	
	private $BLOG_LIST="SELECT * FROM blog ORDER BY id DESC LIMIT :number_of_blogs_per_page OFFSET :offset";
	
	private $BLOG_DETAIL="SELECT * FROM `blog` WHERE id=?";
	
	private $COUNT_BLOG="SELECT COUNT(*) as total FROM blog";
	
	
			
/*********************************************** ADMIN MODEL **************************************************/
/*********************************************** ADMIN MODEL **************************************************/
	
	
	
	private $GET_ADMIN_USER_FOR_LOGIN="SELECT * FROM admin WHERE email=? AND password=?";
	
	private $INSERT_ADMIN_USER="INSERT INTO `admin` (`name`, `last_name`, `email`,`password`,`role`) VALUES (?,?,?,?,?)";
	
	private $CHECK_ADMIN_USER="SELECT * FROM admin WHERE email=?";
	
	private $ADMIN_USERS_LIST="SELECT * FROM admin";
	
	private $ADMIN_USER="SELECT * FROM `admin` WHERE admin_id=?";
	
	private $UPDATE_ADMIN_USER="UPDATE admin SET name=?,last_name=?,email=?,password=?,role=? WHERE admin_id=?";
	
	private $DELETE_ADMIN_USER="DELETE FROM admin WHERE admin_id=?";
	
	private $INSERT_CATEGORY="INSERT INTO `categories` (`id`, `cat_name`) VALUES (NULL,?);";
	
	private $GET_CATEGORIES_LIST="SELECT * FROM `categories`";
	
	private $GET_CATEGORY_BY_ID="SELECT * FROM `categories` WHERE id=?";
	
	private $UPADTE_CATEGORY="UPDATE categories SET cat_name=? WHERE id=?";
	
	private $TEST_IF_CATEGORY_IS_EMPTY="SELECT * FROM subcategories WHERE subcategories.category_id=?";
	
	private $DELETE_CATEGORY="DELETE FROM categories WHERE categories.id=?";
	
	private $INSERT_SUBCATEGORY="INSERT INTO `subcategories` (`sub_id`, `sub_name`, `category_id`) VALUES (NULL,?,?);";
	
	private $SUBCATEGORIES_LIST="SELECT categories.id, categories.cat_name,subcategories.* FROM subcategories JOIN categories ON categories.id=subcategories.category_id";
	
	private $SUBCATEGORY_BY_ID="SELECT * FROM `subcategories` WHERE sub_id=?";
	
	private $EDIT_SUBCATEGORY="UPDATE `subcategories` SET `sub_name` =?, `category_id` =? WHERE `subcategories`.`sub_id` =?";
	
	private $TEST_IF_SUB_CAT_IS_EMPTY="SELECT * FROM `product` WHERE sub_cat_id=?";
	
	private $DELETE_SUBCATEGORY="DELETE FROM subcategories WHERE subcategories.sub_id=?";
	
	private $SELECT_SUBCATEGORY_FOR_INSERT_PRODUCT="SELECT categories.cat_name,subcategories.* FROM `subcategories` JOIN categories ON categories.id=subcategories.category_id";
	
	private $INSERT_PRODUCT="INSERT INTO `product` (`name`, `price`, `discount_price`, `discount`, `img`, `description`,`type`, `sub_cat_id`) VALUES (?,?,?,?,?,?,?,?);";
	
	private $SELECT_PRODUCTS_FOR_ADMIN_PANEL="SELECT * FROM `product` ORDER BY id_product DESC";
	
	private $UPDATE_PRODUCT="UPDATE `product` SET `name` =?, `price` =?, `discount_price` =?, `discount` =?, `img` =?, `description` =?, `type` =?, `sub_cat_id` =? WHERE `product`.`id_product` =?;";
	
	private $LAST_INSERTED_PRODUCT="SELECT * FROM `product` WHERE name=? AND price=? AND img=? AND type=? AND sub_cat_id=?";
	
	private $DELETE_PRODUCT="DELETE FROM product WHERE id_product=?";
	
	private $SELECT_ORDERS="SELECT orders.*, orderitems.*  FROM orderitems JOIN orders ON orders.orderId=orderitems.orderItemId ORDER BY orderItemId DESC LIMIT :number_of_products_per_page OFFSET :offset";
	
	private $SELECT_ORDERS_BY_DATE="SELECT orders.*,orderitems.* FROM orderitems JOIN orders ON orders.orderId=orderitems.orderItemId WHERE time=:time  ORDER BY orderItemId DESC LIMIT :number_of_products_per_page OFFSET :offset";
	
	private $DELETE_ORDER="DELETE FROM orders WHERE orderId=?;";
	
	private $DELETE_ORDER_ITEMS="DELETE FROM orderitems WHERE orderItemId=?;";
	
	private $ORDER_DATE="SELECT DISTINCT DATE_FORMAT(time, '%Y-%c-%e') as date FROM orders";
	
	private $REVIEWS_LIST="SELECT reviews.*,product.name,product.img,product.id_product FROM reviews JOIN product ON reviews.product_id=product.id_product";
	
	private $APPROVE_REVIEW="UPDATE reviews SET status=? WHERE product_id=? AND review_id=?";
	
	private $DELETE_REVIEW="DELETE FROM reviews WHERE review_id=?";
		
	private $INSERT_BLOG="INSERT INTO `blog` (`user_name`, `title`,`time`,`date`,`blog_text`,`image`) VALUES (?,?,?,?,?,?);";
	
	private $BLOG_LIST_ADMIN="SELECT * FROM blog ORDER BY id DESC;";
	
	private $BLOG_BY_ID="SELECT * FROM `blog` WHERE id=?";
	
	private $UPDATE_BLOG="UPDATE `blog` SET `user_name` = ?, `title` = ?, `time` = ?, `date` = ?, `blog_text` = ?,image=? WHERE `blog`.`id` = ?;";
	
	private $DELETE_BLOG="DELETE FROM blog WHERE id=?";
	
	public function __construct(){
		
		$this->db =DB::createInstance();
		
	}
	
	
	public function register($name,$lastName,$address,$email,$password,$phone){
	        $statement =$this->db->prepare($this->REGISTER);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $lastName);
		    $statement->bindValue(3, $address);
			$statement->bindValue(4, $email);
			$statement->bindValue(5, $password);
			$statement->bindValue(6, $phone);
			
			$statement->execute();
		     
	}
		
	public function getUser($email,$password){
			$statement =$this->db->prepare($this->GET_USER);
			$statement->bindValue(1, $email); 
			$statement->bindValue(2, $password);
			$statement->execute();
			
			$result=$statement->fetch();
			return $result;
			
	}
	
	public function User($userId){
			$statement =$this->db->prepare($this->USER);
			$statement->bindValue(1, $userId); 
			$statement->execute();
			
			$result=$statement->fetch();
			return $result;
				
	}
	
	public function checkUser($username,$password){
	    	$statement =$this->db->prepare($this->CHECK_USER);
	    	$params = array(
	            ':email' => $username,
	    		':password'=>$password
	         );
			$statement->execute($params);
			 if($statement->rowCount()){
	    			$msgRegister="username ili password su vec uneti";
	    		return TRUE;
	         }else{
	         	return FALSE;
	         }
	}
	    
	public function UpdateUser($username,$last_name,$address,$email,$phone,$userId){
	        $statement =$this->db->prepare($this->UPDATE_USER);
		    $statement->bindValue(1, $username);
		    $statement->bindValue(2, $last_name);
		    $statement->bindValue(3, $address);
		    $statement->bindValue(4, $email);
			$statement->bindValue(5, $phone);
			$statement->bindValue(6, $userId);
			
			$statement->execute();
		     
	}
	    
	public function getCountProductsBySubIdFix(){
			$statement =$this->db->prepare($this->GET_COUNT_PRODUCTS_BY_SUB_ID_FIX);
			$statement->execute();
			$result=$statement->fetch();
		
			return $result['total'];
       	
	}
	
	public function getSubIdFix(){
	   	    $statement =$this->db->prepare($this->GET_SUBCAT_ID_FIX);
			$statement->execute();
			$result=$statement->fetch();
			return $result['sub_id'];
			
	}
	
	public function getCountProductsBySubId($subId){
			$statement =$this->db->prepare($this->GET_COUNT_PRODUCTS_BY_SUB_ID);
	        $statement->bindValue(1, $subId);
			$statement->execute();
			$result=$statement->fetch();
		
			return $result['total'];
	       	
		}
	
	public function countProductsByType($typeOfProducts){
			$statement =$this->db->prepare($this->GET_COUNT_PRODUCTS_BY_TYPE);
			$statement->bindValue(1, $typeOfProducts);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result['total'];
	}
	
	public function subCatName($subId){
			$statement =$this->db->prepare($this->GET_SUB_CAT_NAME);
			$statement->bindValue(1, $subId);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
	}
	
	
	public function getProductBySubId($subId,$numberOfPagesByType,$pageByType){
			$statement =$this->db->prepare($this->GET_PRODUCT_BY_SUB_ID);
			$statement->bindValue(':subId', $subId);
			$statement->bindParam(':number_of_products_per_page_by_subcat', $numberOfPagesByType,PDO::PARAM_INT);
			$statement->bindValue(':ofset', ($pageByType-1)  * $numberOfPagesByType,PDO::PARAM_INT);
			$statement->execute();
			$result=$statement->fetchAll();
			
			return $result;
		
		
	}
	
	public function getProductBySubIdFix($numberOfPagesForProductPage,$page){
			$statement =$this->db->prepare($this->GET_PRODUCT_BY_SUB_ID_FIX);
			$statement->bindParam(':number_of_products_per_page_by_subcat',$numberOfPagesForProductPage,PDO::PARAM_INT);
		    $statement->bindValue(':offset',($page - 1) * $numberOfPagesForProductPage,PDO::PARAM_INT);
			$statement->execute();
			$result=$statement->fetchAll();
			
			return $result;
			
			
	}
	
	public function getProductForCart($idItem){
			$statement =$this->db->prepare($this->GET_ONE_PRODUCT_FOR_CART);
			$statement->bindValue(1, $idItem);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
			
	}
	
    public function getProducDetailById($idProduct){
			$statement =$this->db->prepare($this->GET_ONE_PRODUCT_DETAIL_BY_ID);
			$statement->bindValue(1, $idProduct);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
		
	}
	
    public function getProductsOnSale(){
			$statement =$this->db->prepare($this->GET_PRODUCTS_ON_SALE);
			$statement->execute();
			$result=$statement->fetchAll();
	
		    return $result;
       	
	}
	
	
    public function getProductsByType($type,$numberOfPagesByType,$pageByType){
			 $statement=$this->db->prepare($this->GET_PRODUCTS_BY_TYPE);
			 $statement->bindParam(':tip',$type);
			 $statement->bindParam(':postrani',$numberOfPagesByType,PDO::PARAM_INT);
			 $statement->bindValue(':strana',($pageByType - 1) * $numberOfPagesByType,PDO::PARAM_INT);
			 $statement->execute();
			 $result=$statement->fetchAll();
		
			 return $result;
		 
	} 

    public function getProductsByTypeFix($numberOfPages,$page){
			 $statement=$this->db->prepare($this->PRODUCTS_BY_TYPE_FIX);
			 $statement->bindParam(':number_of_rows_per_page',$numberOfPages,PDO::PARAM_INT);
			 $statement->bindValue(':offset',($page - 1) * $numberOfPages,PDO::PARAM_INT);
			 $statement->execute();
			 $result=$statement->fetchAll();
		
			 return $result;
		 
	}
	
    public function getProductType(){
			 $statement =$this->db->prepare($this->PRODUCT_TYPE);
			 $statement->execute();
			 $result=$statement->fetchAll();
		
			 return $result;
       	
	}
	
    public function getNewProducts(){
			$statement =$this->db->prepare($this->NEW_PRODUCTS);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
       	
	}
	
	public function getCategories(){
			$statement =$this->db->prepare($this->GET_CATEGORIES);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
       	
	} 
	
	public function insertOrder($userId,$postUsername,$postLastname,$postAddress,$postEmail,$postPhone,$time){
			$statement =$this->db->prepare($this->INSERT_ORDER);
			$statement->bindValue(1,$userId);
			$statement->bindValue(2,$postUsername);
			$statement->bindValue(3,$postLastname);
			$statement->bindValue(4,$postAddress);
			$statement->bindValue(5,$postEmail);
			$statement->bindValue(6,$postPhone);
			$statement->bindValue(7,$time);
			
		    $statement->execute();
		    $result=$this->db->lastInsertId();
		    
		    return $result;
	}
	
	
	
	public function InsertOrderItems($orderId,$orderItems){
	        $statement =$this->db->prepare($this->INSERT_ORDER_ITEMS);
	        $statement->bindValue(1,$orderId);
			$statement->bindValue(2, $orderItems);
			
			$statement->execute();
	}
	
	public function getLastOrder($orderId){
			$statement =$this->db->prepare($this->GET_LAST_ORDER);
			$statement->bindValue(1, $orderId);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
	}
	
	public function countOrders(){
			$statement =$this->db->prepare($this->COUNT_ORDERS);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result['total'];
	}
	
    public function countNewOrders(){
			$statement =$this->db->prepare($this->COUNT_NEW_ORDERS);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result['total'];
	}
	
    public function countOrdersByDate($date){
			$statement =$this->db->prepare($this->COUNT_ORDERS_BY_DATE);
			$statement->bindValue(1, $date);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result['total'];
	}
	
    public function insertReview($name,$email,$text,$time,$date,$idProduct){
	        $statement =$this->db->prepare($this->INSERT_REVIEW);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $email);
		    $statement->bindValue(3, $text);
			$statement->bindValue(4, $time);
			$statement->bindValue(5, $date);
			$statement->bindValue(6, $idProduct);
			$statement->execute();
		
	}
	
    public function selectReviewsById($idProduct){
			$statement =$this->db->prepare($this->SELECT_REVIEWS_BY_ID_PRODUCT);
			$statement->bindValue(1, $idProduct); 
			$statement->execute();
			$result=$statement->fetchAll();
			
			return $result;
	}
	
    public function blogList($numberOfPages,$page){
			$statement =$this->db->prepare($this->BLOG_LIST);
			$statement->bindValue(':number_of_blogs_per_page', $numberOfPages,PDO::PARAM_INT);
			$statement->bindValue(':offset', ($page-1)*$numberOfPages,PDO::PARAM_INT);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
	
	public function blogDetail($blogId){
			$statement =$this->db->prepare($this->BLOG_DETAIL);
			$statement->bindValue(1, $blogId);
			$statement->execute();
			$result=$statement->fetch();
		
			return $result;
	} 
	
	public function countBlog(){
			$statement =$this->db->prepare($this->COUNT_BLOG);
			$statement->execute();
			$result=$statement->fetch();
			
			return $result['total'];
	}
	
	
/*********************************************** ADMIN MODEL **************************************************/
/*********************************************** ADMIN MODEL **************************************************/
	
    public function getAdminUserForLogin($email,$password){
			$statement =$this->db->prepare($this->GET_ADMIN_USER_FOR_LOGIN);
			$statement->bindValue(1, $email); 
			$statement->bindValue(2, $password);
		    $statement->execute();
			$result=$statement->fetch();
			
			return $result;
			
	}
	
    public function insertUser($name,$lastName,$email,$password,$role){
	        $statement =$this->db->prepare($this->INSERT_ADMIN_USER);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $lastName);
		    $statement->bindValue(3, $email);
			$statement->bindValue(4, $password);
			$statement->bindValue(5, $role);
			$statement->execute();
		     
	}
    
	public function Users(){
			$statement =$this->db->prepare($this->ADMIN_USERS_LIST);
			$statement->execute();
			$result=$statement->fetchAll();
			
			return $result;
		
	} 
	
	public function AdminUser($userId){
			$statement =$this->db->prepare($this->ADMIN_USER);
			$statement->bindValue(1, $userId); 
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
				
	}
	
    public function UpdateAdminUser($name,$lastName,$email,$password,$role,$userId){
	        $statement =$this->db->prepare($this->UPDATE_ADMIN_USER);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $lastName);
		    $statement->bindValue(3, $email);
		    $statement->bindValue(4, $password);
			$statement->bindValue(5, $role);
			$statement->bindValue(6, $userId);
			$statement->execute();
		     
	}
	
	public function checkAdminUser($email){
			    	
	    	$statement =$this->db->prepare($this->CHECK_ADMIN_USER);
		    $statement->bindValue(1, $email);
			$statement->execute();
			
	        $result=$statement->fetch();
	        
			if($result){
		       return TRUE;
		    }else{
		       return FALSE;
		    }
	}
	
	public function deleteAdminUser($userId){
			 $statement=$this->db->prepare($this->DELETE_ADMIN_USER);
			 $statement->bindValue(1,$userId);		 
			 $statement->execute();
	}
	
	public function insertCategory($categoryName){
		     $statement =$this->db->prepare($this->INSERT_CATEGORY);
			 $statement->bindValue(1, $categoryName);
			 $statement->execute();
	}
	
    public function getCategoriesList(){
			$statement =$this->db->prepare($this->GET_CATEGORIES_LIST);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
       	
	}
	
    public function categoryById($categoryId){
			$statement =$this->db->prepare($this->GET_CATEGORY_BY_ID);
			$statement->bindValue(1, $categoryId); 
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
				
	}
	
    public function updateCategory($categoryName,$categoryId){
	        $statement =$this->db->prepare($this->UPADTE_CATEGORY);
		    $statement->bindValue(1, $categoryName);
		    $statement->bindValue(2, $categoryId);
			$statement->execute();
		     
	}
	
	public function testIfEmptyCategory($categoryId){
	        $statement =$this->db->prepare($this->TEST_IF_CATEGORY_IS_EMPTY);
			$statement->bindValue(1, $categoryId);
			$statement->execute();
			$result=$statement->fetchAll();
			
			if (!empty($result)){
				return true;
			}else{
				return false;
			}
	}
	
    public function deleteCategory($categoryId){
			 $statement=$this->db->prepare($this->DELETE_CATEGORY);
			 $statement->bindValue(1,$categoryId);		 
			 $statement->execute();
	}
	
	public function insertSubcategory($subCatName,$catId){
	        $statement =$this->db->prepare($this->INSERT_SUBCATEGORY);
		    $statement->bindValue(1, $subCatName);
		    $statement->bindValue(2, $catId);
			$statement->execute();
		     
	}
	
    public function subactegoriesList(){
			$statement =$this->db->prepare($this->SUBCATEGORIES_LIST);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
       	
	}
	
    public function subcategoryById($subId){
			$statement =$this->db->prepare($this->SUBCATEGORY_BY_ID);
			$statement->bindValue(1, $subId); 
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
				
	}
	
    public function updateSubcategory($subCatName,$catId,$subId){
	        $statement =$this->db->prepare($this->EDIT_SUBCATEGORY);
		    $statement->bindValue(1, $subCatName);
		    $statement->bindValue(2, $catId);
		    $statement->bindValue(3, $subId);
			$statement->execute();
		     
	}
	
    public function testIfEmptySubCategory($subcatId){
	        $statement =$this->db->prepare($this->TEST_IF_SUB_CAT_IS_EMPTY);
			$statement->bindValue(1, $subcatId);
			$statement->execute();
			$result=$statement->fetchAll();
			
			if (!empty($result)){
				return true;
			}else{
				return false;
			}
	}
	
    public function deleteSubCategory($subcatId){
			$statement=$this->db->prepare($this->DELETE_SUBCATEGORY);
			$statement->bindValue(1,$subcatId);		 
			$statement->execute();
	}
	
    public function selectSubcategriesForInsert(){
			$statement =$this->db->prepare($this->SELECT_SUBCATEGORY_FOR_INSERT_PRODUCT);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
       	
	}
	
    public function insertProduct($name,$price,$discountPrice,$discount,$image,$description,$type,$subcategoryId){
	        $statement =$this->db->prepare($this->INSERT_PRODUCT);
	        $statement->bindValue(1,$name);
	        $statement->bindValue(2, $price);
			$statement->bindValue(3, $discountPrice);
			$statement->bindValue(4, $discount);
			$statement->bindValue(5, $image);
			$statement->bindValue(6, $description);
			$statement->bindValue(7, $type);
			$statement->bindValue(8, $subcategoryId);
			
			$statement->execute();
		    	
	}
	
	public function ProductsList(){
			$statement =$this->db->prepare($this->SELECT_PRODUCTS_FOR_ADMIN_PANEL);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
    
    public function updateProduct($name,$price,$discountPrice,$discount,$image,$description,$type,$subcategoryId,$idProduct){
	        $statement =$this->db->prepare($this->UPDATE_PRODUCT);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $price);
		    $statement->bindValue(3, $discountPrice);
		    $statement->bindValue(4, $discount);
		    $statement->bindValue(5, $image);
		    $statement->bindValue(6, $description);
		    $statement->bindValue(7, $type);
		    $statement->bindValue(8, $subcategoryId);
		    $statement->bindValue(9, $idProduct);
		    
			$statement->execute();
		     
	}
	
    public function lastInsertedProduct($name,$price,$image,$type,$subcategoryId){
			$statement =$this->db->prepare($this->LAST_INSERTED_PRODUCT);
			$statement->bindValue(1, $name);
			$statement->bindValue(2, $price);
			$statement->bindValue(3, $image);
			$statement->bindValue(4, $type);
			$statement->bindValue(5, $subcategoryId);
			$statement->execute();
			$result=$statement->fetch();
		    
			return $result;
	}
	
    public function deleteProduct($idProduct){
			$statement=$this->db->prepare($this->DELETE_PRODUCT);
			$statement->bindValue(1,$idProduct);		 
			$statement->execute();
	}
	
    public function ordersList($numberOfPages,$page){
			$statement =$this->db->prepare($this->SELECT_ORDERS);
			$statement->bindValue(':number_of_products_per_page', $numberOfPages,PDO::PARAM_INT);
			$statement->bindValue(':offset' ,($page - 1) * $numberOfPages,PDO::PARAM_INT);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
	
	public function ordersByDate($date,$numberOfPages,$page){
		    $statement =$this->db->prepare($this->SELECT_ORDERS_BY_DATE);
		    $statement->bindParam(':time',$date);
		    $statement->bindParam(':number_of_products_per_page',$numberOfPages,PDO::PARAM_INT);
			$statement->bindValue(':offset',($page - 1) * $numberOfPages,PDO::PARAM_INT);
		    $statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
	
    public function updateOrder($status,$orderId){
	        $statement =$this->db->prepare($this->UPDATE_ORDER);
		    $statement->bindValue(1, $status);
		    $statement->bindValue(2, $orderId);
			$statement->execute();
		     
	}
	
	public function orderDate(){
		    $statement =$this->db->prepare($this->ORDER_DATE);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
	
	public function deleteOrder($orderId){
			$statement=$this->db->prepare($this->DELETE_ORDER);
			$statement->bindValue(1,$orderId);		 
			$statement->execute();
	} 
	
    public function deleteOrderItems($orderId){
			$statement=$this->db->prepare($this->DELETE_ORDER_ITEMS);
			$statement->bindValue(1,$orderId);		 
			$statement->execute();
	}
	
    public function reviewsList(){
			$statement =$this->db->prepare($this->REVIEWS_LIST);
			$statement->execute();
			$result=$statement->fetchAll();
		
			return $result;
	}
	
    public function updateReview($status,$ProductId,$reviewId){
	        $statement =$this->db->prepare($this->APPROVE_REVIEW);
		    $statement->bindValue(1, $status);
		    $statement->bindValue(2, $ProductId);
		    $statement->bindValue(3, $reviewId);
			$statement->execute();
	}
	
    public function deleteReview($reviewId){
			$statement=$this->db->prepare($this->DELETE_REVIEW);
			$statement->bindValue(1,$reviewId);		 
			$statement->execute();
	}
	
	
	public function insertBlog($name,$title,$time,$date,$blogContent,$image){
			$statement =$this->db->prepare($this->INSERT_BLOG);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $title);
		    $statement->bindValue(3, $time);
		    $statement->bindValue(4, $date);
		    $statement->bindValue(5, $blogContent);
		    $statement->bindValue(6, $image);
		    
		    $statement->execute();
	}
	
	public function blogListAdmin(){
			$statement =$this->db->prepare($this->BLOG_LIST_ADMIN);
			$statement->execute();
			$result=$statement->fetchAll();
	
		    return $result;
	}
	
	public function blogById($blogId){
			$statement =$this->db->prepare($this->BLOG_BY_ID);
			$statement->bindValue(1, $blogId); 
			$statement->execute();
			$result=$statement->fetch();
			
			return $result;
	}
	
	public function updateBlog($name,$title,$time,$date,$blogContent,$image,$blogId){
			$statement =$this->db->prepare($this->UPDATE_BLOG);
		    $statement->bindValue(1, $name);
		    $statement->bindValue(2, $title);
		    $statement->bindValue(3, $time);
		    $statement->bindValue(4, $date);
		    $statement->bindValue(5, $blogContent);
		    $statement->bindValue(6, $image);
		    $statement->bindValue(7, $blogId);
		    
			$statement->execute();
	}
	
    public function deleteBlog($blogId){
			$statement=$this->db->prepare($this->DELETE_BLOG);
			$statement->bindValue(1,$blogId);		 
			$statement->execute();
	}
}
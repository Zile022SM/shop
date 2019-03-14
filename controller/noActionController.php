<?php 
require_once '../model/DAO.php';
$dao=new DAO();
$onSale=$dao->getProductsOnSale();
$newItems=$dao->getNewProducts();
$productType=$dao->getProductType();
$categories=$dao->getCategories();
$subNameFix=$dao->subCatName($subId=1);
$subIdFix=$dao->getSubIdFix();
//var_dump($subIdFix);




/** PAGINATION FIX FOR INDEX PAGE **/
if(isset($_GET['page'])){
    $page = $_GET['page'];
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
$numberOfPages=4;
$totalNumberOfRowsFix=$dao->countProductsByType($typeOfProducts="shoes");
//var_dump($totalNumberOfRowsFix);
$totalNumberOfPagesFix= ceil( $totalNumberOfRowsFix / $numberOfPages );
//var_dump($totalNumberOfPagesFix);
if($totalNumberOfPagesFix < $page || $page <= 0){
    $page = 1;
}
$fixItemsByType=$dao->getProductsByTypeFix($numberOfPages, $page);
//var_dump($fixItemsByType);
/** PAGINATION FIX FOR INDEX PAGE **/



/*******************************************/




/** PAGINATION FIX FOR PRODUCTS PAGE **/
if(isset($_GET['page'])){
    $page = $_GET['page'];
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
$numberOfPagesForProductPage=6;
$totalNumberOfRows=$dao->getCountProductsBySubIdFix();
//var_dump($totalNumberOfRows);
$totalNumberOfPages= ceil( $totalNumberOfRows / $numberOfPagesForProductPage );
//var_dump($totalNumberOfPages);
if($totalNumberOfPages < $page || $page <= 0){
    $page = 1;
}
$fixItemsBySubCatId=$dao->getProductBySubIdFix($numberOfPagesForProductPage, $page);
//var_dump($fixItemsBySubCatId);
/** PAGINATION FIX FOR PRODUCTS PAGE **/


?>



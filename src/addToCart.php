<?php
session_start();
include("config.php"); 
 header("location:products.php");

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$_SESSION['bcheck'] = $_POST['buyNow'];

 if (!isset($_SESSION['buynow']))
    {
        $_SESSION['buynow'] =array();
    }


    print_r(($_POST));

foreach ($_POST as $k => $v)
{
    $action = $k;
    break;
}
switch ($action)
{  
    case "AddToCart":
        addToCart();
        break;

    case "quantity":
        changeQuantity();
        break;

      case "buyNow":
        buynow(); 

    
}









function addToCart()
{
    foreach($_SESSION['product'] as $key=> $value)
    {
        if (isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key =>$val){
                if($val['id']==$_POST['AddToCart']){
                    $_SESSION['cart'][$key]['quantity'] +=1;

                    return;
                }
            }
        }        
    }





    foreach ($_SESSION['product'] as $value){ 
        if ($value['id'] == $_POST['AddToCart'])
        {
            $id = $value['id'];
            $name = $value['name'];
            $image =$value['image'];
            $price =$value ['price'];
            $data = array("id" => $id ,"name"=> $name , "image"=> $image ,"price" => $price, "quantity" => "1");
            array_push($_SESSION['cart'], $data);
        }
    }
   }

   function changeQuantity()
   {
       foreach($_SESSION['cart'] as $key =>$val){
        if($val['id']==$_POST['id']){
            $_SESSION['cart'][$key]['quantity'] =$_POST['quantity'];
            return;
        }
    }
   }
  
   
   
if(isset($_POST['remove'])){
    foreach($_SESSION['cart'] as $key => $val){
               if($val['id'] == $_POST['remove']){
                   array_splice($_SESSION['cart'] , $key ,1);
                     
}
    }
}


function buynow(){
   
  
   
   foreach($_SESSION['product']  as $key=> $val)

    {
        echo ("helo");
        if($_POST['buyNow'] == $val['id'])
        {
            $bid = $val['id'];
            $bname = $val['name'];
            $bimage =$val['image'];
            $bprice =$val ['price'];
            $bdata = array("id" => $bid ,"name"=> $bname , "image"=> $bimage ,"price" => $bprice, "quantity" => "1");
           array_push($_SESSION['buynow'] , $bdata);
           break;
        } 
       
    }
    print_r($_SESSION['buynow']);   
}
 
if(isset($_POST['addTocart'])){
    foreach($_SESSION['buynow'] as $key=> $value)
    {
        if (isset($_SESSION['cart']))
        {
            foreach($_SESSION['cart'] as $key =>$val){
                if($val['id']==$_POST['addTocart']){
                 $_SESSION['cart'][$key]['quantity'] +=1;
                  array_splice($_SESSION['buynow'],$key,1);
                    return;
                }
            }
        }        
    }
    foreach ($_SESSION['buynow'] as $value){ 
        if ($value['id'] == $_POST['addTocart'])
        {
            $id = $value['id'];
             $name = $value['name'];
             $image =$value['image'];
            $price =$value ['price'];
             $data = array("id" => $id ,"name"=> $name , "image"=> $image ,"price" => $price, "quantity" => "1");
            array_push($_SESSION['cart'], $data);
            array_splice($_SESSION['buynow'],$key,1);
        }
    }

}



if(isset($_POST['bbuyNow'])){
    foreach ($_SESSION['cart'] as $vll){ 
        if ($vll['id'] == $_POST['bbuyNow'])
        {
             $aid = $vll['id'];
             $aname = $vll['name'];
             $aimage =$vll['image'];
            $aprice =$vll ['price'];
            $aquantity =$vll['quantity'];
             $adata = array("id" => $aid ,"name"=> $aname , "image"=> $aimage ,"price" => $aprice, "quantity" => $aquantity);
            array_push($_SESSION['buynow'], $adata);
            array_splice($_SESSION['cart'],$key,1);
        }
    }
   

}

if(isset($_POST['addtobuy'])){

    
    foreach($_SESSION['cart'] as $key => $ve){
              $aid = $ve['id'];
             $baname = $ve['name'];
             $baimage =$ve['image'];
            $baprice =$ve ['price'];
            $baquantity =$ve['quantity'];
            $badata = array("id" => $baid ,"name"=> $baname , "image"=> $baimage ,"price" => $baprice, "quantity" => $baquantity);
            array_push($_SESSION['buynow'], $badata);

            
            unset($_SESSION['cart']);
            //array_splice($_SESSION['cart'],$key,1);
    }
}

if(isset($_POST['clearcart'])){
    unset($_SESSION['cart']);

}
if(isset($_POST['clearBuy'])){
    unset($_SESSION['buynow']);

}

?>
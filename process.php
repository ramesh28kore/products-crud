<?php
session_start();
$product_id = 0;
$update = false;
$product_name = '';
$product_type = '';
$product_image = '';
$status = '';
$adress = '';


//Connection data
$mysqli = new mysqli('localhost', 'root', '', 'products') or die(mysqli_error($mysqli));

// INSERT OK
if (isset($_POST['save'])) {
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_image = $_POST['product_image'];
    $status = $_POST['status'];
    $adress = $_POST['adress'];
    

    $mysqli->query("INSERT INTO products(product_name, product_type, product_image,status,adress) VALUES('$product_name', '$product_type','product_image',$status,'$adress')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("Location: index.php");
}
// END INSERT OK

//DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM products WHERE product_id=$product_id") or die ($mysqli->error());

    $_SESSION['message'] = "Record has been Deleted!";
    $_SESSION['msg_type'] = "danger";

    header("Location: index.php");
}
//END DELETE

//EDIT

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM products WHERE product_id=$product_id") or die($mysqli->error());
//    if(count()==1){
    if ($result->num_rows) {
        $row = $result->fetch_array();        
        $product_name = $_POST['product_name'];
        $product_type = $_POST['product_type'];
        $product_image = $_POST['product_image'];
        $status = $_POST['status'];
        $adress = $_POST['adress'];
              
    }    
}

if (isset($_POST['update'])){
    $id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_image = $_POST['product_image'];
    $status = $_POST['status'];
    $adress = $_POST['adress'];
    
    
    $mysqli->query("UPDATE products SET product_name='$product_name',  product_type = '$product_type',product_image = '$product_image',status = 
    '$status',adress = '$adress' WHERE product_id=$product_id") or die($mysqli->error);
    $_SESSION['message'] = "Revord has been update!";
    $_SESSION['msg_type'] = "warning";
    
    header('Location: index.php');
}
//END EDIT
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-16">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Products Details</h2>
                        <a href="create.html" class="btn btn-success pull-right">Add New Products</a>
                  </div>
                  <?php require_once 'process.php' ?>
                  <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?=$_SESSION['msg_type']?>">
                        <?php 
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                   </div>
                     <?php endif ?>
                        
                            <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'products') or die(mysqli_error($mysqli));
                            $result = $mysqli->query("SELECT * FROM products") or die($mysqli->error);
                            ?>
                            <div class="row justify-content-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Type</th>
                                            <th>Product Image</th>
                                            <th>Status</th>
                                            <th>Address</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $row['product_type']; ?></td>
                                            <td><?php echo $row['product_image']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['adress']; ?></td>
                                            <td>
                                                <a href="index.php?edit=<?php echo $row['product_id']; ?>" class="btn btn-link">Edit</a>
                                                <a href="process.php?delete=<?php echo $row['product_id']; ?>" class="btn btn-link">Delete</a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </thead>
                                </table>
                            </div>

                            <?php function pre_r($array) { echo '<pre>'; print_r($array); echo '</pre>'; } ?>
                      
                    
            </div>        
        </div>
    </div>
</body>
</html>
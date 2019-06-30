<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <style>
    .title{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table{
            background-color: #efefef;
        }
        table, td{
            text-align: center;
        }
        .alert-error{
    color:red;
  }
    </style>
</head>
<body>
<?php
    session_start();
    include("../MasterPage/header.php");
    ?>
    <?php

    $_SESSION['message']=' ';
    $host='127.0.0.1'; //yeh humry localhost ka default ip hain
    $username='root';
    $password='';
    $dbname='projrct';
    $con=new mysqli($host,$username,$password,$dbname);
    
    if($con->connect_error)
    {
        echo "Connection Failed";
    }
    else{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["employee_email"] && $_POST["password"])) {
                $_SESSION['message'] = "All fileds are required";
            } 
    
              
            
        else if(isset($_POST['Add_employee']))
         {
      
           // $employee_id=$_POST['productemployee_id'];
            $employee_name=$_POST['employee_name'];
            $employee_email=$_POST['employee_email'];
           // $password=$_POST['password'];
            $employyee_salary=$_POST['salary'];
            $employee_imag=$_FILES['employee_image']['name'];
            $employee_image_tmp=$_FILES['employee_image']['tmp_name'];
    
            move_uploaded_file($employee_image_tmp,"$employee_imag");
    
            $insert_emply="INSERT INTO  `employee`(`name`, `image`,  `salary`, 'email') VALUES ('$employee_name','$employee_imag','$employyee_salary',' $employee_emai')"; 
            $insert_emp=mysqli_query($con, $insert_emply);
    
            if($insert_emp)
            {
                echo "<script>alert('Employee has been added succesfully!')</script>";
                echo "<script>window.open('insert_employee.php','_self')</script>";
    
            }
            else{
                echo "Not Inserted";
            }
                            
        }
    
    }
    
    }
   


   <!-- updation -->

   if (isset($_REQUEST["edt"]))
{
    $edt = $_REQUEST["edt"];
    $query="SELECT * FROM `employee` WHERE id='$edt'";
    $run = mysqli_query($conn, $query);
    $row=mysqli_fetch_array($run);
}
if(isset($_REQUEST["Update_employee"]))
{
    //$employee_id=$_POST['productemployee_id'];
    $employee_name=$_POST['employee_name'];
    $employee_email=$_POST['employee_email'];
   // $password=$_POST['password'];
    $employyee_salary=$_POST['salary'];
    $employee_imag=$_FILES['employee_image']['name'];
    $employee_image_tmp=$_FILES['employee_image']['tmp_name'];

    move_uploaded_file($employee_image_tmp,"$employee_imag");

    $q = "UPDATE `employee` SET `Name`='$name',`Image`='$employee_imag',`email`='$email',`salary`='$salary' WHERE id='$edt'";
    $r = mysqli_query($conn, $q);
    
}
?>




    <script src="js/jquery 3.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
     
     <form action="insert_employee" method="post" enctype="multipart/form-data">
    
     <div class="container" style="width: 65%">
<div style="clear: both"></div>
        <h3 class="title">Add New Employee <a href="Adminpanel.html"><i style="float:left" class="fas fa-arrow-left mr-3"></i></a></h3>
        <div class="table-responsive">
            <table class="table">
            <tr>
               <td>Employee Name</td>
               <td><input type="text" name="employee_name"/></td>
            </tr>
            <!-- <tr>
               <td>Product Status</td>
               <td><input type="text" name="product_status"/></td>
            </tr> -->
            <!-- <tr>
               <td>Product Category</td>
               <td>
               <select name="product_cat">
                <option>Select a Category</option>
                <?php
                    //  $get_cats = "SELECT * FROM `categories`";
                    //  $run_cat = mysqli_query($con, $get_cats);
                    //  while ($row_cats=mysqli_fetch_array($run_cat))
                    //  {
                    //      $cat_id = $row_cats['cat_id'];
                    //      $cat_title = $row_cats['cat_title'];
                    //     echo "<option>$cat_title</option>";
                    // }
                ?>
               </select>
               </td>
            </tr> -->
            <tr>
               <td>Employee Email</td>
               <td><input type="text" name="employee_email"/></td>
            </tr>
            <tr>
               <td>Employee salary</td>
               <td><input type="text" name="employee_salary"/></td>
            </tr>
            <tr>
               <td>Employee Image</td>
               <td><input type="file" name="employee_image"/></td>
            </tr>
            
          </table>
          <div class="alert alert-error"><?= $_SESSION['message']?></div>
          <div align="center"><input type="submit" name="Add_employee" value="Add employee"/></div>
     </form>
  
       <?php
       include("../MasterPage/footer.php");
    ?>
</body>
</html>
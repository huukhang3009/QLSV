<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from students where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Đã xóa !!";
      }

     if(isset($_GET['pass']))
      {
        $password="12345";
        $newpass=md5($password);
              mysqli_query($bd, "update students set password='$newpass' where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Đặt lại mật khẩu 12345";
      } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Quản lý sinh viên</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
   
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Quản lý sinh viên</h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quản lý sinh viên
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã số sinh viên</th>
                                            <th>Tên sinh viên</th>
                                            <th>Mã xác thực</th>
                                             <th>Ngày đăng ký</th>
                                             <th>Hoạt động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from students");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['pincode']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>              
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&del=delete" onClick="return confirm('Xác nhận xóa sinh viên?')">
                                            <button class="btn btn-danger">Xóa</button>
</a>
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&pass=update" onClick="return confirm('Xác nhận đặt lại mật khẩu ban đầu?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Đặt lại mật khẩu</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>





        </div>
    </div>
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>

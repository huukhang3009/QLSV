<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lịch sử đăng ký</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
  
<?php if($_SESSION['login']!="")
{
 include('includes/menubar.php');
}
 ?>

    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Lịch sử đăng ký</h1>
                    </div>
                </div>
                <div class="row" >
            
                <div class="col-md-12">
                   
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Lịch sử đăng ký
                        </div>
                      
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Môn học </th>
                                            <th>Buổi học</th>
                                            <th>Kỳ học</th>
                                            <th>Ngày đăng ký</th>
                                            <th>Phòng học</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
//$sql=mysqli_query($bd, "select courseenrolls.course as cid, course.courseName as courname,session.session as session,department.department as dept,courseenrolls.enrollDate as edate ,semester.semester as sem from courseenrolls join course on course.id=courseenrolls.course join session on session.id=courseenrolls.session join department on department.id=courseenrolls.department   join semester on semester.id=courseenrolls.semester join students on students.StudentRegno=courseenrolls.studentRegno ");
$sql=mysqli_query($bd, "select courseenrolls.course as cid, course.courseName as courname,session.session as session,department.department as dept,courseenrolls.enrollDate as edate ,semester.semester as sem from courseenrolls join course on course.id=courseenrolls.course join session on session.id=courseenrolls.session join department on department.id=courseenrolls.department   join semester on semester.id=courseenrolls.semester join students on students.StudentRegno=courseenrolls.studentRegno where courseenrolls.studentRegno='".$_SESSION['login']."'");

$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['courname']);?></td>
                                            <td><?php echo htmlentities($row['session']);?></td>
                                            <td><?php echo htmlentities($row['sem']);?></td>
                                            <td><?php echo htmlentities($row['edate']);?></td>
                                            <td><?php echo htmlentities($row['dept']);?></td>
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

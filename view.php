<?php
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Uploading With PHP and MySql</title> 
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
</head>
<body >
<div class="header">
            <a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
        </div>
<br><br>
<div class="box">
<div>
    <div class="box_left">
        <a href="<?php echo $url_home; ?>">File Uploading using PHP</a>
    </div>
    <div class="box_right">
        <a href="index.php">Go to Main Page <?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
    </div>
    <div class="clean"></div>
    <br>
 <table class="view_table">
   <!-- <tr> 
    <th colspan="4">File Uploaded<label><a href="new_reply.php">Upload New Files</a></label></th> 
    </tr> -->
    <tr>
    <th class="forum_cat">File Name</th>
    <th>File Type</th>
    <th>File Size(KB)</th>
    <th>View</th>
    <?php
if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
        <th class="forum_act">Action</th>
<?php
}
?>
    </tr>
    <?php
 $sql="SELECT * FROM tbl_uploads";
 $conn= new mysqli("localhost","root","","vithub");
 $result_set=mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result_set))
 {
  ?>
        <tr>
        <td><?php echo $row['file'] ?></td>
        <td><?php echo $row['type'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">view file</a></td>
        <?php
        if(isset($_SESSION['username']) and $_SESSION['username']==$admin)
{
?>
        <td><a href="delete_view.php?id4=<?php echo $row['id4']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a>
<?php
}
        ?>
        </tr>
        <?php
 }
 ?>
    </table>
    
</div>
</div>
        <div class="foot"> <a href="view.php">View Files</a></div>
</body>
</html>
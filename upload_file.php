<?php
//$dbhost = "localhost";
//$dbuser = "root";
//$dbpass = "";
//$dbname = "vithub";
//$conn= new mysqli("localhost","root","","vithub");
include('config.php');
if(isset($_GET['id']))
{
  $id = intval($_GET['id']);
  }
  else {
    echo "loll error";
  }
//mysqli_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 

//mysqli_select_db($conn,"vithub") or die('database selection problem');
?>
<?php
if(isset($_POST['btn-upload']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 
 // new file size in KB
 $new_size = $file_size/1024;  
 // new file size in KB
 
 // make file name in lower case
 $new_file_name = strtolower($file);
 // make file name in lower case
 
 $final_file=str_replace(' ','-',$new_file_name);
 
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {$conn= new mysqli("localhost","root","","vithub");
  $sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  mysqli_query($conn,$sql);
  ?>
 <script>
 //window.open.href='view.php';
  alert('successfully uploaded');
        window.location.href='new_reply.php?id=<?php echo $id; ?>';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error while uploading file');
        window.location.href='new_reply.php?id=<?php echo $id; ?>';
        </script>
  <?php
 }
}
?>
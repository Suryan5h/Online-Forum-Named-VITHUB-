<?php
//This page let log in
$conn= new mysqli("localhost","root","","vithub");
include('config.php');
if(isset($_SESSION['username']))
{
	unset($_SESSION['username'], $_SESSION['userid']);
	setcookie('username', '', time()-100);
	setcookie('password', '', time()-100);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
	    </div>
<div class="message">You have successfully been logged out.<br />
<a href="<?php echo $url_home; ?>">Home</a></div>
<?php

}
else
{
	$conn= new mysqli("localhost","root","","vithub");
	$ousername = '';
	if(isset($_POST['username'], $_POST['password']))
	{
		if(get_magic_quotes_gpc())
		{	$conn= new mysqli("localhost","root","","vithub");
			$ousername = stripslashes($_POST['username']);
			$username = mysqli_real_escape_string($conn,stripslashes($_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{	$conn= new mysqli("localhost","root","","vithub");
			$username = mysqli_real_escape_string($conn,$_POST['username']);
			$password = $_POST['password'];
		}
		$conn= new mysqli("localhost","root","","vithub");
		$req = mysqli_query($conn,'select password,id from users where username="'.$username.'"');
		$dn = mysqli_fetch_array($req);
		if($dn['password']==sha1($password) and mysqli_num_rows($req)>0)
		{
			$form = false;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['userid'] = $dn['id'];
			if(isset($_POST['memorize']) and $_POST['memorize']=='yes')
			{
				$one_year = time()+(60*60*24*365);
				setcookie('username', $_POST['username'], $one_year);
				setcookie('password', sha1($password), $one_year);
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
	    </div>
<div class="message">You have successfully been logged.<br />
<a href="<?php echo $url_home; ?>">WELCOME USER</a></div>
<?php
$conn= new mysqli("localhost","root","","vithub");
		}
		else
		{
			$form = true;
			$message = 'The username or password you entered are not good.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
        <title>Login</title>
    </head>
    <body>
    	<div class="header">
        	<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
	    </div>
<?php
if(isset($message))
{
	echo '<div class="message">'.$message.'</div>';
}
?>
<div class="content">
<?php
$conn= new mysqli("localhost","root","","vithub");
$nb_new_pm = mysqli_fetch_array(mysqli_query($conn,'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
<div class="box">
	<div class="box_left">
    	<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; Login
    </div>
	<div class="box_right">
    	<a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['userid']; ?>"><?php echo htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
    </div>
    <div class="clean"></div>
	</div>
    <form action="login.php" method="post">
        Please, type your IDs to log:<br />
        <div class="login">
            <label for="username">Username</label><input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
            <label for="password">Password</label><input type="password" name="password" id="password" /><br />
            <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" /><br />
            <input type="submit" value="Login" />
		</div>
    </form>
</div>
<?php
	}
}
?>
		<div class="foot"> <a href="view.php">View Files</a></div>
	</body>
</html>
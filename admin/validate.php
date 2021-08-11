<?php
//from tambahorang.php
session_start();
$errorMessage = '';
if (isset($_POST['username']) && isset($_POST['password']))
{
    include 'config.php';
    $uname   = $_POST['username'];
    $password = md5($_POST['password']);
    
    $query = "select * from user where uname = '$uname' and password = '$password'";
    $result = mysqli_query($conn,$query) or die('Query failed. ' . mysqli_error($conn));
    list($usid,$uname,$nama,$password,$status) = mysqli_fetch_array($result);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['login']=true;
        $_SESSION['usid']=$usid;
        $_SESSION['uname']=$uname;
        $_SESSION['nama']=$nama;
        $_SESSION['status']=$status;
        header('Location: mainuser.php');
        exit;
    }
    else
    {
        echo 'gagal';
        $errorMessage = 'Maaf, username atau password salah';
    }
    mysqli_close($conn);
}
echo "sss";
?>
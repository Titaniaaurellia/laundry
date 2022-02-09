<?php 
session_start(); 
$conn = mysqli_connect('localhost','root','','laundry'); 
$username = stripslashes($_POST['username']); 
$password = md5($_POST['password']); 
$query = "SELECT * FROM user where username='$username' AND password='$password'"; 
$row = mysqli_query($conn,$query); 
$data = mysqli_fetch_array($row);  
$cek = mysqli_num_rows($row);

if($cek > 0){
    if($data['role']== 'admin'){ 
        $_SESSION['role']='admin'; 
        $_SESSION['username'] = $data['username']; 
        $_SESSION['id'] = $data['id']; 
        $_SESSION['nama_user']=$data['nama_user'];
        $_SESSION['status_login']=true;
        header('location: admin/home.php'); 
    }else if($data['role'] =='kasir'){
        $_SESSION['role']='kasir';
        $_SESSION['username'] = $data['username'];
        $_SESSION['id']= $data['id']; 
        $_SESSION['status_login']=true;
        header('location: kasir/home.php'); 
    }else if($data['role']== 'owner'){ 
        $_SESSION['role'] ='owner';
        $_SESSION['username'] = $data['username'];
        $_SESSION ['id'] = $data['id'] ;
        $_SESSION['status_login']=true;
        header('location: owner/home.php');} 
    }else{
        $msg = 'username Atau password Salah';
        echo '<script>alert("'.$msg.'");location.href="index.php"</script>';
    }
?>
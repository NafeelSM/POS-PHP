<?php 

require 'config/function.php';

if(isset($_POST['loginBtn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['passwor$password']);


    if($email != '' && $password != '')
    {
        $query = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if($result)
        {
        
        }else{
            redirect('login.php', 'Somthing Wents Wrong!');
        }
    }
    else
    {
        redirect('login.php' ,'All Fields Are Mendetory!');
    }
}



?>
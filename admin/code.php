<?php

include('../config/function.php');

//insert
if(isset($_POST['saveAdmin']))
{
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if($name != '' && $email != '' && $password != ''){

        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0 ){
                redirect('admins-create.php', 'Email Already Exits!');
            }
        }

        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_password,
            'phone' => $phone,
            'is_ban' => $is_ban,
        ];
        $result = insert('admins', $data);

        if($result){
            redirect('admins.php', 'Created Success!');
        }else{
            redirect('admins-create.php', 'Somthing Wants Wrong!');
        }

    }else{
        redirect('admins-create.php', 'Please Fill Required Feilds!');
    }
}

//edit
if(isset($_POST['updateAdmin']))
{
    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins', $adminId);
    if($adminData['status'] != 200){
        redirect('admins-edit.php?id='.$adminId, 'Please Fill Required Feilds!');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if($password != ''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }
    else{
        $hashedPassword = $adminData['data']['password']; 
    }

    if($name != '' && $email != '')
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban,
        ];
        $result = update('admins', $adminId, $data);

        if($result){
            redirect('admins-edit.php?id='.$adminId, 'Update Successfully!');
        }else{
            redirect('admins-edit.php?id='.$adminId, 'Somthing Wants Wrong!');
        }
    }
    else{
        redirect('admins-create.php', 'Please Fill Required Feilds!');
    }
    
}

//Category
if(isset($_POST['saveCategory']))
{
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status,
        
    ];
    $result = insert('categories', $data);

    if($result){
        redirect('categories.php', 'Created Success!');
    }else{
        redirect('categories-create.php', 'Somthing Wants Wrong!');
    }
}


?>




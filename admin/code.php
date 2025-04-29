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

if(isset(($_POST['updateCategory'])))
{
    $categoryId = validate($_POST['categoryId']);

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1:0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status,
        
    ];
    $result = update('categories',$categoryId, $data);

    if($result){
        redirect('categories-edit.php?id='.$categoryId, 'Update Success!');
    }else{
        redirect('categories-edit.php?id='.$categoryId, 'Somthing Wants Wrong!');
    }
}

if(isset(($_POST['saveProduct'])))
{
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);

    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1:0;

    if($_FILES['image']['size'] > 0)
    {
        $path = "../assets/uploads/products";
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        $filename = time().'.'.$image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path."/".$filename);

        $finalImage = "assets/uploads/products/".$filename;
    }
    else
    {
        $finalImage = '';
    }



    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status,
        
    ];
    $result = insert('products', $data);

    if($result){
        redirect('products.php', 'Created Success!');
    }else{
        redirect('products-create.php', 'Somthing Wants Wrong!');
    }
}




?>




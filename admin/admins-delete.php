<?php 

require '../config/function.php';

$paraRestultId = checkParamId('id');
if(is_numeric(($paraRestultId))){

    $adminId = validate($paraRestultId);

    $admin = getById('admins', $adminId);
    if($admin['status'] == 200)
    {
        $adminDeleteRes = delete('admins', $adminId);
        if($adminDeleteRes)
        {
            redirect('admins.php', 'Admin Delete Successfully');
        }
        else
        {
            redirect('admins.php', 'Somthing Wants Wrong');
        }
    }
    else
    {
        redirect('admins.php', $admin['message']);   
    }
    // echo $adminId;

}else{
    redirect('admins.php', 'Somthing Wants Wrong');
}



?>
<?php 

require '../config/function.php';

$paraRestultId = checkParamId('id');
if(is_numeric(($paraRestultId))){

    $categoryId = validate($paraRestultId);

    $category = getById('categories', $categoryId);

    if($category['status'] == 200)
    {
        $response = delete('categories', $categoryId);
        if($response)
        {
            redirect('categories.php', 'Category Delete Successfully');
        }
        else
        {
            redirect('categories.php', 'Somthing Wants Wrong');
        }
    }
    else
    {
        redirect('categories.php', $category['message']);   
    }
    // echo $adminId;

}else{
    redirect('categories.php', 'Somthing Wants Wrong');
}



?>
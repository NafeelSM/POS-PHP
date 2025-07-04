<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Admin</h4>
            <a href="admins.php" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST">

                <?php
                if (isset($_GET['id'])) {
                    if ($_GET['id'] != '') {

                        $adminId = $_GET['id'];
                    } else {
                        echo '<h5>No ID Found</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>No ID Given In Params</h5>';
                    return false;
                }

                $adminData = getById('admins', $adminId);
                if ($adminData) {

                    if ($adminData['status'] == 200) {

                        ?>
                        <input type="hidden" name="adminId" value="<?= $adminData['data']['id']; ?>"

                        ?>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Name *</label>
                                <input type="text" name="name" required value="<?= $adminData['data']['name']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email *</label>
                                <input type="email" name="email" required value="<?= $adminData['data']['email']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password *</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Phone Number *</label>
                                <input type="number" name="phone" required value="<?= $adminData['data']['phone']; ?>" class="form-control" />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">IS Ban</label>
                                <br/>
                                <input type="checkbox" name="is_ban" <?= $adminData['data']['is_ban'] == true ? 'Checked': ''; ?> style="width:30px;height:30px;" />
                            </div>
                            <div class="col-md-12 mb-3 text-end">

                                <button href="admins.php"button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <?php

                    } else {
                        echo '<h5>' . $adminData['message'] . '</h5>';
                    }

                } else {
                    echo 'Somthing Wrong!';
                    return false;
                }

                ?>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
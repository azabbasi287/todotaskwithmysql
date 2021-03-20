<?php
require_once "dbconfig.php";
    if (isset($_POST['update'])){
        $userid = intval($_GET['id']);
        $names = $_POST['names'];
        $task = $_POST['task'];
        $completed = $_POST['completed'];
/*        $sql = "UPDATE usertask set names=:names,completed=:completed ,task=:task WHERE  id=:binarycode";*/
       $sql = "UPDATE `usertask`   
   SET `names` = :names,
       `completed` = :completed,
       `task` = :task
 WHERE `usertask`.`id` = :user_id";
        $query = $connection->prepare($sql);
        $query -> bindParam(':names' ,$names , PDO::PARAM_STR);
        $query -> bindParam(':task' ,$task , PDO::PARAM_STR);
        $query -> bindParam(':completed' ,$completed , PDO::PARAM_STR);
        $query-> bindParam(':user_id', $userId, PDO::PARAM_STR);
        $query->execute();
        echo '<script>window.alert("the update is seccfully")</script>';
        echo '<script>window.location.href="index.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container border p-4 mt-4">

        <div class="row">
            <div class="col-md-12">
                <h3 class="p-4">ویرایش اطلاعات</h3>
                <hr />
            </div>
        </div>
        <?php
        $user_id = intval($_GET['id']);
        $sql = "SELECT  names,task,create_at,completed,id FROM usertask where id=:id";
        $query = $connection->prepare($sql);
        $query->bindParam("id" , $user_id ,PDO::PARAM_STR );
        $query ->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        ?>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>نام</label>
                    <input value="<?= htmlentities($result->names);?>" name="names" type="text" class="form-control" placeholder="مثال : علی">
                </div>
                <div class="form-group col-md-6">
                    <label>تکمیل شده یا نه؟</label>
                    <input value="<?= htmlentities($result->completed) ?>" name="completed" type="text" class="form-control" placeholder="0 یا 1">
                </div>
            </div>

            <div class="form-group">
                <label>کاری که باید انجام شود</label>
                <input name="task"  value="<?=htmlentities($result->task) ?>" type="text" class="form-control" placeholder="تمیز کردن خانه">
            </div>
            <input type="submit" class="btn btn-warning" name="update" value="ثبت">
        </form>


    </div>
</body>
</html>
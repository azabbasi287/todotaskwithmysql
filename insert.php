<?php
require_once 'dbconfig.php';
    if (isset($_POST['insert'])){
        $names = $_POST['names'];
        $task = $_POST['task'];
        $completed = $_POST['completed'];
        $sql = "INSERT INTO usertask (names,task,completed) VALUES (:names , :task , :completed)";
        $query = $connection->prepare($sql);
        $query->bindParam(":names" , $names , PDO::PARAM_STR);
        $query->bindParam(":task" , $task , PDO::PARAM_STR);
        $query->bindParam(":completed" , $completed , PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $connection->lastInsertId();
        if($lastInsertId){
            echo '<script>alert(" added new insert is seccfully");</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
        else{
            echo '<script>alert("errore 404");</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PHP CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style type="text/css">

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container border p-4 mt-4">

        <div class="row">
            <div class="col-md-12">
                <h3 class="p-4">وارد کردن اطلاعات</h3>
                <hr />
            </div>
        </div>

        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>نام</label>
                    <input name="names" type="text" class="form-control" placeholder="مثال : علی">
                </div>
                <div class="form-group col-md-6">
                    <label>تکمیل شده است یا نه</label>
                    <input type="text" name="completed" class="form-control" placeholder="مثال : 0 یا 1">
                </div>
            </div>
            <div class="form-group">
                <label>کاری که باید انجام شود</label>
                <input type="text" name="task" class="form-control" placeholder="مثال : ali@gmail.com">
            </div>
            <input class="btn btn-success" type="submit" name="insert" value="ثبت">
        </form>
    </div>
</body>
</html>
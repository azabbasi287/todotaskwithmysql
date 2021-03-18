<?php
require_once 'dbconfig.php';
        if (isset($_REQUEST['del'])){
            $userid = intval($_GET['del']);
            $sql = 'delete from usertask where id=:code';
            $query = $connection->prepare($sql);
            $query -> bindParam('code', $userid , PDO::PARAM_STR);
            $query ->execute();
            echo '<script>window.alert("the delete mission is seccful")</script>';
            echo '<script>window.location.href="index.php"</script>';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>پروژه عملی</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="#"><button class="btn btn-primary font-16 m-3">وارد کردن رکورد</button></a>
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped m-2">
                        <thead>
                            <th>شناسه</th>
                            <th>نام خانوادگی</th>
                            <th>کاری که باید انجام شود</th>
                            <th>تاریخ ساخت</th>
                            <th>تکمیل است یا نه</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT  names,task,create_at,completed,id FROM usertask";
                        $query = $connection->prepare($sql);
                        $query ->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount()>0){
                            $counter =0;
                        foreach ($result as $result) {
                        ?>
                            <tr>
                                <td>
                                    <?= htmlentities($counter) ?>
                                </td>
                                <td>
                                   <?= htmlentities($result->names)?>
                                </td>
                                <td>
                                    <?= htmlentities($result->task)?>
                                </td>
                                <td>
                                    <?= htmlentities($result->create_at)?>
                                </td>
                                <td>
                                    <?= htmlentities($result->completed)?>
                                </td>
                                <td><a href="update.php"><button class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a></td>

                                <td><a href="index.php?del=<?=htmlentities($result->id)?>"><button class="btn btn-danger" onClick="return confirm('آیا حذف انجام شود');"><span class="glyphicon glyphicon-trash"></span></button></a></td>
                            </tr>
                        <?php
                        $counter++;
                        }}
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
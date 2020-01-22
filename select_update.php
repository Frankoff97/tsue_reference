<?php 
    session_start();
    require './functions.php';
    $events = new Events;
    $row = $events->SELECT($_SESSION['category'],$_GET['pass'])[0]; 
    // $update -> UPDATE($_SESSION['category'], $row);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>O'ZGARTIRISH</title>
</head>
<body>
    
    <form action="/confirm_update.php" method="POST">
        <div class="d-flex ">
            <?php foreach($row as $item): ?>
                <input type="text" name="<?= $item ?>"  value="<?= $item ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Tasdiqlash</button>
        </div>
    </form>
</body>
</html>
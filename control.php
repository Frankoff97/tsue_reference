
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style_add.css">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>
    <section class="main_search" style="background-image: url('/img/6.jpg');">
        <div class="container ">
            <div class="find pt-5"> 
                    <form method="POST">
                        <p>Ma'lumotnomaning ID raqamini kiriting</p>
                        <div class="insert">
                        <input type="text" name="control" class="search mr-2" value="<?=$_SESSION['search']?>"
                            placeholder=" 100115" required>
                            <button type="submit" class="btn btn-success">Tekshirish</button></div>
                    </form>
            </div>
            <?php if(isset($_POST['control'])){
                 $pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
                 $search = "'". strip_tags(($_POST['control'])) . "'";
                    $sql = "SELECT * FROM `token` WHERE id LIKE " . $search;
                    $query = $pdo->prepare($sql);
                    $query -> execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                } 
            ?>
            <?php if($row): ?>
                <div class="alert-success cont"> 
                    Haqiqatdan ham <?= $row['fullname']?> ga <?= strip_tags($_POST['control'])?> sonli ma'lumotnoma berilgan!
                </div>
            <?php endif; ?>
        </div>            
    </section>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
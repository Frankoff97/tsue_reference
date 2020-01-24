
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
    <?php 
        // phpinfo();
        require './functions.php';
        unset($_SESSION['block']);
        date_default_timezone_set('Asia/Tashkent');	
        $CurrentTime = date('Y-m-d');
        $_SESSION['currentime'] = $CurrentTime;
        $pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
        $origin_category=$_GET['route'];
        switch ($_GET['route']) {
            case 'student':
            case 'non_student':
            case 'soldier_026':
            case 'soldier_028':
                $category='student';
                break;
            case 'offer':
            case 'non_offer':
                $category='offer';
            break;
        }
        $_SESSION['category']=$category;
        $_SESSION['search']=strip_tags($_POST['search']);

    ?>
    <section class="main_search" style="background-image: url('/img/6.jpg');">
        <!-- Example single danger button -->
        <div class="btn-customize">
           
            <div class="prev">
                <a href="/index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            </div>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Admin <i class="fa fa-lock" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu ">
                    <form action="/admin.php" method="POST" class="px-4 py-3">
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1">Login</label>
                            <input type="text" name="login" disabled value="<?= $category ?>" class="form-control" id="exampleDropdownFormEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Saqlab qolish
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirish</button>
                    </form>
                    <a class="dropdown-item" href="#">Parolni o'zgartirish</a>
                </div>
            </div>
        </div>
        <!-- Example single danger button -->

        <div class="container ">
            <?php 
                if(isset($_POST['search'])){
                    /*******************SEARCH PASSPORT SERIES*****************************/
                    $search = "'". ($_POST['search']) . "'";
                    $sql = "SELECT * FROM " . $category . " WHERE passport LIKE " . $search;
                    $_SESSION['on']=true;
                    $query = $pdo->prepare($sql);
                    $query -> execute();
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                    
                    /*******************REGISTRATE TO BASE *****************************/
                    if(!$row['fullname']=='' and !$row['passport']==''){
                        $fullname = add_slesh($row['fullname']);
                        $passport = $row['passport'];
                            $insert = "INSERT INTO `token` VALUES (NULL, '$fullname', '$passport', '$CurrentTime' )";
                            $insertQuery = $pdo ->prepare($insert);
                            $insertQuery -> execute();
                    }
                    /*********************CALL ID IN BASE for information******************************/
                   
                };
            ?>
                        <!-- ********************** qidiruv bo'limi ***************************** -->
            <div class="find pt-5"> 
                    <form  <?php if($row): ?> action="./dom/index.php?path=<?php echo $origin_category . '/' . $row['passport']; endif; ?>" method="POST">
                        <p>Passport seriya raqami</p>
                        <div class="insert">
                        <input type="text" name="search" class="search mr-2" value="<?=$_SESSION['search']?>"
                            placeholder=" AA7775588" required>
                            <button type="submit" class="btn btn-success">Ma'lumotnoma olish</button></div>
                    </form>
                    <?php 
                        // if($_POST['search']){
                        //     echo "<div class='alert alert-danger' role='alert'>
                        //             Ma'lumot xato kiritildi yoki ushbu passport raqami bazada mavjud emas
                        //           </div>";
                        // }
                    ?>
            </div> 
        </div>            
    </section>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
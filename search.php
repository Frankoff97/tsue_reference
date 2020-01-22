
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
        $CurrentTime = date('Y-m-d H:i:s');
        $pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
        $category=$_GET['route']; 
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
                    $_SESSION['passpo']=$passport;
                   
                    $call = "SELECT max(ID) as id FROM TOKEN where passport LIKE '" . $passport . "'";
                    $callQuery = $pdo-> prepare($call);
                    $callQuery -> execute();
                    $id = $callQuery->fetch(PDO::FETCH_ASSOC);
                    
                    
                };
            ?>
                    <!--********************** Spravka ***************** -->
            <?php 
                if($row){
                    switch ($_GET['route']) {
                        case 'offer': echo
                            "<div class='container pt-2 '>
                                <form action=''>
                                    <div class='informationForm'>
                                        <div class='head'>
                                            <img src='/img/bg_lisence.jpg' width='120px'>
                                            <div class='title'>ТОШКЕНТ ДАВЛАТ ИҚТИСОДИЁТ УНИВЕРСИТЕТИ<br>
                                            </div>
                                        </div>
                                        <div class='body'>
                                            <div class='date'>"; echo date('d-m-Y') ."</div>
                                            <div class='title'>"; echo $id['id'] . " - сонли Offer </div><br>
                                            <div class='inform-body'>Берилди <b>"; echo $row['fullname'] ."</b>га шу ҳақидаки, у
                                            ҳақиқатан ҳам Тошкент Давлат Иқтисодиёт Университети “Иқтисодиётда ахборот тизимлари”
                                            факультетида бакалавриатнинг <b>"; echo $row['faculty'] . "</b> таълим
                                            йўналиши бўйича <b>"; echo $row['course'] . "</b> курс <b>"; echo  $row['group'] . "</b> гуруҳида
                                            <b>"; echo $row['price'] . "</b> асосида таҳсил
                                            олмоқда.
                                        </div>
                                        <div class='span'>Ўзбекистон Республикаси, Тошкент шаҳри, Ислом Каримов кўчаси, 49-уй
                                        </div>
                                        <br>
                                        <div class='qr-code'> <img src='/img/qr.jpg'></div>
                
                                        </div>
                                        <div class='buttons'><a href='/dom/index.php?path="; echo $row['passport'] . ';' . $category . "'
                                            class='btn btn-primary convert'>Download or print PDF</a>
                                        </div>
                                    </div>
                                </form>
                            </div>";; 
                            break;
                        case 'non_offer': echo
                            "<div class='container pt-2 '>
                                <form action=''>
                                    <div class='informationForm'>
                                        <div class='head'>
                                            <img src='/img/bg_lisence.jpg' width='120px'>
                                            <div class='title'>ТОШКЕНТ ДАВЛАТ ИҚТИСОДИЁТ УНИВЕРСИТЕТИ<br>
                                            </div>
                                        </div>
                                        <div class='body'>
                                            <div class='date'>"; echo date('d-m-Y') ."</div>
                                            <div class='title'>"; echo $id['id'] . " - сонли NON_OFFER </div><br>
                                            <div class='inform-body'>Берилди <b>"; echo $row['fullname'] ."</b>га шу ҳақидаки, у
                                                ҳақиқатан ҳам Тошкент Давлат Иқтисодиёт Университети “Иқтисодиётда ахборот тизимлари”
                                                факультетида бакалавриатнинг <b>"; echo $row['faculty'] . "</b> таълим
                                                йўналиши бўйича <b>"; echo $row['course'] . "</b> курс <b>"; echo  $row['group'] . "</b> гуруҳида
                                                <b>"; echo $row['price'] . "</b> асосида таҳсил
                                                олмоқда.
                                            </div>
                                        <div class='span'>Ўзбекистон Республикаси, Тошкент шаҳри, Ислом Каримов кўчаси, 49-уй
                                        </div>
                                        <br>
                                        <div class='qr-code'> <img src='/img/qr.jpg'></div>
                
                                        </div>
                                        <div class='buttons'><a href='/dom/index.php?path="; echo $row['passport'] . ';' . $category . "'
                                            class='btn btn-primary convert'>Download or print PDF</a>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        case 'student': ?>
                            <div class="reference">
                                <div class="ref-header">
                                    <div class="minster"><b>O'ZBEKISTON RESPUBLIKASI OLIY VA O'RTA MAXSUS TA'LIM VAZIRLIGI</b></div>
                                    <div class="logo"><img src="/img/tdiu_logo.png"></div>
                                    <div class="univer"><b>TOSHKENT DAVLAT IQTISODIYOT UNIVERSITETI</b></div>
                                </div>
                                <div class="adress">O'zbekiston Raspublikasi, 100003, Toshkent shahri, Islom Karimov ko'chasi           49. <br>Tel.: 998 71 232 64 46, 998 71 239 01 42</div>
                                <hr size="2px" color="#0000"><hr class="hr" size="5px" color="#0000">
                                <div class="ref-body">
                                <b>MA'LUMOTNOMA</b>
                                <div class="data">
                                    <div class="id">№ <?= $id['id'] ?></div> <div class="date"><?= date('d-m-Y') ?> y.</div>
                                </div>
                                <div class="ref-main">
                                        <p>
                                            &nbsp &nbsp &nbsp &nbsp Sizga shuni maʼlum qilamizki, bugungi kunda <?= $row['fullname'] ?>, haqiqatdan ham Toshkent davlat iqtisodiyot universitetining “<?= $row['faculty'] ?>” fakultetida “<?= $row['faculty'] ?>” taʼlim yoʼnalishi boʼyicha <?= $row['course'] ?> - bosqich <?= $row['group'] ?> guruhida <?= $row['price'] ?> asosida tahsil olmoqda.
                                        </p>
                                </div>
                                <div class="check">
                                    <i>
                                        Chop etilgan maʼlumotnomaning haqiqiyligini <a href="www.tsue.uz">www.tsue.uz</a> manzilida joylashgan “Tekshirish” oynasiga ID kodni kiritish orqali tekshirish mumkin.
                                    </i>
                                </div>
                                <div class="print-box">
                                <button class="print">SAQLAB OLISH yoki CHOP ETISH</button>

                                </div>
                                </div>
                                
                                <!-- <div class="print">
                                    <div class="btn btn-primary">Download or Print</div>
                                </div> -->
                                <!-- <div class="ijrochi">
                                    Ijrochi: М.Abdullayev <br>
                                    Tel: (+998) 71 239 28 15
                                </div> -->
                            </div>
                        <?php $_SESSION['on']=false;   break;
                        case 'non_student': echo
                            "<div class='container pt-2 '>
                                <form action=''>
                                    <div class='informationForm'>
                                        <div class='head'>
                                            <img src='/img/bg_lisence.jpg' width='120px'>
                                            <div class='title'>ТОШКЕНТ ДАВЛАТ ИҚТИСОДИЁТ УНИВЕРСИТЕТИ<br>
                                            </div>
                                        </div>
                                        <div class='body'>
                                            <div class='date'>"; echo date('d-m-Y') ."</div>
                                            <div class='title'>"; echo $id['id'] . " - сонли NON_STUDENT </div><br>
                                            <div class='inform-body'>Берилди <b>"; echo $row['fullname'] ."</b>га шу ҳақидаки, у
                                            ҳақиқатан ҳам Тошкент Давлат Иқтисодиёт Университети “Иқтисодиётда ахборот тизимлари”
                                            факультетида бакалавриатнинг <b>"; echo $row['faculty'] . "</b> таълим
                                            йўналиши бўйича <b>"; echo $row['course'] . "</b> курс <b>"; echo  $row['group'] . "</b> гуруҳида
                                            <b>"; echo $row['price'] . "</b> асосида таҳсил
                                            олмоқда.
                                        </div>
                                        <div class='span'>Ўзбекистон Республикаси, Тошкент шаҳри, Ислом Каримов кўчаси, 49-уй
                                        </div>
                                        <br>
                                        <div class='qr-code'> <img src='/img/qr.jpg'></div>
                
                                            </div>
                                        <div class='buttons'><a href='/dom/index.php?path="; echo $row['passport'] . ';' . $category . "'
                                            class='btn btn-primary convert'>Download or print PDF</a>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        case 'soldier_026': echo
                            "<div class='container pt-2 '>
                                <form action=''>
                                    <div class='informationForm'>
                                        <div class='head'>
                                            <img src='/img/bg_lisence.jpg' width='120px'>
                                            <div class='title'>ТОШКЕНТ ДАВЛАТ ИҚТИСОДИЁТ УНИВЕРСИТЕТИ<br>
                                            </div>
                                        </div>
                                        <div class='body'>
                                            <div class='date'>"; echo date('d-m-Y') ."</div>
                                            <div class='title'>"; echo $id['id'] . " - сонли SOLDIER_026 </div><br>
                                            <div class='inform-body'>Берилди <b>"; echo $row['fullname'] ."</b>га шу ҳақидаки, у
                                            ҳақиқатан ҳам Тошкент Давлат Иқтисодиёт Университети “Иқтисодиётда ахборот тизимлари”
                                            факультетида бакалавриатнинг <b>"; echo $row['faculty'] . "</b> таълим
                                            йўналиши бўйича <b>"; echo $row['course'] . "</b> курс <b>"; echo  $row['group'] . "</b> гуруҳида
                                            <b>"; echo $row['price'] . "</b> асосида таҳсил
                                            олмоқда.
                                        </div>
                                        <div class='span'>Ўзбекистон Республикаси, Тошкент шаҳри, Ислом Каримов кўчаси, 49-уй
                                        </div>
                                        <br>
                                        <div class='qr-code'> <img src='/img/qr.jpg'></div>
                
                                        </div>
                                        <div class='buttons'><a href='/dom/index.php?path="; echo $row['passport'] . ';' . $category . "'
                                            class='btn btn-primary convert'>Download or print PDF</a>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                            break;
                        case 'soldier_028': echo
                            "<div class='container pt-2 '>
                                <form action=''>
                                    <div class='informationForm'>
                                        <div class='head'>
                                            <img src='/img/bg_lisence.jpg' width='120px'>
                                            <div class='title'>ТОШКЕНТ ДАВЛАТ ИҚТИСОДИЁТ УНИВЕРСИТЕТИ<br>
                                            </div>
                                        </div>
                                        <div class='body'>
                                            <div class='date'>"; echo date('d-m-Y') ."</div>
                                            <div class='title'>"; echo $id['id'] . " - сонли SOLDIER_028 </div><br>
                                            <div class='inform-body'>Берилди <b>"; echo $row['fullname'] ."</b>га шу ҳақидаки, у
                                            ҳақиқатан ҳам Тошкент Давлат Иқтисодиёт Университети “Иқтисодиётда ахборот тизимлари”
                                            факультетида бакалавриатнинг <b>"; echo $row['faculty'] . "</b> таълим
                                            йўналиши бўйича <b>"; echo $row['course'] . "</b> курс <b>"; echo  $row['group'] . "</b> гуруҳида
                                            <b>"; echo $row['price'] . "</b> асосида таҳсил
                                            олмоқда.
                                        </div>
                                        <div class='span'>Ўзбекистон Республикаси, Тошкент шаҳри, Ислом Каримов кўчаси, 49-уй
                                        </div>
                                        <br>
                                        <div class='qr-code'> <img src='/img/qr.jpg'></div>
                
                                        </div>
                                        <div class='buttons'><a href='/dom/index.php?path="; echo $row['passport'] . ';' . $category . "'
                                            class='btn btn-primary convert'>Download or print PDF</a>
                                        </div>
                                    </div>
                                </form>
                            </div>";
                            break;
                    }
                }
            ?>
            
                        <!--********************** end of Spravka ***************** -->

                        <!-- ********************** qidiruv bo'limi ***************************** -->
            <div class="find pt-5 <?php if($row) echo " d-none"?>">
                    <form method="POST">
                        <p>Passport seriya raqami</p>
                        <div class="insert">
                        <input type="text" name="search" class="search mr-2" value="<?= $_SESSION['search']?>"
                            placeholder=" AA7775588" required>
                            <button type="submit" class="btn btn-success">Ma'lumotnoma olish</button></div>
                    </form>
                    <?php 
                        if(isset($_POST['search'])){
                            echo "<div class='alert alert-danger'   role='alert'>
                            Ma'lumot xato kiritildi yoki ushbu passport raqami bazada mavjud emas
                            </div>";
                        }
                    ?>
            </div> 
        </div>            
    </section>

    <script src="bootstrap-4.4.1-dist/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
    <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
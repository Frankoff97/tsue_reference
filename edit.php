<?php 
    session_start();
    require "./functions.php";
    $events = new Events;
?>
<?php if($_SESSION['block']=='on'): ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="/bootstrap-4.4.1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php 
        switch ($_SESSION['category']) {
            case 'offer':
            case 'non_offer':
                $category='offer'; $categories='non_offer';
                break;
            case 'student':
            case 'non_student':
                $category='student'; $categories='non_student';
                break;
            case 'soldier_026':
            case 'soldier_028':
                $category='soldier_026'; $categories='soldier_028';
                break;
        }
    ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active btn-primary" data-toggle="tab" href="#<?=$category?>"><?= $_SESSION['tab_name']; ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-warning " data-toggle="tab" href="#<?= $categories?>"><?= $_SESSION['tab_names']; ?></a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active container" id="<?=$category?>">
                    <div>
                        <form  method="post">
                        <?php if(isset($_POST['name'])){
                            $_SESSION['name'] = $_POST['name']; }
                        ?>
                            <div class="d-flex mt-5">
                                <input type="text" name="name" class="control" placeholder="F.I.Sh" value="<?=$_SESSION['name']?>">
                                <button type="submit" class="btn btn-danger">Qidirish</button>
                                <a  class="text-right add_people btn btn-success">Qo'shish</a>
                            </div>
                        </form>
                    </div>
                    <?php if(isset($_POST['name'])){
                    $rows = $events->SELECT($category, $_POST['name']);}
                        else $rows = $events -> SELECT($category, $_SESSION['name']);
                    
                 ?>
            <?php if($rows): ?>    
            <?php if($category=='offer'): ?>
                <?php $i = 0; ?> 
                <table class="mt-5">
                    <th>№</th>
                    <th>F.I.SH</th>
                    <th>Ishlayotgan fakultet, kafedra <br> yoki bo’lim nomi</th>
                    <th>Lavozimi</th>
                    <th>Passport seriyasi</th>
                    <th>Kirgan sanasi</th>
                    <th colspan="2">Amallar</th>
                <?php foreach($rows as $row): $i++; ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <?= $row['fullname'];?>
                        </td> 
                        <td>
                            <?= $row['faculty'] ?>
                        </td> 
                        <td>
                            <?= $row['duty'] ?>
                        </td> 
                        <td>
                            <?= $row['passport']?>
                        </td> 
                        <td>
                            <?= $row['Kirgan_yili'] ?>
                        </td> 
                        <td>
                            <a href="/select_update.php?pass=<?= $row['passport']?>" class="btn btn-warning">Tahrirlash</a>
                        </td>
                        <td>
                            <a href="/delete.php?pass=<?= $row['passport']?>" class="btn btn-danger">O'chirish</a>
                        </td>
                    </tr>

                <?php 
                  
                    $fullname="'".strip_tags(add_slesh($_POST['fullname']))."'";
                    // $faculty="'".strip_tags(add_slesh($_POST['faculty']))."'";
                    // $duty="'".strip_tags(add_slesh($_POST['duty']))."'";
                    // $passport="'".strip_tags(add_slesh($_POST['passport']))."'";
                    // $into="'".strip_tags(add_slesh($_POST['into']))."'";
                  
                    // if(isset($_POST['change'])){
                        $pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
                        $update="UPDATE `$category` SET `fullname`=".$fullname.", `faculty`=".$faculty.", `duty`=".$duty.", `passport`=".$passport.", `Kirgan_yili`=".$into." WHERE `fullname`=".$fullname."WHERE `passport`= $passport";
                        $queryUpdate=$pdo->prepare($update);
                        $queryUpdate->execute();
                        
                      
                // }
                // 
                //     if(isset($_POST['delete'])){
                //     $pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
                //     $delete="DELETE FROM `$category` WHERE `fullname`=" .$fullname;
                //     $queryDelete=$pdo->prepare($delete);
                //     $queryDelete->execute();
                //     var_dump($delete);
                //     }
                        ?>
            
                <?php endforeach; ?>
                </table>
                <?php endif;?>
            <?php endif;?>
        </div>
                
        <div class="tab-pane container" id="<?= $categories?>">..213.
        </div>
    
    </div>

        <script src="bootstrap-4.4.1-dist/js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap-4.4.1-dist/js/popper.js"></script>
        <script src="bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
    </body>
    </html>   
  
<?php endif;?>   
<?php if(!$_SESSION['block']) : ?>
    <h1><b>Доступ запрещен !</b></h1>
<?php endif; ?>  









  
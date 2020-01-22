<?php 
session_start();
require_once 'dompdf/autoload.inc.php';

$getPassportOrCategry =  explode(';', $_GET['path']);

$pdo=new PDO("mysql:host=localhost; dbname=information",'root','');
$sql="SELECT * FROM " . $getPassportOrCategry[1] . " WHERE passport LIKE " . "'" . $getPassportOrCategry[0] . "'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->fetch(PDO::FETCH_ASSOC);
$passpo=$_SESSION['passpo'];
$call = "SELECT max(ID) as id FROM TOKEN where passport LIKE '" . $passpo . "'";
$callQuery = $pdo-> prepare($call);
$callQuery -> execute();
$id = $callQuery->fetch(PDO::FETCH_ASSOC);

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$style = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
    <style>
        body {
            font-size: 18px;
            line-height: 23px;
        }

        .informationForm {
            padding: 40px 40px 20px 40px;
            background: url(./tdiuLogo.jpg) no-repeat center;
        }

        .head {
            display: flex;
        }

        .title {
            margin: auto;
            text-align: center;
            font-weight: 600;
        }

        .span {
            font-size: 15px;
            font-style: italic;
            text-align: center;
        }
        .span:last-child{
            text-align: right;
        }

        .date {
            font-weight: 600;
            text-align: right;
        }

        .inform-body {
            text-align: justify;
        }
        img {
            width: 90px;
        }
    </style>";
$page = $style;

switch ($getPassportOrCategry[1]) {
    case 'offer':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $row['passport'] . "- sonli OFFERMAN </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    case 'non_offer':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $id['id']. "- 6sonli NON_OFFERMAN </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    case 'student':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $_SESSION['passpo'] . "- sonli student </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    case 'non_student':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $row['passport'] . "- sonli NON-STUDENTMAN </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    case 'soldier_026':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $row['passport'] . "- sonli soldier_026 </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    case 'soldier_028':
        $page .= 
                "<body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <img src='./tdiu.jpg' class='small'>
                                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br>
                                        <div class='span'>O'zbekistion Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
                49-uy</div>
                                    </div>
                                </div>
                                <div class='body'>
                                    <div class='date'>2019-yil 10-yanvar</div><br>
                                    <div class='title'>" . $row['passport'] . "- sonli soldier_028man </div><br>
                                    <div class='inform-body'>Berildi <b>" . $row['fullname'] . " </b>ga shu
                                    haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti " . $row['faculty']  . " fakultetida bakalavriatning " . $row['course'] . " ta'lim yo'nalishi
                                    bo'yicha " . $row['course'] . "-kurs " . $row['group'] . " guruhida " . $row['price'] . " asosida tahsil olmoqda.

                            </div>
                        </div>
                </form>
                </body>
            </html>";
        break;
    

}



$dompdf -> loadHTML($page);
// $dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf ->setPaper('A4', 'landspace');
$dompdf ->render();

$dompdf->stream('information', array('Attachment'=>0));
?>

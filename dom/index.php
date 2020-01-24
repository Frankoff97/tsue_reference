<?php 
session_start();
require_once 'dompdf/autoload.inc.php';

$getCategoryOrPassport =  explode('/', $_GET['path']);

$pdo=new PDO('mysql:host=localhost; dbname=information','root','');
$sql="SELECT * FROM " . $_SESSION['category'] . " WHERE passport LIKE " . "'" . $getCategoryOrPassport[1] . "'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->fetch(PDO::FETCH_ASSOC);

$call = "SELECT * FROM token  where ID = (select max(ID) from token WHERE passport LIKE "."'" . $getCategoryOrPassport[1] . "'); ";
$callQuery = $pdo-> prepare($call);
$callQuery -> execute();
$token = $callQuery->fetch(PDO::FETCH_ASSOC);
use Dompdf\Dompdf;

$dompdf = new Dompdf(); 


$page = 
"<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            line-height: 23px;
            background: url('../img/lisence_bg1.png') no-repeat right top, url('../img/lisence_bg2.png') no-repeat right bottom;
        }
        .informationForm {
           padding: 1px 20px;
        }

        .head {
            margin-right: auto;
            display: flex;
            width: 60%;
        }
        .section {
            margin-top: 10px;
        }
        .image {
            width: 450px;
            padding-left: -20px;
        }
        .body .title {
            margin-top: 30px;
            text-transform: uppercase;
        }
        .inform-body {
            text-align: justify;
            margin-top: 30px;
        }
        .additional {
            margin: 30px;
            margin-bottom: 0;
            display: flex;
        }
        .add-right{
            margin-left: 270px;
        }
        .add-info {
            margin-top: -270px;
        }
        .qr-code img {
            width: 150px;
        }
    </style>
    <body>
                        <form action=''>
                            <div class='informationForm'>
                                <div class='head'>
                                    <div class='image'>
                                        <img src='../img/dom_logo.png' width='100%'>
                                    </div>
                                </div>
                                ";

    switch ($getCategoryOrPassport[0]) {
        case 'student':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'>Talaba <b>" . $row['fullname'] . "</b>ning  toshkent davlat iqtisodiyot universitetida o'qishi haqida ma'lumotnoma</div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                        Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan talaba Toshkent davlat iqtisodiyot universiteti talabasi ekanligini tasdiqlaymiz. Shuningdek, quyida ushbu talaba haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Talabaning F.I.Sh:</p>
                                                <p>Pasport raqami:</p>
                                                <p>Darajasi:</p>
                                                <p>O'qishga kirgan yili:</p>
                                                <p>Mutaxassisligi:</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>" . $row['fullname'] . "</b></p>
                                                <p><b>" . $row['passport'] . "</b></p>
                                                <p><b>" . $row['degree'] . "</b></p>
                                                <p><b>" . $row['kirgan_yili'] . "</b></p>
                                                <p><b>" . $row['direction'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'> <br><br><br>
                                        Ushbu talaba haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        case 'non_student':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'> " . $row['fullname'] . "ning toshkent davlat iqtisodiyot universitetida o'qiganligi haqida ma'lumotnoma</div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                        Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan shaxs Toshkent davlat iqtisodiyot universitetining  talabasi bo'lganligini tasdiqlaymiz. Shuningdek, quyida ushbu talaba haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Talabaning F.I.Sh:</p>
                                                <p>Pasport raqami:</p>
                                                <p>Darajasi:</p>
                                                <p>O'qishga kirgan yili:</p>
                                                <p>Bitirgan yili:</p>
                                                <p>Mutaxassisligi:</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>" . $row['fullname'] . "</b></p>
                                                <p><b>" . $row['passport'] . "</b></p>
                                                <p><b>" . $row['degree'] . "</b></p>
                                                <p><b>" . $row['kirgan_yili'] . "</b></p>
                                                <p><b>" . $row['ketgan_yili'] . "</b></p>
                                                <p><b>" . $row['direction'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'> <br>
                                        Ushbu bitirgan talaba haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.   
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        case 'offer':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'>" . $row['fullname'] . "ning toshkent davlat iqtisodiyot universitetida ishlashligi haqida ma'lumotnoma</div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                        Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan shaxs Toshkent davlat iqtisodiyot universiteti xodimi ekanligini tasdiqlaymiz. Shuningdek, quyida ushbu xodim haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Xodimning F.I.Sh.</p>
                                                <p>Pasport raqami</p>
                                                <p>Ishlayotgan kafedra,fakultet <br> yoki bo'lim nomi</p>
                                                <p>Lavozimi</p>
                                                <p>Ish boshlagan sanasi</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>:" . $row['fullname'] . "</b></p>
                                                <p><b>:" . $row['passport'] . "</b></p>
                                                <p><b>:" . $row['faculty']. "</b><br><br></p>
                                                <p><b>:" . $row['duty'] . "</b></p>
                                                <p><b>:" . $row['kirgan_yili'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'> <br> <br>
                                        Ushbu xodim haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.   
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        case 'non_offer':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'>" . $row['fullname'] . "ning toshkent davlat iqtisodiyot universitetida ishlaganligi haqida ma'lumotnoma</div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                        Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan shaxs Toshkent davlat iqtisodiyot universiteti xodimi bo'lganligini tasdiqlaymiz. Shuningdek, quyida ushbu xodim haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Xodimning F.I.Sh.</p>
                                                <p>Pasport raqami</p>
                                                <p>Ishlagan kafedra,fakultet <br> yoki bo'lim nomi</p>
                                                <p>Lavozimi</p>
                                                <p>Ish boshlagan sanasi</p>
                                                <p>Ish yakunlagan sanasi</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>:" . $row['fullname'] . "</b></p>
                                                <p><b>:" . $row['passport'] . "</b></p>
                                                <p><b>:" . $row['faculty']. "</b><br><br></p>
                                                <p><b>:" . $row['duty'] . "</b></p>
                                                <p><b>:" . $row['kirgan_yili'] . "</b></p>
                                                <p><b>:" . $row['ketgan_yili'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'>
                                            Ushbu sobiq xodim haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.   
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        case 'soldier_026':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'><b>" . $row['fullname'] . "</b>ning toshkent davlat iqtisodiyot universitetida o'qishi haqida ma'lumotnoma <b>(forma-26)</b></div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                    Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan talaba Toshkent davlat iqtisodiyot universiteti talabasi ekanligini tasdiqlaymiz. Shuningdek, quyida ushbu talaba haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Talabaningning F.I.Sh.</p>
                                                <p>Pasport raqami</p>
                                                <p>Mutaxassisligi</p>
                                                <p>Kursi</p>
                                                <p>Tug'ilgan sanasi</p>
                                                <p>Kirgan yili</p>
                                                <p>O'qishni yakunlash yili</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>:" . $row['fullname'] . "</b></p>
                                                <p><b>:" . $row['passport'] . "</b></p>
                                                <p><b>:" . $row['direction']. "</b><br></p>
                                                <p><b>:" . $row['course']. "</b><br></p>
                                                <p><b>:" . $row['born'] . "</b></p>
                                                <p><b>:" . $row['kirgan_yili'] . "</b></p>
                                                <p><b>:" . $row['ketgan_yili'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'>
                                            Ushbu talaba haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.   
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        case 'soldier_028':
            $page .= 
                    
                                    "<div class='section'>
                                    ID: <b>" . $token['id'] . "</b><br>
                                    Sana: <b>" . $_SESSION['currentime'] . "</b></Sana:>
                                </div>
                                <div class='body'>
                                    <div class='title'><b>" . $row['fullname'] . "</b>ning toshkent davlat iqtisodiyot universitetida o'qishi haqida ma'lumotnoma <b>(forma-26)</b></div>
                                    <hr border='5px solid blue'>
                                    <div class='inform-body'>
                                    Sizga shuni ma'lum qilamizki, yuqorida qayd etib o'tilgan talaba Toshkent davlat iqtisodiyot universiteti talabasi ekanligini tasdiqlaymiz. Shuningdek, quyida ushbu talaba haqida qo'shimcha ma'lumotlar keltirib o'tilgan:
                                        <div class='additional'>
                                            <div class='add-left'>
                                                <p>Talabaningning F.I.Sh :</p>
                                                <p>Pasport raqami:</p>
                                                <p>Mutaxassisligi:</p>
                                                <p>Kursi:</p>
                                                <p>Ta'lim asosi:</p>
                                                <p>Tug'ilgan sanasi:</p>
                                                <p>Kirgan yili:</p>
                                            </div>
                                            <div class='add-right'>
                                                <p><b>" . $row['fullname'] . "</b></p>
                                                <p><b>" . $row['passport'] . "</b></p>
                                                <p><b>" . $row['direction']. "</b><br></p>
                                                <p><b>" . $row['course']. "</b><br></p>
                                                <p><b>" . $row['price']. "</b></p>
                                                <p><b>" . $row['born'] . "</b></p>
                                                <p><b>" . $row['kirgan_yili'] . "</b></p>
                                              
                                            </div>
                                        </div>
                                        <div class='add-info'>
                                            Ushbu talaba haqida qo'shimcha ma'lumotlar kerak bo'lsa, (yagona darcha saytidan) qidirishingiz mumkin.   
                                        </div>
                                        <div class='qr-code'>
                                            <img src='../img/qr-rector.png' width='100%'>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </body>
                </html>";
        break;
        
       }

$dompdf -> loadHTML($page, 'UTF-8');
$dompdf ->setPaper('A4', 'landspace');
$dompdf ->render();

$dompdf->stream('information', array('Attachment'=>0));
?>
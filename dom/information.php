<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </style>

<body>
        <form action="">
            <div class="informationForm">
                <div class="head">
                    <img src="./tdiu.jpg" class="small">
                    <div class='title'>TOSHKENT DAVLAT IQTISOIYOT UNIVERSITETI<br><b>IQTISODIYOTDA AXBOROT TIZIMLARI
                            <br>FAKULTETI</b><br>
                        <div class="span"> <?= $_GET['id']?>Respublikasi, Toshkent shahri, Islom Karimov ko'chasi,
 49-uy</div>
                    </div>
                </div>
                <div class="body">
                    <div class="date">2019-yil 10-yanvar</div><br>
                    <div class="title">_______ - sonli MA'LUMOTNOMA </div><br>
                    <div class="inform-body">Berildi ___________________________________________________ ga shu
                        haqidaki, u haqiqatan ham Toshkent Davlat Iqtisodiyot Universiteti “Iqtisodiyotda axborot tizimlari” fakultetida bakalavriatning ________________________________________________ ta'lim yo'nalishi
                        bo'yicha _________ kurs _____________ guruhida ______________ asosida tahsil olmoqda. Ma'lumotnoma ___________________________________________ ga taqdim etish uchun berildi.
                    </div>
                    <b>
                        <div class="span">Ushbu ma'lumotnoma ishga kirish uchun taqdim etilmaydi.</div>
                    </b>

                </div>
            </div>
</form>
</body>
</html>
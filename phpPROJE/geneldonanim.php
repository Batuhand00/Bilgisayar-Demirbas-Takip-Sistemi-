<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genel/Donanım</title>
    <link rel="stylesheet" href="bilgisayardemirbas.css">
</head>
<body>
<?php
session_start();
require_once "giris.php";

$vt = @new mysqli('localhost', 'root', '', 'bilgisayardemisbas');
if ($vt->connect_error) {
    die("Bağlantı hatası :(" . $vt->connect_errorno . ")" . $vt->connect_error);
} else {
    $query = $vt->query("SELECT * FROM genel");
    if ($query) {
        $row = $query->fetch_assoc();
    } else {
        die("Veritabanı sorgusu başarısız oldu.");
    }

    $query1 = $vt->query("SELECT *, 'belirli_kriter' AS kriter FROM donanım");
    if ($query1) {
        $table1 = [];
        $table2 = [];

        while ($row1 = $query1->fetch_assoc()) {
            if ($row1['kriter'] === 'belirli_kriter') {
                $table1[] = $row1;
            } else {
                $table2[] = $row1;
            }
        }

    } else {
        die("Veritabanı sorgusu başarısız oldu.");
    }
}

if (isset($_POST['submit'])) {
    $Ad = $_POST['Ad'];
    $Soyad = $_POST['Soyad'];
    $SicilNo = $_POST['SicilNo'];
    $Unvan = $_POST['Unvan'];
    $Bolum = $_POST['Bolum'];
    $notlar = $_POST['notlar'];
    $Eposta = $_POST['Eposta'];
    $OdaNumarası = $_POST['OdaNumarası'];
    $isbaslamatarih = $_POST['isbaslamatarih'];

    $query = $vt->prepare("UPDATE genel SET Ad=?, Soyad=?, SicilNo=?, Unvan=?, Bolum=?, notlar=?, Eposta=?, OdaNumarası=?, isbaslamatarih=? WHERE SicilNo=?");
    $query->bind_param("ssssssssss", $Ad, $Soyad, $SicilNo, $Unvan, $Bolum, $notlar, $Eposta, $OdaNumarası, $isbaslamatarih, $SicilNo);
    $query->execute();
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = $vt->prepare("DELETE FROM genel WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
}


$vt->close();
?>
<section>
    <header>
        <h1>Genel</h1>
    </header>

    <section>
        <form action="" autocomplete="on" method="post">
            <label for="Ad">Ad:</label>
            <input type="text" name="Ad" size="30" maxlength="30" value="<?php echo $row['Ad']; ?>">
            <br>
            <label for="Soyad">Soyad:</label>
            <input type="text" name="Soyad" size="30" maxlength="30" value="<?php echo $row['Soyad']; ?>">
            <br>
            <label for="SicilNo">Sicil No:</label>
            <input type="text" name="SicilNo" size="30" maxlength="30" value="<?php echo $row['SicilNo']; ?>">
            <br>
            <label for="Unvan">Ünvan:</label>
            <select name="Unvan">
                <option><?php echo $row['Unvan']; ?></option>
            </select>
            <br>
            <label for="Bolum">Bölüm:</label>
            <select name="Bolum" >
                <option><?php echo $row['Bolum']; ?></option>
            </select>
            <br>
            <label for="notlar">Notlar:</label>
            <input type="text" name="notlar" size="50" maxlength="50" value="<?php echo $row['notlar']; ?>">
            <br>
            <label for="Eposta">E-posta:</label>
            <input type="text" name="Eposta" size="30" maxlength="30" value="<?php echo $row['Eposta']; ?>">
            <br>
            <label for="OdaNumarası">Oda Numarası:</label>
            <input type="text" name="OdaNumarası" size="30" maxlength="30" value="<?php echo $row['OdaNumarası']; ?>">
            <br>
            <label for="isbaslamatarih">İşe Başlama Tarihi:</label>
            <input type="text" name="isbaslamatarih" size="30" maxlength="30" value="<?php echo $row['isbaslamatarih']; ?>">
            <br>
            <button type="submit" name="submit">Kaydet</button>
        </form>
    </section>

</section>

<hr>

<section>
    <h3> Marka &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Model &nbsp;&nbsp;&nbsp; Açıklama &nbsp;&nbsp;&nbsp; Verildiği tarih</h3>
    <?php foreach ($table1 as $row1): ?>
        <fieldset>
            <form action="" method="post">
                
                <input type="text" size="15" value="<?php echo $row1['marka']; ?>">
                <input type="text" size="15" value="<?php echo $row1['model']; ?>">
                <input type="text" size="15" value="<?php echo $row1['aciklama']; ?>">
                <input type="text" size="15" value="<?php echo $row1['verildigitarih']; ?>">
                <button type="submit" name="delete">Sil</button>
            </form>
        </fieldset>
        <br>
    <?php endforeach; ?>

    <?php foreach ($table2 as $row2): ?>
        <fieldset>
            <form action="" method="post">
                
                <input type="text" size="15" value="<?php echo $row2['marka']; ?>">
                <input type="text" size="15" value="<?php echo $row2['model']; ?>">
                <input type="text" size="15" value="<?php echo $row2['aciklama']; ?>">
                <input type="text" size="15" value="<?php echo $row2['verildigitarih']; ?>">
                <button type="submit" name="delete">Sil</button>
            </form>
        </fieldset>
        <br>
    <?php endforeach; ?>

    <form action="kasabilgileri.php" method="post" target="_blank">
        <button type="submit">Kasa Bilgileri</button>
    </form>

</section>
</body>
</html>

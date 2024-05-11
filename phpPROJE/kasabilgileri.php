<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasa Bilgileri</title>
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
    $query = $vt->query("SELECT * FROM kasabilgi");
    if ($query) {
        $row = $query->fetch_assoc();
    } else {
        die("Veritabanı sorgusu başarısız oldu.");
    }
}
if (isset($_POST['submit'])) {
    $kasademirbasno = $_POST['Kasademirbasno'];
    $calisansicilno = $_POST['calisansicilno'];
    $isletimsistemi = $_POST['isletimsistemi'];
    $islemcimarkamodel = $_POST['islemcimarkamodel'];
    $Ram = $_POST['Ram'];
    $Sabitdisk = $_POST['Sabitdisk'];
    $ekrankartı = $_POST['ekrankartı'];
    $pcmodel = $_POST['pcmodel'];
    $islemcihiz = $_POST['islemcihiz'];
    $cekirdeksayi = $_POST['cekirdeksayi'];
    $monitörboyut = $_POST['monitörboyut'];

    $query = $vt->prepare("UPDATE kasabilgi SET kasademirbasno=?, sicilno=?, isletimsistemi=?, islemcimarka=?, ram=?, sabitdisk=?, ekrankartı=?, pcmodel=?, islemcihiz=?, cekirdeksayisi=?, monitorboyut=?");
    $query->bind_param("sssssssssss", $kasademirbasno, $calisansicilno, $isletimsistemi, $islemcimarkamodel, $Ram, $Sabitdisk, $ekrankartı, $pcmodel, $islemcihiz, $cekirdeksayi, $monitörboyut);

    $query->close();
    $vt->close();
}

if (isset($_POST['delete'])) {
    $kasademirbasno = $_POST['Kasademirbasno'];

    $query = $vt->prepare("DELETE FROM kasabilgi WHERE kasademirbasno = ?");
    $query->bind_param("s", $kasademirbasno);

}

?>
    

    <section>
    <header>
        <h1>Kasa Bilgileri</h1>
    </header>
        <form action="" autocomplete="on" method="post">
            <label for="Kasademirbasno">Kasa Demirbaş No:</label>
            <input type="text" name="Kasademirbasno" size="30" maxlength="30" value=" <?php echo $row['kasademirbasno']; ?>" >
            <br>
            <label for="calisansicilno">Çalışan Sicil No:</label>
            <input type="text" name="calisansicilno" size="30" maxlength="30" value=" <?php echo $row['sicilno']; ?>">
            <br>
            <label for="isletimsistemi">İşletim Sistemi :</label>
            <input type="text" name="isletimsistemi" size="30" maxlength="30" value=" <?php echo $row['isletimsistemi']; ?>">
            <br>
            <label for="islemcimarkamodel">İşlemci Marka Model :</label>
            <input type="text" name="islemcimarkamodel" size="30" maxlength="30" value="<?php echo $row['islemcimarka']; ?>">

            <br>
            <label for="Ram">Ram:</label>
            <input type="text" name="Ram" size="30" maxlength="30" value=" <?php echo $row['ram']; ?>">gb
            <br>
            <label for="Sabitdisk">Sabit Disk Kapasite:</label>
            <input type="text" name="Sabitdisk" size="30" maxlength="30" value=" <?php echo $row['sabitdisk']; ?>">gb
            <br>
            <label for="ekrankartı">Ekran Kartı:</label>
            <input type="text" name="ekrankartı" size="30" maxlength="30" value=" <?php echo $row['ekrankartı']; ?>">
            <br>
            <label for="pcmodel">PC Model:</label>
            <input type="text" name="pcmodel" size="30" maxlength="30" value=" <?php echo $row['pcmodel']; ?>">
            <br>
            <label for="islemcihiz">İşlemci Hızı:</label>
            <input type="text" name="islemcihiz" size="30" maxlength="30" value=" <?php echo $row['islemcihiz']; ?>">ghz
            <br>
            <label for="cekirdeksayi">Çekirdek Sayısı:</label>
            <input type="text" name="cekirdeksayi" size="30" maxlength="30" value=" <?php echo $row['cekirdeksayisi']; ?>">
            <br>
            <label for="monitörboyut">Monitör Boyutu:</label>
            <input type="text" name="monitörboyut" size="30" maxlength="30" value=" <?php echo $row['monitorboyut']; ?>">inç

            <br>

            <button type="submit" name="submit">Kaydet</button>
            <button type="submit" name="delete">Kaydı Sil</button>



        </form>
    </section>

  
    
</body>
</html>
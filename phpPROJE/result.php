<?php 
session_start();
require_once "giris.php"; 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $kullanici = test_input($_POST["kullanici"]);
    $sifre = test_input($_POST["sifre"]);
    
    //DATABASE BAĞLAMA 
    $vt = @new mysqli('localhost', 'root', '', 'bilgisayardemisbas');
    if($vt->connect_error){
        die("Bağlantı hatası :(" . $vt->connect_errorno . ")" . $vt->connect_error);
    }
    
    // Kullanıcı Kontrolü
    if(empty($kullanici) || empty($sifre))
    {
        echo "<h2>Lütfen formda boş yer bırakmayınız</h2>";
        geri(10);

    } else 
    {
        $query = $vt->prepare("SELECT * FROM giris WHERE kullanici = ?");
        $query->bind_param("s", $kullanici);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($sifre, $row["sifre"])) {
                echo "<h2>Şifre yanlış</h2>";
                geri(2);
            } else {
                session_regenerate_id(true);
                $_SESSION["LogedIn"] = true;
                $_SESSION["kullanici"] = $kullanici;
                $_SESSION["LoginIP"] = $_SERVER["REMOTE_ADDR"];
                $_SESSION["UserAgent"] = $_SERVER["HTTP_USER_AGENT"];
                ileri("geneldonanim.php", 1);
               
            }
        } else {
            echo "<h2>Kullanıcı bulunamadı</h2>";
            geri(2);
        }
        
      
    }
}

?>

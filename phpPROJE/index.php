<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="bilgisayardemirbas.css">
</head>
<body>
  
    <section>
    <header >
        <h1>KULLANICI GİRİŞİ</h1>
    </header>
        <form method="post" action="result.php" autocomplete="on" >
            <div>
              <label for="kullanici" >Kullanıcı Adı :</label>
              
              <div class="col-sm-10">
                <input type="text" id="kullanici" name="kullanici" placeholder="Kullanıcı Adı">
              </div>
            </div>
            <div >
                <label for="sifre" >Şifre :</label>
                <div >
                  <input type="password"  id="sifre" name ="sifre" placeholder="Şifre">
                </div>
              </div>
        </section>
    
    <section>
        <button type="submit"> Giriş</button>
    </section>
  </form>
   
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isim = trim($_POST["isim"]);
    $soyisim = trim($_POST["soyisim"]);
    $email = trim($_POST["email"]);
    $sifre = trim($_POST["sifre"]);
    $dogumTarihi = trim($_POST["dogum_tarihi"]);
    $cinsiyet = trim($_POST["cinsiyet"]);

    $errors = [];

    if (empty($isim) || empty($soyisim) || empty($email) || empty($sifre) || empty($dogumTarihi) || empty($cinsiyet)) {
        $errors[] = "Tüm alanlar doldurulmalıdır.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Geçersiz e-posta formatı.";
    }

    if (strlen($sifre) < 6) {
        $errors[] = "Şifre en az 6 karakter olmalıdır.";
    }

    if (empty($errors)) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "kullanici_veritabani";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT COUNT(*) FROM kullanicilar WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                $errors[] = "Bu e-posta adresi zaten kayıtlı.";
            } else {
                $stmt = $conn->prepare("INSERT INTO kullanicilar (isim, soyisim, email, sifre, dogum_tarihi, cinsiyet) VALUES (:isim, :soyisim, :email, :sifre, :dogum_tarihi, :cinsiyet)");
                $stmt->bindParam(':isim', $isim);
                $stmt->bindParam(':soyisim', $soyisim);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':sifre', $sifre);
                $stmt->bindParam(':dogum_tarihi', $dogumTarihi);
                $stmt->bindParam(':cinsiyet', $cinsiyet);

                $stmt->execute();
                echo "Kayıt başarılı!";
            }
        } catch(PDOException $e) {
            echo "Hata: " . $e->getMessage();
        }
        
        $conn = null;
    } else {
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
    }
}
?>

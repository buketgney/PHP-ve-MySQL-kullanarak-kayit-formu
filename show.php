<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kullanici_veritabani";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT id, isim, soyisim, email FROM kullanicilar");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Kullanıcı Listesi</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>İsim</th><th>Soyisim</th><th>Email</th></tr>";
?>
    <form action="form.php" method="get">
        <button type="submit">Ana Sayfaya Git</button>
    </form>
<?php
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['isim'] . "</td>";
        echo "<td>" . $row['soyisim'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} catch(PDOException $e) {
    echo "Hata: " . $e->getMessage();
}

$conn = null;
?>

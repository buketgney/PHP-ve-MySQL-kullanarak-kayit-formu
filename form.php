<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Formu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .form-container {
            display: inline-block;
            text-align: left;
            margin-top: 50px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 400px;
        }
        table tr td {
            padding: 10px;
        }
        input[type="text"], input[type="password"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            box-sizing: border-box;
        }
        input[type="submit"], .user-list-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover, .user-list-btn:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function validateForm() {
            var isim = document.forms["registerForm"]["isim"].value;
            var soyisim = document.forms["registerForm"]["soyisim"].value;
            var email = document.forms["registerForm"]["email"].value;
            var sifre = document.forms["registerForm"]["sifre"].value;
            var dogumTarihi = document.forms["registerForm"]["dogum_tarihi"].value;
            var cinsiyet = document.forms["registerForm"]["cinsiyet"].value;

            if (isim == "" || soyisim == "" || email == "" || sifre == "" || dogumTarihi == "" || cinsiyet == "") {
                alert("Tüm alanlar doldurulmalıdır.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Geçersiz e-posta formatı.");
                return false;
            }

            if (sifre.length < 6) {
                alert("Şifre en az 6 karakter olmalıdır.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h2>Kayıt Formu</h2>
    <div class="form-container">
        <form name="registerForm" action="register.php" onsubmit="return validateForm()" method="post">
            <table>
                <tr>
                    <td>İsim:</td>
                    <td><input type="text" name="isim"></td>
                </tr>
                <tr>
                    <td>Soyisim:</td>
                    <td><input type="text" name="soyisim"></td>
                </tr>
                <tr>
                    <td>E-posta:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Şifre:</td>
                    <td><input type="password" name="sifre"></td>
                </tr>
                <tr>
                    <td>Doğum Tarihi:</td>
                    <td><input type="date" name="dogum_tarihi"></td>
                </tr>
                <tr>
                    <td>Cinsiyet:</td>
                    <td>
                        <select name="cinsiyet">
                            <option value="">Seçiniz</option>
                            <option value="Erkek">Erkek</option>
                            <option value="Kadın">Kadın</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Kayıt Ol"></td>
                </tr>
            </table>
        </form>
        <form action="show.php" method="get">
            <button class="user-list-btn" type="submit">Kullanıcı Listesine Git</button>
        </form>
    </div>
</body>
</html>

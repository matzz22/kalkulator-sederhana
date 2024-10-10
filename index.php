<!DOCTYPE html>
<html>

<head>
    <title>Kalkulator</title>
    <style>
        body {
            background: #F2F2F2;
        }

        .kal {
            width: 350px;
            height: 660px;
            border: 1px solid black;
            margin: 80px auto;
            padding: 10px;
            border-radius: 10px;
            background-color: black;
        }

        h1 {
            text-align: center;
            color: white;
        }

        .FormInput {
            padding: 10px;
            display: block;
            width: 94%;
            font-size: 15px;
            border-radius: 5px;
            border: none;
        }

        .FormSelect {
            padding: 10px;
            display: block;
            width: 100%;
            font-size: 15px;
            border-radius: 5px;
            border: none;
            font-weight: bold;
        }

        .FormHasil {
            margin-top: 10px;
            padding: 30px 10px;
            display: block;
            width: 94%;
            font-size: 30px;
            border-radius: 5px;
            border: none;
            background-color: white;
            color: black;
            text-align: center;
        }

        .StarBox {
            margin-top: 10px;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 94%;
            height: 150px;
            border-radius: 5px;
            border: none;
            background-color: white;
            color: black;
            text-align: center;
            font-size: 20px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        button {
            padding: 10px;
            font-weight: bold;
            margin-top: 10px;
            width: 100%;
            font-size: 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }

        p {
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }
    </style>

</head>

<body>
    <?php
    $hasil = 0;
    $stars = '';

    function is_prime($num)
    {
        if ($num <= 1)
            return false;
        if ($num <= 3)
            return true;
        if ($num % 2 == 0 || $num % 3 == 0)
            return false;
        for ($i = 5; $i * $i <= $num; $i += 6) {
            if ($num % $i == 0 || $num % ($i + 2) == 0)
                return false;
        }
        return true;
    }

    if (isset($_POST['kirim'])) {
        $bil1 = $_POST['bil1'];
        $bil2 = $_POST['bil2'];
        $aksi = $_POST['aksi'];
        switch ($aksi) {
            case 'tambah':
                $hasil = $bil1 + $bil2;
                break;
            case 'kurang':
                $hasil = $bil1 - $bil2;
                break;
            case 'kali':
                $hasil = $bil1 * $bil2;
                break;
            case 'bagi':
                if ($bil2 != 0) {
                    $hasil = $bil1 / $bil2;
                } else {
                    $hasil = 0;
                }
                break;
        }

        // Add the first star if hasil is greater than 0
        if ($hasil > 0) {
            $stars .= "*" . "<br>";
            $hasil--;  // Reduce hasil by 1 to account for the initial star
        }

        // Generate stars in a prime number sequence
        $num = 2;
        $primeCount = 0;
        while ($primeCount < $hasil) {
            if (is_prime($num)) {
                $stars .= str_repeat("* ", $num) . "<br>";
                $primeCount++;
            }
            $num++;
        }
    }
    ?>

    <form method="POST">
        <div class="kal">
            <h1>Kalkulator Sederhana</h1>
            <hr>
            <p>Bilangan Pertama :</p>
            <input class="FormInput" type="number" name="bil1" value="0">
            <p>Bilangan Kedua :</p>
            <input class="FormInput" type="number" name="bil2" value="0">
            <p>Aksi</p>
            <select class="FormSelect" name="aksi">
                <option value="tambah">Tambah (+)</option>
                <option value="kurang">Kurang (-)</option>
                <option value="kali">Kali (X)</option>
                <option value="bagi">Bagi (/)</option>
            </select>
            <button type="submit" name="kirim">Hitung</button>
            <input class="FormHasil" type="number" value="<?= $hasil + 1 ?>" readonly>
            <div class="StarBox"><?= $stars ?></div>
        </div>
    </form>
</body>

</html>
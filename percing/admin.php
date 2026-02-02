<?php
session_start();

// --- KONFIGURACJA ---
$haslo = "Severus2024"; // USTAW TU TRUDNE HASŁO!
$plik_danych = 'dane.json';
// --------------------

// Wylogowanie
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Logowanie
if (isset($_POST['password'])) {
    if ($_POST['password'] === $haslo) {
        $_SESSION['logged_in'] = true;
    } else {
        $error = "Błędne hasło!";
    }
}

// Zapisywanie zmian
if (isset($_POST['save']) && isset($_SESSION['logged_in'])) {
    // Pobieramy stare dane, żeby zachować strukturę
    $nowe_dane = [];
    foreach ($_POST as $klucz => $wartosc) {
        if($klucz != 'save') {
            $nowe_dane[$klucz] = htmlspecialchars($wartosc);
        }
    }
    file_put_contents($plik_danych, json_encode($nowe_dane, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $success = "Zapisano zmiany!";
}

// Odczyt aktualnych danych do formularza
$aktualne_dane = json_decode(file_get_contents($plik_danych), true);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Edycji - Severus</title>
    <style>
        body { font-family: sans-serif; background: #222; color: #fff; padding: 50px; }
        .box { background: #333; max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 8px; box-shadow: 0 0 20px rgba(0,0,0,0.5); }
        input[type="text"], textarea { width: 100%; padding: 10px; margin: 10px 0 20px; background: #444; border: 1px solid #555; color: white; }
        label { font-weight: bold; color: #bf00ff; }
        button { background: #bf00ff; color: white; padding: 10px 20px; border: none; cursor: pointer; font-size: 1.1em; }
        .msg { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .error { background: #ff4444; }
        .success { background: #00C851; }
    </style>
</head>
<body>

<div class="box">
    <?php if (!isset($_SESSION['logged_in'])): ?>
        <h2>Zaloguj się</h2>
        <?php if(isset($error)) echo "<div class='msg error'>$error</div>"; ?>
        <form method="post">
            <input type="password" name="password" placeholder="Podaj hasło" required>
            <button type="submit">Wejdź</button>
        </form>

    <?php else: ?>
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h2>Edycja Treści</h2>
            <a href="?logout=1" style="color:#aaa; text-decoration:none;">Wyloguj [x]</a>
        </div>

        <?php if(isset($success)) echo "<div class='msg success'>$success</div>"; ?>
        
        <form method="post">
            <?php foreach ($aktualne_dane as $klucz => $wartosc): ?>
                <label><?php echo ucfirst(str_replace('_', ' ', $klucz)); ?></label>
                <input type="text" name="<?php echo $klucz; ?>" value="<?php echo $wartosc; ?>">
            <?php endforeach; ?>
            
            <button type="submit" name="save">ZAPISZ ZMIANY</button>
        </form>
        <p style="margin-top:20px;"><a href="index.php" target="_blank" style="color:white;">Zobacz stronę &rarr;</a></p>
    <?php endif; ?>
</div>

</body>
</html>

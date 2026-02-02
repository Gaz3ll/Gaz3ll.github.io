<?php
// 1. Pobieramy dane z pliku JSON
$plik_danych = 'dane.json';
if (file_exists($plik_danych)) {
    $json_data = file_get_contents($plik_danych);
    $dane = json_decode($json_data, true);
} else {
    // Dane domyślne, gdyby plik zniknął (zabezpieczenie)
    $dane = [
        "naglowek_strony" => "Cennik",
        "ogloszenie_tekst" => "",
        "cena_lobe" => "...",
        "cena_helix" => "...",
        "cena_nostril" => "...",
        "cena_navel" => "...",
        "cena_tongue" => "...",
        "cena_wymiana" => "..."
    ];
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Oferta - Severus INK</title>
    <style>
        body { background-color: #050505; color: #fff; font-family: 'Verdana', sans-serif; margin: 0; }
        :root { --neon: #bf00ff; --alert: #ff0055; }
        
        /* Menu */
        nav { padding: 20px 40px; border-bottom: 2px solid var(--neon); background: #000; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.8em; font-weight: 900; color: #fff; text-shadow: 0 0 10px var(--neon); text-decoration: none; }
        .menu a { color: #ccc; margin-left: 25px; text-decoration: none; text-transform: uppercase; font-size: 0.85em; transition: 0.3s; }
        .menu a:hover { color: var(--neon); }

        /* Kontener */
        .container { max-width: 800px; margin: 50px auto; padding: 20px; }
        
        /* Alert / Ogłoszenie (Dynamiczne) */
        .announcement {
            border: 1px solid var(--neon);
            background: rgba(191, 0, 255, 0.1);
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(191, 0, 255, 0.2);
        }

        /* Lista Cen */
        .price-list { list-style: none; padding: 0; }
        .price-item { display: flex; justify-content: space-between; border-bottom: 1px solid #333; padding: 20px 0; transition: 0.3s; }
        .price-item:hover { border-color: var(--neon); padding-left: 10px; padding-right: 10px; background: #111; }
        
        .service { font-size: 1.2em; font-weight: bold; }
        .note { font-size: 0.8em; color: #666; margin-top: 5px; }
        
        /* Cena (Dynamiczna) */
        .price { color: var(--neon); font-size: 1.2em; font-weight: bold; text-shadow: 0 0 5px var(--neon); }

        /* Footer */
        footer { text-align: center; padding: 20px; color: #444; font-size: 0.8em; border-top: 1px solid #222; margin-top: 50px; }
    </style>
</head>
<body>

<nav>
    <a href="index.html" class="logo">SEVERUS INK</a>
    <div class="menu">
        <a href="onas.html">Studio & Ekipa</a>
        <a href="oferta.php" style="color:var(--neon)">Cennik</a>
        <a href="zalecenia.html">Zalecenia</a>
        <a href="kontakt.html">Rezerwacja</a>
        <a href="../index.html">EXIT</a>
    </div>
</nav>

<div class="container">
    
    <h2 style="color: var(--neon); text-align: center; margin-bottom: 40px;">
        <?php echo $dane['naglowek_strony']; ?>
    </h2>

    <?php if (!empty($dane['ogloszenie_tekst']) && $dane['pokazuj_ogloszenie'] == 'tak'): ?>
        <div class="announcement">
            📢 <strong>INFO:</strong> <?php echo $dane['ogloszenie_tekst']; ?>
        </div>
    <?php endif; ?>

    <ul class="price-list">
        <li class="price-item">
            <div>
                <div class="service">Ucho - Płatek (Lobe)</div>
                <div class="note">Cena zawiera podstawową biżuterię tytanową</div>
            </div>
            <div class="price"><?php echo $dane['cena_lobe']; ?></div>
        </li>

        <li class="price-item">
            <div>
                <div class="service">Ucho - Chrząstka (Helix/Tragus)</div>
            </div>
            <div class="price"><?php echo $dane['cena_helix']; ?></div>
        </li>

        <li class="price-item">
            <div>
                <div class="service">Nos (Nostril/Septum)</div>
            </div>
            <div class="price"><?php echo $dane['cena_nostril']; ?></div>
        </li>

        <li class="price-item">
            <div>
                <div class="service">Pępek (Navel)</div>
            </div>
            <div class="price"><?php echo $dane['cena_navel']; ?></div>
        </li>

        <li class="price-item">
            <div>
                <div class="service">Język (Tongue)</div>
            </div>
            <div class="price"><?php echo $dane['cena_tongue']; ?></div>
        </li>

        <li class="price-item">
            <div>
                <div class="service">Wymiana biżuterii (z twoją ozdobą)</div>
            </div>
            <div class="price"><?php echo $dane['cena_wymiana']; ?></div>
        </li>
    </ul>

</div>

<footer>
    &copy; 2023 Severus Ink. <br> 
    <a href="admin.php" style="color: #222; text-decoration: none;">Admin Login</a>
</footer>

</body>
</html>

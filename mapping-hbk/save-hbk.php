<?php
$baseDir = __DIR__ . '/../';
$uploadDir = $baseDir . 'uploads-hbk/';
$storageFile = $baseDir . 'hbk-data.json';


$text = trim($_POST['text'] ?? '');
$textarea = trim($_POST['textarea'] ?? '');
$openAnswer = trim($_POST['open_answer'] ?? '');
$choices = $_POST['choices'] ?? [];
$x = floatval($_POST['x'] ?? 0);
$y = floatval($_POST['y'] ?? 0);


if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


$imageFile = null;
if (!empty($_FILES['image']['name'])) {
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'heic'];
    if (in_array($ext, $allowed)) {
        $fileName = time() . '-' . rand(1000, 9999) . '.' . $ext;
        $uploadPath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $imageFile = $fileName;
        }
    }
}


function interpretRotationAngle1(int $angle): string {
    if ($angle > 0 && $angle < 90) return 'auffällig / privat';
    if ($angle > 90 && $angle < 180) return 'unauffällig / privat';
    if ($angle > 180 && $angle < 270) return 'öffentlich / unauffällig';
    if ($angle > 270 && $angle < 360) return 'öffentlich / auffällig';
    switch ($angle) {
        case 0: return 'auffällig';
        case 90: return 'privat';
        case 180: return 'unauffällig';
        case 270: return 'öffentlich';
        default: return 'unbekannt';
    }
}

function interpretRotationAngle2(int $angle): string {
    if ($angle > 0 && $angle < 90) return 'störend / leicht zu ersetzen';
    if ($angle > 90 && $angle < 180) return 'unauffällig / leicht zu ersetzen';
    if ($angle > 180 && $angle < 270) return 'unauffällig / notwendig';
    if ($angle > 270 && $angle < 360) return 'störend / notwendig';
    switch ($angle) {
        case 0: return 'störend';
        case 90: return 'leicht zu ersetzen';
        case 180: return 'unauffällig';
        case 270: return 'notwendig';
        default: return 'unbekannt';
    }
}

function interpretRotationAngle3(int $angle): string {
    if ($angle > 0 && $angle < 90) return 'Problem / warm';
    if ($angle > 90 && $angle < 180) return 'Problemlösung / warm';
    if ($angle > 180 && $angle < 270) return 'Problemlösung / kalt';
    if ($angle > 270 && $angle < 360) return 'Problem / kalt';
    switch ($angle) {
        case 0: return 'Problem';
        case 90: return 'warm';
        case 180: return 'Problemlösung';
        case 270: return 'kalt';
        default: return 'unbekannt';
    }
}

function interpretRotationAngle4(int $angle): string {
    if ($angle > 0 && $angle < 90) return 'kommt / beeinflusst';
    if ($angle > 90 && $angle < 180) return 'geht / beeinflusst';
    if ($angle > 180 && $angle < 270) return 'geht / autonom';
    if ($angle > 270 && $angle < 360) return 'kommt / autonom';
    switch ($angle) {
        case 0: return 'kommt';
        case 90: return 'beeinflusst';
        case 180: return 'geht';
        case 270: return 'autonom';
        default: return 'unbekannt';
    }
}


$angleMap = [
    'A' => 'rotationAngle1',
    'B' => 'rotationAngle2',
    'C' => 'rotationAngle3',
    'D' => 'rotationAngle4'
];


$data = [
    'text' => $text,
    'textarea' => $textarea,
    'image' => $imageFile,
    'choices' => $choices,
    'open_answer' => $openAnswer,
    'x' => $x,
    'y' => $y,
    'rotationAngleA' => null,
    'rotationTextA'  => null,
    'rotationAngleB' => null,
    'rotationTextB'  => null,
    'rotationAngleC' => null,
    'rotationTextC'  => null,
    'rotationAngleD' => null,
    'rotationTextD'  => null,
    'timestamp' => date('Y-m-d H:i:s')
];


foreach ($angleMap as $key => $inputName) {
    if (isset($_POST[$inputName]) && is_numeric($_POST[$inputName])) {
        $angle = (int) $_POST[$inputName];

        $data['rotationAngle' . $key] = $angle;

        switch ($key) {
            case 'A':
                $rotationText = interpretRotationAngle1($angle);
                break;
            case 'B':
                $rotationText = interpretRotationAngle2($angle);
                break;
            case 'C':
                $rotationText = interpretRotationAngle3($angle);
                break;
            case 'D':
                $rotationText = interpretRotationAngle4($angle);
                break;
            default:
                $rotationText = 'unbekannt';
        }

        $data['rotationText' . $key] = $rotationText;
    }
}


if (file_exists($storageFile)) {
    $allData = json_decode(file_get_contents($storageFile), true);
} else {
    $allData = [];
}


$allData[] = $data;


file_put_contents($storageFile, json_encode($allData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));


echo '<link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />';
echo '<link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />';
echo '<link rel="shortcut icon" href="../favicon/favicon.ico" />';
echo '<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />';
echo '<meta name="apple-mobile-web-app-title" content="zeichensaal.xyz" />';
echo '<link rel="manifest" href="../favicon/site.webmanifest" />';
echo '<link rel="stylesheet" href="../stylesheets/var.css">';
echo '<link rel="stylesheet" href="../stylesheets/tool.css">';
echo '<link rel="stylesheet" href="../stylesheets/feedback.css">';
echo '<header>
        <div class="logo">Documenting</div>
        <div class="menu">
      <a href="../startseite.html" target="_blank">About |</a>
      <a href="../demo-hbk.php" target="_blank">HBK Map</a>
        </div>
        <div class="menubutton">
        <img src="../menu.svg" alt="">
        <p class="x">X</p>
        </div>
        </header>';
echo '<div class="menumobil">
      <a href="../startseite.html" target="_blank">About</a>
      <a href="../demo-hbk.php" target="_blank">HBK Map</a>
  <div class="close"></div>
</div>';
echo '<div class="layout_seite">
        <div class="layout_text">
            <div class="upload">
                <p> Erfolgreich hochgeladen! </p>
            </div>
            <div class="optionen">
            <p><a href="tool-hbk.php"> Weiterer Eintrag </a> | <a href="../demo-hbk.php"> Sammlung anzeigen </a></p>
            </div>
        </div>
    </div>';
echo ' <script>
    document.addEventListener("DOMContentLoaded", () => {
    const menuButton   = document.querySelector(".menubutton");
    const menuImg      = document.querySelector(".menubutton img");
    const closeBtn     = document.querySelector(".x");
    const closeArea    = document.querySelector(".close");
    const menuMobil    = document.querySelector(".menumobil");

    menuButton.addEventListener("click", () => {
        menuMobil.style.display = "flex";
        menuImg.style.display    = "none";
        closeBtn.style.display   = "block";
    });

    const closeMenu = (e) => {
        e.stopPropagation();
        menuMobil.style.display = "none";
        menuImg.style.display    = "block";
        closeBtn.style.display   = "none";
    };
    closeBtn.addEventListener("click", closeMenu);
    if (closeArea) closeArea.addEventListener("click", closeMenu);
    });
    </script>'
?>
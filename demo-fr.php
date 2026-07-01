<?php

$storageFile = 'frankfurt.json';
$uploadDir   = 'uploads/';
$allData     = [];

if (file_exists($storageFile)) {
    $json = file_get_contents($storageFile);
    $allData = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON-Fehler: ' . json_last_error_msg());
    }
}

usort($allData, fn($a, $b) =>
    strtotime($b['timestamp'] ?? 0) <=> strtotime($a['timestamp'] ?? 0)
);

?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Mapping</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="stylesheets/demo.css">
<link rel="stylesheet" href="stylesheets/var.css">
<link rel="stylesheet" href="stylesheets/demo-fr.css">



</head>

<body>

<header>
    <div class="logo">Mapping</div>
    <div class="menu">
        <a href="/mapping_frankfurt/tool.php" target="_blank">Tool</a>
        <a href="/mapping_frankfurt/abstract.html">| Abstract</a>
    </div>

    <div class="menubutton">
      <img src="../menu.svg" alt="">
      <p class="x">X</p>
    </div>
    
</header>

<div class="menumobil">
      <a href="/mapping_frankfurt/tool.php" target="_blank">Tool</a>
      <a href="abstract.html" target="_blank">Abstract</a>
  <div class="close"></div>
</div>

<div class="gallery">

<?php foreach ($allData as $item):

    $img = $uploadDir . ($item['image'] ?? '');

    $choice = strtoupper($item['choices'][0] ?? '');
    $choiceClass = $choice ? "choice-$choice" : '';

    $labels  = $item['choice_labels'] ?? [];
    $choices = $item['choices'] ?? [];
?>
    <div class="tile farbe<?= $choiceClass ?>"
         data-image="<?= htmlspecialchars($img) ?>"
         data-text="<?= htmlspecialchars($item['text'] ?? '') ?>"
         data-textarea="<?= htmlspecialchars($item['textarea'] ?? '') ?>"
         data-x="<?= htmlspecialchars($item['x'] ?? '') ?>"
         data-y="<?= htmlspecialchars($item['y'] ?? '') ?>"
         data-timestamp="<?= htmlspecialchars($item['timestamp'] ?? '') ?>"
         data-labels='<?= htmlspecialchars(json_encode($labels), ENT_QUOTES, "UTF-8") ?>'
         data-choices='<?= htmlspecialchars(json_encode($choices), ENT_QUOTES, "UTF-8") ?>'>

        <img src="<?= htmlspecialchars($img) ?>" alt="">

        <?php
        $choiceClasses = [];
        foreach ($labels as $i => $label) {
        $c = $choices[$i] ?? ($choices[0] ?? '');
        if ($c) {
        $choiceClasses[] = "choice-" . strtoupper($c);}}
        $choiceClassString = implode(' ', array_unique($choiceClasses));
        ?>

        <div class="tile-tags farbe <?= $choiceClassString ?>"></div>

    </div>
<?php endforeach; ?>

</div>

<div class="overlay" id="overlay">
    <button class="overlay-close" id="ov-close">< back</button>


    <div class="overlay-inner">

        <div class="ov-img-container">
            <img class="overlay-img" id="ov-img">
        </div>

        <div class="meta">
            <div id="ov-text"></div>
            <div class="tags" id="ov-tags"></div>
            <div id="ov-textarea"></div>
        </div>
        <div class="karte">
            <div class="map">
                <svg viewBox="0 0 100 100">
                <image href="mapborder.svg" width="100" height="100"/>
                <circle id="ov-point" cx="0" cy="0" r="1.5"></circle>
                </svg>
            </div>
            <div class="timestamp" id="ov-time"></div>
        </div>

        <div class="space"></div>

    </div>
</div>

<script>
const tiles = document.querySelectorAll('.tile');
const overlay = document.getElementById('overlay');

const ovImg = document.getElementById('ov-img');
const ovText = document.getElementById('ov-text');
const ovTextarea = document.getElementById('ov-textarea');
const ovTime = document.getElementById('ov-time');
const ovPoint = document.getElementById('ov-point');
const ovTags = document.getElementById('ov-tags');

function closeOverlay(){
    overlay.classList.remove('open');
}

tiles.forEach(t => {
    t.addEventListener('click', () => {

        ovImg.src = t.dataset.image;
        ovText.textContent = t.dataset.text;
        ovTextarea.textContent = t.dataset.textarea;
        ovTime.textContent = t.dataset.timestamp;

        ovPoint.setAttribute('cx', t.dataset.x || 0);
        ovPoint.setAttribute('cy', t.dataset.y || 0);

        const choices = JSON.parse(t.dataset.choices || "[]");
        const labels  = JSON.parse(t.dataset.labels || "[]");

        ovPoint.className.baseVal = "";
        const first = (choices[0] || "").toUpperCase();
        if (first) ovPoint.classList.add("choice-" + first);

        ovTags.innerHTML = "";

        labels.forEach((label, i) => {
            const c = (choices[i] || choices[0] || "").toUpperCase();

            const el = document.createElement("span");
            el.className = "tag choice-" + c;
            el.textContent = label;

            ovTags.appendChild(el);
        });

        overlay.classList.add('open');
    });
});

document.getElementById('ov-close').addEventListener('click', closeOverlay);

overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeOverlay();
});


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
</script>

</body>
</html>
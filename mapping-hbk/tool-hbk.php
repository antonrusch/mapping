<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Workshop Tool Projekt 3</title>
  <link rel="icon" type="image/png" href="../favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="../favicon/favicon.svg" />
  <link rel="shortcut icon" href="../favicon/favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png" />
  <meta name="apple-mobile-web-app-title" content="zeichensaal.xyz" />
  <link rel="manifest" href="../favicon/site.webmanifest" />
  <link rel="stylesheet" href="../stylesheets/var.css">
  <link rel="stylesheet" href="../stylesheets/tool-hbk.css">
  <script src="../propeller.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/heic2any/dist/heic2any.min.js"></script>


</head>

<body>

<header>
    <div class="logo">Mapping Computer</div>
    <div class="menu">
      <a href="../startseite.html" target="_blank">About |</a>
      <a href="../demo-hbk.php" target="_blank">HBK Map</a>
    </div>

    <div class="menubutton">
      <img src="../menu.svg" alt="">
      <p class="x">X</p>
    </div>
</header>

<div class="menumobil">
      <a href="../startseite.html" target="_blank">About</a>
      <a href="../demo-hbk.php" target="_blank">HBK Map</a>
  <div class="close"></div>
</div>

<div class="layoutseite">

<form action="save-hbk.php" method="POST" enctype="multipart/form-data" class="form1">

    <div class="layout">

    <div class="intro">
      <p class="introtext farbe">
       Location: HBK Campus</p>
    </div>


    <div class="form-group">
      <div class="options">
        <div class="option">
          <input type="radio" name="choices[]" value="A" id="choiceA" checked />
          <label for="choiceA">Infrastruktur</label>
        </div>
        <div class="option">
          <input type="radio" name="choices[]" value="B" id="choiceB" />
          <label for="choiceB">Werkzeug</label>
        </div>
        <div class="option">
          <input type="radio" name="choices[]" value="C" id="choiceC" />
          <label for="choiceC">Wetter</label>
        </div>
        <div class="option">
          <input type="radio" name="choices[]" value="D" id="choiceD" />
          <label for="choiceD">Natur</label>
        </div>
      </div>

      <div class="beschreibung">
        <p class="farbetext">Erklärungen <br> <br>
        Infrastuktur <br>
        Beschreibt alle festen Installationen des Menschen – dazu sollen hier nicht nur Straßen, Gebäude oder Leitungen zählen. Alle fest installierten oder dauerhaft platzierten Objekte des Menschen können hier dokumentiert werden. Sei es der Trampelpfad, der Zaun oder die längst vergessene Mülldeponie unter unseren Füßen – diese Kategorie vereint alles, was das, was einmal zur Umwelt zählte, nun in das System des Menschen überträgt.<br> <br>
        Werkzeuge <br>
        Sind der verlängerte Arm des Menschen. Sie werden genutzt um Infrastrukturen zu schaffen oder sie im Betrieb zu halten. Sei es die Wetterstation, die essentielle Daten liefert oder das Schneeräumfahrzeug, das die Infrastruktur zugänglich hält – sie alle helfen dem Menschen seine Ambitionen zu realisieren. Im Kontext menschlicher Eingriffe in die Umwelt spielen Werkzeuge die wesentliche Rolle im Umgang mit der Extraktion von Ressourcen.
        <br> <br> 
        Wetter <br>
        Unter dem Begriff soll hier nicht direkt das Wetter dokumentiert werden, stattdessen sollen dessen Abdrücke – seien es Schneeverwehungen, vom Wind verwehte Objekte oder warme Lichtungen im Wald – zusammengetragen ergeben sie ein Bild von dem, wie das Wetter mit der Natur, den Infrastrukturen und Werkzeugen interagiert.
        <br> <br>
        Natur <br>
        Wie auch immer sich die Natur für einen persönlich zu erkennen gibt, kann hier dokumentiert werden. Sei es das Gras, was sich aus dem brüchigen Asphalt hervor kämpft oder die Struktur des Waldes am Horizont. Aus dem gesammelten Eindrücken ergibt sich ein Gesamtbild darüber, wie wir Natur erfahren und wahrnehmen.

        <br> <br>
        [schließen]
        </p>
        <p class="close_beschreibung">
        </p>
      </div>
    </div>


    <div class="form-group">
      <label for="question">Name der Beobachtung</label>
      <input type="text" class="text_klein" name="text" />
    </div>


    <div class="form-group" id="rechnertext1">
      <label for="question">Analyse - Wähle eine Kombination</label>
      <div class="aim"><img src="../aim.svg" alt=""></div>
      <div class="rechenscheibe">
        <div class="rechner"><img src="../rechenscheiben/Infrastruktur-hbk.svg" alt=""></div>
        <div class="matrix">
          <div class="matrixzeileoben"><p class="matrixa"></p><p class="matrixb">&nbsp;</p></div>
          <div class="matrixzeileunten"><p class="matrixc">&nbsp;</p><p class="matrixd">&nbsp;</p></div>
        </div>
      </div>
      <input type="text" id="rotationAngle1" name="rotationAngle1" value="" style="display:none;"/>
      <div class="beschreibung">
        <p class="farbetext">
          Erklärungen <br> <br>
          auffällig/unauffällig <br>
          Wie leicht gibt sich die Beobachtung zu erkennen? <br> <br>
          öffentlich/privat <br>
          An der HBK sind nicht alle Orte zugänglich – diese Kategorie kann entweder bedeuten, ob etwas rechtlich privat ist oder ob sich Infrastruktur privat anfühlt – das gleiche gilt für öffentlich.
          <br> <br>
          Die Scheibe zeigt immer zwei gegenseitige Begriffe, mit deren Hilfe der persönliche Eindruck gegenüber der Beobachtung berwertet werden soll. Durch die zwei Achsen – die von oben nach unten und die von links nach rechts – lassen sie immer zwei Begriffe miteinander kombinieren. Beispielsweise kann etwas "störend" aber auch "notwendig" sein. Hier soll nicht lange überlegt und stattdessen ein erster Eindruck festgehalten werden. 
        
          <br> <br> [schließen]
        </p>
      </div>
    </div>

    <div class="form-group" id="rechnertext2" style="display:none;">
       <label for="question">Analyse - Wähle eine Kombination</label>
      <div class="aim"><img src="../aim.svg" alt=""></div>
      <div class="rechenscheibe2">
        <div class="rechner2"><img src="../rechenscheiben/Werkzeug.svg" alt=""></div>
        <div class="matrix">
          <div class="matrixzeileoben"><p class="matrixa"></p><p class="matrixb">&nbsp;</p></div>
          <div class="matrixzeileunten"><p class="matrixc">&nbsp;</p><p class="matrixd">&nbsp;</p></div>
        </div>
      </div>
      <input type="text" id="rotationAngle2" name="rotationAngle2" value="" style="display:none;" />
    <div class="beschreibung">
        <p class="farbetext">
          Erklärungen <br> <br>
          störend/unauffällig <br>
          Welchen Eindruck hinterlässt die Beobachtung? <br> <br>
          notwendig/leicht zu ersetzen <br>
          Nicht alle Werkzeuge erscheinen gleich wichtig – gib eine Einschätzung.
          <br> <br>
          Die Scheibe zeigt immer zwei gegenseitige Begriffe, mit deren Hilfe der persönliche Eindruck gegenüber der Beobachtung berwertet werden soll. Durch die zwei Achsen – die von oben nach unten und die von links nach rechts – lassen sie immer zwei Begriffe miteinander kombinieren. Beispielsweise kann etwas "störend" aber auch "notwendig" sein. Hier soll nicht lange überlegt und stattdessen ein erster Eindruck festgehalten werden. 
        
                  <br> <br> [schließen]
        </p>
      </div>
    </div>

        <div class="form-group" id="rechnertext3" style="display:none;">
       <label for="question">Analyse - Wähle eine Kombination</label>
      <div class="aim"><img src="../aim.svg" alt=""></div>
      <div class="rechenscheibe3">
        <div class="rechner3"><img src="../rechenscheiben/Wetter.svg" alt=""></div>
        <div class="matrix">
          <div class="matrixzeileoben"><p class="matrixa"></p><p class="matrixb">&nbsp;</p></div>
          <div class="matrixzeileunten"><p class="matrixc">&nbsp;</p><p class="matrixd">&nbsp;</p></div>
        </div>
      </div>
      <input type="text" id="rotationAngle3" name="rotationAngle3" value="" style="display:none;" />
    <div class="beschreibung">
        <p class="farbetext">
          Erklärungen <br> <br>
          Problem/Problemlösung <br>
          Manchmal wird das, was das Wetter hinterlässt, zum Problem: etwa der vereiste Fußweg. Manchmal sorgt das Wetter aber auch für das bisschen Licht, was man zum Arbeiten gerade braucht. Beachte das Wetter hier nicht direkt das Wetter, sondern Wetterbeobachtungen meint. <br> <br>
          warm/kalt <br>
          Wie lässt sich die Beobachtung einordnen? Beachte, dass es auch im Winter warme Beobachtungen geben kann, wie es auch im Sommer kalte geben kann.
          <br> <br>
          Die Scheibe zeigt immer zwei gegenseitige Begriffe, mit deren Hilfe der persönliche Eindruck gegenüber der Beobachtung berwertet werden soll. Durch die zwei Achsen – die von oben nach unten und die von links nach rechts – lassen sie immer zwei Begriffe miteinander kombinieren. Beispielsweise kann etwas "störend" aber auch "notwendig" sein. Hier soll nicht lange überlegt und stattdessen ein erster Eindruck festgehalten werden. 
                  <br> <br> [schließen]
        </p>
      </div>
    </div>

        <div class="form-group" id="rechnertext4" style="display:none;">
     <label for="question">Analyse - Wähle eine Kombination</label>
      <div class="aim"><img src="../aim.svg" alt=""></div>
      <div class="rechenscheibe4">
        <div class="rechner4"><img src="../rechenscheiben/Natur.svg" alt=""></div>
        <div class="matrix">
          <div class="matrixzeileoben"><p class="matrixa"></p><p class="matrixb">&nbsp;</p></div>
          <div class="matrixzeileunten"><p class="matrixc">&nbsp;</p><p class="matrixd">&nbsp;</p></div>
        </div>
      </div>
     <div class="beschreibung">
        <p class="farbetext">
          Erklärungen <br> <br>
          kommt/geht <br>
          Stellt gegenüber, ob die Natur gerade aus etwas oder von etwas hervorkommt oder ob sie sich durch die äußeren Einflüsse zurückzieht. <br> <br>
          beeinflusst/autonom <br>
          Lässt bewerten, wie es dazu kommt, dass die Natur entweder im Kommen oder im Gehen ist. <br>
          <br> Beachte hier, dass “die Natur” hier nur ein Sammelbegriff ist und offen ist, ob es sich um einen Wald, einen Baum oder einen Käfer handelt.
          <br> <br>
          Die Scheibe zeigt immer zwei gegenseitige Begriffe, mit deren Hilfe der persönliche Eindruck gegenüber der Beobachtung berwertet werden soll. Durch die zwei Achsen – die von oben nach unten und die von links nach rechts – lassen sie immer zwei Begriffe miteinander kombinieren. Beispielsweise kann etwas "störend" aber auch "notwendig" sein. Hier soll nicht lange überlegt und stattdessen ein erster Eindruck festgehalten werden. 
                  <br> <br> [schließen]
        </p>
      </div>
      <input type="text" id="rotationAngle4" name="rotationAngle4" value="" style="display:none;" />
    
    </div>

    <!-- Text groß -->
    <div class="form-group">
      <label for="question">Beschreibung der Beobachtung</label>
      <textarea class="text_groß" name="textarea"></textarea>
    </div>


    <div class="form-group" id="bild">
      <label for="image">Bild Upload</label>
      <input type="file" id="image" name="image" accept="image/*" />
      <div class="bildcontainer"><img id="imagePreview" style="display:none;"></div>
      <button type="button" id="removeImage" style="display:none;" class="farbe">Bild entfernen</button>
    </div>


    <div class="form-group">
      <label>Position im Feld wählen</label>
      <div class="map">
<div class="svg-container" style="background-image: url('hbk.avif');">
          <svg id="positionCanvas"
               xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 100 100"
               preserveAspectRatio="xMidYMid meet">
            <image href="../mapborder.svg"
                   x="0" y="0"
                   width="100" height="100"
                   preserveAspectRatio="none"/>
          </svg>
        </div>
      </div>
      <input type="hidden" id="x" name="x" value="" />
      <input type="hidden" id="y" name="y" value="" />
    </div>


    <button type="submit" class="farbe">Dokumentation speichern</button>

    </div>
</form>

</div>

<script>

document.querySelectorAll('input[type="radio"][name="choices[]"]').forEach(radio => {
  radio.addEventListener('change', () => {
    const choice = radio.value;



    document.querySelectorAll('.farbe, .farbetext').forEach(el => {
      if (el.className.baseVal !== undefined) {
        el.className.baseVal = el.classList.contains('farbetext') ? 'farbetext' : 'farbe';
      } else {
        el.className = el.classList.contains('farbetext') ? 'farbetext' : 'farbe';
      }
      el.classList.add('choice-' + choice);
    });
    






const r1 = document.getElementById('rechnertext1');
const r2 = document.getElementById('rechnertext2');
const r3 = document.getElementById('rechnertext3');
const r4 = document.getElementById('rechnertext4');

if (choice === 'A') {
  r1.style.display = 'block';
  r2.style.display = 'none';
  r3.style.display = 'none';
  r4.style.display = 'none';
} else if (choice === 'B') {
  r1.style.display = 'none';
  r2.style.display = 'block';
  r3.style.display = 'none';
  r4.style.display = 'none';
} else if (choice === 'C') {
  r1.style.display = 'none';
  r2.style.display = 'none';
  r3.style.display = 'block';
  r4.style.display = 'none';
} else {
  r1.style.display = 'none';
  r2.style.display = 'none';
  r3.style.display = 'none';
  r4.style.display = 'block';
}
  });
});



  function initPropeller(rechnerSelector, angleInputId) {
    const scheibe = document.querySelector(rechnerSelector);
    if (!scheibe) return;

    new Propeller(scheibe, {
      inertia: 0.7,
      onRotate: function() {
        const matrix = getComputedStyle(scheibe).transform;
        const angle = convertToAngle(matrix);
        document.getElementById(angleInputId).value = angle;

        let a = 1, b = 0, c = 0, d = 1;
        if (matrix && matrix !== 'none') {
          const values = matrix.match(/matrix\(([^)]+)\)/)[1].split(',').map(parseFloat);
          [a, b, c, d] = values;
        }

        const parent = scheibe.closest('.form-group');
        parent.querySelector('.matrixa').textContent = a.toFixed(2);
        parent.querySelector('.matrixb').textContent = b.toFixed(2);
        parent.querySelector('.matrixc').textContent = c.toFixed(2);
        parent.querySelector('.matrixd').textContent = d.toFixed(2);
      }
    });
  }

  function convertToAngle(matrix) {
    if (!matrix || matrix === 'none') return 0;
    const values = matrix.match(/matrix\(([^)]+)\)/)[1].split(',').map(parseFloat);
    let angle = Math.atan2(values[1], values[0]) * (180 / Math.PI);
    if (angle < 0) angle += 360;
    return Math.round(angle);
  }

  initPropeller('.rechner', 'rotationAngle1');
  initPropeller('.rechner2', 'rotationAngle2');
  initPropeller('.rechner3', 'rotationAngle3');
  initPropeller('.rechner4', 'rotationAngle4');
  


const imageInput = document.getElementById('image');
const preview    = document.getElementById('imagePreview');
const removeBtn  = document.getElementById('removeImage');

imageInput.addEventListener('change', async () => {
  const file = imageInput.files[0];
  if (!file) return;

  let processedFile = file;


  if (file.type === 'image/heic' || file.name.toLowerCase().endsWith('.heic')) {
    try {
      const blob = await heic2any({ blob: file, toType: "image/jpeg", quality: 0.8 });
      processedFile = new File([blob], file.name.replace(/\.[^/.]+$/, ".jpg"), { type: "image/jpeg" });
    } catch (e) {
      alert('HEIC‑Konvertierung fehlgeschlagen');
      return;
    }
  }


  const reader = new FileReader();
  reader.onload = ev => {
    const img = new Image();
    img.src = ev.target.result;
    img.onload = () => {
      const canvas = document.createElement('canvas');
      const maxWidth = 2000;
      let scale = 1;
      if (img.width > maxWidth) scale = maxWidth / img.width;
      canvas.width  = img.width * scale;
      canvas.height = img.height * scale;

      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

      canvas.toBlob(blob => {
        if (blob.size > 8 * 1024 * 1024) {
          alert('Datei nach Komprimierung immer noch größer als 8 MB');
          imageInput.value = '';
          preview.src = '';
          preview.style.display = 'none';
          removeBtn.style.display = 'none';
          return;
        }

        processedFile = new File([blob], processedFile.name, { type: blob.type });


        preview.src = URL.createObjectURL(processedFile);
        preview.style.display = 'block';
        removeBtn.style.display = 'block';


        const dt = new DataTransfer();
        dt.items.add(processedFile);
        imageInput.files = dt.files;
      }, 'image/jpeg', 0.8);
    };
  };
  reader.readAsDataURL(processedFile);
});

removeBtn.addEventListener('click', () => {
  imageInput.value = '';
  preview.src = '';
  preview.style.display = 'none';
  removeBtn.style.display = 'none';
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



function snapToGrid(value, steps = 100) {
  const stepSize = 100 / steps;  
  return Math.round(value / stepSize) * stepSize;
}

const canvas   = document.getElementById('positionCanvas');
const xInput   = document.getElementById('x');
const yInput   = document.getElementById('y');
let point = null;                         

canvas.addEventListener('click', (e) => {

  const rect = canvas.getBoundingClientRect();
  const relX = ((e.clientX - rect.left) / rect.width)  * 100;
  const relY = ((e.clientY - rect.top)  / rect.height) * 100;

  const gridX = snapToGrid(relX);
  const gridY = snapToGrid(relY);

  xInput.value = gridX;
  yInput.value = gridY;

  const currentChoice = document.querySelector('input[name="choices[]"]:checked')?.value || 'A';

  if (!point) {
    point = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
    point.setAttribute('r', '1.5');  
    point.classList.add('farbe');     
    canvas.appendChild(point);
  }

  point.setAttribute('cx', gridX);
  point.setAttribute('cy', gridY);

  point.className.baseVal = point.className.baseVal
    .split(' ')
    .filter(cls => !cls.startsWith('choice-'))
    .join(' ');
  point.classList.add('choice-' + currentChoice);
});




document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.beschreibung').forEach(beschreibung => {
    const closeBtn = beschreibung.querySelector('.close_beschreibung');
    const toggle = () => beschreibung.classList.toggle('expanded');

    beschreibung.addEventListener('click', toggle);

    if (closeBtn) {
      closeBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        toggle();
      });
    }
  });
});


</script>

</body>
</html>
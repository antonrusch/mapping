<?php

$storageFile = 'quiz-data.json';
$uploadDir   = 'uploads/';
$allData     = [];

if (file_exists($storageFile)) {
    $json = file_get_contents($storageFile);
    $allData = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON‑Fehler: ' . json_last_error_msg());
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Brocken Map – Übersicht</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="zeichensaal.xyz" />
    <link rel="manifest" href="favicon/site.webmanifest" />

    <link rel="stylesheet" href="stylesheets/demo.css">
    <link rel="stylesheet" href="stylesheets/var.css">
</head>

<body>

<header>
    <div class="logo">Brocken Map</div>
    <div class="menu">
        <a href="countercybernetics.html">Counter-Cybernetics |</a>
        <a href="/mapping/tool.php" target="_blank">Workshop Tool</a>
    </div>
    <div class="menubutton"><img src="menu.svg" alt=""><p class="x">X</p></div>
</header>

<div class="menumobil">
        <a href="countercybernetics.html">Counter-Cybernetics |</a>
        <a href="/mapping/tool.php" target="_blank">Workshop Tool</a>
    <div class="close"></div>
</div>

<div class="demolayout">

    
       <section id="eintragsliste">
    <div class="buttons">
        <button id="collapseAll">Alle schließen</button>
        <button id="preview">Preview Mode</button>
        
        
    </div>

    <?php if (empty($allData)): ?>
        <p>Keine Einträge gefunden.</p>
    <?php else: ?>
        <?php foreach ($allData as $idx => $item):
            $x = $item['x'] ?? '';
            $y = $item['y'] ?? '';

  
            $choiceClass = '';
            if (!empty($item['choices']) && is_array($item['choices'])) {
                $first = strtoupper($item['choices'][0]);
                if (in_array($first, ['A','B','C','D'])) {
                    $choiceClass = 'choice-' . $first;
                }
            }


            $title = htmlspecialchars($item['text'] ?? "Eintrag #".($idx+1));
            ?>
            <div class="entry <?= $choiceClass ? 'farbetext '.$choiceClass : '' ?>"
                 data-index="<?= $idx ?>"
                 data-x="<?= htmlspecialchars($x) ?>"
                 data-y="<?= htmlspecialchars($y) ?>">
                <h3 class="entry-header"><?= $title ?></h3>

                <div class="entry-content">
                    <?php
          
                    if (!empty($item['image'])) {
                        echo '<img src="'. $uploadDir . htmlspecialchars($item['image']) .'" alt="">';
                    }

           
                    $standard = ['text','image','choices','open_answer','x','y','timestamp',
                                 'rotationAngleA','rotationAngleB','rotationAngleC','rotationAngleD'];
                    foreach ($item as $key => $value) {
                        if (in_array($key, $standard, true)) continue;
                        if ($value === null || $value === '') continue;
                        echo '<div class="field rotation-text">'
                             .htmlspecialchars($value)
                             .'</div>';
                    }


                    if (!empty($item['open_answer'])) {
                        echo '<div class="field">'.nl2br(htmlspecialchars($item['open_answer'])).'</div>';
                    }


                    if (!empty($item['timestamp'])) {
                        echo '<div class="field entry-timestamp">'.htmlspecialchars($item['timestamp']).'</div>';
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="abstand"></div>
</section>


    <section id="mapPane">
        <svg id="mapCanvas"
             xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 100 100"
             preserveAspectRatio="xMidYMid meet">

            <image href="mapborder.svg"
                   x="0" y="0"
                   width="100"
                   height="100"
                   preserveAspectRatio="none" />

            <?php foreach ($allData as $idx => $item):
                if (!isset($item['x']) || !isset($item['y'])) continue;

                $choiceClass = '';
                if (!empty($item['choices']) && is_array($item['choices'])) {
                    $first = strtoupper($item['choices'][0]);   
                    if (in_array($first, ['A','B','C','D'])) {
                        $choiceClass = 'choice-' . $first;      
                    }
                }
                ?>
                <circle class="point farbe <?= $choiceClass ?>"
                        data-index="<?= $idx ?>"
                        data-x="<?= htmlspecialchars($item['x']) ?>"
                        data-y="<?= htmlspecialchars($item['y']) ?>"
                        cx="<?= htmlspecialchars($item['x']) ?>"
                        cy="<?= htmlspecialchars($item['y']) ?>"
                        r="1.5"
                        title="<?= htmlspecialchars($item['text'] ?? 'Eintrag') ?>">
                </circle>
            <?php endforeach; ?>
        </svg>
    </section>

</div> 

<script>

document.addEventListener('DOMContentLoaded', () => {
    const circles = document.querySelectorAll('#mapCanvas .point');
    const entries = document.querySelectorAll('#eintragsliste .entry');


    circles.forEach(circle => {
        const cx = circle.dataset.x;
        const cy = circle.dataset.y;

        circle.addEventListener('mouseenter', () => {
            document.querySelectorAll(
                `#eintragsliste .entry[data-x="${cx}"][data-y="${cy}"]`
            ).forEach(el => el.classList.add('highlight'));
        });

        circle.addEventListener('mouseleave', () => {
            document.querySelectorAll(
                `#eintragsliste .entry[data-x="${cx}"][data-y="${cy}"]`
            ).forEach(el => el.classList.remove('highlight'));
        });
    });


    circles.forEach(circle => {
        const cx = circle.dataset.x;
        const cy = circle.dataset.y;

        circle.addEventListener('click', () => {
            const matching = document.querySelectorAll(
                `#eintragsliste .entry[data-x="${cx}"][data-y="${cy}"]`
            );

            matching.forEach(entry => {
                entry.classList.add('expanded');
                entry.classList.add('highlight');
            });

            if (matching.length) {
                matching[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            circle.classList.add('active-point');
        });

        circle.addEventListener('mouseleave', () => {
            circle.classList.remove('active-point');
        });
    });


    entries.forEach(entry => {
        const ex = entry.dataset.x;
        const ey = entry.dataset.y;
        if (ex === '' && ey === '') return;

        entry.addEventListener('mouseenter', () => {
            document.querySelectorAll(
                `#mapCanvas .point[data-x="${ex}"][data-y="${ey}"]`
            ).forEach(p => p.classList.add('active-point'));
        });

        entry.addEventListener('mouseleave', () => {
            document.querySelectorAll(
                `#mapCanvas .point[data-x="${ex}"][data-y="${ey}"]`
            ).forEach(p => p.classList.remove('active-point'));
        });
    });


    document.querySelectorAll('.entry-header').forEach(header => {
        header.addEventListener('click', () => {
            header.parentElement.classList.toggle('expanded');
        });
    });


    document.getElementById('collapseAll').addEventListener('click', () => {
        entries.forEach(entry => entry.classList.remove('expanded'));
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const menuButton = document.querySelector(".menubutton");
    const menuImg    = document.querySelector(".menubutton img");
    const closeBtn   = document.querySelector(".x");
    const closeArea  = document.querySelector(".close");
    const menuMobil  = document.querySelector(".menumobil");

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

document.getElementById('preview').addEventListener('click', () => {
    const mapPane = document.getElementById('mapPane');
    if (!mapPane) return;

    const win = window.open(
        '',
        'mapPreview',
        'width=1280,height=800,resizable=yes'
    );

    win.document.open();
    win.document.write(`
        <!DOCTYPE html>
        <html lang="de">
        <head>
            <meta charset="UTF-8">
            <title>Map – Ausstellungsmodus</title>
            <link rel="stylesheet" href="stylesheets/demo.css">
            <link rel="stylesheet" href="stylesheets/var.css">
            <style>
                html, body {
                    margin: 0;
                    background-color: black;
                }

                .demonstrator {
                    height: 100%;
                    width: 100%;
                    overflow: hidden;
                    background-color: black;
                    display: flex;
                    flex-direction: row;
                }


                #mapPane {
                    margin-left: 20vw;
                }

                #mapCanvas {
                    width: calc(80vh - 2.44rem);
                    height: auto;
                }

                .legend-text {
                color: white;
                font-family: routed-gothic-narrow-file;
                }

                #legende {
                    display: flex;
                    flex-direction: column;
                    width: 100vh;
                    margin-top: 2.44rem;
					margin-left: 10vw;
                }

                .legend-point {
                    height: 60px;
                    width: 60px;
                    clip-path: circle(15%);
                    margin-top: 0.2rem;
                }

               .legend-item {
                    display: flex;
                    align-items: center;
                    margin-bottom: 0.5rem;
                    justify-content: flex-start;
                    height: 1.22rem;
                    width: 20vw;
                }

            </style>
        </head>
        <body>

        <div class="demonstrator"> 
            ${mapPane.outerHTML}

            <div id="legende">
                <div class="legend-item">
                    <span class="legend-point" style="background-color: var(--textdetail)"></span>
                    <span class="legend-text">Infrastruktur</span>
                </div>
                <div class="legend-item">
                    <span class="legend-point" style="background-color: var(--textdetail2)"></span>
                    <span class="legend-text">Werkzeug</span>
                </div>
                <div class="legend-item">
                    <span class="legend-point" style="background-color: var(--textdetail3)"></span>
                    <span class="legend-text">Wetter</span>
                </div>
                <div class="legend-item">
                    <span class="legend-point" style="background-color: var(--textdetail4)"></span>
                    <span class="legend-text">Natur</span>
                </div>

                
                <div id="activeLine">
                    Verbundene Punkte: <span id="pointsConnected">–</span>
                </div>
                <div id="activeTimestamp">
                    Timestamp: <span id="currentTimestamp">–</span>
                </div>
                <div class="line-visual"></div>
            </div>

        </div>    

            <script>
                const svg = document.querySelector('svg');
                const points = Array.from(svg.querySelectorAll('circle.point'));

                // sortieren nach data-timestamp
                points.sort((a,b) => (parseFloat(a.dataset.timestamp)||0) - (parseFloat(b.dataset.timestamp)||0));



                
                
            function drawLine(x1, y1, x2, y2) {
            const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
            line.setAttribute("x1", x1);
            line.setAttribute("y1", y1);
            line.setAttribute("x2", x2);
            line.setAttribute("y2", y2);
            line.setAttribute("stroke", "white");
            line.setAttribute("stroke-width", 0.3);

            // Linie vor die Punkte setzen
            const firstCircle = svg.querySelector('circle.point');
            if (firstCircle) {
            svg.insertBefore(line, firstCircle);
            } else {
            svg.appendChild(line);
            }

            return line;
            }

                function animateLines() {
                    let delay = 0;
                    points.forEach((point, i) => {
                        if (i === 0) return;
                        const prev = points[i - 1];
                        const x1 = prev.cx.baseVal.value;
                        const y1 = prev.cy.baseVal.value;
                        const x2 = point.cx.baseVal.value;
                        const y2 = point.cy.baseVal.value;

                        setTimeout(() => {
                            const line = drawLine(x1, y1, x2, y2);
                            setTimeout(() => { line.remove(); }, 3000);
                        }, delay);

                        delay += 2000;
                    });

                    const totalTime = delay + 3000;
                    setTimeout(animateLines, totalTime + 1000);
                }

                animateLines();
            <\/script>
        </body>
        </html>
    `);
    win.document.close();
});
</script>

</body>
</html>
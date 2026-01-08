<?php
$personagem = [
    "nome" => "Meris",
    "jogador" => "Nowack",
    "origem" => "Sobrevivente",
    "classe" => "Ocultista",
    "nex" => 65,
    "vida" => [75, 75],
    "sanidade" => [75, 75],
    "esforco" => [118, 118],
    "defesa" => 11,
    "bloqueio" => 20,
    "esquiva" => 11
];

$atributos = [
    "FOR" => 1,
    "AGI" => 1,
    "INT" => 3,
    "VIG" => 3,
    "PRE" => 5
];

$pericias = [
    ["Acrobacia", "AGI", 0],
    ["Adestramento", "PRE", 0],
    ["Atletismo", "FOR", 0],
    ["Atualidades", "INT", 0],
    ["Ciências", "INT", 5],
    ["Crime", "AGI", 0],
    ["Diplomacia", "PRE", 0],
    ["Enganação", "PRE", 0],
    ["Fortitude", "VIG", 10],
    ["Furtividade", "AGI", 0],
    ["Iniciativa", "AGI", 0],
    ["Intimidação", "PRE", 10],
    ["Investigação", "INT", 5],
    ["Luta", "FOR", 0],
    ["Medicina", "INT", 5],
    ["Ocultismo", "INT", 10],
    ["Percepção", "PRE", 0],
    ["Pontaria", "AGI", 0],
    ["Reflexos", "AGI", 0],
    ["Religião", "PRE", 0],
    ["Sobrevivência", "INT", 10],
    ["Tática", "INT", 5],
    ["Tecnologia", "INT", 0],
    ["Vontade", "PRE", 10]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<meta charset="UTF-8">
<title>Ficha de Personagem</title>

<style>
/* ===== RESET / BASE ===== */
* {
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

html, body {
    margin: 0;
    height: 100%;
    background: #0f0f0f;
    color: #eaeaea;
}

/* ===== LAYOUT ===== */
.container {
    display: grid;
    grid-template-columns: 300px 1fr 320px;
    height: 100vh;
}

/* ===== SIDEBAR (ESQUERDA) ===== */
.sidebar {
    background: #1e1e1e;
    padding: 24px;
    border-right: 1px solid #2a2a2a;
}

.sidebar h2 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
}

.sidebar .sub {
    font-size: 12px;
    color: #b0b0b0;
    margin-top: 2px;
}

/* ===== ATRIBUTOS ===== */
.atributos {
    margin: 20px 0;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}

.atributo {
    background: #2c2c2c;
    border: 1px solid #333;
    border-radius: 6px;
    padding: 10px 5px;
    text-align: center;
}

.atributo strong {
    display: block;
    font-size: 11px;
    color: #9a9a9a;
    letter-spacing: 1px;
}

.atributo span {
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
}

/* ===== BARRAS ===== */
.barra {
    margin: 14px 0;
}

.barra span {
    font-size: 12px;
    color: #bdbdbd;
}

.barra .progress {
    background: #111;
    height: 18px;
    border-radius: 6px;
    overflow: hidden;
    margin: 4px 0;
    border: 1px solid #333;
}

.barra .progress div {
    height: 100%;
}

.vida { background: #6a100a; }
.sanidade { background: #5e2b7a; }
.esforco { background: #c47c1b; }

/* ===== DEF / BLOQ / ESQ ===== */
.stats {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    gap: 8px;
}

.stats div {
    flex: 1;
    background: #2c2c2c;
    border: 1px solid #333;
    padding: 10px 0;
    border-radius: 6px;
    text-align: center;
    font-size: 12px;
    color: #ddd;
}

/* ===== COLUNA CENTRAL ===== */
.main {
    padding: 24px;
    overflow-y: auto;
}

/* Personalização da barra de rolagem para tema escuro */
.main::-webkit-scrollbar {
    width: 8px;
}

.main::-webkit-scrollbar-track {
    background: #1e1e1e;
}

.main::-webkit-scrollbar-thumb {
    background: #555;
    border-radius: 4px;
}

.main::-webkit-scrollbar-thumb:hover {
    background: #777;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #2a2a2a;
    padding-bottom: 10px;
}

.header h1 {
    margin: 0;
    font-size: 22px;
    color: #ffffff;
}

.header span {
    font-size: 13px;
    color: #aaa;
}

/* ===== PERÍCIAS ===== */
.pericias {
    margin-top: 20px;
}

.pericia {
    display: grid;
    grid-template-columns: 1fr 70px 50px;
    align-items: center;
    padding: 8px 10px;
    border-bottom: 1px solid #222;
    font-size: 14px;
}

.pericia:hover {
    background: #1b1b1b;
}

.pericia span {
    color: #8e8e8e;
    font-size: 12px;
}

/* ===== DADO ===== */
.dado {
    text-align: center;
    cursor: pointer;
    color: #500000;
    font-size: 18px;
}

.dado:hover {
    color: #750904;
}

/* ===== COLUNA DIREITA ===== */
.right {
    background: #1e1e1e;
    padding: 24px;
    border-left: 1px solid #2a2a2a;
}

.right h3 {
    margin-top: 0;
    font-size: 18px;
    color: #ffffff;
}

.box {
    background: #2c2c2c;
    padding: 15px;
    border-radius: 6px;
    border: 1px solid #333;
    text-align: center;
    color: #aaa;
    font-size: 13px;
}

/* ===== BOTÕES ===== */
button {
    background: #500000;
    border: none;
    color: #fff;
    padding: 10px;
    width: 100%;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 12px;
    font-size: 14px;
}

button:hover {
    background: #750904;
}

/* ===== TOAST (ROLAGEM) ===== */
.toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #1e1e1e;
    border: 1px solid #333;
    padding: 16px 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.6);
    font-size: 14px;
    color: #eaeaea;
    display: none;
    min-width: 260px;
}

.toast hr {
    border: 1px solid #333;
    margin: 8px 0;
}

</style>
</head>

<body>

<div class="container">

    <!-- ESQUERDA -->
    <div class="sidebar">
        <h2><?= $personagem["nome"] ?></h2>
        <div class="sub"><?= $personagem["origem"] ?> • <?= $personagem["classe"] ?></div>
        <div class="sub">Jogador: <?= $personagem["jogador"] ?></div>
        
<div class="atributos">
    <div class="atributo">
        <strong>FOR</strong>
        <span><?= $atributos["FOR"] ?></span>
    </div>
    <div class="atributo">
        <strong>AGI</strong>
        <span><?= $atributos["AGI"] ?></span>
    </div>
    <div class="atributo">
        <strong>INT</strong>
        <span><?= $atributos["INT"] ?></span>
    </div>
    <div class="atributo">
        <strong>PRE</strong>
        <span><?= $atributos["PRE"] ?></span>
    </div>
    <div class="atributo">
        <strong>VIG</strong>
        <span><?= $atributos["VIG"] ?></span>
    </div>
</div>
        <div class="barra">
            <span>Vida</span>
            <div class="progress">
                <div class="vida" style="width:100%"></div>
            </div>
            <span><?= $personagem["vida"][0] ?>/<?= $personagem["vida"][1] ?></span>
        </div>

        <div class="barra">
            <span>Sanidade</span>
            <div class="progress">
                <div class="sanidade" style="width:100%"></div>
            </div>
            <span><?= $personagem["sanidade"][0] ?>/<?= $personagem["sanidade"][1] ?></span>
        </div>

        <div class="barra">
            <span>Esforço</span>
            <div class="progress">
                <div class="esforco" style="width:100%"></div>
            </div>
            <span><?= $personagem["esforco"][0] ?>/<?= $personagem["esforco"][1] ?></span>
        </div>

        <div class="stats">
            <div>DEF<br><?= $personagem["defesa"] ?></div>
            <div>BLOQ<br><?= $personagem["bloqueio"] ?></div>
            <div>ESQ<br><?= $personagem["esquiva"] ?></div>
        </div>
    </div>

    <!-- MEIO -->
    <div class="main">
        <div class="header">
            <h1>Perícias</h1>
            <span>NEX <?= $personagem["nex"] ?>%</span>
        </div>

        <div class="pericias">
            <?php foreach ($pericias as $p): ?>
                <div class="pericia">
                    <div><?= $p[0] ?> <span>(<?= $p[1] ?>)</span></div>
                    <div>+<?= $p[2] ?></div>
                    <div class="dado" onclick="rolarDado('<?= $p[0] ?>', '<?= $p[1] ?>', <?= $p[2] ?>)">
    <i class="bi bi-dice-5-fill"></i>
</div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- DIREITA -->
    <div class="right">
        <h3>Combate</h3>
        <div class="box">
            Você ainda não possui ataques
        </div>
        <button>Novo Ataque</button>
    </div>

</div>
<div id="toast" class="toast"></div>

<script>
/* ===== ATRIBUTOS (vindos do PHP) ===== */
const atributos = {
    FOR: <?= $atributos["FOR"] ?>,
    AGI: <?= $atributos["AGI"] ?>,
    INT: <?= $atributos["INT"] ?>,
    PRE: <?= $atributos["PRE"] ?>,
    VIG: <?= $atributos["VIG"] ?>
};

/* ===== ÁUDIO DO DADO ===== */
let audioDado = null;

/* ===== CONTROLE DO TOAST ===== */
let toastTimeout = null;

/* ===== FUNÇÃO DE ROLAGEM ===== */
function rolarDado(pericia, atributo, bonus) {

    /* --- ÁUDIO --- */
    if (!audioDado) {
        audioDado = new Audio('./audio/dice.mp3'); // ajuste o caminho se necessário
        audioDado.preload = 'auto';
    }

    audioDado.pause();
    audioDado.currentTime = 0;
    audioDado.play().catch(() => {});

    /* --- LÓGICA DO DADO --- */
    const quantidadeDados = atributos[atributo] || 1;
    let resultados = [];

    for (let i = 0; i < quantidadeDados; i++) {
        resultados.push(Math.floor(Math.random() * 20) + 1);
    }

    const maior = Math.max(...resultados);
    const total = maior + bonus;

    /* --- TOAST --- */
    const toast = document.getElementById("toast");

    const resultadoHTML = `
        <strong>${pericia}</strong><br>
        Atributo: <strong>${atributo}</strong><br>
        Dados rolados: <strong>${resultados.join(", ")}</strong><br>
        Maior dado: <strong>${maior}</strong><br>
        Bônus: <strong>+${bonus}</strong>
        <hr style="border:1px solid #333">
        Total: <strong>${total}</strong>
    `;

    toast.innerHTML = resultadoHTML;
    toast.style.display = "block";

    // Cancela o timer anterior (se houver)
    if (toastTimeout) {
        clearTimeout(toastTimeout);
    }

    // Mantém o toast visível por no mínimo 5 segundos
    toastTimeout = setTimeout(() => {
        toast.style.display = "none";
        toastTimeout = null;
    }, 5000);
}
</script>
</body>
</html>
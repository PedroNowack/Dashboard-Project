<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Adicionando Bootstrap para melhorar o visual -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<meta charset="UTF-8">
<title>Hub de Sistemas RPG</title>

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
    overflow: hidden;
}

/* ===== LAYOUT ===== */
.container-custom {
    display: grid;
    grid-template-columns: 150px 1fr;
    height: 100vh;
    transition: opacity 0.6s ease-in-out, filter 0.6s ease-in-out;
}

.container-custom.oculto {
    opacity: 0;
    filter: blur(10px);
    pointer-events: none;
}

/* ===== SIDEBAR (ESQUERDA) ===== */
.sidebar {
    background: #1e1e1e;
    padding: 24px 15px;
    border-right: 1px solid #2a2a2a;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 5;
}

.profile-pic {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #500000;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.5);
}

.back-button {
    background: transparent;
    border: 1px solid #555;
    color: #eaeaea;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
    width: 100%;
}

.back-button:hover {
    background: #500000;
    border-color: #750904;
}

/* ===== COLUNA CENTRAL ===== */
.main {
    padding: 24px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transform: translateY(-30px);
    z-index: 5;
}

.header {
    text-align: center;
    margin-bottom: 40px;
}

.header h1 {
    margin: 0;
    font-size: 28px;
    color: #ffffff;
}

/* ===== SISTEMAS ===== */
.sistemas {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    max-width: 1200px;
    width: 100%;
}

.sistema {
    position: relative;
    width: 100%;
    max-width: 300px;
    height: 200px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-size: cover;
    background-position: center;
    margin: 0 auto;
}

.sistema:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
}

.sistema::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(80, 0, 0, 0.7), rgba(117, 9, 4, 0.7));
    z-index: 1;
}

.sistema.sacramento::before {
    background: linear-gradient(135deg, rgba(139, 69, 19, 0.7), rgba(255, 140, 0, 0.7)); /* Alaranjado terroso/vibrante */
}

.sistema.tormenta::before {
    background: linear-gradient(135deg, rgba(0, 100, 0, 0.7), rgba(32, 178, 170, 0.7));
}

.sistema h2 {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    margin: 0;
    font-size: 20px;
    color: #ffffff;
    z-index: 2;
    text-shadow: 0 0 5px rgba(0,0,0,0.8);
    width: 90%;
    text-align: center;
}

/* ===== SELEÇÃO DINÂMICA ===== */
.selecao {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 100;
}

/* Cores de Fundo por Sistema */
.selecao.ordem { background: linear-gradient(135deg, rgba(15, 15, 15, 0.98), rgba(60, 0, 0, 0.95)); }
.selecao.sacramento { background: linear-gradient(135deg, rgba(15, 15, 15, 0.98), rgba(100, 40, 0, 0.95)); } /* Fundo alaranjado escuro */
.selecao.tormenta { background: linear-gradient(135deg, rgba(15, 15, 15, 0.98), rgba(0, 60, 60, 0.95)); }

.selecao.ativa {
    opacity: 1;
    pointer-events: all;
}

.selecao .pergunta {
    font-size: 32px;
    color: #ffffff;
    margin-bottom: 40px;
    text-shadow: 0 0 10px rgba(0,0,0,0.8);
    transform: translateY(20px);
    transition: transform 0.8s ease 0.2s, opacity 0.8s ease 0.2s;
    opacity: 0;
}

.selecao.ativa .pergunta {
    transform: translateY(0);
    opacity: 1;
}

.opcoes {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
    justify-content: center;
}

.opcao {
    width: 250px;
    height: 350px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    border: none !important;
    background: #2c2c2c;
    transform: scale(0.8) translateY(50px);
    opacity: 0;
    transition: transform 0.8s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.8s ease, box-shadow 0.3s ease;
}

.opcao:nth-child(2) { transition-delay: 0.1s; }

.selecao.ativa .opcao {
    transform: scale(1) translateY(0);
    opacity: 1;
}

/* Hover dinâmico baseado no sistema */
.selecao.ordem .opcao:hover { box-shadow: 0 10px 30px rgba(117, 9, 4, 0.6); transform: scale(1.05) !important; }
.selecao.sacramento .opcao:hover { box-shadow: 0 10px 30px rgba(255, 140, 0, 0.6); transform: scale(1.05) !important; }
.selecao.tormenta .opcao:hover { box-shadow: 0 10px 30px rgba(32, 178, 170, 0.6); transform: scale(1.05) !important; }

.opcao img {
    width: 100%;
    height: 70%;
    object-fit: cover;
    display: block;
}

.opcao .card-body {
    text-align: center;
    padding: 15px;
    background: #2c2c2c;
    color: #ffffff;
    font-size: 22px;
    font-weight: bold;
    border: none;
}

/* Botão de Voltar Dinâmico */
.voltar-selecao {
    position: absolute;
    top: 20px;
    left: 20px;
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
    z-index: 110;
}

/* Cores do Botão por Sistema */
.selecao.ordem .voltar-selecao { background: #500000; }
.selecao.ordem .voltar-selecao:hover { background: #750904; transform: translateX(5px); box-shadow: 0 0 15px rgba(117, 9, 4, 0.5); }

.selecao.sacramento .voltar-selecao { background: #8b4513; } /* Marrom alaranjado */
.selecao.sacramento .voltar-selecao:hover { background: #ff8c00; transform: translateX(5px); box-shadow: 0 0 15px rgba(255, 140, 0, 0.5); }

.selecao.tormenta .voltar-selecao { background: #006464; }
.selecao.tormenta .voltar-selecao:hover { background: #20b2aa; transform: translateX(5px); box-shadow: 0 0 15px rgba(32, 178, 170, 0.5); }

</style>
</head>

<body>

<div class="container-custom" id="hub">
    <div class="sidebar">
        <img src="imagens/Multilador Noturno.jfif" alt="Foto de Perfil" class="profile-pic">
        <button class="back-button" onclick="history.back()">
            <i class="bi bi-arrow-left"></i> Voltar
        </button>
    </div>

    <div class="main">
        <div class="header">
            <h1>Selecione seu sistema</h1>
        </div>

        <div class="sistemas">
            <div class="sistema ordem" onclick="abrirSelecao('ordem')" style="background-image: url('imagens/Ordem.jfif');">
                <h2>Ordem Paranormal RPG</h2>
            </div>
            <div class="sistema sacramento" onclick="abrirSelecao('sacramento')" style="background-image: url('imagens/Sacramento.jfif');">
                <h2>Sacramento RPG</h2>
            </div>
            <div class="sistema tormenta" onclick="abrirSelecao('tormenta')" style="background-image: url('imagens/Tormenta.jfif');">
                <h2>Tormenta 20</h2>
            </div>
        </div>
    </div>
</div>

<!-- SELEÇÃO DINÂMICA -->
<div class="selecao" id="selecao">
    <button class="voltar-selecao" onclick="voltarHub()">
        <i class="bi bi-arrow-left"></i> Voltar ao Hub
    </button>
    <div class="pergunta">Jogar como:</div>
    <div class="opcoes" id="opcoes-dinamicas">
        <!-- Conteúdo inserido via JavaScript -->
    </div>
</div>

<script>
const sistemasConfig = {
    ordem: {
        classe: 'ordem',
        opcoes: [
            { nome: 'Mestre', img: 'imagens/mestre.jfif' },
            { nome: 'Agente', img: 'imagens/Agente.jfif' }
        ]
    },
    sacramento: {
        classe: 'sacramento',
        opcoes: [
            { nome: 'Mestre', img: 'imagens/bispos.jfif' },
            { nome: 'Pistoleiro', img: 'imagens/horacio.jfif' }
        ]
    },
    tormenta: {
        classe: 'tormenta',
        opcoes: [
            { nome: 'Mestre', img: 'imagens/mestre2.jpg' },
            { nome: 'Herói', img: 'imagens/herói.jpg' }
        ]
    }
};

function abrirSelecao(sistemaKey) {
    const config = sistemasConfig[sistemaKey];
    const selecaoDiv = document.getElementById('selecao');
    const opcoesContainer = document.getElementById('opcoes-dinamicas');
    
    // Limpa classes de sistema anteriores e adiciona a nova
    selecaoDiv.classList.remove('ordem', 'sacramento', 'tormenta');
    selecaoDiv.classList.add(config.classe);
    
    // Gera os cards dinamicamente
    opcoesContainer.innerHTML = config.opcoes.map(opt => `
        <div class="opcao card" onclick="escolherOpcao('${opt.nome}')">
            <img src="${opt.img}" alt="${opt.nome}">
            <div class="card-body">${opt.nome}</div>
        </div>
    `).join('');
    
    // Ativa a transição
    document.getElementById('hub').classList.add('oculto');
    selecaoDiv.classList.add('ativa');
}

function voltarHub() {
    document.getElementById('hub').classList.remove('oculto');
    document.getElementById('selecao').classList.remove('ativa');
}

function escolherOpcao(opcao) {
    alert('Escolheu: ' + opcao);
}
</script>

</body>
</html>
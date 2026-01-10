
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Campanha - Ordem Paranormal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-red: #500000;
            --secondary-red: #8B0000;
            --bg-dark: #0a0a0a;
            --bg-panel: #141414;
            --border-color: #2a2a2a;
            --text-light: #dcdcdc;
            --text-muted: #888;
            --accent-glow: rgba(139, 0, 0, 0.7);

            /* Cores de Status */
            --hp-color: #dc3545; /* Vermelho */
            --san-color: #0d6efd; /* Azul */
            --pe-color: #ffc107;  /* Amarelo */
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        body {
            background: radial-gradient(circle, #1a0505 0%, var(--bg-dark) 70%);
            color: var(--text-light);
            height: 100vh;
            display: grid;
            grid-template-columns: 350px 1fr;
            grid-template-rows: 100vh;
            overflow: hidden;
        }

        /* ===== PAINEL ESQUERDO (MESTRE) ===== */
        .master-panel {
            background-color: var(--bg-panel);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 20px;
            gap: 25px;
        }

        .panel-header {
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }

        .panel-header h2 {
            font-size: 1.5rem;
            color: var(--secondary-red);
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 8px var(--accent-glow);
        }

        /* Rolagem de Dados */
        .dice-roller {
            background: #1a1a1a;
            border-radius: 8px;
            padding: 15px;
            border: 1px solid var(--border-color);
        }

        .dice-roller h3 {
            margin-bottom: 15px;
            font-size: 1rem;
            text-align: center;
            text-transform: uppercase;
        }

        .dice-input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .dice-input-group input {
            width: 60px;
            background: #2c2c2c;
            border: 1px solid #444;
            color: var(--text-light);
            border-radius: 4px;
            padding: 8px;
            text-align: center;
        }

        .dice-input-group select {
            flex-grow: 1;
            background: #2c2c2c;
            border: 1px solid #444;
            color: var(--text-light);
            border-radius: 4px;
            padding: 8px;
        }

        .btn-roll {
            width: 100%;
            padding: 10px;
            background: var(--primary-red);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
        }

        .btn-roll:hover {
            background: var(--secondary-red);
            box-shadow: 0 0 15px var(--accent-glow);
        }

        /* Abas de Conteúdo (Bestiário, etc) */
        .content-tabs {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .tab-nav {
            display: flex;
            border-bottom: 1px solid var(--border-color);
        }

        .tab-nav-button {
            padding: 10px 15px;
            cursor: pointer;
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 0.9rem;
            border-bottom: 2px solid transparent;
            transition: color 0.3s, border-color 0.3s;
        }

        .tab-nav-button.active, .tab-nav-button:hover {
            color: var(--text-light);
            border-bottom-color: var(--secondary-red);
        }

        .tab-content {
            padding-top: 15px;
            overflow-y: auto;
            flex-grow: 1;
            position: relative;
            padding-bottom: 80px; 
        }
        
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }

        .list-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            background: #1c1c1c;
            border: 1px solid var(--border-color);
        }
        .list-item img {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            object-fit: cover;
        }
        .list-item .info { flex-grow: 1; }
        .list-item .info h4 { margin: 0; font-size: 1rem; }
        .list-item .info p { margin: 0; font-size: 0.8rem; color: var(--text-muted); }
        
        .btn-scene-toggle {
            background: none;
            border: 1px solid var(--secondary-red);
            color: var(--secondary-red);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-scene-toggle:hover { background: var(--secondary-red); color: white; }
        .btn-scene-toggle.remove { border-color: #6c757d; color: #6c757d; }
        .btn-scene-toggle.remove:hover { background: #6c757d; color: white; }


        /* ===== PAINEL DIREITO (CENA) ===== */
        .scene-panel {
            padding: 25px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .scene-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px; /* Espaçamento para os botões */
        }

        .scene-header h1 {
            font-size: 2rem;
            text-shadow: 0 0 10px var(--accent-glow);
            flex-grow: 1; /* Faz o título ocupar o espaço disponível */
        }

        .back-to-hub {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background: var(--primary-red);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
            flex-shrink: 0; /* Impede que o botão encolha */
        }
        .back-to-hub:hover { background: var(--secondary-red); }

        /* NOVO BOTÃO DE AJUSTES */
        .btn-settings {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
            transition: color 0.3s, transform 0.3s;
        }
        .btn-settings:hover {
            color: var(--text-light);
            transform: scale(1.1);
        }

        /* Área de Rolagem da Iniciativa */
        .initiative-track {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .initiative-track h3 {
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .initiative-scroll-area {
            display: flex;
            gap: 20px;
            padding: 15px 10px;
            overflow-x: auto;
        }

        /* Cards de Personagem/Inimigo */
        .char-card {
            flex: 0 0 220px;
            background: #1c1c1c;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, border 0.3s;
            display: flex;
            flex-direction: column;
        }

        .char-card:hover {
            transform: translateY(-5px);
        }

        .char-card.active-turn {
            border: 2px solid var(--secondary-red);
            transform: translateY(-5px) scale(1.05);
        }

        .char-card .portrait {
            width: 100%;
            height: 160px;
            object-fit: cover;
            object-position: center top;
            border-bottom: 1px solid var(--border-color);
        }
        
        .char-card.active-turn .portrait {
             border-bottom-color: var(--secondary-red);
        }
        
        .char-info {
            padding: 8px 10px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .char-card .char-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }

        .char-card .char-initiative {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-align: center;
            margin-top: -5px;
        }

        .status-bars {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .status-bar {
            width: 100%;
            height: 10px;
            background-color: #444;
            border-radius: 5px;
            overflow: hidden;
        }

        .status-bar .fill {
            height: 100%;
            border-radius: 5px;
        }

        .status-bar .hp { background-color: var(--hp-color); }
        .status-bar .san { background-color: var(--san-color); }
        .status-bar .pe { background-color: var(--pe-color); }

        .attributes-stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 5px;
            padding: 8px 5px;
            border-top: 1px solid var(--border-color);
            margin-top: 8px;
        }

        .attributes-stats .stat-item .value {
            font-size: 1.3rem;
        }

        .defense-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            padding: 8px 10px;
            border-top: 1px solid var(--border-color);
            margin-top: 5px;
        }

        .stat-item {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-item .label {
            font-size: 0.75rem;
            font-weight: bold;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .stat-item .value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-light);
            line-height: 1.2;
        }

        /* BOTÃO FLUTUANTE */
        .btn-add-new {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-red);
            color: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            cursor: pointer;
            z-index: 1000;
            transition: background-color 0.3s, transform 0.3s, opacity 0.3s;
            opacity: 0;
            pointer-events: none;
        }

        .btn-add-new.visible {
            opacity: 1;
            pointer-events: auto;
        }

        .btn-add-new:hover {
            background-color: var(--secondary-red);
            transform: scale(1.1);
        }

        /* ESTILO GLOBAL DA SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-panel);
        }

        ::-webkit-scrollbar-thumb {
            background-color: #444;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--primary-red);
        }
        /* BOTÃO NO CANTO INFERIOR DIREITO */
.btn-notes {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background-color: var(--primary-red);
    color: white;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    cursor: pointer;
    z-index: 1001; /* Acima do botão flutuante existente */
    transition: background-color 0.3s, transform 0.3s;
}
.btn-notes:hover {
    background-color: var(--secondary-red);
    transform: scale(1.1);
}

/* POP-UP DO BLOCO DE NOTAS */
.notes-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    height: 300px;
    background-color: var(--bg-panel);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
    z-index: 1002;
    display: none; /* Inicialmente oculto */
    flex-direction: column;
    overflow: hidden;
    cursor: move; /* Indica que é arrastável */
    resize: both; /* Permite redimensionamento via CSS nativo (flexível) */
    min-width: 200px;
    min-height: 150px;
    max-width: 80vw;
    max-height: 80vh;
}
.notes-popup.active {
    display: flex;
}
.notes-header {
    background-color: var(--primary-red);
    color: white;
    padding: 10px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bold;
    cursor: move; /* Parte do drag */
}
.btn-close-notes {
    background: none;
    border: none;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    transition: color 0.3s;
}
.btn-close-notes:hover {
    color: var(--text-muted);
}
.notes-textarea {
    flex-grow: 1;
    background-color: var(--bg-dark);
    color: var(--text-light);
    border: none;
    padding: 10px;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    font-size: 0.9rem;
    resize: none; /* O textarea não redimensiona sozinho, o pop-up sim */
    outline: none;
}
.notes-textarea::placeholder {
    color: var(--text-muted);
}

    </style>
</head>
<body>

    <!-- PAINEL DO MESTRE (ESQUERDA) -->
    <div class="master-panel">
        <div class="panel-header">
            <h2>Painel do Mestre</h2>
        </div>
        <div class="dice-roller">
            <h3>Rolagem Rápida</h3>
            <div class="dice-input-group">
                <input type="number" value="1">
                <select>
                    <option value="20">d20</option>
                    <option value="12">d12</option>
                    <option value="10">d10</option>
                    <option value="8">d8</option>
                    <option value="6">d6</option>
                    <option value="4">d4</option>
                </select>
            </div>
            <button class="btn-roll"><i class="bi bi-dice-6-fill"></i> Rolar</button>
        </div>
        <div class="content-tabs">
            <nav class="tab-nav">
                <button class="tab-nav-button active" data-tab="bestiary">Bestiário</button>
                <button class="tab-nav-button" data-tab="agents">Agentes</button>
            </nav>
            <div class="tab-content">
                <!-- Conteúdo do Bestiário -->
                <div id="bestiary" class="tab-pane active">
                    <div class="list-item">
                        <img src="imagens/zumbisangue.jpg" alt="Zumbi de Sangue">
                        <div class="info">
                            <h4>Zumbi de Sangue</h4>
                            <p>VD 40 - Sangue</p>
                        </div>
                        <button class="btn-scene-toggle" title="Adicionar à Cena"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    <div class="list-item">
                        <img src="imagens/existido.jpg" alt="Existido">
                        <div class="info">
                            <h4>Existido</h4>
                            <p>VD 80 - Conhecimento</p>
                        </div>
                        <button class="btn-scene-toggle" title="Adicionar à Cena"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>
                <!-- Conteúdo dos Agentes -->
                <div id="agents" class="tab-pane">
                    <div class="list-item">
                        <img src="imagens/dante.jpg" alt="Dante">
                        <div class="info"><h4>Dante</h4><p>Em cena</p></div>
                        <button class="btn-scene-toggle remove" title="Remover da Cena"><i class="bi bi-dash-lg"></i></button>
                    </div>
                    <div class="list-item">
                        <img src="imagens/arthur.jfif" alt="Arthur">
                        <div class="info"><h4>Arthur</h4><p>Em cena</p></div>
                        <button class="btn-scene-toggle remove" title="Remover da Cena"><i class="bi bi-dash-lg"></i></button>
                    </div>
                     <div class="list-item">
                        <img src="imagens/liz.jpg" alt="Elizabeth">
                        <div class="info"><h4>Elizabeth</h4><p>Em cena</p></div>
                        <button class="btn-scene-toggle remove" title="Remover da Cena"><i class="bi bi-dash-lg"></i></button>
                    </div>
                    <div class="list-item">
                        <img src="imagens/kaiser.jfif" alt="Kaiser">
                        <div class="info"><h4>Kaiser</h4><p>Oculto</p></div>
                        <button class="btn-scene-toggle" title="Adicionar à Cena"><i class="bi bi-plus-lg"></i></button>
                    </div>
                    <div class="list-item">
                        <img src="imagens/erin.jpg" alt="Erin">
                        <div class="info"><h4>Erin</h4><p>Oculto</p></div>
                        <button class="btn-scene-toggle" title="Adicionar à Cena"><i class="bi bi-plus-lg"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTÃO FLUTUANTE PARA ADICIONAR CRIATURA/AGENTE -->
    <button class="btn-add-new" title="Criar Novo">
        <i class="bi bi-plus-lg"></i>
    </button>

    <!-- PAINEL DA CENA (DIREITA) -->
    <div class="scene-panel">
        <header class="scene-header">
            <h1>Ordem Paranormal: Raízes</h1>
            <button class="btn-settings" title="Ajustes">
                <i class="bi bi-gear-fill"></i>
            </button>
            <a href="selecao_campanha.php" class="back-to-hub">
                <i class="bi bi-house-door-fill"></i> Voltar à Seleção
            </a>
        </header>

        <main class="initiative-track">
            <h3>INICIATIVA DA CENA</h3>
            <div class="initiative-scroll-area">
                
                <!-- Card do Turno Ativo -->
                <div class="char-card active-turn">
                    <img src="imagens/dante.jpg" alt="Retrato do Dante" class="portrait">
                    <div class="char-info">
                        <h4 class="char-name">Dante</h4>
                        <p class="char-initiative">Iniciativa: 24</p>
                        <div class="status-bars">
                            <div class="status-bar" title="Vida"><div class="fill hp" style="width: 85%;"></div></div>
                            <div class="status-bar" title="Sanidade"><div class="fill san" style="width: 40%;"></div></div>
                            <div class="status-bar" title="Pontos de Esforço"><div class="fill pe" style="width: 90%;"></div></div>
                        </div>
                    </div>
                    <div class="attributes-stats">
                        <div class="stat-item"><span class="label">FOR</span><div class="value">4</div></div>
                        <div class="stat-item"><span class="label">AGI</span><div class="value">3</div></div>
                        <div class="stat-item"><span class="label">INT</span><div class="value">1</div></div>
                        <div class="stat-item"><span class="label">VIG</span><div class="value">3</div></div>
                        <div class="stat-item"><span class="label">PRE</span><div class="value">1</div></div>
                    </div>
                    <div class="defense-stats">
                        <div class="stat-item" title="Defesa"><span class="label">DEF</span><div class="value">22</div></div>
                        <div class="stat-item" title="Bloqueio"><span class="label">BLOQ</span><div class="value">25</div></div>
                        <div class="stat-item" title="Esquiva"><span class="label">ESQ</span><div class="value">28</div></div>
                    </div>
                </div>

                <!-- Outros Cards -->
                <div class="char-card">
                    <img src="imagens/zumbisangue.jpg" alt="Retrato da Criatura" class="portrait">
                     <div class="char-info">
                        <h4 class="char-name">Zumbi de Sangue</h4>
                        <p class="char-initiative">Iniciativa: 18</p>
                        <div class="status-bars">
                            <div class="status-bar" title="Vida"><div class="fill hp" style="width: 100%;"></div></div>
                        </div>
                    </div>
                    <div class="attributes-stats">
                        <div class="stat-item"><span class="label">FOR</span><div class="value">3</div></div>
                        <div class="stat-item"><span class="label">AGI</span><div class="value">1</div></div>
                        <div class="stat-item"><span class="label">INT</span><div class="value">0</div></div>
                        <div class="stat-item"><span class="label">VIG</span><div class="value">2</div></div>
                        <div class="stat-item"><span class="label">PRE</span><div class="value">0</div></div>
                    </div>
                    <div class="defense-stats">
                        <div class="stat-item" title="Defesa"><span class="label">DEF</span><div class="value">15</div></div>
                    </div>
                </div>

                <div class="char-card">
                    <img src="imagens/arthur.jfif" alt="Retrato do Arthur" class="portrait">
                    <div class="char-info">
                        <h4 class="char-name">Arthur</h4>
                        <p class="char-initiative">Iniciativa: 15</p>
                        <div class="status-bars">
                            <div class="status-bar" title="Vida"><div class="fill hp" style="width: 95%;"></div></div>
                            <div class="status-bar" title="Sanidade"><div class="fill san" style="width: 70%;"></div></div>
                            <div class="status-bar" title="Pontos de Esforço"><div class="fill pe" style="width: 65%;"></div></div>
                        </div>
                    </div>
                    <div class="attributes-stats">
                        <div class="stat-item"><span class="label">FOR</span><div class="value">1</div></div>
                        <div class="stat-item"><span class="label">AGI</span><div class="value">2</div></div>
                        <div class="stat-item"><span class="label">INT</span><div class="value">4</div></div>
                        <div class="stat-item"><span class="label">VIG</span><div class="value">2</div></div>
                        <div class="stat-item"><span class="label">PRE</span><div class="value">3</div></div>
                    </div>
                    <div class="defense-stats">
                        <div class="stat-item" title="Defesa"><span class="label">DEF</span><div class="value">18</div></div>
                        <div class="stat-item" title="Bloqueio"><span class="label">BLOQ</span><div class="value">22</div></div>
                        <div class="stat-item" title="Esquiva"><span class="label">ESQ</span><div class="value">20</div></div>
                    </div>
                </div>

                <div class="char-card">
                    <img src="imagens/liz.jpg" alt="Retrato da Elizabeth" class="portrait">
                    <div class="char-info">
                        <h4 class="char-name">Elizabeth</h4>
                        <p class="char-initiative">Iniciativa: 12</p>
                        <div class="status-bars">
                            <div class="status-bar" title="Vida"><div class="fill hp" style="width: 60%;"></div></div>
                            <div class="status-bar" title="Sanidade"><div class="fill san" style="width: 80%;"></div></div>
                            <div class="status-bar" title="Pontos de Esforço"><div class="fill pe" style="width: 50%;"></div></div>
                        </div>
                    </div>
                    <div class="attributes-stats">
                        <div class="stat-item"><span class="label">FOR</span><div class="value">1</div></div>
                        <div class="stat-item"><span class="label">AGI</span><div class="value">4</div></div>
                        <div class="stat-item"><span class="label">INT</span><div class="value">3</div></div>
                        <div class="stat-item"><span class="label">VIG</span><div class="value">2</div></div>
                        <div class="stat-item"><span class="label">PRE</span><div class="value">2</div></div>
                    </div>
                    <div class="defense-stats">
                        <div class="stat-item" title="Defesa"><span class="label">DEF</span><div class="value">16</div></div>
                        <div class="stat-item" title="Bloqueio"><span class="label">BLOQ</span><div class="value">19</div></div>
                        <div class="stat-item" title="Esquiva"><span class="label">ESQ</span><div class="value">24</div></div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <!-- BOTÃO NO CANTO INFERIOR DIREITO -->
<button class="btn-notes" title="Abrir Bloco de Notas">
    <i class="bi bi-journal-text"></i>
</button>

<!-- POP-UP DO BLOCO DE NOTAS -->
<div id="notes-popup" class="notes-popup">
    <div class="notes-header">
        <span>Bloco de Notas</span>
        <button class="btn-close-notes" title="Fechar">&times;</button>
    </div>
    <textarea class="notes-textarea" placeholder="Digite suas anotações aqui..."></textarea>
</div>

    <script>
        // Lógica para o sistema de abas e visibilidade do botão
        const tabButtons = document.querySelectorAll('.tab-nav-button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        const addNewButton = document.querySelector('.btn-add-new');

        function updateButtonVisibility(activeTabId) {
            addNewButton.classList.add('visible');
            
            if (activeTabId === 'bestiary') {
                addNewButton.title = 'Criar Nova Criatura';
            } else if (activeTabId === 'agents') {
                addNewButton.title = 'Criar Novo Agente';
            }
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabPanes.forEach(pane => pane.classList.remove('active'));

                button.classList.add('active');
                const tabId = button.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');

                updateButtonVisibility(tabId);
            });
        });

        // Garante que o botão esteja visível e com o title correto no carregamento da página
        const initialActiveTab = document.querySelector('.tab-nav-button.active').getAttribute('data-tab');
        updateButtonVisibility(initialActiveTab);

        // Lógica para o botão e pop-up do bloco de notas
const btnNotes = document.querySelector('.btn-notes');
const notesPopup = document.getElementById('notes-popup');
const btnCloseNotes = document.querySelector('.btn-close-notes');

// Abrir o pop-up ao clicar no botão
btnNotes.addEventListener('click', () => {
    notesPopup.classList.add('active');
});

// Fechar o pop-up ao clicar no botão de fechar (opcional)
btnCloseNotes.addEventListener('click', () => {
    notesPopup.classList.remove('active');
});

// Tornar o pop-up arrastável APENAS ao segurar no cabeçalho (parte vermelha)
let isDragging = false;
let dragOffsetX, dragOffsetY;

notesPopup.addEventListener('mousedown', (e) => {
    // Só permite drag se o clique for dentro do cabeçalho
    if (e.target.closest('.notes-header')) {
        isDragging = true;
        dragOffsetX = e.clientX - notesPopup.offsetLeft;
        dragOffsetY = e.clientY - notesPopup.offsetTop;
        notesPopup.style.cursor = 'grabbing'; // Cursor de "segurando" durante o drag
    }
});

document.addEventListener('mousemove', (e) => {
    if (isDragging) {
        notesPopup.style.left = (e.clientX - dragOffsetX) + 'px';
        notesPopup.style.top = (e.clientY - dragOffsetY) + 'px';
        notesPopup.style.transform = 'none'; // Remove o translate inicial para permitir movimento livre
    }
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    notesPopup.style.cursor = 'move'; // Volta ao cursor de move no cabeçalho após soltar
});
    </script>

</body>
</html>

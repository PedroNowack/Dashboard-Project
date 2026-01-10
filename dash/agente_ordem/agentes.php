<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Agentes - Ordem Paranormal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* Definição da fonte Sigilos */
        @font-face {
            font-family: 'sigilos';
            src: url('fontes/sigilos_conhecimento.ttf') format('truetype'); 
            font-display: swap;
        }

        :root {
            --primary-red: #500000;
            --secondary-red: #8B0000;
            --bg-dark: #0a0a0a;
            --bg-panel: #141414;
            --border-color: #2a2a2a;
            --text-light: #dcdcdc;
            --text-muted: #888;
            --accent-glow: rgba(139, 0, 0, 0.7);
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
            grid-template-columns: 120px 1fr;
            grid-template-rows: 100vh;
            overflow: hidden;
        }

        /* ===== OVERLAY DE BOAS-VINDAS ===== */
        #welcome-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 1.5s ease, visibility 1.5s;
        }

        #welcome-text {
            color: var(--secondary-red);
            text-transform: uppercase;
            letter-spacing: 5px;
            text-shadow: 0 0 20px var(--primary-red);
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 0;
            max-width: 95vw;
        }

        .char {
            display: inline-block;
            transition: all 0.3s ease;
        }

        .char.sigilos-style {
            font-family: 'sigilos';
            font-size: 4.5rem;
        }

        .char.arial-style {
            font-family: Arial, sans-serif;
            font-size: 2.8rem;
            letter-spacing: 2px;
        }

        .word-spacer {
            display: inline-block;
            width: 0.8em; 
        }

        /* Esconde o conteúdo inicial para a animação */
        .main-container {
            display: grid;
            grid-template-columns: 120px 1fr;
            width: 100vw;
            height: 100vh;
            opacity: 0;
            transition: opacity 2s ease;
        }

        /* ===== PAINEL ESQUERDO (PERFIL - COMPACTO) ===== */
        .profile-panel {
            background-color: var(--bg-panel);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 12px;
            gap: 12px;
            align-items: center;
        }

        .panel-header {
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
            width: 100%;
        }

        .panel-header h2 {
            font-size: 0.75rem;
            color: var(--secondary-red);
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 8px var(--accent-glow);
        }

        .profile-panel img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid var(--secondary-red);
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        .profile-info {
            text-align: center;
            padding: 8px;
            font-size: 0.75rem;
        }

        .profile-info h3 {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .profile-info p {
            color: var(--text-muted);
            font-size: 0.7rem;
            line-height: 1.2;
        }

        .agent-counter {
            text-align: center;
            padding: 8px;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }

        .agent-counter p {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .agent-counter .count {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--secondary-red);
            text-shadow: 0 0 8px var(--accent-glow);
        }

        /* ===== NOVO: CONTADOR DE CAMPANHAS ===== */
        .campaign-counter {
            text-align: center;
            padding: 8px;
            border-top: 1px solid var(--border-color);
        }

        .campaign-counter p {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .campaign-counter .count {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--secondary-red);
            text-shadow: 0 0 8px var(--accent-glow);
        }

        /* ===== PAINEL DIREITO (BIBLIOTECA) ===== */
        .library-panel {
            padding: 15px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .library-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
        }

        .library-header h1 {
            font-size: 1.6rem;
            text-shadow: 0 0 10px var(--accent-glow);
            flex-grow: 1;
        }

        /* ===== NAVEGAÇÃO POR ABAS ===== */
        .tab-navigation {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 5px;
        }

        .tab-button {
            padding: 10px 20px;
            background: transparent;
            color: var(--text-muted);
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tab-button:hover {
            color: var(--text-light);
            border-bottom-color: var(--primary-red);
        }

        .tab-button.active {
            color: var(--secondary-red);
            border-bottom-color: var(--secondary-red);
            text-shadow: 0 0 8px var(--accent-glow);
        }

        /* ===== CONTEÚDO DAS ABAS ===== */
        .tab-content {
            display: none;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
        }

        .tab-content.active {
            display: flex;
        }

        .back-to-selection {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: var(--primary-red);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 0.9rem;
            transition: background 0.3s, transform 0.2s;
            flex-shrink: 0;
        }

        .back-to-selection:hover {
            background: var(--secondary-red);
            transform: translateY(-2px);
        }

        /* Área de rolagem dos cards (grid layout) */
        .agents-list, .campaigns-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
            overflow-y: auto;
            padding: 5px;
            flex-grow: 1;
        }

        /* Cards de agentes (compactos com fotos quadradas) */
        .agent-card, .campaign-card {
            background: #1c1c1c;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: visible;
            transition: transform 0.3s, border 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            position: relative;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            height: fit-content;
        }

        .agent-card:hover, .campaign-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }

        .agent-card.selected {
            border: 2px solid var(--secondary-red);
            transform: translateY(-3px);
        }

        /* Foto quadrada que ocupa mais espaço */
        .agent-card .portrait, .campaign-card .campaign-image {
            width: 100%;
            height: 140px;
            object-fit: cover;
            object-position: center;
            border-bottom: 1px solid var(--border-color);
            aspect-ratio: 1 / 1;
            border-radius: 10px 10px 0 0;
            display: block;
        }

        .agent-card.selected .portrait {
            border-bottom-color: var(--secondary-red);
        }

        .agent-info, .campaign-info {
            padding: 8px;
            text-align: center;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .agent-card .agent-name, .campaign-card .campaign-name {
            font-size: 0.95rem;
            font-weight: bold;
            color: var(--text-light);
            margin: 0;
            line-height: 1.1;
        }

        .agent-card .agent-class {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--secondary-red);
        }

        .agent-card .agent-trilha {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* Botões de ação (aparecem ao clicar no card) */
        .agent-actions {
            display: none;
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            flex-direction: row;
            gap: 6px;
            z-index: 100;
            background: rgba(0, 0, 0, 0.8);
            padding: 8px;
            border-radius: 6px;
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .agent-actions.active {
            display: flex;
        }

        .btn-action {
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.8rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.4);
        }

        .btn-view {
            background: var(--primary-red);
            color: white;
        }

        .btn-view:hover {
            background: var(--secondary-red);
            transform: scale(1.05);
            box-shadow: 0 3px 8px rgba(139, 0, 0, 0.6);
        }

        .btn-delete {
            background: #333;
            color: white;
        }

        .btn-delete:hover {
            background: #555;
            transform: scale(1.05);
            box-shadow: 0 3px 8px rgba(85, 85, 85, 0.6);
        }

        /* ===== BOTÃO FLUTUANTE ===== */
        .btn-create-agent {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-red);
            color: white;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .btn-create-agent:hover {
            background: var(--secondary-red);
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.7);
        }

        /* ===== SCROLLBAR PERSONALIZADA ===== */
        .agents-list::-webkit-scrollbar, .campaigns-list::-webkit-scrollbar {
            width: 8px;
        }

        .agents-list::-webkit-scrollbar-track, .campaigns-list::-webkit-scrollbar-track {
            background: var(--bg-panel);
            border-radius: 4px;
        }

        .agents-list::-webkit-scrollbar-thumb, .campaigns-list::-webkit-scrollbar-thumb {
            background: var(--primary-red);
            border-radius: 4px;
        }

        .agents-list::-webkit-scrollbar-thumb:hover, .campaigns-list::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-red);
        }

        /* ===== RESPONSIVIDADE ===== */
        @media (max-width: 768px) {
            body {
                grid-template-columns: 1fr;
            }

            .profile-panel {
                display: none;
            }

            .library-header h1 {
                font-size: 1.3rem;
            }

            .agents-list, .campaigns-list {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }
    </style>
</head>
<body>
    <!-- OVERLAY DE BOAS-VINDAS -->
    <div id="welcome-overlay">
        <div id="welcome-text"></div>
    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="main-container" id="content">
        <!-- PAINEL ESQUERDO (PERFIL) -->
        <aside class="profile-panel">
            <div class="panel-header">
                <h2>Nowackpjj</h2>
            </div>
            <img src="imagens/Multilador Noturno.jfif" alt="Foto de Perfil" onerror="this.src='https://via.placeholder.com/80'">
            <div class="profile-info">
                <h3>Gerenciador</h3>
                <p>Biblioteca de Agentes</p>
            </div>
            <div class="agent-counter">
                <p>Agentes</p>
                <div class="count"><span id="currentCount">0</span>/50</div>
            </div>
            <!-- NOVO: Contador de Campanhas -->
            <div class="campaign-counter">
                <p>Campanhas</p>
                <div class="count"><span id="currentCampaignCount">0</span>/20</div>
            </div>
        </aside>

        <!-- PAINEL DIREITO (BIBLIOTECA) -->
        <div class="library-panel">
            <div class="library-header">
                <h1>Sistema de Gestão</h1>
                <a href="/dash/hub/selecao.php" class="back-to-selection">
                    <i class="bi bi-house-door-fill"></i> Voltar
                </a>
            </div>

            <!-- NAVEGAÇÃO POR ABAS -->
            <div class="tab-navigation">
                <button class="tab-button active" data-tab="agents" onclick="switchTab('agents')">
                    <i class="bi bi-people-fill"></i> Biblioteca de Agentes
                </button>
                <button class="tab-button" data-tab="campaigns" onclick="switchTab('campaigns')">
                    <i class="bi bi-collection-fill"></i> Campanhas
                </button>
            </div>

            <!-- ABA: BIBLIOTECA DE AGENTES -->
            <div id="tab-agents" class="tab-content active">
                <main class="agents-list">
                    <!-- Meris -->
                    <div class="agent-card" data-agent="Meris">
                        <img src="imagens/neris.png" alt="Retrato do Meris" class="portrait" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="agent-info">
                            <h4 class="agent-name">Meris</h4>
                            <p class="agent-class">Ocultista</p>
                            <p class="agent-trilha">Médico da Peste</p>
                        </div>
                        <div class="agent-actions">
                            <button class="btn-action btn-view" onclick="viewAgent('Meris', event)">
                                <i class="bi bi-eye-fill"></i> Ver
                            </button>
                            <button class="btn-action btn-delete" onclick="deleteAgent('Meris', event)">
                                <i class="bi bi-trash-fill"></i> Del
                            </button>
                        </div>
                    </div>

                    <!-- Arthur -->
                    <div class="agent-card" data-agent="arthur">
                        <img src="imagens/arthur.jfif" alt="Retrato do Arthur" class="portrait" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="agent-info">
                            <h4 class="agent-name">Arthur</h4>
                            <p class="agent-class">Especialista</p>
                            <p class="agent-trilha">Atirador de Elite</p>
                        </div>
                        <div class="agent-actions">
                            <button class="btn-action btn-view" onclick="viewAgent('arthur', event)">
                                <i class="bi bi-eye-fill"></i> Ver
                            </button>
                            <button class="btn-action btn-delete" onclick="deleteAgent('arthur', event)">
                                <i class="bi bi-trash-fill"></i> Del
                            </button>
                        </div>
                    </div>

                    <!-- Elizabeth -->
                    <div class="agent-card" data-agent="liz">
                        <img src="imagens/liz.jpg" alt="Retrato da Elizabeth" class="portrait" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="agent-info">
                            <h4 class="agent-name">Elizabeth</h4>
                            <p class="agent-class">Especialista</p>
                            <p class="agent-trilha">Médica de Campo</p>
                        </div>
                        <div class="agent-actions">
                            <button class="btn-action btn-view" onclick="viewAgent('liz', event)">
                                <i class="bi bi-eye-fill"></i> Ver
                            </button>
                            <button class="btn-action btn-delete" onclick="deleteAgent('liz', event)">
                                <i class="bi bi-trash-fill"></i> Del
                            </button>
                        </div>
                    </div>

                    <!-- Kaiser -->
                    <div class="agent-card" data-agent="kaiser">
                        <img src="imagens/kaiser.jfif" alt="Retrato do Kaiser" class="portrait" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="agent-info">
                            <h4 class="agent-name">Kaiser</h4>
                            <p class="agent-class">Combatente</p>
                            <p class="agent-trilha">Tropa de Choque</p>
                        </div>
                        <div class="agent-actions">
                            <button class="btn-action btn-view" onclick="viewAgent('kaiser', event)">
                                <i class="bi bi-eye-fill"></i> Ver
                            </button>
                            <button class="btn-action btn-delete" onclick="deleteAgent('kaiser', event)">
                                <i class="bi bi-trash-fill"></i> Del
                            </button>
                        </div>
                    </div>

                    <!-- Erin -->
                    <div class="agent-card" data-agent="erin">
                        <img src="imagens/erin.jpg" alt="Retrato da Erin" class="portrait" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="agent-info">
                            <h4 class="agent-name">Erin</h4>
                            <p class="agent-class">Especialista</p>
                            <p class="agent-trilha">Técnica em Explosivos</p>
                        </div>
                        <div class="agent-actions">
                            <button class="btn-action btn-view" onclick="viewAgent('erin', event)">
                                <i class="bi bi-eye-fill"></i> Ver
                            </button>
                            <button class="btn-action btn-delete" onclick="deleteAgent('erin', event)">
                                <i class="bi bi-trash-fill"></i> Del
                            </button>
                        </div>
                    </div>
                </main>
            </div>

            <!-- ABA: CAMPANHAS -->
            <div id="tab-campaigns" class="tab-content">
                <main class="campaigns-list">
                    <!-- Campanha 1 -->
                    <div class="campaign-card" data-campaign="campanha1">
                        <img src="imagens/calamidade.png" alt="Imagem da Campanha 1" class="campaign-image" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="campaign-info">
                            <h4 class="campaign-name">Calamidade</h4>
                        </div>
                    </div>

                    <!-- Campanha 2 -->
                    <div class="campaign-card" data-campaign="campanha2">
                        <img src="imagens/O_Segredo_na_Ilha_Ep_2.webp" alt="Imagem da Campanha 2" class="campaign-image" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="campaign-info">
                            <h4 class="campaign-name">O Segredo na Ilha</h4>
                        </div>
                    </div>

                    <!-- Campanha 3 -->
                    <div class="campaign-card" data-campaign="campanha3">
                        <img src="imagens/Título_Sinais_do_Outro_Lado.webp" alt="Imagem da Campanha 3" class="campaign-image" onerror="this.src='https://via.placeholder.com/150'">
                        <div class="campaign-info">
                            <h4 class="campaign-name">Sinais do Outro Lado</h4>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- BOTÃO FLUTUANTE PARA CRIAR NOVO AGENTE -->
        <button class="btn-create-agent" title="Criar Novo Agente" onclick="createAgent()">
            <i class="bi bi-plus-lg"></i>
        </button>
    </div>

    <script>
        // ===== SISTEMA DE ANIMAÇÃO ENCRIPTADA =====
        function easeInOutCubic(t) {
            return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        }

        function decryptEffect(element, finalText, duration, callback) {
            element.innerHTML = '';
            const spans = [];
            
            finalText.split('').forEach((char) => {
                if (char === ' ') {
                    const spacer = document.createElement('span');
                    spacer.className = 'word-spacer';
                    element.appendChild(spacer);
                } else {
                    const span = document.createElement('span');
                    span.className = 'char sigilos-style';
                    element.appendChild(span);
                    spans.push({ element: span, targetChar: char, revealed: false });
                }
            });

            let startTime = null;
            
            function animate(timestamp) {
                if (!startTime) startTime = timestamp;
                const rawProgress = (timestamp - startTime) / duration;
                const progress = easeInOutCubic(Math.min(rawProgress, 1));
                
                spans.forEach((item) => {
                    if (!item.revealed) {
                        if (Math.random() < progress * 0.1) {
                            item.revealed = true;
                            item.element.textContent = item.targetChar;
                            item.element.className = 'char arial-style';
                        } else {
                            // Mantém APENAS sigilos durante o processo
                            const randomChar = String.fromCharCode(33 + Math.floor(Math.random() * 94));
                            item.element.textContent = randomChar;
                            item.element.className = 'char sigilos-style';
                        }
                    } else {
                        item.element.className = 'char arial-style';
                    }
                });

                if (rawProgress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    spans.forEach((item) => {
                        item.element.textContent = item.targetChar;
                        item.element.className = 'char arial-style';
                    });
                    if (callback) setTimeout(callback, 1000);
                }
            }
            
            requestAnimationFrame(animate);
        }

        // ===== SISTEMA DE NAVEGAÇÃO POR ABAS COM PERSISTÊNCIA =====
        function switchTab(tabName) {
            // Remove active de todos os botões e conteúdos
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Ativa o botão e conteúdo selecionado
            document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');
            document.getElementById(`tab-${tabName}`).classList.add('active');

            // Salva a aba atual no localStorage
            localStorage.setItem('currentTab', tabName);

            // Atualiza contadores conforme a aba
            if (tabName === 'agents') {
                updateAgentCount();
            } else if (tabName === 'campaigns') {
                updateCampaignCount();
            }
        }

        // ===== RESTAURA ABA APÓS F5 =====
        function restoreTab() {
            const savedTab = localStorage.getItem('currentTab');
            if (savedTab) {
                switchTab(savedTab);
            } else {
                switchTab('agents'); // Padrão
            }
        }

        // ===== LÓGICA DA PÁGINA =====
        function updateAgentCount() {
            const count = document.querySelectorAll('.agent-card').length;
            document.getElementById('currentCount').textContent = count;
        }

        // NOVO: Função para atualizar contador de campanhas
        function updateCampaignCount() {
            const count = document.querySelectorAll('.campaign-card').length;
            document.getElementById('currentCampaignCount').textContent = count;
        }

        function attachCardListeners() {
            const agentCards = document.querySelectorAll('.agent-card');
            agentCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (e.target.closest('.btn-action')) return;
                    agentCards.forEach(c => {
                        c.classList.remove('selected');
                        c.querySelector('.agent-actions').classList.remove('active');
                    });
                    card.classList.add('selected');
                    card.querySelector('.agent-actions').classList.add('active');
                });
            });
        }

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.agent-card') && !e.target.closest('.btn-action')) {
                document.querySelectorAll('.agent-card').forEach(c => {
                    c.classList.remove('selected');
                    c.querySelector('.agent-actions').classList.remove('active');
                });
            }
        });

        function viewAgent(agentId, event) {
            event.stopPropagation();
            window.location.href = `/dash/agente_ordem/ficha_agente.php?id=${agentId}`;
        }

        function deleteAgent(agentId, event) {
            event.stopPropagation();
            if (confirm(`Tem certeza que deseja excluir o agente ${agentId}?`)) {
                const card = document.querySelector(`[data-agent="${agentId}"]`);
                if (card) {
                    card.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => {
                        card.remove();
                        updateAgentCount();
                    }, 300);
                }
            }
        }

        function createAgent() {
            window.location.href = '/dash/agente_ordem/criar_agente.php';
        }

        // Adiciona animação de fade out
        const style = document.createElement('style');
        style.textContent = `@keyframes fadeOut { from { opacity: 1; transform: scale(1); } to { opacity: 0; transform: scale(0.8); } }`;
        document.head.appendChild(style);

        // Inicialização com Animação
        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('welcome-overlay');
            const welcomeText = document.getElementById('welcome-text');
            const content = document.getElementById('content');

            attachCardListeners();
            updateAgentCount();
            updateCampaignCount();  // NOVO: Atualiza contador de campanhas

            // Restaura a aba salva
            restoreTab();

            // Inicia animação de entrada
            decryptEffect(welcomeText, "Bem-Vindo", 3000, () => {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.visibility = 'hidden';
                    content.style.opacity = '1';
                }, 1500);
            });
        });
    </script>
</body>
</html>
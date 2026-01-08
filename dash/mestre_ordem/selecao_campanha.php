
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Campanhas - Ordem Paranormal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Importação da fonte Sigmar One (usada como fallback ou base) */
        @import url('https://fonts.googleapis.com/css2?family=Sigmar+One&display=swap');

        /* Definição da fonte Sigilos (Simulada via Font-Face se você tiver o arquivo, 
           ou usando uma estilização que remeta ao tema se for apenas visual) */
        @font-face {
            font-family: 'sigilos';
            src: url('fontes/sigilos.ttf') format('truetype'); /* Ajuste o caminho se necessário */
        }

        :root {
            --primary-red: #500000;
            --secondary-red: #750904;
            --bg-dark: #0f0f0f;
            --card-bg: #1a1a1a;
            --text-light: #eaeaea;
            --accent-glow: rgba(117, 9, 4, 0.6);
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at center, #1a0505 0%, #0f0f0f 100%);
            color: var(--text-light);
            font-family: Arial, sans-serif;
            padding: 40px;
            overflow-x: hidden;
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
            font-family: 'sigilos', 'Sigmar One', Arial, sans-serif;
            font-size: 4rem;
            color: var(--secondary-red);
            text-transform: uppercase;
            letter-spacing: 5px;
            text-shadow: 0 0 20px var(--primary-red);
            text-align: center;
        }

        /* Esconde o conteúdo inicial para a animação */
        .main-content {
            opacity: 0;
            transition: opacity 2s ease;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 {
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 0 0 15px var(--primary-red);
        }

        /* ===== GRID DE CAMPANHAS ===== */
        .campanhas-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .campanha-wrapper {
            position: relative;
            width: 300px;
        }

        .campanha-card {
            background: var(--card-bg);
            border: 1px solid #333;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 2;
            position: relative;
        }

        .campanha-card:hover {
            transform: scale(1.05);
            border-color: var(--secondary-red);
            box-shadow: 0 10px 30px rgba(0,0,0,0.8);
        }

        .campanha-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-bottom: 2px solid var(--primary-red);
            background-color: #222;
        }

        .campanha-info {
            padding: 20px;
        }

        .campanha-titulo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }

        .campanha-stats {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #aaa;
            margin-bottom: 15px;
        }

        .btn-visualizar {
            width: 100%;
            background: var(--primary-red);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-visualizar:hover {
            background: var(--secondary-red);
        }

        .campanha-popup {
            position: absolute;
            left: 105%;
            top: 50%;
            transform: translateY(-50%) translateX(-20px);
            width: 220px;
            background: #222;
            border: 1px solid var(--primary-red);
            border-radius: 10px;
            padding: 15px;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 10;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        .campanha-wrapper:hover .campanha-popup {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
            pointer-events: all;
        }

        .popup-item {
            margin-bottom: 12px;
            font-size: 13px;
        }

        .popup-label {
            color: var(--secondary-red);
            font-weight: bold;
            display: block;
            text-transform: uppercase;
            font-size: 11px;
            margin-bottom: 2px;
        }

        .popup-value {
            color: #fff;
        }

        .btn-voltar {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255,255,255,0.1);
            border: 1px solid #444;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s;
            z-index: 100;
        }

        .btn-voltar:hover {
            background: var(--primary-red);
            color: white;
        }

        .campanha-card.criar-nova {
            height: 345px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.03);
            border: 2px dashed #444;
            transition: all 0.3s ease;
        }

        .campanha-card.criar-nova:hover {
            background: rgba(80, 0, 0, 0.1);
            border-color: var(--primary-red);
            transform: scale(1.02);
        }

        .criar-conteudo {
            text-align: center;
            color: #666;
            transition: color 0.3s;
        }

        .campanha-card.criar-nova:hover .criar-conteudo {
            color: var(--primary-red);
        }

        .criar-conteudo i {
            font-size: 50px;
            display: block;
            margin-bottom: 15px;
        }

        .criar-conteudo span {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .campanha-wrapper:nth-child(3n) .campanha-popup {
            left: auto;
            right: 105%;
            transform: translateY(-50%) translateX(20px);
        }
        .campanha-wrapper:nth-child(3n):hover .campanha-popup {
            transform: translateY(-50%) translateX(0);
        }

    </style>
</head>
<body>

    <!-- Overlay de Boas-Vindas -->
    <div id="welcome-overlay">
        <h1 id="welcome-text"></h1>
    </div>

    <div class="main-content" id="content">
        <a href="index.html" class="btn-voltar">
            <i class="bi bi-arrow-left"></i> Voltar ao Hub
        </a>

        <div class="header">
            <h1>Minhas Campanhas</h1>
            <p style="color: #888;">Selecione uma campanha para mestrar</p>
        </div>

        <div class="campanhas-grid">
            <!-- Card Criar Nova Campanha -->
            <div class="campanha-wrapper">
                <div class="campanha-card criar-nova" onclick="alert('Abrir modal de criação...')">
                    <div class="criar-conteudo">
                        <i class="bi bi-plus-circle-dotted"></i>
                        <span>Criar Nova Campanha</span>
                    </div>
                </div>
            </div>
            
            <!-- Campanha 1 -->
            <div class="campanha-wrapper">
                <div class="campanha-card" onclick="window.location.href='ordem_mestre.html'">
                    <img src="imagens/campanha1.jpg" class="campanha-img" alt="Sinais do Outro Lado" onerror="this.src='https://via.placeholder.com/300x180?text=Sinais+do+Outro+Lado'">
                    <div class="campanha-info">
                        <div class="campanha-titulo">Sinais do Outro Lado</div>
                        <div class="campanha-stats">
                            <span><i class="bi bi-people-fill"></i> 4 Jogadores</span>
                            <span><i class="bi bi-calendar-event"></i> Ativa</span>
                        </div>
                        <button class="btn-visualizar">
                            <i class="bi bi-eye"></i> Visualizar
                        </button>
                    </div>
                </div>
                <div class="campanha-popup">
                    <div class="popup-item">
                        <span class="popup-label">Sistema de Nível</span>
                        <span class="popup-value">NEX e Nível</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Aprendizado</span>
                        <span class="popup-value">Aprendizado Normal</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Recursos</span>
                        <span class="popup-value">PE e SAN</span>
                    </div>
                </div>
            </div>

            <!-- Campanha 2 -->
            <div class="campanha-wrapper">
                <div class="campanha-card" onclick="window.location.href='ordem_mestre.html'">
                    <img src="imagens/segredo.webp" class="campanha-img" alt="O Segredo na Ilha" onerror="this.src='https://via.placeholder.com/300x180?text=O+Segredo+na+Ilha'">
                    <div class="campanha-info">
                        <div class="campanha-titulo">O Segredo na Ilha</div>
                        <div class="campanha-stats">
                            <span><i class="bi bi-people-fill"></i> 5 Jogadores</span>
                            <span><i class="bi bi-calendar-event"></i> Pausada</span>
                        </div>
                        <button class="btn-visualizar">
                            <i class="bi bi-eye"></i> Visualizar
                        </button>
                    </div>
                </div>
                <div class="campanha-popup">
                    <div class="popup-item">
                        <span class="popup-label">Sistema de Nível</span>
                        <span class="popup-value">Por Patente</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Aprendizado</span>
                        <span class="popup-value">Aprendizado Lento</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Recursos</span>
                        <span class="popup-value">Determinação</span>
                    </div>
                </div>
            </div>

            <!-- Campanha 3 -->
            <div class="campanha-wrapper">
                <div class="campanha-card" onclick="window.location.href='ordem_mestre.html'">
                    <img src="imagens/calamidade.webp" class="campanha-img" alt="Calamidade" onerror="this.src='https://via.placeholder.com/300x180?text=Calamidade'">
                    <div class="campanha-info">
                        <div class="campanha-titulo">Calamidade</div>
                        <div class="campanha-stats">
                            <span><i class="bi bi-people-fill"></i> 6 Jogadores</span>
                            <span><i class="bi bi-calendar-event"></i> Finalizada</span>
                        </div>
                        <button class="btn-visualizar">
                            <i class="bi bi-eye"></i> Visualizar
                        </button>
                    </div>
                </div>
                <div class="campanha-popup">
                    <div class="popup-item">
                        <span class="popup-label">Sistema de Nível</span>
                        <span class="popup-value">NEX</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Aprendizado</span>
                        <span class="popup-value">Aprendizado Normal</span>
                    </div>
                    <div class="popup-item">
                        <span class="popup-label">Recursos</span>
                        <span class="popup-value">PE e SAN</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função de easing cúbica para suavizar o progresso
        function easeInOutCubic(t) {
            return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        }

        // Função para efeito de desencriptação (Scramble Text)
        function decryptEffect(element, finalText, duration, callback) {
            element.style.fontFamily = 'sigilos, Arial, sans-serif';
            
            let startTime = null;
            const letters = finalText.split('');
            const revealed = new Array(letters.length).fill(false);
            
            function animate(timestamp) {
                if (!startTime) startTime = timestamp;
                const rawProgress = (timestamp - startTime) / duration;
                const progress = easeInOutCubic(Math.min(rawProgress, 1));
                
                letters.forEach((char, i) => {
                    if (!revealed[i] && Math.random() < progress * 0.1) {
                        revealed[i] = true;
                    }
                });

                const currentText = letters.map((char, i) => 
                    revealed[i] ? char : Math.random().toString(36)[2]
                ).join('');
                
                element.textContent = currentText;

                if (rawProgress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    element.textContent = finalText;
                    if (callback) setTimeout(callback, 1000); // Espera 1s após terminar para sumir
                }
            }
            
            requestAnimationFrame(animate);
        }

        // Inicia a animação ao carregar a página
        window.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('welcome-overlay');
            const welcomeText = document.getElementById('welcome-text');
            const content = document.getElementById('content');

            // Inicia o efeito de desencriptação
            decryptEffect(welcomeText, "BEM VINDO", 3000, () => {
                // Após a animação, esconde o overlay e mostra o conteúdo
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

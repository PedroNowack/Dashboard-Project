<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Mestre - Ordem Paranormal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-red: #500000;
            --secondary-red: #750904;
            --bg-dark: #0f0f0f;
            --sidebar-bg: #1e1e1e;
            --text-light: #eaeaea;
            --accent-glow: rgba(117, 9, 4, 0.5);
        }

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: var(--bg-dark);
            color: var(--text-light);
            display: grid;
            grid-template-columns: 250px 1fr;
            overflow: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background: var(--sidebar-bg);
            border-right: 1px solid #2a2a2a;
            display: flex;
            flex-direction: column;
            padding: 20px;
            z-index: 10;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar-header h2 {
            font-size: 18px;
            color: var(--secondary-red);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 10px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(80, 0, 0, 0.2);
            border-color: var(--primary-red);
            color: #fff;
            box-shadow: 0 0 10px var(--accent-glow);
        }

        .back-to-hub {
            margin-top: auto;
            padding: 12px;
            background: var(--primary-red);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s;
        }

        .back-to-hub:hover {
            background: var(--secondary-red);
            color: white;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 30px;
            overflow-y: auto;
            background: linear-gradient(135deg, #0f0f0f 0%, #1a0505 100%);
        }

        .header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--primary-red);
            padding-bottom: 15px;
        }

        .header-panel h1 {
            font-size: 24px;
            margin: 0;
            text-shadow: 0 0 10px var(--primary-red);
        }

        /* ===== DASHBOARD GRID ===== */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card-custom {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            border-color: var(--secondary-red);
        }

        .card-title {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: var(--secondary-red);
            font-weight: bold;
            font-size: 18px;
        }

        .card-title i {
            margin-right: 10px;
        }

        .stat-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #2a2a2a;
        }

        .stat-value {
            color: #fff;
            font-weight: bold;
        }

        /* ===== QUICK ACTIONS ===== */
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-action {
            flex: 1;
            background: #2a2a2a;
            border: 1px solid #444;
            color: white;
            padding: 10px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-action:hover {
            background: var(--primary-red);
            border-color: var(--secondary-red);
        }

        /* Scrollbar Custom */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f0f0f; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-red); }

    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="/dash/hub/imagens/Multilador Noturno.jfif" alt="Mestre" style="width: 80px; height: 80px; border-radius: 50%; border: 2px solid var(--primary-red); object-fit: cover;">
            <h2>Mestre</h2>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people"></i> Agentes
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-journal-text"></i> Missões
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-skull"></i> Bestiário
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-gear"></i> Configurações
                </a>
            </li>
        </ul>

        <a href="/dash/hub/selecao.php" class="back-to-hub">
            <i class="bi bi-house-door"></i> Voltar ao Hub
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="header-panel">
            <h1>Painel de Controle Paranormal</h1>
            <div class="status-session">
                <span class="badge bg-danger">Sessão Ativa</span>
            </div>
        </div>

        <div class="dashboard-grid">
            <!-- Card: Resumo da Missão -->
            <div class="card-custom">
                <div class="card-title">
                    <i class="bi bi-geo-alt"></i> Localização Atual
                </div>
                <p>Sanatório de Arkham - Ala Oeste</p>
                <div class="stat-row">
                    <span>Nível de Exposição</span>
                    <span class="stat-value text-danger">Alto</span>
                </div>
                <div class="stat-row">
                    <span>Membrana</span>
                    <span class="stat-value">Instável (0.8)</span>
                </div>
            </div>

            <!-- Card: Status dos Agentes -->
            <div class="card-custom">
                <div class="card-title">
                    <i class="bi bi-heart-pulse"></i> Status do Grupo
                </div>
                <div class="stat-row">
                    <span>Agente Arthur</span>
                    <span class="stat-value text-success">Saudável</span>
                </div>
                <div class="stat-row">
                    <span>Agente Elizabeth</span>
                    <span class="stat-value text-warning">Ferida</span>
                </div>
                <div class="stat-row">
                    <span>Agente Dante</span>
                    <span class="stat-value text-danger">Enlouquecendo</span>
                </div>
            </div>

            <!-- Card: Iniciativa -->
            <div class="card-custom">
                <div class="card-title">
                    <i class="bi bi-list-ol"></i> Ordem de Iniciativa
                </div>
                <div class="stat-row">
                    <span>1. Dante</span>
                    <span class="stat-value">24</span>
                </div>
                <div class="stat-row">
                    <span>2. Criatura</span>
                    <span class="stat-value">18</span>
                </div>
                <div class="stat-row">
                    <span>3. Arthur</span>
                    <span class="stat-value">15</span>
                </div>
            </div>
        </div>

        <div class="header-panel mt-5">
            <h1>Ações Rápidas do Mestre</h1>
        </div>

        <div class="quick-actions">
            <button class="btn-action"><i class="bi bi-dice-6"></i> Rolar Dados</button>
            <button class="btn-action"><i class="bi bi-lightning-charge"></i> Gerar Encontro</button>
            <button class="btn-action"><i class="bi bi-music-note-beamed"></i> Mudar Trilha</button>
            <button class="btn-action"><i class="bi bi-eye"></i> Revelar Pista</button>
        </div>
    </div>

</body>
</html>
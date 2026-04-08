<?php
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Pet não informado.");
}

$apiUrl = "http://localhost:8888/adote_aqui/api/animal.php?id=" . urlencode($id);

$resposta = @file_get_contents($apiUrl);

if (!$resposta) {
    die("Erro ao buscar dados do pet.");
}

$animal = json_decode($resposta, true);

if (!$animal || (isset($animal['sucesso']) && $animal['sucesso'] === false)) {
    die("Pet não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($animal['nome']); ?></h1>
    <p>Conheça melhor este pet e entre em contato com o responsável para dar o próximo passo na adoção.</p>
    <hr>
</header>

<main id="informacoesDoPet">
    <article id="dadosDoPet">

        <img
            src="<?php echo !empty($animal['foto']) ? htmlspecialchars($animal['foto']) : 'assets/dogstock.jpg'; ?>"
            alt="Foto do pet"
        >

        <div id="informacoesGerais">
            <div class="info-card">
                <span class="info-label">Sexo</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['sexo'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Espécie</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['especie'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Data de nascimento</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['data_nascimento'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Porte</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['porte'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Peso</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['peso_atual'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Cor da pelagem</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['cor_pelagem'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Raça</span>
                <span class="info-value"><?php echo htmlspecialchars($animal['raca'] ?? '-'); ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Vacinado</span>
                <span class="info-value"><?php echo !empty($animal['vacinado']) ? 'Sim' : 'Não'; ?></span>
            </div>

            <div class="info-card">
                <span class="info-label">Castrado</span>
                <span class="info-value"><?php echo !empty($animal['castrado']) ? 'Sim' : 'Não'; ?></span>
            </div>
        </div>

        <div id="descricao">
            <h2>Descrição</h2>
            <p><?php echo htmlspecialchars($animal['descricao'] ?? 'Sem descrição.'); ?></p>
        </div>

        <div class="detail-actions">
            <a href="index.php">
                <button class="botao corPrincipal">Voltar</button>
            </a>

            <a
                href="https://wa.me/55<?php echo preg_replace('/\D/', '', $animal['numero_contato']); ?>"
                target="_blank"
            >
                <button class="botao corSecundaria">Entrar em contato</button>
            </a>
        </div>

    </article>
</main>

</body>
</html>
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
    <title>Detalhes do PET</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($animal['nome']); ?></h1>
    <hr>
</header>

<main id="informacoesDoPet">
    <article id="dadosDoPet">

        <img
            src="<?php echo !empty($animal['foto']) ? htmlspecialchars($animal['foto']) : 'assets/dogstock.jpg'; ?>"
            alt="Foto do pet"
        >

        <div id="informacoesGerais">
            <p><strong>Sexo:</strong> <?php echo htmlspecialchars($animal['sexo'] ?? '-'); ?></p>
            <p><strong>Espécie:</strong> <?php echo htmlspecialchars($animal['especie'] ?? '-'); ?></p>
            <p><strong>Data de nascimento:</strong> <?php echo htmlspecialchars($animal['data_nascimento'] ?? '-'); ?></p>
            <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal['porte'] ?? '-'); ?></p>
            <p><strong>Peso:</strong> <?php echo htmlspecialchars($animal['peso_atual'] ?? '-'); ?></p>
            <p><strong>Cor da pelagem:</strong> <?php echo htmlspecialchars($animal['cor_pelagem'] ?? '-'); ?></p>
            <p><strong>Raça:</strong> <?php echo htmlspecialchars($animal['raca'] ?? '-'); ?></p>
            <p><strong>Vacinado:</strong> <?php echo !empty($animal['vacinado']) ? 'Sim' : 'Não'; ?></p>
            <p><strong>Castrado:</strong> <?php echo !empty($animal['castrado']) ? 'Sim' : 'Não'; ?></p>
        </div>

        <div id="descricao">
            <h2>Descrição</h2>
            <p><?php echo htmlspecialchars($animal['descricao'] ?? 'Sem descrição.'); ?></p>
        </div>

        <div style="margin-top:20px;">
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
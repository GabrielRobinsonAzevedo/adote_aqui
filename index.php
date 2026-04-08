<?php
$apiUrl = 'http://localhost:8888/adote_aqui/api/animais.php';
$animais = [];

$resposta = @file_get_contents($apiUrl);

if ($resposta !== false) {
    $dados = json_decode($resposta, true);

    if (is_array($dados)) {
        $animais = $dados;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adote aqui</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Adote aqui - Adoção de animais</h1>
        <hr>
        <a href="cadastro.php">
            <button class="botao corPrincipal">Cadastrar Novo Pet</button>
        </a>
    </header>

    <main id="cardHolder">
        <?php if (!empty($animais)): ?>
            <?php foreach ($animais as $animal): ?>
                <article class="card">
                    <div class="imageContainer">
                        <img
                            class="dogPhoto"
                            src="<?php echo !empty($animal['foto']) ? htmlspecialchars($animal['foto']) : 'assets/dogstock.jpg'; ?>"
                            alt="Pet disponível para adoção"
                        >
                    </div>

                    <h2 class="pet-name">
                        <?php echo htmlspecialchars($animal['nome'] ?? 'Pet sem nome'); ?>
                    </h2>

                    <p class="pet-description">
                        <?php
                        $descricao = $animal['descricao'] ?? 'Sem descrição disponível.';
                        echo htmlspecialchars(mb_strimwidth($descricao, 0, 80, '...'));
                        ?>
                    </p>

                    <div class="cardButton">
                        <a href="verMais.php?id=<?php echo urlencode($animal['id']); ?>">
                            <button class="botao corPrincipal">Ver mais</button>
                        </a>

                        <a
                            href="https://wa.me/55<?php echo preg_replace('/\D/', '', $animal['numero_contato'] ?? ''); ?>"
                            target="_blank"
                        >
                            <button class="botao corSecundaria">Entrar em contato</button>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum pet cadastrado no momento.</p>
        <?php endif; ?>
    </main>
</body>
</html>
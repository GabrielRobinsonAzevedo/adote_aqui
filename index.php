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
    <title>Adote Aqui</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Adote Aqui</h1>
        <p>Encontre um novo melhor amigo e ajude a transformar a vida de um pet com adoção responsável, simples e acessível.</p>
        <hr>
    </header>

    <main>
        <div class="top-actions">
            <a href="cadastro.php">
                <button class="botao corPrincipal">Cadastrar Novo Pet</button>
            </a>
        </div>

        <section id="cardHolder">
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

                        <div class="card-content">
                            <h2 class="pet-name">
                                <?php echo htmlspecialchars($animal['nome'] ?? 'Pet sem nome'); ?>
                            </h2>

                            <div class="pet-meta">
                                <span class="pet-tag"><?php echo htmlspecialchars($animal['especie'] ?? 'Não informado'); ?></span>
                                <span class="pet-tag"><?php echo htmlspecialchars($animal['sexo'] ?? 'Não informado'); ?></span>
                                <?php if (!empty($animal['porte'])): ?>
                                    <span class="pet-tag"><?php echo htmlspecialchars($animal['porte']); ?></span>
                                <?php endif; ?>
                            </div>

                            <p class="pet-description">
                                <?php
                                $descricao = $animal['descricao'] ?? 'Sem descrição disponível.';
                                echo htmlspecialchars(mb_strimwidth($descricao, 0, 100, '...'));
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
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <p>Nenhum pet cadastrado no momento.</p>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
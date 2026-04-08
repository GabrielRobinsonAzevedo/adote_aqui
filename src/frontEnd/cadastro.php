<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de PET</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Adote aqui - Cadastro de PET</h1>
        <hr>
    </header>
    <form id="formSign" action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nome">Nome *</label>
            <input type="text" name="nome" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="sexo">Sexo *</label>
            <input type="text" name="sexo" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="especie">Espécie *</label>
            <input type="text" name="especie" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="dataDeNascimento">Data de nascimento *</label>
            <input type="date" name="dataDeNascimento" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="porte">Porte *</label>
            <input type="text" name="porte" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="pesoAtual">Peso atual *</label>
            <input type="numer" step="0.1" name="pesoAtual" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="CorPelagem">Cor da pelagem *</label>
            <input type="text" name="CorPelagem" placeholder="Placeholder" required>
        </div>

        <div class="form-group">
            <label for="raca">Raça *</label>
            <input type="text" name="raca" placeholder="Placeholder" required>
        </div>

        <div class="form-group full">
            <label for="imagem">Foto *</label>
            <input type="file" name="imagem" required>
        </div>

        <div class="form-group full">
            <label for="descricao">Descrição *</label>
            <textarea name="descricao" placeholder="Placeholder" required></textarea>
        </div>

        <div class="checkbox-group">
            <label><input type="checkbox" name="castrado" value="1"> Castrado</label>
            <label><input type="checkbox" name="vacinado" value="1"> Vacinado</label>
        </div>

        <input type="submit" value="Confirmar">
    </form>
</body>
</html>
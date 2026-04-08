<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1>Cadastro de Pet</h1>
    <p>Preencha os dados do animal para disponibilizá-lo na vitrine de adoção.</p>
    <hr>
</header>

<main>
    <div class="form-wrapper">
        <form id="formSign">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nome *</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="form-group">
                    <label>Sexo *</label>
                    <select name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="Macho">Macho</option>
                        <option value="Fêmea">Fêmea</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Espécie *</label>
                    <input type="text" name="especie" required>
                </div>

                <div class="form-group">
                    <label>Data de nascimento</label>
                    <input type="date" name="data_nascimento">
                </div>

                <div class="form-group">
                    <label>Porte</label>
                    <input type="text" name="porte">
                </div>

                <div class="form-group">
                    <label>Peso atual</label>
                    <input type="number" step="0.1" name="peso_atual">
                </div>

                <div class="form-group">
                    <label>Cor da pelagem</label>
                    <input type="text" name="cor_pelagem">
                </div>

                <div class="form-group">
                    <label>Raça</label>
                    <input type="text" name="raca">
                </div>

                <div class="form-group full">
                    <label>Descrição</label>
                    <textarea name="descricao"></textarea>
                </div>

                <div class="form-group full">
                    <label>Contato (WhatsApp) *</label>
                    <input type="text" name="numero_contato" required>
                </div>

                <div class="form-group full">
                    <label>URL da foto</label>
                    <input type="text" name="foto">
                </div>

                <div class="form-group full">
                    <div class="checkbox-row">
                        <label>
                            <input type="checkbox" name="castrado">
                            Castrado
                        </label>

                        <label>
                            <input type="checkbox" name="vacinado">
                            Vacinado
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="botao corPrincipal">Cadastrar</button>

                <a href="index.php">
                    <button type="button" class="botao corSecundaria">Voltar</button>
                </a>
            </div>
        </form>
    </div>
</main>

<script>
document.getElementById('formSign').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const dados = {
        nome: formData.get('nome'),
        sexo: formData.get('sexo'),
        especie: formData.get('especie'),
        data_nascimento: formData.get('data_nascimento'),
        porte: formData.get('porte'),
        peso_atual: formData.get('peso_atual'),
        cor_pelagem: formData.get('cor_pelagem'),
        raca: formData.get('raca'),
        descricao: formData.get('descricao'),
        numero_contato: formData.get('numero_contato'),
        foto: formData.get('foto'),
        castrado: formData.get('castrado') ? 1 : 0,
        vacinado: formData.get('vacinado') ? 1 : 0
    };

    try {
        const resposta = await fetch('api/animais.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dados)
        });

        const texto = await resposta.text();
        console.log('Resposta bruta da API:', texto);

        let resultado;
        try {
            resultado = JSON.parse(texto);
        } catch (e) {
            alert('A API retornou uma resposta inválida:\n\n' + texto);
            return;
        }

        alert(resultado.mensagem || 'Resposta recebida.');

        if (resultado.sucesso) {
            window.location.href = 'index.php';
        }

    } catch (erro) {
        console.error(erro);
        alert('Erro ao conectar com o servidor.');
    }
});
</script>

</body>
</html>
1. Visão geral

A API do sistema Adote Aqui foi desenvolvida para permitir a comunicação entre a interface web e o back end em PHP, realizando operações de cadastro e consulta de animais disponíveis para adoção.

A comunicação entre cliente e servidor é feita no padrão HTTP, com troca de dados em formato JSON. A API foi projetada para ser consumida de forma assíncrona pelo front end, utilizando fetch, conforme proposto para a aplicação web. O objetivo principal é suportar as funcionalidades previstas no sistema, como cadastro de pet, listagem dos animais cadastrados e exibição detalhada das informações de cada pet.

2. URL base

Em ambiente local com MAMP, a URL base da API é:

http://localhost:8888/adote_aqui/api

3. Formato de comunicação
Requisições

As requisições podem utilizar os métodos HTTP:

GET
POST
OPTIONS
Respostas

As respostas da API são retornadas em formato:

application/json
Codificação
UTF-8

4. Configuração de cabeçalhos

A API foi preparada para permitir integração com o front end hospedado localmente em outra porta, por exemplo um projeto Next.js em localhost:3000.

Exemplo de cabeçalhos utilizados:

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

Esses cabeçalhos permitem o funcionamento correto da comunicação entre front end e back end em ambiente de desenvolvimento.

5. Endpoints disponíveis
5.1 Listar animais
Endpoint
GET /animais.php
Descrição

Retorna a lista de pets cadastrados no sistema.

Objetivo

Atender à funcionalidade de visualização dos pets cadastrados na tela inicial, em formato de cards. Essa funcionalidade está prevista nos requisitos do sistema.

Exemplo de requisição
GET http://localhost:8888/adote_aqui/api/animais.php
Exemplo de resposta de sucesso
[
  {
    "id": 3,
    "nome": "Toto",
    "sexo": "Macho",
    "especie": "Cachorro",
    "idade": 2,
    "descricao": "Cachorro dócil e brincalhão.",
    "numero_contato": "54999999999",
    "foto": "https://meusite.com/imagens/toto.jpg",
    "castrado": 1,
    "vacinado": 1
  },
  {
    "id": 2,
    "nome": "Luna",
    "sexo": "Fêmea",
    "especie": "Gato",
    "idade": 1,
    "descricao": "Gata calma e carinhosa.",
    "numero_contato": "54988888888",
    "foto": "https://meusite.com/imagens/luna.jpg",
    "castrado": 0,
    "vacinado": 1
  }
]
Regras

A listagem deve retornar os animais ordenados do mais recente para o mais antigo.

5.2 Cadastrar animal
Endpoint
POST /animais.php
Descrição

Realiza o cadastro de um novo pet no sistema.

Objetivo

Atender à funcionalidade de cadastro de novo pet, prevista no sistema.

Corpo da requisição
{
  "nome": "Toto",
  "sexo": "Macho",
  "especie": "Cachorro",
  "idade": 2,
  "descricao": "Cachorro dócil e brincalhão.",
  "numero_contato": "54999999999",
  "foto": "https://meusite.com/imagens/toto.jpg",
  "castrado": true,
  "vacinado": true
}
Campos aceitos
Campo	Tipo	Obrigatório	Descrição
nome	string	Sim	Nome do pet
sexo	string	Não	Sexo do animal
especie	string	Sim	Espécie do pet
idade	integer	Não	Idade do pet
descricao	string	Não	Descrição do animal
numero_contato	string	Sim	Número de WhatsApp do responsável
foto	string	Não	URL ou caminho da imagem
castrado	boolean	Não	Indica se o animal é castrado
vacinado	boolean	Não	Indica se o animal é vacinado
Exemplo de requisição
POST http://localhost:8888/adote_aqui/api/animais.php
Content-Type: application/json
Exemplo de resposta de sucesso
{
  "sucesso": true,
  "mensagem": "Pet cadastrado com sucesso"
}
Exemplo de resposta de erro
{
  "sucesso": false,
  "mensagem": "Nome e espécie são obrigatórios"
}
Regras de negócio aplicadas

Na camada de serviço, são aplicadas validações mínimas para garantir a consistência dos dados recebidos. Entre as principais regras:

o campo nome é obrigatório
o campo especie é obrigatório
o campo numero_contato é obrigatório

Caso algum desses campos não seja informado, o sistema retorna mensagem de erro e o cadastro não é realizado.

5.3 Buscar animal por ID
Endpoint
GET /animal.php?id={id}
Descrição

Retorna os dados completos de um animal específico.

Objetivo

Atender à funcionalidade de visualização detalhada de um pet ao clicar em “Ver mais”, conforme previsto no projeto.

Parâmetro
Nome	Tipo	Obrigatório	Descrição
id	integer	Sim	Identificador do animal
Exemplo de requisição
GET http://localhost:8888/adote_aqui/api/animal.php?id=3
Exemplo de resposta de sucesso
{
  "id": 3,
  "nome": "Toto",
  "sexo": "Macho",
  "especie": "Cachorro",
  "idade": 2,
  "descricao": "Cachorro dócil e brincalhão.",
  "numero_contato": "54999999999",
  "foto": "https://meusite.com/imagens/toto.jpg",
  "castrado": 1,
  "vacinado": 1
}
Exemplo de resposta quando não encontrado
{
  "sucesso": false,
  "mensagem": "Animal não encontrado"
}
5.4 Listar vacinas
Endpoint
GET /vacinas.php
Descrição

Retorna a lista de vacinas cadastradas no banco de dados.

Objetivo

Este endpoint pode ser utilizado para popular campos de seleção no formulário, caso a aplicação deseje evoluir para trabalhar com o relacionamento entre animais e vacinas previsto no modelo de banco de dados. O modelo ER do projeto apresenta uma entidade específica para vacinas e uma tabela de associação entre animal e vacinas.

Exemplo de requisição
GET http://localhost:8888/adote_aqui/api/vacinas.php
Exemplo de resposta
[
  {
    "id": 1,
    "nome": "Antirrábica"
  },
  {
    "id": 2,
    "nome": "V10"
  }
]
6. Códigos de resposta HTTP

A API pode utilizar os seguintes códigos de resposta:

Código	Significado	Uso
200	OK	Requisição processada com sucesso
201	Created	Cadastro realizado com sucesso, se desejado
400	Bad Request	Dados inválidos ou incompletos
404	Not Found	Recurso não encontrado
405	Method Not Allowed	Método HTTP não permitido
500	Internal Server Error	Erro interno do servidor

Em uma implementação simplificada, todas as respostas podem ser retornadas com código 200 e um objeto JSON indicando sucesso ou falha. No entanto, em uma evolução futura, recomenda-se o uso mais rigoroso dos códigos HTTP para melhorar a padronização da API.

7. Estrutura de resposta padronizada

Para facilitar a integração com o front end, recomenda-se manter o seguinte padrão:

Resposta de sucesso
{
  "sucesso": true,
  "mensagem": "Operação realizada com sucesso"
}
Resposta de erro
{
  "sucesso": false,
  "mensagem": "Descrição do erro"
}
Resposta de listagem
[
  {
    "id": 1,
    "nome": "Exemplo"
  }
]
Resposta de item único
{
  "id": 1,
  "nome": "Exemplo"
}
8. Exemplo de uso com fetch
Cadastrar animal
const response = await fetch("http://localhost:8888/adote_aqui/api/animais.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify({
    nome: "Toto",
    sexo: "Macho",
    especie: "Cachorro",
    idade: 2,
    descricao: "Cachorro dócil",
    numero_contato: "54999999999",
    foto: "",
    castrado: true,
    vacinado: true
  })
});

const data = await response.json();
console.log(data);
Listar animais
const response = await fetch("http://localhost:8888/adote_aqui/api/animais.php");
const data = await response.json();
console.log(data);
Buscar detalhes de um animal
const response = await fetch("http://localhost:8888/adote_aqui/api/animal.php?id=1");
const data = await response.json();
console.log(data);
9. Relação da API com os requisitos do sistema

A API foi planejada para atender diretamente aos requisitos funcionais apresentados no projeto:

Requisito	Descrição	Endpoint relacionado
RU01	Cadastrar um novo pet	POST /animais.php
RU02	Visualizar pets cadastrados	GET /animais.php
RU03	Ver detalhes de um pet	GET /animal.php?id={id}
RU04	Entrar em contato com o responsável	uso do campo numero_contato para redirecionamento ao WhatsApp
RU06	Manter dados temporariamente	substituído por persistência em banco de dados no back end

No documento original, a proposta inicial previa armazenamento local no navegador, mas na etapa de implementação do back end esse armazenamento passa a ser realizado no banco de dados MySQL, o que representa uma evolução da arquitetura do sistema.

10. Considerações finais

A API do sistema Adote Aqui foi estruturada para ser simples, objetiva e compatível com a proposta acadêmica do projeto. Sua principal função é permitir que a interface web envie e recupere dados dos pets cadastrados, garantindo integração com o banco de dados e separação entre front end, regras de negócio e persistência.

A adoção desse modelo torna o sistema mais organizado, facilita a manutenção do código e permite futura expansão, como inclusão de edição, exclusão, upload real de imagem e gerenciamento de vacinas e raças.

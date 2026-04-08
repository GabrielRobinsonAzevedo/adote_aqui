<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repository/AnimalRepository.php';
require_once __DIR__ . '/../service/AnimalService.php';

class AnimalController
{
    public $service;

    public function __construct()
    {
        $conn = Database::connect();
        $repository = new AnimalRepository($conn);
        $this->service = new AnimalService($repository);
    }

    public function listar()
    {
        echo json_encode($this->service->listar());
    }

    public function cadastrar()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';

        if (stripos($contentType, 'application/json') !== false) {
            $dados = json_decode(file_get_contents("php://input"), true) ?? [];
            echo json_encode($this->service->cadastrar($dados));
            return;
        }

        $dados = $_POST;
        $dados['castrado'] = isset($dados['castrado']) ? (int)$dados['castrado'] : 0;
        $dados['vacinado'] = isset($dados['vacinado']) ? (int)$dados['vacinado'] : 0;
        $dados['foto'] = '';

        if (isset($_FILES['foto_arquivo']) && $_FILES['foto_arquivo']['error'] !== UPLOAD_ERR_NO_FILE) {
            $upload = $_FILES['foto_arquivo'];

            if ($upload['error'] !== UPLOAD_ERR_OK) {
                echo json_encode([
                    'sucesso' => false,
                    'mensagem' => 'Erro ao enviar a imagem.'
                ]);
                return;
            }

            $tiposPermitidos = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
                'image/gif' => 'gif'
            ];

            $mimeType = mime_content_type($upload['tmp_name']);

            if (!isset($tiposPermitidos[$mimeType])) {
                echo json_encode([
                    'sucesso' => false,
                    'mensagem' => 'Formato de imagem não permitido. Use JPG, PNG, WEBP ou GIF.'
                ]);
                return;
            }

            $uploadsDir = dirname(__DIR__, 2) . '/uploads';

            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0777, true);
            }

            $extensao = $tiposPermitidos[$mimeType];
            $nomeArquivo = uniqid('pet_', true) . '.' . $extensao;
            $caminhoAbsoluto = $uploadsDir . '/' . $nomeArquivo;
            $caminhoRelativo = 'uploads/' . $nomeArquivo;

            if (!move_uploaded_file($upload['tmp_name'], $caminhoAbsoluto)) {
                echo json_encode([
                    'sucesso' => false,
                    'mensagem' => 'Não foi possível salvar a imagem enviada.'
                ]);
                return;
            }

            $dados['foto'] = $caminhoRelativo;
        }

        echo json_encode($this->service->cadastrar($dados));
    }
}
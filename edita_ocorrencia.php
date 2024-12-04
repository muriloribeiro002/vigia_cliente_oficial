<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $id_ocorrencia = $_POST['id_ocorrencia'];
    $descricao = $_POST['descricao'];
    $dt_evento = $_POST['dt_evento'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];

    // Atualizar a ocorrência no banco de dados
    $sql = "UPDATE ocorrencia SET descricao = ?, dt_evento = ?, tipo = ?, endereco = ? WHERE ID_ocorrencia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $descricao, $dt_evento, $tipo, $endereco, $id_ocorrencia);

    if ($stmt->execute()) {
        echo "Ocorrência atualizada com sucesso";
    } else {
        echo "Erro ao atualizar ocorrência: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
?>

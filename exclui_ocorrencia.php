<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

// Verificar se o ID_ocorrencia foi fornecido via parâmetro GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_ocorrencia = $_GET['id'];

    // Excluir a ocorrência do banco de dados
    $sql = "DELETE FROM ocorrencia WHERE ID_ocorrencia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_ocorrencia);

    if ($stmt->execute()) {
        echo "Ocorrência excluída com sucesso.";
    } else {
        echo "Erro ao excluir ocorrência: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID_ocorrencia não especificado.";
}

$conn->close();
?>

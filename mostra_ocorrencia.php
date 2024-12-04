<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

// Recuperar dados da tabela de ocorrências
$sql = "SELECT o.ID_ocorrencia, p.nome, o.dt_evento, o.tipo, o.endereco, o.descricao, o.dt_reg_ocorrencia 
        FROM ocorrencia o 
        JOIN pessoa p ON o.ID_pessoa = p.ID_pessoa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibir dados de cada ocorrência
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ID_ocorrencia"]. " - Nome: " . $row["nome"]. " - Data do Evento: " . $row["dt_evento"]. " - Tipo: " . $row["tipo"]. " - Endereço: " . $row["endereco"]. " - Descrição: " . $row["descricao"]. " - Data de Registro: " . $row["dt_reg_ocorrencia"]. "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>

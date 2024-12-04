<?php
session_start(); 

$conexao = mysqli_connect("localhost", "root", "120226", "Vigia");

if (!$conexao) {
    echo "Não Conectado ao Banco de Dados";
} else {
    echo "Conectado ao Banco de Dados<br>";
}

if (isset($_SESSION['usuario_id'])) {
    $id_usuario = $_SESSION['usuario_id'];
} else {
    echo "Você precisa estar logado para registrar uma ocorrência.";
    exit;
}

$tipo = mysqli_real_escape_string($conexao, $_POST['tipo']);
$dt_evento = mysqli_real_escape_string($conexao, $_POST['dt_evento']);
$endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

$dt_evento_parts = explode('/', $dt_evento);
$dt_evento_mysql = $dt_evento_parts[2] . '-' . $dt_evento_parts[1] . '-' . $dt_evento_parts[0];

$sql = "INSERT INTO vigia.ocorrencia(ID_cadastro, dt_evento, tipo, endereco, descricao, dt_reg_ocorrencia) 
        VALUES ('$id_usuario', '$dt_evento_mysql', '$tipo', '$endereco', '$descricao', CURRENT_TIMESTAMP())";

$return = mysqli_query($conexao, $sql);

if ($return) { 
    echo "<script>alert('Ocorrência registrada com sucesso!');</script>";
	echo "<script>window.location.href = 'feed.html';</script>";
} else {
    echo "Erro ao cadastrar: " . mysqli_error($conexao) . "<br>";
}
?>
<?php
session_start();

$conexao = mysqli_connect("localhost", "root", "120226", "Vigia");

if (!$conexao) {
    echo "Não Conectado ao Banco de Dados";
} else {
    echo "Conectado ao Banco de Dados<br>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "SELECT ID_cadastro, senha_hash FROM vigia.cadastro WHERE cpf='$cpf'";
    $return = mysqli_query($conexao, $sql);

if (mysqli_num_rows($return) > 0) {
    $usuario = mysqli_fetch_assoc($return);

    if (password_verify($senha, $usuario['senha_hash'])) {
        $_SESSION['usuario_id'] = $usuario['ID_cadastro'];
        echo "<script>alert('Login bem-sucedido!');</script>";
        echo "<script>window.location.href = 'feed.html';</script>";
        exit;
    } else {
            echo "<script>alert('CPF ou senha inválidos.');</script>";
        }
    } else {
        echo "<script>alert('CPF não encontrado.');</script>";
    }
}
?>
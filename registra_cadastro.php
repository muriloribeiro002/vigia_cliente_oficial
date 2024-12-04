<?php
$conexao = mysqli_connect("localhost", "root", "120226", "Vigia");

if (!$conexao) {
    echo "Não Conectado ao Banco de Dados";
} else {
    echo "Conectado ao Banco de Dados<br>";
}

$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);

$sql = "SELECT cpf FROM vigia.cadastro WHERE cpf='$cpf'";
$return = mysqli_query($conexao, $sql);

if(mysqli_num_rows($return)>0){
	echo "CPF já cadastrado!<br>";
} else{
	$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
	$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
	$dt_nascimento = mysqli_real_escape_string($conexao, $_POST['dt_nascimento']);
	$email = mysqli_real_escape_string($conexao, $_POST['email']);
	$celular = mysqli_real_escape_string($conexao, $_POST['celular']);
	$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$dt_nascimento_parts = explode('/', $dt_nascimento);
$dt_nascimento_mysql = $dt_nascimento_parts[2] . '-' . $dt_nascimento_parts[1] . '-' . $dt_nascimento_parts[0];

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

$sql = "INSERT INTO vigia.cadastro(nome, cpf, dt_nascimento, email, celular, senha_hash) 
        VALUES ('$nome', '$cpf', '$dt_nascimento_mysql', '$email', '$celular', '$senha_hash')";

$return = mysqli_query($conexao, $sql);

  if ($return) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
		echo "<script>window.location.href = 'index.html';</script>";
        exit;
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao) . "<br>";
    }
}
?>
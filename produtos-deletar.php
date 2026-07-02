<?php
require_once "conexao.php";

// Verifica se o ID do produto foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redireciona se não houver ID
    header("Location: visualizarprodutos.php?status=delete_error");
    exit();
}

//  Recebe  o ID
$id_produto = mysqli_real_escape_string($conexao, $_GET['id']);

// Query de Exclusão (DELETE)
$sql_delete = "DELETE FROM produtos WHERE id_produto = '$id_produto'";

$resultado = mysqli_query($conexao, $sql_delete);

// 3. Verifica o resultado e redireciona
if ($resultado) {
    // Redireciona para a lista com status de sucesso
    header("Location: visualizarprodutos.php?status=delete_success");
} else {
    // Redireciona com status de erro (e pode incluir o erro do MySQL para debug)
    header("Location: visualizarprodutos.php?status=delete_error");
}

mysqli_close($conexao);
exit(); 
?>
<?php
require_once "conexao.php";

// Verifica se o ID do filme foi passado na URL
// A variável 'idfilme' é esperada, pois corrigimos o link em readfilmes.php
if (!isset($_GET['idfilme']) || empty($_GET['idfilme'])) {
    header("Location: readfilmes.php?status=delete_error");
    exit();
}

// Recebe o ID
// CORRIGIDO: Usando o nome de variável correto e consistente: $idfilme
$idfilme = mysqli_real_escape_string($conexao, $_GET['idfilme']);

// Query de Exclusão (DELETE)
// CORRIGIDO: Usando a variável correta $idfilme na query
$sql_delete = "DELETE FROM filmes WHERE id_filme = '$idfilme'";

$resultado = mysqli_query($conexao, $sql_delete);

// 3. Verifica o resultado e redireciona
if ($resultado) {
    // CORRIGIDO: Corrigido o erro de digitação no nome do arquivo: 'readflmes.php' para 'readfilmes.php'
    header("Location: readfilmes.php?status=delete_success");
} else {
    // Redireciona com status de erro 
    header("Location: readfilmes.php?status=delete_error");
}

mysqli_close($conexao);
exit(); 
?>
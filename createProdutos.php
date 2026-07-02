
<?php
require_once"conexao.php";
$id = $_POST['id'];
$nome = $_POST['nome'];
$desc = $_POST['desc'];
$qtde = $_POST['qtde'];
$unimed = $_POST['unimed'];
$tipo = $_POST['tipo'];
$precouni = $_POST['precouni'];

$resultado = mysqli_query($conexao, "insert into produtos(id_produto, nome_produto, desc_produto,qtde_produto, unimed_produto, tipo_produto, precouni_produto ) values
('$id','$nome','$desc','$qtde','$unimed','$tipo','$precouni');");

if ($resultado) {
    header("Location: cadastroprodutos.php?status=success");
} else {
    header("Location: cadastroprodutos.php?status=error");
}

mysqli_close($conexao);
exit(); 
?>
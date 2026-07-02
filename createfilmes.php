<?php
    require_once "conexao.php";
   
    $idfilme = $_POST['idfilme'];
    $nomefilme = $_POST['nomefilme'];
    $ano_lancamento = $_POST['ano_lancamento'];
    $duracao = $_POST['duracao'];
    $sinopse = $_POST['sinopse'];
    $faixa_etaria = $_POST['faixa_etaria'];
    $genero = $_POST['genero'];
    $diretor = $_POST['diretor'];

    $resultado = mysqli_query($conexao, "insert into filmes(id_filme, nome_filme, anolancamento_filme, duracao_filme, 
    sinopse_filme, faixaetaria_filme, genero_filme, diretor_filme) values
    ('$idfilme','$nomefilme','$ano_lancamento','$duracao','$sinopse','$faixa_etaria','$genero','$diretor');");

     if ($resultado){
        header("Location: cadastrofilmes.php?status=success");
     }
     else {
    header("Location: cadastrofilmes.php?status=error");
}
     mysqli_close($conexao);
      exit(); 
?>

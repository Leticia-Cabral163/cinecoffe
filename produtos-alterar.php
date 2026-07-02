<?php
// Inclui o arquivo de conexão
require_once "conexao.php"; 

if (isset($_POST['alterar_produto'])) { // Verifica se o botão 'Salvar Alterações' (name="alterar_produto") foi clicado.
    
    $id = mysqli_real_escape_string($conexao, $_POST['id_produto']); 
    // mysqli_real_escape_string:  // Armazena e protege o valor do ID (e outros campos) para evitar ataques (SQL Injection).
    $nome = mysqli_real_escape_string($conexao, $_POST['nome_produto']);
    $desc = mysqli_real_escape_string($conexao, $_POST['desc_produto']);
    $qtde = mysqli_real_escape_string($conexao, $_POST['qtde_produto']);
    $unimed = mysqli_real_escape_string($conexao, $_POST['unimed_produto']);
    $tipo = mysqli_real_escape_string($conexao, $_POST['tipo_produto']);
    // Tratamento do preço: substitui vírgula por ponto para o MySQL
    $precouni_limpo = str_replace(',', '.', $_POST['precouni_produto']); 
    $precouni = mysqli_real_escape_string($conexao, $precouni_limpo);
    
    // 1.2 Query de Atualização (UPDATE)
    $sql_update = "UPDATE produtos SET 
                    nome_produto = '$nome', 
                    desc_produto = '$desc', 
                    qtde_produto = '$qtde', 
                    unimed_produto = '$unimed', 
                    tipo_produto = '$tipo', 
                    precouni_produto = '$precouni' 
                    WHERE id_produto = '$id'";

    $resultado_update = mysqli_query($conexao, $sql_update);

    if ($resultado_update) { // Verifica se a atualização no banco de dados foi bem-sucedida.
        header("Location: visualizarprodutos.php?status=alterado_success");
    } else {
        header("Location: visualizarprodutos.php?status=alterado_error&id=$id");
    }
    
    mysqli_close($conexao);
    exit(); // Encerra o script após o redirecionamento
}



// CARREGAMENTO DOS DADOS ATUAIS 

if (!isset($_GET['id']) || empty($_GET['id'])) { 
    // Verifica se o ID foi passado na URL. Se não, impede o carregamento da página de alteração.
    header("Location: visualizarprodutos.php?status=no_id");
    exit();
}
// Armazena e protege o ID recebido pela URL.
$id_produto = mysqli_real_escape_string($conexao, $_GET['id']); 

$sql_select = "SELECT * FROM produtos WHERE id_produto = '$id_produto'"; 
// Monta a consulta SQL para buscar (SELECT) todas as colunas (*) do produto específico.
$resultado_select = mysqli_query($conexao, $sql_select);
$produto = mysqli_fetch_array($resultado_select); 
// Pega a linha de resultado e a transforma em um array associativo (Ex: $produto['nome_produto'])

if (!$produto) {
    header("Location: visualizarprodutos.php?status=not_found"); 
    exit();
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadatrovisualizar-produtos.css">   <!-- MESMO ESTILO-->
    <title>Alterar Produto: <?= $produto['nome_produto'] ?> | CineCoffee Admin</title>
</head>
<body>
      <!-- SIDEBAR-->
    <aside class="sidebar"> 
        <div class="sidebar-profile">
            <img src="fotoperfil.jpg" alt="Foto de Perfil" class="profile-img">
            <p class="profile-name">Funcionário(a) Admin</p>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                <li><a href="visualizarprodutos.php">🍔 Lista de Produtos</a></li>
                <li  class="active" ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li ><a href="readfilmes.php">🎬	Lista de Filmes</a></li>
                <li ><a href="cadastrofilmes.php">➕ Novo Filme</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR -->

    <div class="content-container"> 
        <header class="main-header">
            <h1>Alteração de Produto</h1>   <!-- TITULO -->
        </header>

        <main class="area-cadastro">   <!-- EDITAR PRODUTO QUNADO O ID FOR TAL -->
            <h2 class="titulo-cadastro">EDITAR PRODUTO: <?= $produto['id_produto'] ?></h2>
            
            <div class="formulario">
                <form method="post" action="produtos-alterar.php" class = "form">
                    <input name="id_produto" type="hidden" value="<?= $produto['id_produto'] ?>"
 
                    <div class="l1">   <!-- CAMPOS IGUAL AO FORMULÁRIO -->
                        <div class="form-group col-large">
                            <label for="nome_produto">Nome*</label>
                            <input type="text" name="nome_produto" value="<?= $produto['nome_produto'] ?>" required>               
                         <!--  // O 'value' exibe o dado atual do banco para que o usuário possa editar. -->         
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-full">
                            <label for="desc_produto">Descrição</label>
                            <input type="text" name="desc_produto" value="<?= $produto['desc_produto'] ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-medium">
                            <label for="tipo_produto">Tipo de Produto</label>
                            <select name="tipo_produto" id="tipo_produto"> 
                                <option value="" disabled>Selecione a Categoria</option> 
                                <?php
                                $tipos = [
                                    'BEB_CAFE' => '☕ Bebidas - Café',
                                    'BEB_ESPECIAL' => '🍹 Bebidas - Especiais',
                                    'LANCHE_SAL' => '🍿 Lanches Salgados',
                                    'DOCE_SOBREM' => '🍰 Doces/Sobremesas',
                                    'REFEICAO_LEVE' => '🥄 Refeição Leve',
                                    'PETISCO_SNACK' => '🥣 Petiscos/Snacks'
                                ];
                                foreach ($tipos as $value => $label) {
                                    $selected = ($produto['tipo_produto'] == $value) ? 'selected' : '';
                                    echo "<option value='{$value}' {$selected}>{$label}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-small">
                            <label for="precouni_produto">Preço Unitário (R$)</label>
                            <input type="text" name="precouni_produto" value="<?= number_format($produto['precouni_produto'], 2, ',', '.') ?>"> 
                        </div>
                        <div class="form-group col-small">
                            <label for="qtde_produto">Quantidade</label>
                             <input type="text" name="qtde_produto" value="<?= $produto['qtde_produto'] ?>">
                        </div> 
                        <div class="form-group col-min">
                            <label for="unimed_produto">Unid. Medida</label>
                            <select name="unimed_produto" id="unimed_produto">
                                <option value="" disabled>Unid.</option>     
                                <?php
                                $unidades = ['L', 'ML', 'KG', 'G', 'UN', 'POR'];
                                foreach ($unidades as $unid) {
                                    $selected = ($produto['unimed_produto'] == $unid) ? 'selected' : '';
                                    echo "<option value='{$unid}' {$selected}>{$unid}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions"> <!--- BOTÕES SALVAR OU CANCELAR QUE VÃO DAR PARA A PAGINA VISUALIZAR-->
                        <input type="submit" value="Salvar Alterações" name="alterar_produto">
                        <a href="visualizarprodutos.php" class="cancel-btn">Cancelar</a> 
                    </div>
                </form>
             
            </div>
        </main>
    </div>
</body>
</html>
<?php mysqli_close($conexao); // Fecha a conexão após o carregamento da página ?>
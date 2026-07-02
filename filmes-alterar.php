<?php
require_once "conexao.php"; 

// 1. PROCESSAMENTO DO FORMULÁRIO DE ALTERAÇÃO (POST)
if (isset($_POST['alterar_filme'])) { 
    
    // Obtendo e escapando dados do POST
    $idfilme = mysqli_real_escape_string($conexao, $_POST['idfilme']); 
    $nomefilme = mysqli_real_escape_string($conexao, $_POST['nomefilme']);
    $ano_lancamento = mysqli_real_escape_string($conexao, $_POST['ano_lancamento']);
    $duracao = mysqli_real_escape_string($conexao, $_POST['duracao']);
    $sinopse = mysqli_real_escape_string($conexao, $_POST['sinopse']);
    $faixa_etaria = mysqli_real_escape_string($conexao, $_POST['faixa_etaria']);
    $genero = mysqli_real_escape_string($conexao, $_POST['genero']);
    $diretor = mysqli_real_escape_string($conexao, $_POST['diretor']); // Nome do campo é 'diretor' no POST

    
    // Query de Atualização (UPDATE)
    // CORRIGIDO: O mapeamento das variáveis estava incorreto!
    $sql_update = "UPDATE filmes SET 
                      nome_filme = '$nomefilme', 
                      anolancamento_filme = '$ano_lancamento', 
                      duracao_filme = '$duracao', 
                      sinopse_filme = '$sinopse', 
                      faixaetaria_filme = '$faixa_etaria', 
                      genero_filme = '$genero',
                      diretor_filme = '$diretor'  
                      WHERE id_filme = '$idfilme'";

    $resultado_update = mysqli_query($conexao, $sql_update);

    if ($resultado_update) { 
        header("Location: readfilmes.php?status=alterado_success");
    } else {
        // Incluindo o erro para debug (opcional)
        // echo "Erro: " . mysqli_error($conexao); exit; 
        header("Location: readfilmes.php?status=alterado_error");
    }
    
    mysqli_close($conexao);
    exit(); // Encerra o script após o redirecionamento
}


// 2. CARREGAMENTO DOS DADOS ATUAIS (GET)

// CORRIGIDO: Verificando se o parâmetro 'idfilme' (corrigido em readfilmes.php) existe.
if (!isset($_GET['idfilme']) || empty($_GET['idfilme'])) { 
    header("Location: readfilmes.php?status=not_found");
    exit();
}
// CORRIGIDO: Variável local para o ID do filme está correta agora ($idfilme)
$idfilme = mysqli_real_escape_string($conexao, $_GET['idfilme']); 

// Monta a consulta SQL para buscar o filme específico.
$sql_select = "SELECT * FROM filmes WHERE id_filme = '$idfilme'"; 
$resultado_select = mysqli_query($conexao, $sql_select);
$filme = mysqli_fetch_array($resultado_select, MYSQLI_ASSOC); 
// Usando MYSQLI_ASSOC garante que as chaves do array são os nomes das colunas

if (!$filme) {
    header("Location: readfilmes.php?status=not_found"); 
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadatrovisualizar-produtos.css">   <!-- MESMO ESTILO-->
    <!-- CORRIGIDO: Usando a variável do filme para o título -->
    <title>Alterar Filme: <?= $filme['nome_filme'] ?> | CineCoffee Admin</title>
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
                <li ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li class="active"><a href="readfilmes.php">🎬    Lista de Filmes</a></li>
                <li ><a href="cadastrofilmes.php">➕ Novo Filme</a></li>
                <li><a href="relatorios.php">📊 Relatórios</a></li>
                <li><a href="estoque.php">📦 Gerenciar Estoque</a></li>
                <li><a href="config.php">⚙️ Configurações</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR -->

    <div class="content-container"> 
        <header class="main-header">
            <h1>Alteração de Filme</h1>   <!-- TITULO -->
        </header>

        <main class="area-cadastro">   
            <h2 class="titulo-cadastro">EDITAR FILME: <?= $filme['id_filme'] ?></h2>
            
            <div class="formulario">
                <form method="post" action="filmes-alterar.php" class = "form">
                    <!-- CORRIGIDO: O campo hidden deve ser 'idfilme' para ser pego corretamente no POST -->
                    <input name="idfilme" type="hidden" value="<?= $filme['id_filme'] ?>">
 
                    <div class="l1">   <!-- CAMPOS IGUAL AO FORMULÁRIO -->
                        <div class="form-group col-large">
                            <label for="nome_produto">Nome*</label>
                            <input type="text" name="nomefilme" value="<?= $filme['nome_filme'] ?>" required>               
                        </div>
                    </div>
                    
            <div class="form-group col-small">
                <label for ="diretor"> Diretor de Produção </label>
                <!-- CORRIGIDO: Usando a chave correta 'diretor_filme' para o valor -->
                <input type = "text" name = "diretor" value="<?= $filme['diretor_filme'] ?>" required>
            </div>
            
          
            <div class="form-row"> <!-- campo sinopse-->
                    <div class="form-group col-full"> 
                        <label for ="sinopse"> Sinopse </label>
                        <!-- CORRIGIDO: Usando a chave correta 'sinopse_filme' para o valor -->
                        <input type = "text" name = "sinopse" value="<?= $filme['sinopse_filme'] ?>" required>
                    </div>
            </div>

            <div class="form-group col-min">
                <label for ="duracao"> Duração do Filme </label>
                <!-- CORRIGIDO: Usando a chave correta 'duracao_filme' para o valor -->
                <input type = "text" name = "duracao" value="<?= $filme['duracao_filme'] ?>" required>  
            </div>

            <div class="form-group col-min">
            <label for ="ano_lancamento"> Ano de Lançamento </label>
            <!-- CORRIGIDO: Usando a chave correta 'anolancamento_filme' para o valor -->
            <input type = "text" name = "ano_lancamento" value="<?= $filme['anolancamento_filme'] ?>" required> 
            </div>

                    <div class="form-row">
                        <div class="form-group col-medium">
                            <label for="faixa_etaria">Faixa Etária</label>
                            <select name="faixa_etaria" id="faixa_etaria"> 
                                <option value="" disabled>Selecione a Faixa Etária</option> 
                                <?php
                                $faixa_etaria_opcoes = [
                                    'Livre' => 'Livre',
                                    '10 anos' => '10 anos',
                                    '12 anos' => '12 anos',
                                    '14 anos' => '14 anos',
                                    '16 anos' => '16 anos',
                                    '18 anos' => '18 anos'
                                ];
                                foreach ($faixa_etaria_opcoes as $value => $label) {
                                    // CORRIGIDO: Usando a chave correta 'faixaetaria_filme' para a comparação
                                    $selected = ($filme['faixaetaria_filme'] == $value) ? 'selected' : '';
                                    echo "<option value='{$value}' {$selected}>{$label}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-medium"> <!-- Mudei de form-row para form-group col-medium -->
                            <label for="genero">Gênero</label>
                            <select name="genero" id="genero-filmes"> 
                                <option value="" disabled>Selecione o Gênero</option> 
                                <?php
                                $genero_opcoes = [
                                    'Ação' => 'Ação',
                                    'Comédia' => 'Comédia',
                                    'Aventura' => 'Aventura',
                                    'Drama' => 'Drama',
                                    'Romance' => 'Romance',
                                    'Documentário' => 'Documentário',
                                    'Suspense' => 'Suspense',
                                    'Terror' => 'Terror',
                                    'Ficção científica' => 'Ficção científica',
                                    'Fantasia' => 'Fantasia',
                                    'Musical' => 'Musical'
                                ];
                                foreach ($genero_opcoes as $value => $label) {
                                    // CORRIGIDO: Usando a chave correta 'genero_filme' para a comparação
                                    $selected = ($filme['genero_filme'] == $value) ? 'selected' : '';
                                    echo "<option value='{$value}' {$selected}>{$label}</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-actions"> <!--- BOTÕES SALVAR OU CANCELAR QUE VÃO DAR PARA A PAGINA VISUALIZAR-->
                        <input type="submit" value="Salvar Alterações" name="alterar_filme">
                        <a href="readfilmes.php" class="cancel-btn">Cancelar</a> 
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
<?php mysqli_close($conexao); // Fecha a conexão após o carregamento da página ?>
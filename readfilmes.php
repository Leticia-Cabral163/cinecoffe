<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Filmes | CineCoffee Admin</title>
    <link rel="stylesheet" href="visualizarprodutos.css"> 
</head>
<body>
    <aside class="sidebar"> <!-- SIDEBAR-->
        <div class="sidebar-profile">
            <img src="fotoperfil.jpg" alt="Foto de Perfil" class="profile-img">
            <p class="profile-name">Funcionário(a) Admin</p>
            <a href="logout.php" class="logout-btn">Sair</a>
        </div>
        
        <nav class="sidebar-nav">
            <ul>
                  <li><a href="dashboard.php">🏠 Dashboard</a></li>
                <li><a href="visualizarprodutos.php">🍔 Lista de Produtos</a></li>
                <li ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li class="active"><a href="readfilmes.php">🎬  Lista de Filmes</a></li>
                <li ><a href="cadastroprodutos.php">➕ Novo Filme</a></li>
                  <li><a href="relatorios.php">📊 Relatórios</a></li>
                <li><a href="estoque.php">📦 Gerenciar Estoque</a></li>
                <li><a href="config.php">⚙️ Configurações</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR-->

    <div class="content-container"> 
<?php
    // Inclui a conexão com o banco de dados
    include "conexao.php"; 
    
    // Configurações de Mensagem (DELETE e ALTERAR)
    $message = '';
    $class = '';

    if (isset($_GET['status'])) { 
        if ($_GET['status'] == 'delete_success') { // delete deu certo
            $message = "🗑️ Filme **excluído com sucesso**!";
            $class = 'alert-error'; 
        } elseif ($_GET['status'] == 'delete_error') { // delete deu errado
            $message = "❌ Erro ao excluir o filme. Tente novamente.";
            $class = 'alert-error';
        } elseif ($_GET['status'] == 'alterado_success') { /* alterado com sucesso*/ 
            $message = "✏️ Filme **alterado com sucesso**!";
            $class = 'alert-success'; 
        }
        // Adicionando mensagens de erro para o alterar/deletar
         elseif ($_GET['status'] == 'alterado_error') { 
            $message = "❌ Erro ao alterar o filme. Tente novamente.";
            $class = 'alert-error'; 
        } elseif ($_GET['status'] == 'not_found') { 
            $message = "⚠️ Filme não encontrado ou ID inválido.";
            $class = 'alert-error'; 
        }
    }
?> 

<div class="content-container"> 

<?php if ($message): ?>
        <div class="message-alert <?php echo $class; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
        <header class="main-header"> <!-- TÍTULO-->
              <h1>Lista de Filmes</h1>
        </header>

        <main class="listagem-filmes">
            <h2 class="titulo-cadastro">CONSULTA DE FILMES</h2> 
            
            <div class="table-container">

<?php
    // Refaz a conexão (já incluída no início do arquivo, mas mantendo o seu fluxo)
    include "conexao.php"; 
    
    $sql = "SELECT * FROM filmes";
    $result = $conexao->query($sql); // Execução da query

    if ($result->num_rows > 0){ //imprime a tabela 
            echo"
                <table class='data-table'>
                <thead><tr>
                    <th>ID  FILME</th>
                    <th>NOME FILME</th>
                    <th>ANO DE LANÇAMENTO</th>
                    <th>DURAÇÃO</th>
                    <th>SINOPSE</th>
                    <th>INDICAÇÃO DE IDADE</th>
                    <th>GÊNERO</th>
                    <th>DIRETOR DE PRODUÇÃO</th>
                    <th class='actions-col'>AÇÕES</th>
                    </tr></thead><tbody>
            ";

        while ($linha = $result->fetch_assoc()){ // ITENS TABELA
            echo "
                <tr>
                    <td>" . $linha["id_filme"] . "</td>
                    <td>" . $linha["nome_filme"] . "</td>
                    <td>" . $linha["anolancamento_filme"] . "</td>
                    <td>" . $linha["duracao_filme"] . "</td>
                    <td>" . $linha["sinopse_filme"] . "</td>
                    <td>" . $linha["faixaetaria_filme"] . "</td>
                    <td>" . $linha["genero_filme"] . "</td>
                    <td>" . $linha["diretor_filme"] . "</td>
                    <td class='actions-col'> 
                        <!-- CORRIGIDO: O parâmetro passado deve ser 'idfilme' para bater com o que os scripts esperam -->
                        <a class='action-btn edit-btn' href='filmes-alterar.php?idfilme=" . $linha["id_filme"] . "'>✏️Alterar</a><br>
                        <a class='action-btn delete-btn' href='filmes-deletar.php?idfilme=" . $linha["id_filme"] . "'>🗑️Deletar</a>
                    </td>
                </tr>
                ";
        }
          echo "</tbody></table>";
    }else{
        echo "<p class='empty-message'>🎬 Nenhum Filme cadastrado no momento.</p>";
    }
    // Fecha a conexão (boa prática)
    if (isset($conexao)) {
        $conexao->close();
    }
?>
            </div>
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos | CineCoffee Admin</title>
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
                <li class="active"><a href="visualizarprodutos.php">🍔 Lista de Produtos</a></li>
                <li ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li ><a href="readfilmes.php">🎬	Lista de Filmes</a></li>
                <li ><a href="cadastrofilmes.php">➕ Novo Filme</a></li>
                <li><a href="relatorios.php">📊 Relatórios</a></li>
                <li><a href="estoque.php">📦 Gerenciar Estoque</a></li>
                <li><a href="config.php">⚙️ Configurações</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR-->

    <div class="content-container"> 
        <?php  /* MENSAGEM DE DELETE e ALTERAR*/ 
            $message = '';
            $class = '';

            if (isset($_GET['status'])) { // delete deu certo
                if ($_GET['status'] == 'delete_success') {
                    $message = "🗑️ Produto **excluído com sucesso**!";
                    $class = 'alert-error'; 
                } elseif ($_GET['status'] == 'delete_error') { // delete deu errado
                    $message = "❌ Erro ao excluir o produto. Tente novamente.";
                    $class = 'alert-error';
                } elseif ($_GET['status'] == 'alterado_success') { /* alterado com sucesso*/ 
                    $message = "✏️ Produto **alterado com sucesso**!";
                    $class = 'alert-success'; 
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
             <h1>Lista de Produtos</h1>
        </header>

        <main class="listagem-produtos">
            <h2 class="titulo-cadastro">CONSULTA DE PRODUTOS</h2> 
            
            <div class="table-container">
                
                <?php // CONEXÃO
                    include "conexao.php"; 
                    $sql = "SELECT * FROM produtos"; 
                    $result = $conexao->query($sql);
                ?>

                <?php  // IMPRIME A TABELA
                    if ($result->num_rows > 0) {
                        echo "<table class='data-table'>"; //TITULOS
                        echo "<thead><tr>";
                            echo "<th>ID PRODUTO</th>";
                            echo "<th>NOME PRODUTO</th>";
                            echo "<th>DESCRIÇÃO</th>";
                            echo "<th>QUANTIDADE</th>";
                            echo "<th>UNID. MEDIDA</th>";
                            echo "<th>TIPO</th>";
                            echo "<th>PREÇO UNITÁRIO</th>";
                            echo "<th class='actions-col'>AÇÕES</th>"; 
                        echo "</tr></thead><tbody>";

                        while ($linha = $result->fetch_assoc()) {
                            echo "<tr>"; // ITENS TABELA
                              
                                echo "<td>" . $linha["id_produto"] . "</td>"; 
                                echo "<td>" . $linha["nome_produto"] . "</td>"; 
                                echo "<td>" . $linha["desc_produto"] . "</td>"; 
                                echo "<td>" . $linha["qtde_produto"] . "</td>"; 
                                echo "<td>" . $linha["unimed_produto"] . "</td>"; 
                                echo "<td>" . $linha["tipo_produto"] . "</td>"; 
                                echo "<td>R$ " . number_format($linha["precouni_produto"], 2, ',', '.') . "</td>";                              
                                echo "<td class='actions-col'>"; // BOTÕES DELETAR E ALTERAR
                                    echo "<a class='action-btn edit-btn' href='produtos-alterar.php?id=" . $linha["id_produto"] . "'>✏️Alterar</a><br>";
                                    echo "<a class='action-btn delete-btn' href='produtos-deletar.php?id=" . $linha["id_produto"] . "'>🗑️Deletar</a>";
                                echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";

                    } else {
                        //  MENSAGEM DE NADA 
                        echo "<p class='empty-message'>🎬 Nenhum **Produto** cadastrado no momento.</p>";
                    }
                ?>
                
            </div>
        </main>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadatrovisualizar-produtos.css">
    <title>Cadastro Produtos | CineCoffee Admin</title>
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
                <li><a href="dashboard.php">🏠 Dashboard</a></li>
                <li><a href="visualizarprodutos.php">🍔 Lista de Produtos</a></li>
                <li  class="active" ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li ><a href="readfilmes.php">🎬	Lista de Filmes</a></li>
                <li ><a href="cadastrofilmes.php">➕ Novo Filme</a></li>
                <li><a href="relatorios.php">📊 Relatórios</a></li>
                <li><a href="estoque.php">📦 Gerenciar Estoque</a></li>
                <li><a href="config.php">⚙️ Configurações</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR -->

    <div class="content-container">   <!-- titlo principal-->
        <header class="main-header">
             <h1>Cadastro de Produtos</h1>
        </header>

        <?php // mensagdem de cadastrado com sucesso.
            $message = ''; //variaveis
            $class = '';
            if (isset($_GET['status'])) { // se deu certo
                if ($_GET['status'] == 'success') {
                    $message = "✅ Produto **cadastrado com sucesso**! ";
                    $class = 'alert-success';
                } elseif ($_GET['status'] == 'error') { // se deu errado
                    $message = "❌ Erro ao cadastrar o produto. Tente novamente.";
                    $class = 'alert-error';
                }
            }
         ?>

<div class="content-container">  <!-- mesagem-->
           <?php if ($message): ?> 
        <div class="message-alert <?php echo $class; ?>">
            <?php echo $message; ?>
        </div>
           <?php endif; ?>
 </div>
    <main class="area-cadastro">  <!-- ÁREA DE CADASTRO-->
        <h2 class="titulo-cadastro">CADASTRO DE PRODUTO</h2>
        
        <div class="formulario"> <!-- Formulário-->
            <form method="post" action="createProdutos.php">
                <div class="l1">
                    <div class="form-group col-small">  <!-- campo id-->
                        <label for="id">Código*</label>
                        <input type="text" name="id" value=""> 
                    </div>
                    <div class="form-group col-large"> <!-- campo nome-->
                        <label for="nome">Nome*</label>
                        <input type="text" name="nome" required>
                    </div>
                </div>
                
                <div class="form-row"> <!-- campo descrição-->
                    <div class="form-group col-full"> 
                        <label for="desc">Descrição</label>
                        <input type="text" name="desc" required>
                    </div>
                </div>

                <div class="form-row">  <!-- selecionar tipo-->
                    <div class="form-group col-medium">
                        <label for="tipo">Tipo de Produto</label>
                        <select name="tipo" id="tipo_produto"> 
                            <option value="" disabled selected>Selecione a Categoria</option> 
                            <option value="BEB_CAFE">☕ Bebidas - Café</option>
                            <option value="BEB_ESPECIAL">🍹 Bebidas - Especiais</option> 
                            <option value="LANCHE_SAL">🍿 Lanches Salgados</option>
                            <option value="DOCE_SOBREM">🍰 Doces/Sobremesas</option>
                            <option value="REFEICAO_LEVE">🥄 Refeição Leve</option>
                            <option value="PETISCO_SNACK">🥣 Petiscos/Snacks</option>
                        </select>
                    </div>
                    <div class="form-group col-small"> <!-- campo preço-->
                        <label for="precouni">Preço Unitário (R$)</label>
                        <input type="text" name="precouni"> 
                    </div>
                    <div class="form-group col-small"> <!-- qtde -->
                        <label for="qtde">Quantidade</label>
                        <input type="text" name="qtde">
                    </div> 
                    <div class="form-group col-min"> <!-- selecione unimed -->
                        <label for="unimed">Unid. Medida</label>
                        <select name="unimed" id="unimed">
                            <option value="" disabled selected>Unid.</option>
                            <option value="L">L</option>
                            <option value="ML">ML</option>
                            <option value="KG">KG</option>
                            <option value="G">G</option> 
                            <option value="UN">UN</option>
                            <option value="POR">POR</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" value="Salvar Cadastro"> <!-- BOTÃO SALVAR -->
                </div>
            </form>
        </div>
    </main>
    </div> </body>
</html>

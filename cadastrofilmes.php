<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadatrovisualizar-produtos.css">
    <title>Cadastro Filmes | CineCoffee Admin</title>
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
                <li ><a href="cadastroprodutos.php">➕ Novo Produto</a></li>
                <li ><a href="readfilmes.php">🎬	Lista de Filmes</a></li>
                <li  class="active" ><a href="cadastrofilmes.php">➕ Novo Filme</a></li>
                <li><a href="relatorios.php">📊 Relatórios</a></li>
                <li><a href="estoque.php">📦 Gerenciar Estoque</a></li>
                <li><a href="config.php">⚙️ Configurações</a></li>
            </ul>
        </nav>
    </aside> <!-- FIM SIDEBAR -->

    <div class="content-container">   <!-- titlo principal-->
        <header class="main-header">
             <h1>Cadastro de Filmes</h1>
        </header>

<main class="area-cadastro">  <!-- ÁREA DE CADASTRO-->
        <h2 class="titulo-cadastro">CADASTRO DE FILMES</h2>

        <div class="formulario">
        <form method= "post" action= "createfilmes.php">
            <div class="l1">
                 <div class="form-group col-small"> <!-- campo id do filme-->
                    <label for =""> ID </label><input type = "text" name = "idfilme"> 
                 </div>
                <div class="form-group col-large">  <!-- campo nome do filme -->
                <label for =""> Nome do filme</label><input type = "text" name = "nomefilme"> 
                 </div>
                 
            </div>

            <div class="form-group col-small">
                <label for =""> Diretor de Produção </label><input type = "text" name = "diretor">
            </div>
            
         
            
             <div class="form-row"> <!-- campo descrição-->
                    <div class="form-group col-full"> 
                        <label for =""> Sinopse </label><input type = "text" name = "sinopse">
                    </div>
            </div>

            <div class="form-group col-min">
              <label for =""> Duração do Filme </label><input type = "text" name = "duracao">  
            </div>

            <div class="form-group col-min">
            <label for =""> Ano de Lançamento </label><input type = "text" name = "ano_lancamento"> 
            </div>

            <div class="form-row">  <!-- selecionar tipo-->
                <div class="form-group col-medium">
                <label for =""> Indicação de Faixa Etária </label>
                <select name = "faixa_etaria" id="faixa_etaria"> 
                    <option value="" disabled selected>Selecione a Faixa Etaria</option> 
                            <option value="Livre">Livre</option>
                            <option value="10 anos">10 anos</option> 
                            <option value="12 anos">12 anos</option>
                            <option value="14 anos">14 anos</option>
                            <option value="16 anos">16 anos</option>
                            <option value="18 anos">18 anos</option>
                        </select>
                    </div>    

                <div class="form-group col-medium">
                <label for =""> Gênero </label>
                <select name = "genero" id="genero-filmes"> 
                    <option value="" disabled selected>Selecione o Gênero</option> 
                            <option value="Ação">Ação</option>
                            <option value="Comédia">Comédia</option> 
                            <option value="Aventura">Aventura</option> 
                            <option value="Drama">Drama</option>
                            <option value="Romance">Romance</option>
                            <option value="Documentário">Documentário</option>
                            <option value="Suspense">Suspense</option>
                            <option value="Terror">Terror</option>
                            <option value="Ficção científica">Ficção científica</option>
                            <option value="Fantasia">Fantasia</option>
                            <option value="Musical">Musical</option>
                        </select>
                    </div>     

            <div class="form-actions">
               <br> <input type="submit" value="Cadastrar novo Filme">
            </div>
            
        </form>
        </div>
</main>
</body>
</html>

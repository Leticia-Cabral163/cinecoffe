# CineCoffee ☕🎬

O **CineCoffee** é um sistema web desenvolvido para gerir o catálogo de filmes e o inventário de produtos de um espaço que combina cinema e cafeteria. O projeto permite o registo de novos filmes (com detalhes como sinopse, género e diretor) e o controlo de produtos (quantidades, unidades de medida e preços).

---

## 🚀 Tecnologias Utilizadas

O projeto foi construído utilizando as seguintes tecnologias:

* **HTML5** - Estruturação das páginas web e formulários.
* **CSS3** - Estilização e design da interface.
* **PHP** - Lógica de back-end e processamento dos dados dos formulários.
* **MySQL** - Banco de dados para armazenamento de filmes e produtos.
* **XAMPP** - Ambiente de servidor local (Apache) e gestão do banco de dados (phpMyAdmin).

---

## 📦 Como Executar o Projeto Localmente

Para rodar este projeto no teu computador, segue os passos abaixo:

### 1. Pré-requisitos
Certifica-te de ter o [XAMPP](https://www.apachefriends.org/) instalado na tua máquina.

### 2. Configuração dos Arquivos
1. Baixa ou clona este repositório.
2. Coloca a pasta do projeto dentro do diretório `htdocs` do teu XAMPP. 
   * Caminho comum: `C:\xampp\htdocs\leticiaphp\cinecoffee-Copia\`

### 3. Configuração do Banco de Dados
1. Abre o **XAMPP Control Panel** e inicia os módulos **Apache** e **MySQL**.
2. Acede ao painel do [phpMyAdmin](http://localhost/phpmyadmin).
3. Cria um novo banco de dados com o nome `cinecoffee`.
4. Importa o arquivo `.sql` (disponível na raiz deste projeto) ou executa o script de criação na aba **SQL** para gerar as tabelas `filmes` e `produtos`.

### 4. Aceder à Aplicação
Abre o teu navegador e digita o seguinte endereço:
```text
http://localhost/leticiaphp/cinecoffee-Copia/

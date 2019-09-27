<?php
session_start();
include("conexao.php");
include('verifica_login.php');

$idPrest = filter_input(INPUT_GET, 'idPrestador', FILTER_SANITIZE_NUMBER_INT);
$result_prestador = "SELECT * FROM prestador WHERE idPrestador = '$idPrest'";
$resultado_prestador = mysqli_query($conexao, $result_prestador);
$row_prestador = mysqli_fetch_assoc($resultado_prestador);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- SEO do projeto-->
    <meta name="author" content="Victor Binda">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <title>GoodCare</title>
    <link rel="stylesheet" href="css/painel.css"> <!--Diretório de estilo-->
</head>
<body>
  <header>
    <div class='primary-header-content'>
      <i class='menu-icon material-icons'>menu</i> <!--icone do menu-->
      <h1>GoodCare<sub> Olá, <?php echo $_SESSION['nome'];?></sub></h1> <!--titulo do site-->
    </div>

    <div class='secondary-header-content'> <!--menu superior-->
      <nav>
        <ul> 
        <li><a href="painel.php"><i class='material-icons'>home</i>Home</a></li>
          <li><a href="historico.php"><i class='material-icons'>note_add</i>Histórico</a></li>
          <li><a href="carrinho.php"><i class='material-icons'>add_shopping_cart</i>Carrinho</a></li>
          <li><a href="prestador.php"><i class='material-icons'>account_box</i>Prestador</a></li>
          <li><a href="logout.php"><i class='material-icons' >power_settings_new</i>Logout</a></li>
        </ul>
      </nav>
      <div class='search-area'>
        <!--caixa de pesquisa-->
        <input type="text" name='search' class='search' placeholder="Procurar Serviço..."/>
        <i class='material-icons'>search</i> <!--icone de pesquisa-->
      </div>
    </div>
  </header>
  <div class='side-bar'>
    <div class='side-bar-primary-area'></div>
      <nav>
        <ul class='side-bar-nav'>  
          <li><a href="painel.php"><i class='material-icons'>home</i>Home</a></li>
          <li><a href="historico.php"><i class='material-icons'>note_add</i>Histórico</a></li>
          <li><a href="carrinho.php"><i class='material-icons'>add_shopping_cart</i>Carrinho</a></li>
          <li><a href="prestador.php"><i class='material-icons'>account_box</i>Prestador</a></li>
          <li><a href="logout.php"><i class='material-icons' >power_settings_new</i>Logout</a></li>
        </ul>
      </nav>
  </div>
 <!-- inicio do Conteudo -->
 <h1>Cadastrar Usuário</h1>
    <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<form method="POST" action="proceditprest.php">
      <input type="hidden" name="idPrestador" value="<?php echo $row_prestador['idPrestador'];?>">
			<label>Nome: </label>
      <input type="text" name="nome" placeholder="Digite o nome completo" 
      value="<?php echo $row_prestador['nome']; ?>"required autofocus><br>
			<label>CPF: </label>
      <input type="text" name="cpf" placeholder="Digite o seu CPF"
      value="<?php echo $row_prestador['cpf']; ?>"required><br>
      <label>Coren: </label>
      <input type="text" name="coren" placeholder="Digite o seu COREN"
      value="<?php echo $row_prestador['coren']; ?>"required><br>
      <label>Cel: </label>
      <input type="text" name="cel" placeholder="Digite seu telefone"
      value="<?php echo $row_prestador['cel']; ?>"required><br>
      
			<input type="submit" value="Editar Prestador">
      <a href="prestador.php">Voltar</a>
    </form>
    
 
 <!-- fim do Conteudo -->

  <footer><!--rodapé-->
  </footer>
  <div class='overlay'></div>
</body>
</html>


<!--script em .js-->
<script>(function menu(){
  
  var menuElement = document.querySelector('header .menu-icon');
  var bodyElement = document.querySelector('body');
  
  bodyElement.onclick = function(e){
    document.querySelector('.side-bar').classList.remove('side-bar-visible');
        document.querySelector('.overlay').classList.remove('visible');
  }
  
  menuElement.onclick = function(e){
    e.preventDefault();
    e.stopPropagation();
    document.querySelector('.side-bar').classList.add('side-bar-visible');
    document.querySelector('.overlay').classList.add('visible');
  }
})();</script>

  
<?php
session_start();
include('conexao.php');
include_once('verifica_login.php');

$idServicos= filter_input(INPUT_GET, 'idServicos', FILTER_SANITIZE_NUMBER_INT);
$result_servicos = "SELECT * FROM servicos WHERE idServicos = '$idServicos'";
$resultado_servicos = mysqli_query($conexao, $result_servicos);
$row_servicos = mysqli_fetch_assoc($resultado_servicos);

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
          <li><a href="histo.php"><i class='material-icons'>note_add</i>Histórico</a></li>
          <li><a href="carrinho.php"><i class='material-icons'>add_shopping_cart</i>Carrinho</a></li>
          <li><a href="prestador.php"><i class='material-icons'>account_box</i>Prestador</a></li>
          <li><a href="logout.php"><i class='material-icons' >power_settings_new</i>Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class='side-bar'>
    <div class='side-bar-primary-area'></div>
      <nav>
        <ul class='side-bar-nav'>  
          <li><a href="painel.php"><i class='material-icons'>home</i>Home</a></li>
          <li><a href="histo.php"><i class='material-icons'>note_add</i>Histórico</a></li>
          <li><a href="carrinho.php"><i class='material-icons'>add_shopping_cart</i>Carrinho</a></li>
          <li><a href="prestador.php"><i class='material-icons'>account_box</i>Prestador</a></li>
          <li><a href="logout.php"><i class='material-icons' >power_settings_new</i>Logout</a></li>
        </ul>
      </nav>
  </div>
 <!-- inicio do Conteudo -->
  <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
    <?php
    
        echo "Serviço: " . $row_servicos['plantao'] . "<br>";
        echo "Descrição: " . $row_servicos['descricao'] . "<br>";
        echo "Valor: R$ " . $row_servicos['valor'] . "<br><hr>";
        echo "Nome do Prestador: " . $row_prestador['nome'] . "<br>";
        echo "CPF: " . $row_prestador['cpf'] . "<br>";
        echo "COREN: " . $row_prestador['coren'] . "<br><hr>";
        echo "<a href='procarrinho.php?'>Finalizar</a><br><hr>";

        
    
    ?>
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

  
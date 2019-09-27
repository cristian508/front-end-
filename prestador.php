<?php
session_start();
include('conexao.php');
include_once('verifica_login.php');
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
  <?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
	
		<form method="POST" action="processa.php">
			<label>Nome: </label>
			<input type="text" name="nome" placeholder="Digite o nome completo" required autofocus><br>
			<label>CPF: </label>
			<input type="text" name="cpf" placeholder="Digite o seu CPF"required><br>
      <label>Coren: </label>
			<input type="text" name="coren" placeholder="Digite o seu COREN"required><br>
      <label>Cel: </label>
			<input type="text" name="cel" placeholder="Digite seu telefone"required><br>
			<input type="submit" value="Cadastrar Prestador">
		</form>
    
    <div class='lista'>
    <!--Pesquisar-->
    <div class='search-area'>
        <!--caixa de pesquisa-->
        <hr><form method="POST" action="">
			<input type="text" name="nome" placeholder="Digite o nome">			
			<input name="SendPesqUser" type="submit" value="Pesquisar">
		</form><hr><br>
      </div>
    <?php
		$SendPesqUser = filter_input(INPUT_POST, 'SendPesqUser', FILTER_SANITIZE_STRING);
		if($SendPesqUser){
			$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$result_usuario = "SELECT * FROM prestador WHERE nome LIKE '%$nome%'";
			$resultado_usuario = mysqli_query($conexao, $result_usuario);
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				echo "ID: " . $row_usuario['idPrestador'] . "<br>";
				echo "Nome: " . $row_usuario['nome'] . "<br>";
				echo "Coren: " . $row_usuario['coren'] . "<br>";
				echo "<a href='editar.php?idPrestador=" . $row_usuario['idPrestador'] . "'>Editar</a><br>";
				echo "<a href='procdelprest.php?idPrestador=" . $row_usuario['idPrestador'] . "'>Apagar</a><br><hr>";
			}
		}
		?><br><br><br><!--FIM DO PESQUISAR-->

        <?php
        //Receber o número da página
		$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);		
		$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
		
		//Setar a quantidade de itens por pagina
		$qnt_result_pg = 3;
		
		//calcular o inicio visualização
		$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
        //resultado da query
        $result_prestador = "SELECT * FROM prestador LIMIT $inicio, $qnt_result_pg";
		    $resultado_prestador = mysqli_query($conexao, $result_prestador);
		    while($row_prestador = mysqli_fetch_assoc($resultado_prestador)){
            echo "<hr>Nome: ".$row_prestador['nome']."<br>";
            echo "CPF: ".$row_prestador['cpf']."<br>";
            echo "COREN: ".$row_prestador['coren']."<br>";
          
            echo "<a href='editar.php?idPrestador=".$row_prestador['idPrestador']."'>Editar</a><br>";
            echo "<a href='procdelprest.php?idPrestador=".$row_prestador['idPrestador']."'>Excluir</a><br><hr>";
        }
        //Paginção - Somar a quantidade de usuários
		$result_pg = "select count(*) as idPrestador from prestador";
		$resultado_pg = mysqli_query($conexao, $result_pg);
		$row_pg = mysqli_fetch_assoc($resultado_pg);
		
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['idPrestador'] / $qnt_result_pg);
        //Limitar os link antes depois
		$max_links = 2;
		echo "<br><br><a href='prestador.php?pagina=1'>Primeira</a> ";

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='prestador.php?pagina=$pag_ant'>$pag_ant</a> ";
			}
		}
			
		echo "$pagina ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='prestador.php?pagina=$pag_dep'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='prestador.php?pagina=$quantidade_pg'>Ultima</a>";
        


        ?>
 </div>
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

  
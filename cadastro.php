<?php
session_start();
include('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Victor Binda">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoodCare</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" href="css/login.css"> <!--Diretório de estilo-->
</head>
<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Cadastro<br>GoodCare</h3>
                    <?php
                    if(isset($_SESSION['status_cadastro'])):
                    ?>
                    <div class="notification is-success">
                      <p>Cadastro efetuado!</p>
                      <p>Faça login informando o seu usuário e senha <a href="login.php">aqui</a></p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['status_cadastro'])
                    ?>
                    <?php
                    if(isset($_SESSION['usuario_existe'])):
                    ?>
                    <div class="notification is-info">
                        <p>O usuário escolhido já existe. Informe outro e tente novamente.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['usuario_existe'])
                    ?>
                    <div class="box">
                        <form action="cadastrar.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="nome" type="text" class="input is-large" placeholder="Nome Completo" required autofocus>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="cpf" type="text" class="input is-large" placeholder="Seu CPF" required>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="cel" type="text" class="input is-large" placeholder="Numero CEL" required>
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Sua Senha" required>
                                </div>
                            </div>
                    <button type="submit" class="button is-block is-link is-large is-fullwidth">Cadastrar</button>
                    <a href="index.php">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
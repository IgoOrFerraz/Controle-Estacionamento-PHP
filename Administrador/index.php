<?php
if(isset($_GET['acao'])){
      //Ações de Retorno de Login
      if($_GET['acao'] == 'vazio'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'><b>Dados não Preenchidos </b>, favor preenche-los</div>";
      }
      else if($_GET['acao'] == 'erro'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'>Email e/ou Senha Incorretos</div>";
      }
      else if($_GET['acao'] == 'alterado'){
        echo "<div class='alert alert-success' style='text-align: center;' role='alert'>Senha Alterada com Sucesso</div>";
      }
    }
?>
<html>
<head>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="./css/style.css">

  <link rel="shortcut icon" href="../imges/favicon.ico"/>
  <title>Control Estac || ADMIN</title>
  <meta charset ="utf-8">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- JavaScript -->
  <script type="text/javascript" src="./func.js"></script>
</head>

<body>

  <div class="principal">
    <div class="corpo">
      <div class="container campo_login">
        
        <div class="container logotipo"></div>
        
        <div class="container menu">
          <label id="titulo" class="titulo">LOGIN</label>
        </div>
        
        <hr>
        
        <div class="form_login form-group">

          <form id="form" action="config.php?acao=login" method="POST">

            <!-- ----------------------Campos de Login-------------------------- -->

            <input type="text" id="login" class="form-control" placeholder="Digite seu Login" name="login" autofocus>
            <input type="password" id="senha" class="form-control" placeholder="Digite sua Senha" name="senha">

            <!-- ----------------------Campos de Alterar Senha -------------------------- -->

            <input type="hidden" id="nova_senha" class="form-control" placeholder="Digite sua Nova Senha" name="nova_senha">

            <input type="hidden" id="conf_senha" class="form-control" placeholder="Confirme sua Nova Senha" name="conf_senha">

            <!-- ----------------------Rodapé-------------------------- -->

            <hr>

            <div class="form-group">
              <div class="form_botao">
                <input type="submit" id="btn_entrar" class="btn btn-warning form-control" value="Entrar">
                <input type="button" id="btn_altsenha" class="btn btn-outline-warning form-control" value="Alterar Senha" onclick="Alterar_Senha()">
                <input type="hidden" id="btn_alterar" class="btn btn-warning form-control" value="Alterar">
                <input type="hidden" id="btn_voltar" class="btn btn-outline-warning form-control" value="Voltar" onclick="window.location.href = 'index.php';">
              </div>  
            </div>
          </form>
      </div>
      </div>  
    </div>    
  </div> 
</body>
</html>

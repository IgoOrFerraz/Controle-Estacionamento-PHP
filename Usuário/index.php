<?php
if(isset($_GET['acao'])){
      //Ações de Retorno de Login
      if($_GET['acao'] == 'vazio'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'><b>Dados não Preenchidos </b>, favor preenche-los</div>";
      }
      else if($_GET['acao'] == 'sucesso_cad'){
        echo "<div class='alert alert-success' style='text-align: center;' role='alert'>Dados alterados com sucesso</div>";
      }
      else if($_GET['acao'] == 'erro_login'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'>Email e/ou Senha Incorretos</div>";
      }
      else if($_GET['acao'] == 'erro'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'>Email e/ou Senha Incorretos</div>";
      }
      
      //Ações de Retorno de Cadastro
      else if($_GET['acao'] == 'cad_vazio'){
        echo "<div id='cad_vazio' class='alert alert-danger' style='text-align: center;' role='alert'>Faltam dados a Serem Preenchidos</div>";
      }
      else if($_GET['acao'] == 'cad_sen_dif'){
        echo "<div class='alert alert-danger' style='text-align: center;' role='alert'>Senha e Confirmar Senha são Diferentes</div>";
      }
      else if($_GET['acao'] == 'cadastrorealizado'){
        echo "<div class='alert alert-success' style='text-align: center;' role='alert'>Cadastro Realizado com Sucesso</div>";
      }
    }
?>
<html>
<head>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="./css/style.css">

  <link rel="shortcut icon" href="../imges/favicon.ico"/>
  <title>Controle de Estacionamento</title>
  <meta charset ="utf-8">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- JavaScript -->
  <script type="text/javascript">
 
    function cadastrar(){
      
      // Logins
      
      document.getElementById('log_cpf').type = 'hidden';
      document.getElementById('log_senha').type = 'hidden';
  
      // Cadastrar
  
      document.getElementById('cad_email').type = 'text';
  
  
      document.getElementById('cad_senha').type = 'password';
      document.getElementById('cad_conf_senha').type = 'password';
      document.getElementById('cad_usuario').type = 'text';
      document.getElementById('cad_nasc').type = 'date';
      document.getElementById('cad_cpf').type = 'text';
  
  
      // Titulo
  
      document.getElementById('titulo').innerHTML = 'CADASTRAR';
  
      // Botão
  
      document.getElementById('btn_entrar').type = 'hidden';
      document.getElementById('btn_cadastrar').type = 'hidden';
      document.getElementById('btn_cadastrar_cad').type = 'submit';
      document.getElementById('btn_voltar').type = 'button';
      
      //Alterar o Form
      
      document.getElementById('form').action = 'config.php?acao=cadastrar';
    }

  </script>
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

            <input type="text" id="log_cpf" class="form-control" placeholder="Digite seu CPF" name="log_cpf" maxlength="11" pattern="[0-9]{11}" autofocus>
            <input type="password" id="log_senha" class="form-control" placeholder="Digite sua Senha" name="log_senha">

            <!-- ----------------------Campos de Cadastro-------------------------- -->

            <input type="hidden" id="cad_cpf" class="form-control" placeholder="Digite seu CPF" name="cad_cpf" maxlength="11" pattern="[0-9]{11}" title="Apenas Numeros, Sem (.) e nem (-)" required autofocus>

            <input type="hidden" id="cad_usuario" class="form-control" placeholder="Digite um Nome de Usuário" pattern="[A-z\s]+$" name="cad_usuario" required>

            <input type="hidden" id="cad_email" class="form-control" placeholder="Digite um E-Mail" name="cad_email" required>

            <input type="hidden" id="cad_senha" class="form-control" placeholder="Digite uma Senha" name="cad_senha" required>

            <input type="hidden" id="cad_conf_senha" class="form-control" name="cad_conf_senha" placeholder="Confirme sua Senha" required>

            <input type="hidden" id="cad_nasc" class="form-control" name="cad_nasc">

            <!-- ----------------------Rodapé-------------------------- -->

            <hr>

            <div class="form-group">
              <div class="form_botao">
                <input type="submit" id="btn_entrar" class="btn btn-warning form-control" value="Entrar">
                <input type="button" id="btn_cadastrar" class="btn btn-outline-warning form-control" value="Cadastrar" onclick="cadastrar()">
                <input type="hidden" id="btn_cadastrar_cad" class="btn btn-warning form-control" value="Cadastrar">
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

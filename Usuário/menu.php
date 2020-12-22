<?php

printf("
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='./CSS/style.css'>
        
        <!-- Font Awesome -->
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css' integrity='sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU' crossorigin='anonymous'>
        

        <link rel='shortcut icon' href='../imges/favicon.ico'/>
        <meta charset='utf-8'>
        <title>Controle de Estacionamento</title>

        <!-- Bootstrap -->
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script> 
        
        </head>

    <body>

    <header>
        <nav class='navbar navbar-expand-md bg-custom'>
            <div class='container'>
                <button class='navbar-toggler collapsed' data-toggle='collapse' data-target='#div-princ'>
                    <i class='fas fa-bars' style='color: white;'></i>
                </button>
  
                <div class='collapse navbar-collapse' id='div-princ'>
                    <ul class='navbar-nav menu mr-auto'>
                    
                        <li class='nav-item'>
                            <a href='./veiculos.php' class='nav-link text-light'>Veículos</a>
                        </li>
                            
                        <li class='nav-item'>
                            <a href='./reserva.php' class='nav-link text-light'>Reservas</a>
                        </li>
                            
                        <li class='nav-item'>
                            <a href='./painel.php' class='nav-link text-light'>Cadastro</a>
                        </li>
                        
                        <li class='nav-item'>
                            <a href='fatura.php' class='nav-link text-light'>Fatura</a>
                        </li>
                        
                        <li class='nav-item'>
                            <a href='#' class='nav-link text-light'>Contato</a>
                        </li>

                        <li class='nav-item'>
                            <a href='#' class='nav-link text-light'>Sobre</a>
                        </li>

                    </ul>
            
                    <ul class='navbar-nav ml-auto'>
                        <li class='nav-item'>
                            <a href='./painel.php' class='nav-link'><input class='login btn btn-outline-warning' type='button' value='Editar Cadastro'></a>
                        </li>
                        <li class='nav-item'>
                            <a href='./config.php?acao=encerrar' class='nav-link'><input class='login btn btn-warning' type='button' value='Loggout'></a>
                        </li>
                    </ul>  
                </div>
            </div>
        </nav>
    </header>
");

echo "<section>";

      if(isset($_GET['acao'])){
        if($_GET['acao'] == 'sucesso'){
          echo "<div class='alert alert-success msg' style='text-align: center;' role='alert'>Cadastrado com Sucesso</div>";
        }
        else if($_GET['acao'] == 'erro'){
          echo "<div class='alert alert-danger msg' style='text-align: center;' role='alert'>Erro no Cadastramento, tente novamente</div>";	
        }
        else if($_GET['acao'] == 'exclus_sucesso'){
          echo "<div class='alert alert-success msg' style='text-align: center;' role='alert'>Excluido com Sucesso</div>";	
        }
        else if($_GET['acao'] == 'veicjareserva'){
            echo "<div class='alert alert-danger msg' style='text-align: center;' role='alert'>Esse Veículo ja foi efetuado Reserva nessa Data/Hora</div>";	
        }
        else if($_GET['acao'] == 'semvag'){
            echo "<div class='alert alert-danger msg' style='text-align: center;' role='alert'>Sem Vaga disponível nessa Data/Hora</div>";	
        }   
      }
      
echo "</section>";

?>
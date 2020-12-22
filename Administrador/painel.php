<?php
session_start();
//echo $_SESSION['id'];
include_once('./menu.php');
?>

<script type="text/javascript" src="./func.js"></script>

  <div class="principal">
    <div class="corpo">
      <div class="container campo_painel">
        <div class="container logotipo"></div>
        
        <hr>

        <form id="form" method="POST">
        <div class="painel_conteudo row">

            <div class="col-sm-4 conteudo-esquerdo form-group">

              <!-- LOGGOUT -->
              <input type="button" value="Deslogar" class="btn btn-outline-warning" onclick="window.location.href = 'config.php?acao=encerrar'">
            
              <!-- CATEGORIAS -->
              <input type="button" class="btn btn-warning btn-block" value="Categorias" onclick="ativar('categoria');">

              <input type="hidden" class="btn btn-outline-warning btn-block" id="cadastrar_categoria" value="Cadastrar Categoria" onclick="cad_cat();">
              <input type="hidden" class="btn btn-outline-warning btn-block" id="excluir_categoria" value="Excluir Categoria" onclick="excluir_cat();">

              <!-- VAGAS -->
              <input type="button" class="btn btn-warning btn-block" value="Vagas" onclick="ativar('vaga');">

              <input type="hidden" class="btn btn-outline-warning btn-block" id="cadastrar_vaga" value="Cadastrar Vaga" onclick="cad_vaga();">
              <input type="hidden" class="btn btn-outline-warning btn-block" id="consultar_vaga" value="Consultar Vaga" onclick="cons_vaga();">
              <input type="hidden" class="btn btn-outline-warning btn-block" id="excluir_vaga" value="Excluir Vaga" onclick="exc_vaga();">

              <input type="button" class="btn btn-warning btn-block" value="Reservas" onclick="ativar('reserva');">

              <input type="hidden" class="btn btn-outline-warning btn-block" id="cadastrar_reserva" value="Efetuar Reserva" onclick="cad_res();">
              <input type="hidden" class="btn btn-outline-warning btn-block" id="consultar_reserva" value="Consultar Reserva" onclick="cons_res();">

              <input type="button" class="btn btn-warning btn-block" value="Veículos" onclick="cons_veic();">

              <input type="button" class="btn btn-warning btn-block" value="Relatórios" onclick="relatórios();">
              
              <input type="button" class="btn btn-warning btn-block" value="Faturas" onclick="faturas();">
              
            </div>
            
            <div class="col-sm-8 conteudo-direito form-group">
              <label id="titulo" class="titulo">Seja Bem-Vindo</label>

              <hr>

              <div class="col-sm-12 direito-principal form-group">
                
                <input type="hidden" id="campo1" class="form-control">
                <input type="hidden" id="campo2" class="form-control">
                <input type="hidden" id="campo3" class="form-control">
                <input type="hidden" id="campo4" class="form-control">
                <input type="hidden" id="campo5" class="form-control">
                <input type="hidden" id="campo6" class="form-control">
                <input type="hidden" id="campo7" class="form-control">
                      
                <input type='hidden' id='botao' class='btn btn-warning btn-block form-control'>
              </div>

          
            </div>
          
        </div>
        </form>
      </div>  
    </div>    
  </div>
</body>
</html>
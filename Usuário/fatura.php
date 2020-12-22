<?php 
  session_start();
  include_once('./menu.php');
?>

  <div id="principal"class="principal">
    <div class="corpo">
      <div class="container campo_vagas">
        
        <div class="container logotipo"></div>
        <label id="titulo" class="titulo">FATURA</label>      
        <hr>

        <form id="form" action="config.php?acao=fatura" method="POST">
          <div class="painel_conteudo row">

            <div class="col-sm-12 conteudo form-group form_cad_vaga">

              <input type="hidden" name="cria_veic" value = "<?php echo $_SESSION['cpf']; ?>">

              <input type="submit" id="button_universe" class="btn btn-warning btn-block" value="Emitir Fatura">
              
            </div>
          </div>
        </form>
      </div>  
    </div>    
  </div>
</body>
</html>
  
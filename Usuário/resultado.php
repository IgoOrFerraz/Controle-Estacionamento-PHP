<?php
session_start();
include_once('./menu.php');
?>
  <script>
    function voltar(){
      window.location.href = 'painel.php';
    }
  </script>
  <div class="principal">
    <div class="corpo">
      <div class="container campo_painel">
        
        <div class="container logotipo"></div>
        
        <hr>

        <?php 
          if(isset($_GET['resul'])){
            if($_GET['resul'] == 'veic'){
              echo"
                <form action='config.php?acao=editarveic' method='POST'>
                  <div class='painel_conteudo row'>
                    <div class='col-sm-6 conteudo-esquerdo form-group'>
                    
                      <label for='campo1'>ID Veículo</label>
                      <input type='text' id='campo1' name='campo1' class='form-control' value = ".$_SESSION['idveiculo']." readonly>

                      <label for='campo2'>Placa</label>
                      <input type='text' id='campo2' name='campo2' class='form-control' value = ".$_SESSION['placa']." readonly>

                      <label for='campo3'>Modelo</label>
                      <input type='text' id='campo3' name='campo3' class='form-control' value = ".$_SESSION['modelo'].">

                      <label for='campo4'>Cor</label>
                      <input type='text' id='campo4' name='campo4' class='form-control' value = ".$_SESSION['cor'].">

                      <label for='campo5'>Categoria</label>
                      <input type='text' id='campo5' name='campo5' class='form-control' value = ".$_SESSION['cat']." readonly>

                    </div>
                    
                    <div class='col-sm-6 conteudo-direito form-group'>
          
                      <label for='campo6'>Ano</label>
                      <input type='text' id='campo6' name='campo6' class='form-control' value = ".$_SESSION['ano']." readonly>

                      <label for='campo7'>Dono</label>
                      <input type='text' id='campo7' name='campo7' class='form-control' value = ".$_SESSION['dono'].">

                      <div class='form-group form-botao'>
                        <input type='submit' id='botao' class='btn btn-warning btn-block form-control' value='Editar Veículo'>
                        <input type='button' id='botao_voltar' class='btn btn-outline-warning btn-block form-control' value='Voltar' onclick='voltar();'>
                      </div>
                    </div>
                  </div>
                </form>
              ";
            }
            if($_GET['resul'] == 'consres'){
              
              
              echo"
                <div class='principal'>
                    <div class='corpo'>
                      <div class='container campo_painelres'>
          
                      <h3 style='text-align: center; font-size: 20px; font-weight: bold'>Reservas</h3>
          
                        <hr class='hresul'>
                          <div class='painel_conteudo row'>
                            <div class='col-sm-12 conteudo-direito'>";
                              
                              $result = explode(';', $_SESSION['resulreserv']);
                              
                              for($cont=0;$result[$cont]!=null;$cont++){
                              
                                $cadaresult = explode(',', $result[$cont]);
                                
                                echo "
                                <form action='config.php?acao=excluires' method='POST'>
                                  <div class='col-sm-12 resul row' style='font-size: 13px;'>
                                    <div class='col-sm-11'>
                                      <span>Data_Reserva:</span> $cadaresult[1] 
                                      <span>Hora_Inicio:</span> $cadaresult[2] 
                                      <span>Hora_Fim:</span> $cadaresult[3] 
                                      <span>Vaga:</span> $cadaresult[5]
                                    </div>
                                    <div class='col-sm-1 justify-content-end'>
                                      <input type ='hidden' name='idres' value ='$cadaresult[0]'>
                                      <input type='submit' style='margin-top: 0%;' class='btn btn-danger btn-sm' value='X'>
                                    </div>
                                  </div>
                                </form>
                                 
                                <hr class='hresul'>";
                              }
                              
                              echo" <input type='button' id='botao_voltar' class='btn btn-outline-warning btn-block form-control' value='Voltar' onclick='voltar();'><br>
                            </div>
                          </div>
                ";
                $_SESSION['resulreserv'] = array();
            }
            if($_GET['resul'] == 'fatura'){
              
              
              echo"
                <div class='principal'>
                    <div class='corpo'>
                      <div class='container campo_resulreservas'>
          
                        <h3 style='text-align: center; font-size: 20px; font-weight: bold'>Faturas</h3>
                        <hr class='hresul'>
                          <div class='painel_conteudo row'>
                            <div class='col-sm-12 conteudo-direito'>";
                              
                              $result = explode(';', $_SESSION['strfinal']);
                              
                              $total_fatura = 0;

                              for($cont=0;$result[$cont]!=null;$cont++){
                              
                                $cadaresult = explode(',', $result[$cont]);
                                
                                echo "
                                  <div class='col-sm-12 resul row' style='font-size: 13px;'>
                                    <div class='col-sm-12'>
                                      <span>ID_Veiculo:</span> $cadaresult[0] 
                                      <span>Categoria:</span> $cadaresult[1] 
                                      <span>Placa:</span> $cadaresult[2] 
                                      <span>Total Hrs:</span> $cadaresult[3]
                                      <span>Total (R$):</span> $cadaresult[4]
                                    </div>
                                  </div>
                                
                                 
                                <hr class='hresul'>";

                                $total_fatura += $cadaresult[4];
                                
                              }

                              echo "<br>
                                  <div class='col-sm-12 row'>
                                    <span style='font-size: 20px'>  Total da Fatura: (R$) $total_fatura </span>
                                  </div>
                                ";

                              echo" <br><input type='button' id='botao_voltar' class='btn btn-outline-warning btn-block form-control' value='Voltar' onclick='voltar();'>
                                    <input type='button' class='btn btn-warning btn-block form-control' value='Emitir Boleto'>
                          </div>
                        </div>
              "; $_SESSION['strfinal'] = array();      
            }
          }
        ?>
      </div>  
    </div>    
  </div>
</body>
</html>
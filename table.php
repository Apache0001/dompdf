<?php require __DIR__."/index.php" ;?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>

    
    <style>
    *{
      font-family: 'Roboto', 'sans-serif';
      margin: 0;
      padding: 0;
    }
    
    h1{
      text-align: center;
      margin: 20px 0;
      background-color: blue;
      color: white;
    }
    table{
      max-width: 500px;
      width: 100%;
    }
     td{
       padding: 10px 20px;
       text-align: center;
       border-bottom: 1px solid gray;
     }
     th{
      padding: 10px 20px;
      border-bottom: 1px solid gray;
     }
     .titulo{
       background-color: gray;
     }

    </style>
</head>
<body>
<?php foreach($order as $pedido){ ?>
  <div id="container">
    <!-- Pedidos -->
    <h1>Pedido <?= $pedido->order_id ?></h1>
          <div id="detalhes">
        
          <table class="tabela-detalhes-pedido">
          <!-- TÍTULO DA TABELA -->
          <tr>
          <th colspan="2" class="titulo" >Detalhes do pedido</th>
          </tr>

          <!-- CADA ROW TEM UM HEAD E UM DATA -->
          <tr>
          <th>Loja</th>
          <td><?= $pedido->store_name ?></td>
          </tr>

          <tr>
          <th>Data de cadastro</th>
          <td><?= $pedido->date_added ?></td>
          </tr>

          <tr>
          <th>Forma de pagamento</th>
          <td><?= $pedido->payment_method ?></td>
          </tr>

          <tr>
          <th>Forma de envio</th>
          <td><?= $pedido->shipping_method ?></td>
          </tr>
          </table>

          <table class="tabela-detalhes-asd">
          <tr>
          <th colspan="2" class="titulo">Detalhes do cliente</th>
          </tr>

          <tr>
          <th>Cliente</th>
          <td><?= $pedido->firstname ." ".$pedido->lastname ?></td>
          </tr>

          <tr>
          <th>Tipo de cliente</th>
          <td><?= ($pedido->customer_group_id == 1) ? 'Pessoa Física' : 'Pessoa Jurídica' ; ?></td>
          </tr>

          <tr>
          <th>E-mail</th>
          <td><?= $pedido->email ?></td>
          </tr>

          <tr>
          <th>Telefone</th>
          <td><?= $pedido->telephone ?></td>
          </tr>
          </table>

      </div>
      <br> <br>
      <div id="endereco">

          <table class="tabela-detalhes">
          <tr>
          <th colspan="5" class="titulo">Endereço para Entrega</th>
          </tr>


          <tr>
          <th>Endereço</th>
          <td colspan="3"><?= $pedido->shipping_address_1. ", ".$pedido->shipping_company?>Rua General Canrobert 77</td>
          </tr>

          <tr>
          <th>Bairro</th>
          <td colspan="3"><?= $pedido->shipping_address_2 ?></td>
          </tr>

          <tr>
          <th>Cidade</th>
          <td><?= $pedido->shipping_city ?></td>
          <th>CEP</th>
          <td><?= $pedido->shipping_postcode ?></td>
          </tr>

          <tr>
          <th>Estado</th>
          <td colspan="3"><?= $pedido->shipping_zone ?></td>
          </tr>

          <tr>
          <th>País</th>
          <td colspan="3"><?= $pedido->shipping_country ?></td>
          </tr>
          </table>

          <table class="tabela-detalhes">
          <!-- TÍTULO DA TABELA -->
          <tr>
          <th colspan="5" class="titulo">Endereço para fatura</th>
          </tr>

          <!-- CADA ROW TEM UM HEAD E UM DATA -->

          <tr>
          <th>Endereço</th>
          <th colspan="3"><?= $pedido->payment_address_1 . ", ".$pedido->payment_company ?></th>
          </tr>

          <tr>
          <th>Bairro</th>
          <td colspan="3"><?= $pedido->payment_address_2 ?></td>
          </tr>

          <tr>
          <th>Cidade</th>
          <td><?= $pedido->payment_city ?></td>
          <th>CEP</th>
          <td><?= $pedido->payment_postcode ?></td>
          </tr>

          <tr>
          <th>Estado</th>
          <td colspan="3"><?= $pedido->payment_zone?></td>
          </tr>

          <tr>
          <th>País</th>
          <td colspan="3"><?= $pedido->payment_country ?></td>
          </tr>
          </table>




      </div>
    
    <br> <br>
      <!--  Produtos -->
    
        <div id="produtos">
            <table class="tabela-produtos">
            <tr>
            <th colspan="5" class="titulo">Produtos</th>
            </tr>
            
              <tr>
              <th>Produto</th>
              <th>Modelo</th>
              <th>Quantidade</th>
              <th>Valor</th>
              <th>Total</th>
              </tr>
              <?php foreach($pedido->getProduct($pedido->order_id) as $produto){ ?>
              <tr>
              <td><?= $produto->name ?></td>
              <td><?= $produto->model ?></td>
              <td><?= $produto->quantity ?></td>
              <td><?= $produto->price ?></td>
              <td><?= $produto->total ?></td>
              </tr>
            <?php };?>
              </table>
            
          </div>
          <div id="subtotal">
              <table>
              <tr>
              <th>Subtotal</th>
              <td><?= $pedido->getBuy($pedido->order_id)->value?></td>
              </tr>
              <tr>
              <th>Frete módico - Entrega de 5 até 12 dias úteis</th>
              <td><?= $pedido->getBuy($pedido->order_id,"shipping")->value?></td>
              </tr>

              <tr>
              <th>Total</th>
              <td><?= $pedido->total ?></td>
              </tr>
              </table>

          </div>

          <br> <br>
        
      <!-- Histórico -->
      <div id="historico">
          <table id="historico">
          <tr>
          <th colspan="5" class="titulo">Histórico</th>
          </tr>

          <tr>
          <th>Cadastro</th>
          <th>Comentário</th>
          <th>Situação</th>
          <th>Cliente notificado</th>
          </tr>
          <?php foreach($pedido->getHistory($pedido->order_id) as $historico){ ?>
            <tr>
            <td><?= $historico->date_added ?></td>
            <td><?= $historico->comment ?></td>
            <td><?= $pedido->getStatus($historico->order_status_id)[2] ?></td>
            <td><?= $historico->notify ? 'SIM' : "Não" ?></td>
            </tr>
          <?php }?>
          </table>

      </div>
  </div>
<?php } ?>
</body>
</html>
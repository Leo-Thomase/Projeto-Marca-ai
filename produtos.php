<?php require_once("cabecalho.php") ?>
<style type="text/css">
	.sub_page .hero_area {
  min-height: auto;
}
</style>

</div>





  <?php 
$query = $pdo->query("SELECT * FROM produtos where estoque > 0 and valor_venda >  0 ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
   ?>

  <section class="product_section layout_padding" style="background-color: black;">
    <div class="container-fluid" style="background-color: black;">
      <div class="heading_container heading_center ">
        <h2 class="" style="color: white;">
          Nossos Produtos
        </h2>
        <p class="col-lg-8 px-0">
          Confira alguns de nossos produtos, damos desconto caso compre em grande quantidade.
        </p>
      </div>
      <div class="row" style="background-color: black;" >

<?php 
for($i=0; $i < $total_reg; $i++){
  foreach ($res[$i] as $key => $value){}
 
  $id = $res[$i]['id'];
  $nome = $res[$i]['nome'];   
  $valor = $res[$i]['valor_venda'];
  $foto = $res[$i]['foto'];
  $descricao = $res[$i]['descricao'];
   $valorF = number_format($valor, 2, ',', '.');
 $nomeF = mb_strimwidth($nome, 0, 23, "...");

 ?>

        <div class="col-sm-6 col-md-3" style="background-color: black; margin-top: 25px;">
          <div class="box" style="background-color: white;" >
            <div class="img-box" style="background-color: white;" >
              <img src="sistema/painel/img/produtos/<?php echo $foto ?>" title="<?php echo $descricao ?>">
            </div>
            <div class="detail-box">
              <h5>
               <?php echo $nomeF ?>
              </h5>
              <h6 class="price">
                <span class="new_price">
                 R$ <?php echo $valorF ?>
                </span>
            </div>
          </div>
        </div>
      
   <?php } ?>    


      </div>
      
    </div>
  </section>

<?php } ?>

  <!-- product section ends -->




 
   <?php require_once("rodape.php") ?>
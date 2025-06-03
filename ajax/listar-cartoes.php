<?php 
require_once("../sistema/conexao.php");

$telefone = @$_POST['tel'];

$query = $pdo->query("SELECT * FROM clientes where telefone LIKE '$telefone' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$cartoes = $res[0]['cartoes'];
	$id_cliente = $res[0]['id'];
	


?>


<div class="row">

<div class="col-md-1 col-2" align="center">

</div>
<?php } ?>
</div>

<br>

 } 
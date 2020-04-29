<?php
date_default_timezone_set("Brazil/East");
?>
<LINK REL=StyleSheet HREF="../engine/style.css" TYPE="text/css">
<div style="width: 750px; border: 1px solid #cccccc; margin: 0 auto; text-align: left;">
<div align="center">
<a href="../index.php" class="botao">Voltar ao Menu Principal</a>
</div>
<hr size="1" width="750" color="#666666">
<div align="right">
<a href="pedido.php?pag=4" class="botao">Adicionar um novo registro</a>
</div>
<div align="left" style="margin-top: -25px;">
<a href="pedido.php?pag=1" class="botao">Voltar</a>
</div>
<hr size="1" width="750" color="#666666">
<?php
include "../engine/conexao.php";
if(isset($_GET['pag'])){$pag = $class->antisql($_GET['pag']);}else {$pag = 1;}
if(isset($_GET['cod'])){$cod = $class->antisql($_GET['cod']);}
if(isset($_POST['idcliente'])){$idcliente = $class->antisql($_POST["idcliente"]);}
if(isset($_POST['observacao'])){$observacao = $class->antisql($_POST["observacao"]);}
if(isset($_POST['datapedido'])){$datapedido = $class->antisql($_POST["datapedido"]);}
if(isset($_POST['previsaoentrega'])){$previsaoentrega = $class->antisql($_POST["previsaoentrega"]);}
if(isset($_POST['dataentrega'])){$dataentrega = $class->antisql($_POST["dataentrega"]);}
if(isset($_POST['conclusaopedido'])){$conclusaopedido = $class->antisql($_POST["conclusaopedido"]);}
if(isset($_POST['datavencimento'])){$datavencimento = $class->antisql($_POST["datavencimento"]);}
if(isset($_POST['datapagamento'])){$datapagamento = $class->antisql($_POST["datapagamento"]);}
if(isset($_POST['valortotal'])){$valortotal = $class->antisql($_POST["valortotal"]);}
if(isset($_POST['qtdsolicitada'])){$qtdsolicitada = $class->antisql($_POST["qtdsolicitada"]);}
if(isset($_POST['qtdproduzida'])){$qtdproduzida = $class->antisql($_POST["qtdproduzida"]);}
if(isset($_POST['qtdentregue'])){$qtdentregue = $class->antisql($_POST["qtdentregue"]);}
if(isset($_POST['qtdsobra'])){$qtdsobra = $class->antisql($_POST["qtdsobra"]);}
if(isset($_POST['valorinvestido'])){$valorinvestido = $class->antisql($_POST["valorinvestido"]);}
if(isset($_POST['valorrecebido'])){$valorrecebido = $class->antisql($_POST["valorrecebido"]);}

$mensagem = "";




if($pag == 1){
$res1 = mysql_query("SELECT * 
FROM pedido 
INNER JOIN cliente ON pedido.idcliente = cliente.idcliente
ORDER BY idpedido desc");
echo "<table border=\"1\" style=\"border-collapse:collapse;border-spacing:0;\"><tr>
<td width=20><span class=\"texto\">Numero</span></td>
<td width=\"500\"><span class=\"texto\">Nome do Cliente</span></td>
<td><span class=\"texto\">Data do pedido</span></td>
<td><span class=\"texto\">Status</span></td>
<td><span class=\"texto\">Detalhes</span></td>
<td><span class=\"texto\">Alterar</span></td>
<td><span class=\"texto\">Excluir</span></td>
</tr>";
 while($escrever1=mysql_fetch_array($res1)){
echo "<tr>
<td><span class=\"texto\"><a href=\"pedido.php?pag=2&cod=" . $escrever1['idpedido'] . "\" class=\"botao\">" . $escrever1['idpedido'] . "</a></span></td>
<td><span class=\"texto\"><a href=\"cliente.php?pag=5&cod=" . $escrever1['idcliente'] . "\" class=\"botao\">" . $escrever1['nome'] . " " . $escrever1['sobrenome'] . "</a></span></td>
<td><span class=\"texto\">" . $escrever1['datapedido'] . "</span></td>";
if($escrever1['conclusaopedido'] == 1){
echo"<td><span class=\"concluido\">CONCLUIDO</span></td>";
}else{
echo"<td><span class=\"pendente\">PENDENTE</span></td>";
}
echo"
<td><span class=\"texto\"><a href=\"pedido.php?pag=5&cod=" . $escrever1['idpedido'] . "\" class=\"botao\">Detalhes</a></span></td>
<td><span class=\"texto\"><a href=\"pedido.php?pag=2&cod=" . $escrever1['idpedido'] . "\" class=\"botao\">Alterar</a></span></td>
<td><span class=\"texto\"><a href=\"pedido.php?pag=3&cod=" . $escrever1['idpedido'] . "\" class=\"botao\">Excluir</a></span></td>
</tr>";
}
}









if($pag == 2){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idcliente"]) && !empty($_POST["datapedido"]) && !empty($_POST["qtdsolicitada"])) {

$insert = mysql_query("UPDATE pedido SET idcliente = '$idcliente', observacao = '$observacao', datapedido = '$datapedido', previsaoentrega = '$previsaoentrega', dataentrega = '$dataentrega', conclusaopedido = '$conclusaopedido', datavencimento = '$datavencimento', datapagamento = '$datapagamento', valortotal = '$valortotal', qtdsolicitada = '$qtdsolicitada', qtdproduzida = '$qtdproduzida', qtdentregue = '$qtdentregue', qtdsobra = '$qtdsobra', valorinvestido = '$valorinvestido', valorrecebido = '$valorrecebido' where idpedido = '$cod';") or die(mysql_error());

if($insert) {
$mensagem = "<b>Pedido alterado com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}
$res2 = mysql_query("SELECT * FROM pedido where idpedido = '$cod'");
$escrever2 = mysql_fetch_array($res2);
$res6 = mysql_query("SELECT * FROM cliente");
?>
<form method="post" action="<?php $PHP_SELF; ?>">
<span class="texto"><?php echo $mensagem; ?></span>

<span class="texto">
<select name="idcliente">
<?php
 while($escrever6=mysql_fetch_array($res6)){
if($escrever2['idcliente'] == $escrever6['idcliente']){
echo "<option value=\"" . $escrever6['idcliente'] . "\" selected>" . $escrever6['nome'] . "</option>";
}else{
echo "<option value=\"" . $escrever6['idcliente'] . "\">" . $escrever6['nome'] . "</option>";
}
}
?>
</select><br>
<b>Observacao:</b> <input type="text" name="observacao" value="<?php echo $escrever2['observacao']; ?>"><br>
<b>Data do pedido:</b> <input type="text" name="datapedido" value="<?php echo $escrever2['datapedido']; ?>"><br>
<b>Previsão de entrega:</b> <input type="text" name="previsaoentrega" value="<?php echo $escrever2['previsaoentrega']; ?>"><br>
<b>Data de entrega:</b> <input type="text" name="dataentrega" value="<?php echo $escrever2['dataentrega']; ?>"><br>
<b>Status do pedido:</b> 
<select name="conclusaopedido">
<?php
if($escrever2['conclusaopedido'] == 1){
echo "  <option value=\"0\">Pendente</option>
  <option value=\"1\" selected>Concluido</option>";
}else{
echo "  <option value=\"0\" selected>Pendente</option>
  <option value=\"1\">Concluido</option>";
}
?>
</select><br>
<b>Data de vencimento:</b> <input type="text" name="datavencimento" value="<?php echo $escrever2['datavencimento']; ?>"><br>
<b>Data de pagamento:</b> <input type="text" name="datapagamento" value="<?php echo $escrever2['datapagamento']; ?>"><br>
<b>valor Total:</b> <input type="text" name="valortotal" value="<?php echo $escrever2['valortotal']; ?>"><br>
<b>Quantidade Solicitada:</b> <input type="text" name="qtdsolicitada" value="<?php echo $escrever2['qtdsolicitada']; ?>"><br>
<b>Quantidade Produzida:</b> <input type="text" name="qtdproduzida" value="<?php echo $escrever2['qtdproduzida']; ?>"><br>
<b>Quantidade Entregue:</b> <input type="text" name="qtdentregue" value="<?php echo $escrever2['qtdentregue']; ?>"><br>
<b>Quantidade De Sobra:</b> <input type="text" name="qtdsobra" value="<?php echo $escrever2['qtdsobra']; ?>"><br>
<b>Valor Investido:</b> <input type="text" name="valorinvestido" value="<?php echo $escrever2['valorinvestido']; ?>"><br>
<b>Valor Recebido:</b> <input type="text" name="valorrecebido" value="<?php echo $escrever2['valorrecebido']; ?>"><br>

<button id="input1" type="submit" name="cadastrar" value="Cadastrar">Alterar</button>
</form>
<?php
}










if($pag == 3){
$apaga = mysql_query("DELETE FROM pedido where idpedido = '$cod';") or die(mysql_error());
if($apaga) {
echo "<script>window.location.href = 'pedido.php?pag=1';</script>";
}else{
echo "<script>alert('Houve um erro!');window.location.href = 'pedido.php?pag=1';</script>";
}
}









if($pag == 4){
$res6 = mysql_query("SELECT * FROM cliente");
if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idcliente"]) && !empty($_POST["datapedido"]) && !empty($_POST["valortotal"])) {


$insert = mysql_query("INSERT INTO pedido(idcliente, observacao, datapedido, previsaoentrega, dataentrega, conclusaopedido, datavencimento, datapagamento, valortotal, qtdsolicitada, qtdproduzida, qtdentregue, qtdsobra, valorinvestido, valorrecebido) VALUES('$idcliente', '$observacao', '$datapedido', '$previsaoentrega', '$dataentrega', '$conclusaopedido', '$datavencimento', '$datapagamento', '$valortotal', '$qtdsolicitada', '$qtdproduzida', '$qtdentregue', '$qtdsobra', '$valorinvestido', '$valorrecebido');") or die(mysql_error());

if($insert) {
$mensagem = "<b>Pedido registrado com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}

echo "
<form method=\"post\" action=\"\">
<span class=\"texto\">" . $mensagem . "</span>

<span class=\"texto\">
<b>Cliente:</b> <select name=\"idcliente\"> <option value=\"#\">Selecione um cliente</option>";

while($escrever6=mysql_fetch_array($res6)){
echo "<option value=\"" . $escrever6['idcliente'] . "\">" . $escrever6['nome'] . " " . $escrever6['sobrenome'] . "</option>";
}

echo "</select><br>
<b>Observação:</b> <input type=\"text\" name=\"observacao\"><br>
<b>Data do pedido:</b> <input type=\"text\" name=\"datapedido\"><br>
<b>Previsão de entrega:</b> <input type=\"text\" name=\"previsaoentrega\"><br>
<b>Data de entrega:</b> <input type=\"text\" name=\"dataentrega\"><br>
<b>Status do pedido:</b> 
<select name=\"conclusaopedido\">
<option value=\"0\" selected>Pendente</option>
<option value=\"1\">Concluido</option>
</select><br>
<b>Data de vencimento:</b> <input type=\"text\" name=\"datavencimento\"><br>
<b>Data de pagamento:</b> <input type=\"text\" name=\"datapagamento\"><br>
<b>Valor Total:</b> <input type=\"text\" name=\"valortotal\"><br>
<b>Quantidade Solicitada:</b> <input type=\"text\" name=\"qtdsolicitada\"><br>
<b>Quantidade Produzida:</b> <input type=\"text\" name=\"qtdproduzida\"><br>
<b>Quantidade Entregue:</b> <input type=\"text\" name=\"qtdentregue\"><br>
<b>Quantidade De Sobra:</b> <input type=\"text\" name=\"qtdsobra\"><br>
<b>Valor Investido:</b> <input type=\"text\" name=\"valorinvestido\"><br>
<b>Valor Recebido:</b> <input type=\"text\" name=\"valorrecebido\"><br>

</span>
<button id=\"input1\" type=\"submit\" name=\"cadastrar\" value=\"Cadastrar\">Cadastrar</button>
</form>
";
}








if($pag == 5){
$res5 = mysql_query("SELECT cliente.nome,pedido.*
FROM pedido
inner join cliente on pedido.idcliente = cliente.idcliente
 where pedido.idpedido = '$cod'");
$escrever5 = mysql_fetch_array($res5);
echo "
<span class=\"texto\">
<b>Numero do pedido:</b> " . $escrever5['idpedido'] . "<br>
<b>Cliente:</b> " . $escrever5['nome'] . "<br>
<b>Observação:</b> " . $escrever5['observacao'] . "<br>
<b>Data do pedido:</b> " . $escrever5['datapedido'] . "<br>
<b>Previsao de entrega:</b> " . $escrever5['previsaoentrega'] . "<br>
<b>Data de entrega:</b> " . $escrever5['dataentrega'] . "<br>";
if($escrever5['conclusaopedido'] == 1){
echo "<b>Status do pedido:</b> Concluido<br>";
}else{
echo "<b>Status do pedido:</b> Pendente<br>";
}
echo "
<b>Data de vencimento:</b> " . $escrever5['datavencimento'] . "<br>
<b>Data de pagamento:</b> " . $escrever5['datapagamento'] . "<br>
<b>Valor Total:</b> " . $escrever5['valortotal'] . "<br>
<b>Quantidade Solicitada:</b> " . $escrever5['qtdsolicitada'] . "<br>
<b>Quantidade Produzida:</b> " . $escrever5['qtdproduzida'] . "<br>
<b>Quantidade Entregue:</b> " . $escrever5['qtdentregue'] . "<br>
<b>Quantidade de sobra:</b> " . $escrever5['qtdsobra'] . "<br>
<b>Valor Investido:</b> " . $escrever5['valorinvestido'] . "<br>
<b>Valor recebido:</b> " . $escrever5['valorrecebido'] . "<br>";
}










?>
</div>

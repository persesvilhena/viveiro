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
<a href="produto.php?pag=4" class="botao">Adicionar um novo registro</a>
</div>
<div align="left" style="margin-top: -25px;">
<a href="produto.php?pag=1" class="botao">Voltar</a>
</div>
<hr size="1" width="750" color="#666666">
<?php
include "../engine/conexao.php";
if(isset($_GET['pag'])){$pag = $class->antisql($_GET['pag']);}else {$pag = 1;}
if(isset($_GET['cod'])){$cod = $class->antisql($_GET['cod']);}
if(isset($_POST['idproduto'])){$idproduto = $class->antisql($_POST["idproduto"]);}
if(isset($_POST['idpedido'])){$idpedido = $class->antisql($_POST["idpedido"]);}
if(isset($_POST['nome'])){$nome = $class->antisql($_POST["nome"]);}
if(isset($_POST['preco'])){$preco = $class->antisql($_POST["preco"]);}
if(isset($_POST['descricao'])){$descricao = $class->antisql($_POST["descricao"]);}

$mensagem = "";


if($pag == 1){
$res1 = mysql_query("SELECT * 
FROM produto 
INNER JOIN pedido ON pedido.idpedido = produto.idpedido
ORDER BY idproduto desc");
echo "<table border=\"1\" style=\"border-collapse:collapse;border-spacing:0;\"><tr>
<td width=20><span class=\"texto\">ID</span></td>
<td width=\"230\"><span class=\"texto\">Numero do pedido</span></td>
<td width=\"500\"><span class=\"texto\">Nome</span></td>
<td><span class=\"texto\">Preço</span></td>
<td><span class=\"texto\">Descriçao</span></td>
<td><span class=\"texto\">Detalhes</span></td>
<td><span class=\"texto\">Alterar</span></td>
<td><span class=\"texto\">Excluir</span></td>
</tr>";
 while($escrever1=mysql_fetch_array($res1)){
echo "<tr>
<td><span class=\"texto\"><a href=\"produto.php?pag=2&cod=" . $escrever1['idproduto'] . "\" class=\"botao\">" . $escrever1['idproduto'] . "</a></span></td>
<td><span class=\"texto\"><a href=\"pedido.php?pag=5&cod=" . $escrever1['idpedido'] . "\" class=\"botao\">" . $escrever1['idpedido'] . "</a></span></td>
<td><span class=\"texto\">" . $escrever1['nome'] . "</span></td>
<td><span class=\"texto\">" . $escrever1['preco'] . "</span></td>
<td><span class=\"texto\">" . $escrever1['descricao'] . "</span></td>
<td><span class=\"texto\"><a href=\"produto.php?pag=5&cod=" . $escrever1['idproduto'] . "\" class=\"botao\">Detalhes</a></span></td>
<td><span class=\"texto\"><a href=\"produto.php?pag=2&cod=" . $escrever1['idproduto'] . "\" class=\"botao\">Alterar</a></span></td>
<td><span class=\"texto\"><a href=\"produto.php?pag=3&cod=" . $escrever1['idproduto'] . "\" class=\"botao\">Excluir</a></span></td>
</tr>";
}
}





if($pag == 2){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idpedido"]) && !empty($_POST["nome"]) && !empty($_POST["preco"])) {

$insert = mysql_query("UPDATE produto SET idpedido = '$idpedido', nome = '$nome', preco = '$preco', descricao = '$descricao' where idproduto = '$cod';") or die(mysql_error());

if($insert) {
$mensagem = "<b>Produto alterado com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}
$res2 = mysql_query("SELECT * FROM produto where idproduto = '$cod'");
$escrever2 = mysql_fetch_array($res2);
$res6 = mysql_query("SELECT * FROM pedido");
?>
<form method="post" action="<?php $PHP_SELF; ?>">
<span class="texto"><?php echo $mensagem; ?></span>

<span class="texto">
<select name="idpedido">
<?php
 while($escrever6=mysql_fetch_array($res6)){
if($escrever2['idpedido'] == $escrever6['idpedido']){
echo "<option value=\"" . $escrever6['idpedido'] . "\" selected>" . $escrever6['idpedido'] . "</option>";
}else{
echo "<option value=\"" . $escrever6['idpedido'] . "\">" . $escrever6['idpedido'] . "</option>";
}
}
?>
</select><br>
<b>Nome:</b> <input type="text" name="nome" value="<?php echo $escrever2['nome']; ?>"><br>
<b>Preço:</b> <input type="text" name="preco" value="<?php echo $escrever2['preco']; ?>"><br>
<b>Descrição:</b> <input type="text" name="descricao" value="<?php echo $escrever2['descricao']; ?>"><br>

<button id="input1" type="submit" name="cadastrar" value="Cadastrar">Alterar</button>
</form>
<?php
}








if($pag == 3){
$apaga = mysql_query("DELETE FROM produto where idproduto = '$cod';") or die(mysql_error());
if($apaga) {
echo "<script>window.location.href = 'produto.php?pag=1';</script>";
}else{
echo "<script>alert('Houve um erro!');window.location.href = 'produto.php?pag=1';</script>";
}
}







if($pag == 4){
$res6 = mysql_query("SELECT * FROM pedido");
if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idpedido"]) && !empty($_POST["nome"]) && !empty($_POST["preco"])) {


$insert = mysql_query("INSERT INTO produto(idpedido, nome, preco, descricao) VALUES('$idpedido', '$nome', '$preco', '$descricao');") or die(mysql_error());

if($insert) {
$mensagem = "<b>Produto registrado com sucesso!</b><br>";
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
<b>Pedido:</b> <select name=\"idpedido\"> <option value=\"#\">Selecione o numero do pedido</option>";

while($escrever6=mysql_fetch_array($res6)){
echo "<option value=\"" . $escrever6['idpedido'] . "\">" . $escrever6['idpedido'] . "</option>";
}

echo "</select><br>
<b>Nome:</b> <input type=\"text\" name=\"nome\"><br>
<b>Preço:</b> <input type=\"text\" name=\"preco\"><br>
<b>Descrição:</b> <input type=\"text\" name=\"descricao\"><br>


</span>
<button id=\"input1\" type=\"submit\" name=\"cadastrar\" value=\"Cadastrar\">Cadastrar</button>
</form>
";
}





if($pag == 5){
$res5 = mysql_query("SELECT * FROM produto where idproduto = '$cod'");
$escrever5 = mysql_fetch_array($res5);
echo "
<span class=\"texto\">
<b>Numero do produto:</b> " . $escrever5['idproduto'] . "<br>
<b>Numero do pedido:</b> " . $escrever5['idpedido'] . "<br>
<b>Nome:</b> " . $escrever5['nome'] . "<br>
<b>Preço:</b> " . $escrever5['preco'] . "<br>
<b>Descrição:</b> " . $escrever5['descricao'] . "<br>";





}
?>
</div>

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
<a href="receita.php?pag=4" class="botao">Adicionar um novo registro</a>
</div>
<div align="left" style="margin-top: -25px;">
<a href="receita.php?pag=1" class="botao">Voltar</a>
</div>
<hr size="1" width="750" color="#666666">
<?php
include "../engine/conexao.php";
if(isset($_GET['pag'])){$pag = $class->antisql($_GET['pag']);}else {$pag = 1;}
if(isset($_GET['cod'])){$cod = $class->antisql($_GET['cod']);}
if(isset($_POST['codreceita'])){$codreceita = $class->antisql($_POST["codreceita"]);}
if(isset($_POST['idproduto'])){$idproduto = $class->antisql($_POST["idproduto"]);}
if(isset($_POST['idfuncionario'])){$idfuncionario = $class->antisql($_POST["idfuncionario"]);}
if(isset($_POST['quantidade'])){$quantidade = $class->antisql($_POST["quantidade"]);}
if(isset($_POST['descricao'])){$descricao = $class->antisql($_POST["descricao"]);}
if(isset($_POST['datafabricacao'])){$datafabricacao = $class->antisql($_POST["datafabricacao"]);}

$mensagem = "";


if($pag == 1){
$res1 = mysql_query("SELECT produto.idproduto,funcionario.idfuncionario,funcionario.nome,funcionario.sobrenome,receita.*
FROM receita 
INNER JOIN produto ON receita.idproduto = produto.idproduto
INNER JOIN funcionario ON receita.idfuncionario = funcionario.idfuncionario
ORDER BY codreceita desc");
echo "<table border=\"1\" style=\"border-collapse:collapse;border-spacing:0;\"><tr>
<td width=20><span class=\"texto\">ID</span></td>
<td width=\"230\"><span class=\"texto\">Produto</span></td>
<td width=\"500\"><span class=\"texto\">Funcionario</span></td>
<td><span class=\"texto\">Data de fabricaçao</span></td>
<td><span class=\"texto\">Detalhes</span></td>
<td><span class=\"texto\">Alterar</span></td>
<td><span class=\"texto\">Excluir</span></td>
</tr>";
 while($escrever1=mysql_fetch_array($res1)){
echo "<tr>
<td><span class=\"texto\"><a href=\"receita.php?pag=2&cod=" . $escrever1['codreceita'] . "\" class=\"botao\">" . $escrever1['codreceita'] . "</a></span></td>
<td><span class=\"texto\"><a href=\"produto.php?pag=5&cod=" . $escrever1['idproduto'] . "\" class=\"botao\">" . $escrever1['idproduto'] . "</a></span></td>
<td><span class=\"texto\"><a href=\"funcionario.php?pag=5&cod=" . $escrever1['idfuncionario'] . "\" class=\"botao\">" . $escrever1['nome'] . " " . $escrever1['sobrenome'] . "</a></span></td>
<td><span class=\"texto\">" . $escrever1['datafabricacao'] . "</span></td>
<td><span class=\"texto\"><a href=\"receita.php?pag=5&cod=" . $escrever1['codreceita'] . "\" class=\"botao\">Detalhes</a></span></td>
<td><span class=\"texto\"><a href=\"receita.php?pag=2&cod=" . $escrever1['codreceita'] . "\" class=\"botao\">Alterar</a></span></td>
<td><span class=\"texto\"><a href=\"receita.php?pag=3&cod=" . $escrever1['codreceita'] . "\" class=\"botao\">Excluir</a></span></td>
</tr>";
}
}





if($pag == 2){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idproduto"]) && !empty($_POST["idfuncionario"]) && !empty($_POST["quantidade"])) {

$insert = mysql_query("UPDATE receita SET idproduto = '$idproduto', idfuncionario = '$idfuncionario', quantidade = '$quantidade', descricao = '$descricao', datafabricacao = '$datafabricacao' where codreceita = '$cod';") or die(mysql_error());

if($insert) {
$mensagem = "<b>Receita alterada com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}
$res2 = mysql_query("SELECT * FROM receita where codreceita = '$cod'");
$escrever2 = mysql_fetch_array($res2);
$res6 = mysql_query("SELECT * FROM produto");
$res7 = mysql_query("SELECT * FROM funcionario");
?>
<form method="post" action="<?php $PHP_SELF; ?>">
<span class="texto"><?php echo $mensagem; ?></span>

<span class="texto">
<b>Produto:</b> <select name="idproduto">
<?php
 while($escrever6=mysql_fetch_array($res6)){
if($escrever2['idproduto'] == $escrever6['idproduto']){
echo "<option value=\"" . $escrever6['idproduto'] . "\" selected>" . $escrever6['idproduto'] . "</option>";
}else{
echo "<option value=\"" . $escrever6['idproduto'] . "\">" . $escrever6['idproduto'] . "</option>";
}
}
?>
</select><br>
<b>Funcionario:</b> <select name="idfuncionario">
<?php
 while($escrever7=mysql_fetch_array($res7)){
if($escrever2['idfuncionario'] == $escrever7['idfuncionario']){
echo "<option value=\"" . $escrever7['idfuncionario'] . "\" selected>" . $escrever7['nome'] . " " . $escrever7['sobrenome'] . "</option>";
}else{
echo "<option value=\"" . $escrever7['idfuncionario'] . "\">" . $escrever7['nome'] . " " . $escrever7['sobrenome'] . "</option>";
}
}
?>
</select><br>
<b>Quantidade:</b> <input type="text" name="quantidade" value="<?php echo $escrever2['quantidade']; ?>"><br>
<b>Descrição:</b> <input type="text" name="descricao" value="<?php echo $escrever2['descricao']; ?>"><br>
<b>Data de fabricação:</b> <input type="text" name="datafabricacao" value="<?php echo $escrever2['datafabricacao']; ?>"><br>

<button id="input1" type="submit" name="cadastrar" value="Cadastrar">Alterar</button>
</form>
<?php
}








if($pag == 3){
$apaga = mysql_query("DELETE FROM receita where codreceita = '$cod';") or die(mysql_error());
if($apaga) {
echo "<script>window.location.href = 'receita.php?pag=1';</script>";
}else{
echo "<script>alert('Houve um erro!');window.location.href = 'receita.php?pag=1';</script>";
}
}







if($pag == 4){
$res6 = mysql_query("SELECT * FROM produto");
$res7 = mysql_query("SELECT * FROM funcionario");
if(isset($_POST["cadastrar"])) {
if(!empty($_POST["idproduto"]) && !empty($_POST["idfuncionario"]) && !empty($_POST["quantidade"])) {


$insert = mysql_query("INSERT INTO receita(idproduto, idfuncionario, quantidade, descricao, datafabricacao) VALUES('$idproduto', '$idfuncionario', '$quantidade', '$descricao', '$datafabricacao');") or die(mysql_error());

if($insert) {
$mensagem = "<b>Receita registrada com sucesso!</b><br>";
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
<b>Produto:</b> <select name=\"idproduto\"> <option value=\"#\">Selecione o numero do produto</option>";

while($escrever6=mysql_fetch_array($res6)){
echo "<option value=\"" . $escrever6['idproduto'] . "\">" . $escrever6['idproduto'] . "</option>";
}

echo "</select><br>
<b>Funcionario:</b> <select name=\"idfuncionario\"> <option value=\"#\">Selecione o funcionario</option>";

while($escrever7=mysql_fetch_array($res7)){
echo "<option value=\"" . $escrever7['idfuncionario'] . "\">" . $escrever7['nome'] . " " . $escrever7['sobrenome'] . "</option>";
}

echo "</select><br>
<b>Quantidade:</b> <input type=\"text\" name=\"quantidade\"><br>
<b>Descrição:</b> <input type=\"text\" name=\"descricao\"><br>
<b>Data de fabricação:</b> <input type=\"text\" name=\"datafabricacao\"><br>

</span>
<button id=\"input1\" type=\"submit\" name=\"cadastrar\" value=\"Cadastrar\">Cadastrar</button>
</form>
";
}





if($pag == 5){
$res5 = mysql_query("SELECT produto.idproduto,funcionario.idfuncionario,funcionario.nome,funcionario.sobrenome,receita.*
FROM receita 
INNER JOIN produto ON receita.idproduto = produto.idproduto
INNER JOIN funcionario ON receita.idfuncionario = funcionario.idfuncionario
ORDER BY codreceita desc");
$escrever5 = mysql_fetch_array($res5);
echo "
<span class=\"texto\">
<b>Numero da receita:</b> " . $escrever5['codreceita'] . "<br>
<b>Numero do produto:</b> " . $escrever5['idproduto'] . "<br>
<b>Funcionario:</b> " . $escrever5['nome'] . " " . $escrever5['sobrenome'] . "<br>
<b>Quantidade:</b> " . $escrever5['quantidade'] . "<br>
<b>Descrição:</b> " . $escrever5['descricao'] . "<br>
<b>Data de Fabricação:</b> " . $escrever5['datafabricacao'] . "<br>";





}
?>
</div>

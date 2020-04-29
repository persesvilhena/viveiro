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
<a href="materiaprima.php?pag=4" class="botao">Adicionar um novo registro</a>
</div>
<div align="left" style="margin-top: -25px;">
<a href="materiaprima.php?pag=1" class="botao">Voltar</a>
</div>
<hr size="1" width="750" color="#666666">
<?php
include "../engine/conexao.php";
if(isset($_GET['pag'])){$pag = $class->antisql($_GET['pag']);}else {$pag = 1;}
if(isset($_GET['cod'])){$cod = $class->antisql($_GET['cod']);}
if(isset($_POST['idmateriaprima'])){$idmateriaprima = $class->antisql($_POST["idmateriaprima"]);}
if(isset($_POST['codreceita'])){$codreceita = $class->antisql($_POST["codreceita"]);}
if(isset($_POST['nome'])){$nome = $class->antisql($_POST["nome"]);}
if(isset($_POST['quantidade'])){$quantidade = $class->antisql($_POST["quantidade"]);}
if(isset($_POST['datavalidade'])){$datavalidade = $class->antisql($_POST["datavalidade"]);}

$mensagem = "";


if($pag == 1){
$res1 = mysql_query("SELECT * 
FROM materiaprima
ORDER BY idmateriaprima desc");
echo "<table border=\"1\" style=\"border-collapse:collapse;border-spacing:0;\"><tr>
<td width=20><span class=\"texto\">ID</span></td>
<td width=\"230\"><span class=\"texto\">Receita</span></td>
<td width=\"500\"><span class=\"texto\">Nome</span></td>
<td><span class=\"texto\">Quantidade</span></td>
<td><span class=\"texto\">Data de validade</span></td>
<td><span class=\"texto\">Detalhes</span></td>
<td><span class=\"texto\">Alterar</span></td>
<td><span class=\"texto\">Excluir</span></td>
</tr>";
 while($escrever1=mysql_fetch_array($res1)){
echo "<tr>
<td><span class=\"texto\"><a href=\"materiaprima.php?pag=2&cod=" . $escrever1['idmateriaprima'] . "\" class=\"botao\">" . $escrever1['idmateriaprima'] . "</a></span></td>
<td><span class=\"texto\"><a href=\"receita.php?pag=5&cod=" . $escrever1['codreceita'] . "\" class=\"botao\">" . $escrever1['codreceita'] . "</a></span></td>
<td><span class=\"texto\">" . $escrever1['nome'] . "</span></td>
<td><span class=\"texto\">" . $escrever1['quantidade'] . "</span></td>
<td><span class=\"texto\">" . $escrever1['datavalidade'] . "</span></td>
<td><span class=\"texto\"><a href=\"materiaprima.php?pag=5&cod=" . $escrever1['idmateriaprima'] . "\" class=\"botao\">Detalhes</a></span></td>
<td><span class=\"texto\"><a href=\"materiaprima.php?pag=2&cod=" . $escrever1['idmateriaprima'] . "\" class=\"botao\">Alterar</a></span></td>
<td><span class=\"texto\"><a href=\"materiaprima.php?pag=3&cod=" . $escrever1['idmateriaprima'] . "\" class=\"botao\">Excluir</a></span></td>
</tr>";
}
}





if($pag == 2){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["codreceita"]) && !empty($_POST["nome"]) && !empty($_POST["quantidade"]) && !empty($_POST["datavalidade"])) {

$insert = mysql_query("UPDATE materiaprima SET codreceita = '$codreceita', nome = '$nome', quantidade = '$quantidade', datavalidade = '$datavalidade' where idmateriaprima = '$cod';") or die(mysql_error());

if($insert) {
$mensagem = "<b>Materia prima alterada com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}
$res2 = mysql_query("SELECT * FROM materiaprima where idmateriaprima = '$cod'");
$escrever2 = mysql_fetch_array($res2);
$res6 = mysql_query("SELECT * FROM receita");
?>
<form method="post" action="<?php $PHP_SELF; ?>">
<span class="texto"><?php echo $mensagem; ?></span>

<span class="texto">
<select name="codreceita">
<?php
 while($escrever6=mysql_fetch_array($res6)){
if($escrever2['codreceita'] == $escrever6['codreceita']){
echo "<option value=\"" . $escrever6['codreceita'] . "\" selected>" . $escrever6['codreceita'] . "</option>";
}else{
echo "<option value=\"" . $escrever6['codreceita'] . "\">" . $escrever6['codreceita'] . "</option>";
}
}
?>
</select><br>
<b>Nome:</b> <input type="text" name="nome" value="<?php echo $escrever2['nome']; ?>"><br>
<b>Quantidade:</b> <input type="text" name="quantidade" value="<?php echo $escrever2['quantidade']; ?>"><br>
<b>Data de validade:</b> <input type="text" name="datavalidade" value="<?php echo $escrever2['datavalidade']; ?>"><br>

<button id="input1" type="submit" name="cadastrar" value="Cadastrar">Alterar</button>
</form>
<?php
}








if($pag == 3){
$apaga = mysql_query("DELETE FROM materiaprima where idmateriaprima = '$cod';") or die(mysql_error());
if($apaga) {
echo "<script>window.location.href = 'materiaprima.php?pag=1';</script>";
}else{
echo "<script>alert('Houve um erro!');window.location.href = 'materiaprima.php?pag=1';</script>";
}
}







if($pag == 4){
$res6 = mysql_query("SELECT * FROM receita");
if(isset($_POST["cadastrar"])) {
if(!empty($_POST["codreceita"]) && !empty($_POST["nome"]) && !empty($_POST["quantidade"]) && !empty($_POST["datavalidade"])) {


$insert = mysql_query("INSERT INTO materiaprima(codreceita, nome, quantidade, datavalidade) VALUES('$codreceita', '$nome', '$quantidade', '$datavalidade');") or die(mysql_error());

if($insert) {
$mensagem = "<b>Materia prima registrada com sucesso!</b><br>";
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
<b>Receita:</b> <select name=\"codreceita\"> <option value=\"#\">Selecione o numero da receita</option>";

while($escrever6=mysql_fetch_array($res6)){
echo "<option value=\"" . $escrever6['codreceita'] . "\">" . $escrever6['codreceita'] . "</option>";
}

echo "</select><br>
<b>Nome:</b> <input type=\"text\" name=\"nome\"><br>
<b>Quantidade:</b> <input type=\"text\" name=\"quantidade\"><br>
<b>Data de Validade:</b> <input type=\"text\" name=\"datavalidade\"><br>


</span>
<button id=\"input1\" type=\"submit\" name=\"cadastrar\" value=\"Cadastrar\">Cadastrar</button>
</form>
";
}





if($pag == 5){
$res5 = mysql_query("SELECT * FROM materiaprima where idmateriaprima = '$cod'");
$escrever5 = mysql_fetch_array($res5);
echo "
<span class=\"texto\">
<b>Numero da materia prima:</b> " . $escrever5['idmateriaprima'] . "<br>
<b>Numero da receita:</b> " . $escrever5['codreceita'] . "<br>
<b>Nome:</b> " . $escrever5['nome'] . "<br>
<b>Quantidade:</b> " . $escrever5['quantidade'] . "<br>
<b>Data de Validade:</b> " . $escrever5['datavalidade'] . "<br>";





}
?>
</div>

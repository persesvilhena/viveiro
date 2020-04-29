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
<a href="cliente.php?pag=4" class="botao">Adicionar um novo registro</a>
</div>
<div align="left" style="margin-top: -25px;">
<a href="cliente.php?pag=1" class="botao">Voltar</a>
</div>
<hr size="1" width="750" color="#666666">
<?php
include "../engine/conexao.php";
if(isset($_GET['pag'])){$pag = $class->antisql($_GET['pag']);}else {$pag = 1;}
if(isset($_GET['cod'])){$cod = $_GET['cod'];}
$mensagem = "";




if($pag == 1){
$res1 = mysql_query("SELECT * FROM cliente ORDER BY idcliente desc");
echo "<table border=\"1\" style=\"border-collapse:collapse;border-spacing:0;\"><tr>
<td width=20><span class=\"texto\">ID</span></td>
<td width=300><span class=\"texto\">Cliente</span></td>
<td width=180><span class=\"texto\">Email</span></td>
<td><span class=\"texto\">Data Cadastro</span></td>
<td><span class=\"texto\">Detalhes</span></td>
<td><span class=\"texto\">Excluir</span></td>
</tr>";
 while($escrever1=mysql_fetch_array($res1)){
echo "<tr>
<td><span class=\"texto\">" . $escrever1['idcliente'] . "</span></td>
<td><span class=\"texto\"><a href=\"cliente.php?pag=2&cod=" . $escrever1['idcliente'] . "\" class=\"botao\">" . $escrever1['nome'] . " " . $escrever1['sobrenome'] . "</a></span></td>
<td><span class=\"texto\">" . $escrever1['email'] . "</span></td>
<td><span class=\"texto\">" . $escrever1['datacadastro'] . "</span></td>
<td><span class=\"texto\"><a href=\"cliente.php?pag=5&cod=" . $escrever1['idcliente'] . "\" class=\"botao\">Detalhes</a></span></td>
<td><span class=\"texto\"><a href=\"cliente.php?pag=3&cod=" . $escrever1['idcliente'] . "\" class=\"botao\">Excluir</a></span></td>
</tr>";
}
}





if($pag == 2){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["nome"]) && !empty($_POST["sobrenome"]) && !empty($_POST["cpf_cnpj"])) {

$nome = $class->antisql($_POST["nome"]);
$sobrenome = $class->antisql($_POST["sobrenome"]);
$endereco = $class->antisql($_POST["endereco"]);
$complemento = $class->antisql($_POST["complemento"]);
$numero = $class->antisql($_POST["numero"]);
$bairro = $class->antisql($_POST["bairro"]);
$cidade = $class->antisql($_POST["cidade"]);
$cep = $class->antisql($_POST["cep"]);
$uf = $class->antisql($_POST["uf"]);
$cpf_cnpj = $class->antisql($_POST["cpf_cnpj"]);
$rg_ie = $class->antisql($_POST["rg_ie"]);
$fisicojuridico = $class->antisql($_POST["fisicojuridico"]);
$telefone = $class->antisql($_POST["telefone"]);
$celular = $class->antisql($_POST["celular"]);
$email = $class->antisql($_POST["email"]);
$datacadastro = $class->antisql($_POST["datacadastro"]);
$datanascimento = $class->antisql($_POST["datanascimento"]);
$observacao = $class->antisql($_POST["observacao"]);

$insert = mysql_query("UPDATE cliente SET nome = '$nome', sobrenome = '$sobrenome', endereco = '$endereco', complemento = '$complemento', numero = '$numero', bairro = '$bairro', cidade = '$cidade', cep = '$cep', uf = '$uf', cpf_cnpj = '$cpf_cnpj', rg_ie = '$rg_ie', fisicojuridico = '$fisicojuridico', telefone = '$telefone', celular = '$celular', email = '$email', datacadastro = '$datacadastro', datanascimento = '$datanascimento', observacao = '$observacao' where idcliente = '$cod';") or die(mysql_error());

if($insert) {
$mensagem = "<b>Cliente alterado com sucesso!</b><br>";
}
}
else {
$mensagem = "<b>Por favor, preencha os campos corretamente!</b><br>";	
}
}
$res2 = mysql_query("SELECT * FROM cliente where idcliente = '$cod'");
$escrever2 = mysql_fetch_array($res2);
?>
<form method="post" action="<?php $PHP_SELF; ?>">
<span class="texto"><?php echo $mensagem; ?></span>

<span class="texto">
<b>Nome:</b> <input type="text" name="nome" value="<?php echo $escrever2['nome']; ?>"><br>
<b>Sobrenome:</b> <input type="text" name="sobrenome" value="<?php echo $escrever2['sobrenome']; ?>"><br>
<b>Endereco:</b> <input type="text" name="endereco" value="<?php echo $escrever2['endereco']; ?>"><br>
<b>Complemento:</b> <input type="text" name="complemento" value="<?php echo $escrever2['complemento']; ?>"><br>
<b>Numero:</b> <input type="text" name="numero" value="<?php echo $escrever2['numero']; ?>"><br>
<b>Bairro:</b> <input type="text" name="bairro" value="<?php echo $escrever2['bairro']; ?>"><br>
<b>Cidade:</b> <input type="text" name="cidade" value="<?php echo $escrever2['cidade']; ?>"><br>
<b>Cep:</b> <input type="text" name="cep" value="<?php echo $escrever2['cep']; ?>"><br>
<b>UF:</b> <input type="text" name="uf" value="<?php echo $escrever2['uf']; ?>"><br>
<b>CPF/CNPJ:</b> <input type="text" name="cpf_cnpj" value="<?php echo $escrever2['cpf_cnpj']; ?>"><br>
<b>RG/IE:</b> <input type="text" name="rg_ie" value="<?php echo $escrever2['rg_ie']; ?>"><br>
<b>Telefone:</b> <input type="text" name="telefone" value="<?php echo $escrever2['telefone']; ?>"><br>
<b>Celular:</b> <input type="text" name="celular" value="<?php echo $escrever2['celular']; ?>"><br>
<b>Email:</b> <input type="text" name="email" value="<?php echo $escrever2['email']; ?>"><br>
<b>Data de Cadastro:</b> <input type="text" name="datacadastro" value="<?php echo $escrever2['datacadastro']; ?>"><br>
<b>Data de Nascimento:</b> <input type="text" name="datanascimento" value="<?php echo $escrever2['datanascimento']; ?>"><br>
<b>Observação:</b> <input type="text" name="observacao" value="<?php echo $escrever2['observacao']; ?>"><br>
<b>Tipo de cliente:</b> 
<select name="fisicojuridico">
<?php
if($escrever2['fisicojuridico'] == 1){
echo "  <option value=\"0\">Fisico</option>
  <option value=\"1\" selected>Juridico</option>";
}else{
echo "  <option value=\"0\" selected>Fisico</option>
  <option value=\"1\">Juridico</option>";
}
?>
</select>

<button id="input1" type="submit" name="cadastrar" value="Cadastrar">Alterar</button>
</form>
<?php
}








if($pag == 3){
$apaga = mysql_query("DELETE FROM cliente where idcliente = '$cod';") or die(mysql_error());
if($apaga) {
echo "<script>window.location.href = 'cliente.php?pag=1';</script>";
}else{
echo "<script>alert('Houve um erro!');window.location.href = 'cliente.php?pag=1';</script>";
}
}







if($pag == 4){

if(isset($_POST["cadastrar"])) {
if(!empty($_POST["nome"]) && !empty($_POST["endereco"]) && !empty($_POST["telefone"])) {

$nome = $class->antisql($_POST["nome"]);
$sobrenome = $class->antisql($_POST["sobrenome"]);
$endereco = $class->antisql($_POST["endereco"]);
$complemento = $class->antisql($_POST["complemento"]);
$numero = $class->antisql($_POST["numero"]);
$bairro = $class->antisql($_POST["bairro"]);
$cidade = $class->antisql($_POST["cidade"]);
$cep = $class->antisql($_POST["cep"]);
$uf = $class->antisql($_POST["uf"]);
$cpf_cnpj = $class->antisql($_POST["cpf_cnpj"]);
$rg_ie = $class->antisql($_POST["rg_ie"]);
$fisicojuridico = $class->antisql($_POST["fisicojuridico"]);
$telefone = $class->antisql($_POST["telefone"]);
$celular = $class->antisql($_POST["celular"]);
$email = $class->antisql($_POST["email"]);
$datacadastro = $class->antisql($_POST["datacadastro"]);
$datanascimento = $class->antisql($_POST["datanascimento"]);
$observacao = $class->antisql($_POST["observacao"]);

$insert = mysql_query("INSERT INTO cliente(nome, sobrenome, endereco, complemento, numero, bairro, cidade, cep, uf, cpf_cnpj, rg_ie, fisicojuridico, telefone, celular, email, datacadastro, datanascimento, observacao) VALUES('$nome', '$sobrenome', '$endereco', '$complemento', '$numero', '$bairro', '$cidade', '$cep', '$uf', '$cpf_cnpj', '$rg_ie', '$fisicojuridico', '$telefone', '$celular', '$email', '$datacadastro', '$datanascimento', '$observacao');") or die(mysql_error());

if($insert) {
$mensagem = "<b>Cliente cadastrado com sucesso!</b><br>";
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
<b>Nome:</b> <input type=\"text\" name=\"nome\"><br>
<b>Sobrenome:</b> <input type=\"text\" name=\"sobrenome\"><br>
<b>Endereco:</b> <input type=\"text\" name=\"endereco\"><br>
<b>Complemento:</b> <input type=\"text\" name=\"complemento\"><br>
<b>Numero:</b> <input type=\"text\" name=\"numero\"><br>
<b>Bairro:</b> <input type=\"text\" name=\"bairro\"><br>
<b>Cidade:</b> <input type=\"text\" name=\"cidade\"><br>
<b>Cep:</b> <input type=\"text\" name=\"cep\"><br>
<b>UF:</b> <input type=\"text\" name=\"uf\"><br>
<b>CPF/CNPJ:</b> <input type=\"text\" name=\"cpf_cnpj\"><br>
<b>RG/IE:</b> <input type=\"text\" name=\"rg_ie\"><br>
<b>Telefone:</b> <input type=\"text\" name=\"telefone\"><br>
<b>Celular:</b> <input type=\"text\" name=\"celular\"><br>
<b>Email:</b> <input type=\"text\" name=\"email\"><br>
<b>Data de cadastro:</b> <input type=\"text\" name=\"datacadastro\"><br>
<b>Data de nascimento:</b> <input type=\"text\" name=\"datanascimento\"><br>
<b>Observacao:</b> <input type=\"text\" name=\"observacao\"><br>
<b>Tipo de cliente:</b> 
<select name=\"fisicojuridico\">
  <option value=\"0\">Fisico</option>
  <option value=\"1\">Juridico</option>
</select>

</span>
<button id=\"input1\" type=\"submit\" name=\"cadastrar\" value=\"Cadastrar\">Cadastrar</button>
</form>
";
}





if($pag == 5){
$res5 = mysql_query("SELECT * FROM cliente where idcliente = '$cod'");
$escrever5 = mysql_fetch_array($res5);
echo "
<span class=\"texto\">
<b>ID:</b> " . $escrever5['idcliente'] . "<br>
<b>Nome:</b> " . $escrever5['nome'] . "<br>
<b>Sobrenome:</b> " . $escrever5['sobrenome'] . "<br>
<b>Endereco:</b> " . $escrever5['endereco'] . "<br>
<b>Complemento:</b> " . $escrever5['complemento'] . "<br>
<b>Numero:</b> " . $escrever5['numero'] . "<br>
<b>Bairro:</b> " . $escrever5['bairro'] . "<br>
<b>Cidade:</b> " . $escrever5['cidade'] . "<br>
<b>Cep:</b> " . $escrever5['cep'] . "<br>
<b>UF:</b> " . $escrever5['uf'] . "<br>
<b>CPF/CNPJ:</b> " . $escrever5['cpf_cnpj'] . "<br>
<b>RG/IE:</b> " . $escrever5['rg_ie'] . "<br>
<b>Telefone:</b> " . $escrever5['telefone'] . "<br>
<b>Celular:</b> " . $escrever5['celular'] . "<br>
<b>Email:</b> " . $escrever5['email'] . "<br>
<b>Data de cadastro:</b> " . $escrever5['datacadastro'] . "<br>
<b>Data de nascimento:</b> " . $escrever5['datanascimento'] . "<br>
<b>Observação:</b> " . $escrever5['observacao'] . "<br>";
if($escrever5['fisicojuridico'] == 1){
echo "<b>Tipo de cliente:</b> Juridico<br>";
}else{
echo "<b>Tipo de cliente:</b> Fisico<br>";
}
echo "</span>";




}
?>
</div>
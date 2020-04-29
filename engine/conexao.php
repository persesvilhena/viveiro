<?php
$conecta = mysql_connect("localhost", "root", "369875");
		   mysql_select_db("viveiro", $conecta);
		   
class SistemaLogin { // Defino a classe principal do sistema
	
	function antisql($sql) { // Função Anti-SQL
		$sql = get_magic_quotes_gpc() == 0 ? addslashes($sql) : $sql;
		$sql = trim($sql);
		$sql = strip_tags($sql);
		$sql = mysql_escape_string($sql);
		return preg_replace("@(--|\#|\*|;|=)@s", '', $sql);
	}
}
$class = new SistemaLogin;
?>

<?php

$language = isset($_GET["lang"]) ? $_GET["lang"] : 'pl';
$page_content = file_get_contents("copernic_" . $language .  ".html");
echo $page_content;

?>
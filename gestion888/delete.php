<?php
require_once 'config/include.php';
$id = filter_input(INPUT_GET, 'id');
$etiquette = filter_input(INPUT_GET, 'etiquette');
$db = new articlesModele();
$article = $db->find($id);
$db->delete($article);
header('Location: '.BASE_URL.DS."gestion888/tableau.php?etiquette=$etiquette");
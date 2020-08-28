<?php 

include_once 'database_connection.php';
include_once 'query_database.php';


$query = new QueryDatabase;

$style_id = $_POST['style_id']; // ID of table row clicked


include 'style details/style_basic_info.php';
include 'style details/elemental_resistances.php';
include 'style details/character_info.php';
include 'style details/skills.php';
include 'style details/abilities.php';
include 'style details/inheritable_skills.php'

?>

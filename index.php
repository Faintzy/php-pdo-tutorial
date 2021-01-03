<?php 

require 'classes/models/db.php';

$bd = new Models();

print_r($bd->get_all());
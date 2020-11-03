<?php
require 'controllers/Painel.php'; 

if (isset($_REQUEST)) {
	echo Rest::abrir($_REQUEST);
}
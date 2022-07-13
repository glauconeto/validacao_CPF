<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Validation\CPF;

$resultado = CPF::validar('498.349.950-40');

var_dump($resultado);
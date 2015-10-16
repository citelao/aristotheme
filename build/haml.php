<?php

require __DIR__ . '/../vendor/autoload.php';

$haml = new MtHaml\Environment('php');
$executor = new MtHaml\Support\Php\Executor($haml, array(
    'cache' => __DIR__ . '/../.tmp/haml',
));

// Compiles and executes the HAML template, with variables given as second
// argument
$executor->display(($argv[1]) ? $argv[1] : "", array(
    'var' => 'value',
));
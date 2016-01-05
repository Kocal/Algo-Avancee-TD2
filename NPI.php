#!/usr/bin/env php
<?php
require 'lib/Pile.php';

function npi($input)
{
    $stack = new Pile();

    foreach (explode(' ', $input) as $token) {
        // Le token est un nombre
        if (is_numeric($token)) {
            $stack->push($token);

            // Le token est un opérateur
        } else if (in_array($token, ['+', '-', '*', '/'])) {
            $value = 0;
            $nb1 = $stack->pop();
            $nb2 = $stack->pop();

            if ($nb1 === null || $nb2 === null) {
                return "Impossible de faire le calcul, l'un des deux premiers éléments de la pile est vide";
            }

            $value = eval("return $nb1 $token $nb2;");
            $stack->push($value);
        }
    }

    return $stack->pop();
}

$inputs = [
    '2 +',
    '2 + 3',
    '2 3 +', // 5
    '10 4 5 + *', // 90
    '4 10 10 10 * / +', // 14
    '4 2.2 5.5 * +', // 16.1
];

foreach ($inputs as $k => $input) {
    $status = npi($input);
    echo '[' . $k . '] : ' . $status . PHP_EOL;
}

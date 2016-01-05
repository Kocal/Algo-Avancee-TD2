#!/usr/bin/env php
<?php
require 'lib/Pile.php';

function parseSyntax($input) {
    $stack = new Pile();

    foreach(str_split($input) as $char) {

        switch($char) {

            case '(': $stack->push(')'); break;
            case '{': $stack->push('}'); break;
            case '[': $stack->push(']'); break;

            case ')':
            case '}':
            case ']':
                $token = $stack->first();

                if($stack->isEmpty()) {
                    return "Erreur : $char n'a rien pu fermer";
                }

                if($token !== null) {
                    if($char != $token) {
                        return "Erreur : $token aurait du être trouvé à la place de $char";
                    }
                }

                $stack->pop();
                break;
        }
    }

    if(!$stack->isEmpty()) {
        return "Parse error: syntax error, unexpected end of input.";
    }

    return true;
}

$inputs = [
    'int main() { qsd qsd }',
    '( ( ) )()',
    '()qsd)',
    '((()ddd)',
    'int main(int argc, char *argv[]) {
        char foo[20];

        for(int i = 0; i < 20; i++) {
            std::cout << foo[i] << std::endl;
        }
    }'
];

foreach($inputs as $k => $input) {
    $status = parseSyntax($input);

    echo '[' . $k . '] : ' . ($status === true ? 'valide' : $status) . PHP_EOL;
}

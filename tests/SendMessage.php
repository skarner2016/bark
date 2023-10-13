<?php

require_once "../vendor/autoload.php";

$bark = new \Bark\Bark();

$res = $bark->token('oGpm3tmAWgD33iCrtpFQd8')
    ->title('test-title')
    ->body('test-body')
    ->send();

var_dump($res);
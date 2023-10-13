<?php

require_once "../vendor/autoload.php";

$bark = new \Bark\Bark();

$res = $bark->token('your-bark-key')
    ->title('test-title')
    ->body('test-body')
    ->send();

var_dump($res);
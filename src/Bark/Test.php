<?php
namespace Bark;

require_once "../../vendor/autoload.php";


/**
 * @desc
 * @author  skarner <2023-10-11 10:57>
 */
class Test
{
    public function index()
    {
        
        echo '(new Test())->index()' . PHP_EOL;
    }
}


// (new Test())->index();

$bark = new Bark();

$token = "oGpm3tmAWgD33iCrtpFQd8";
$title = "test-title";
$body = "test-body";

$res = $bark->token($token)
    ->title($title)
    ->body($body)
    ->send();


dd(__METHOD__, __LINE__, $res);
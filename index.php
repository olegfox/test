<?php

function autoloader($class)
{
    $paths = explode('\\', $class);
    $file = end($paths).'.php';
    if (is_file($file)) {
        include $file;
    } else {
        throw new \Exception ("Класс $class не найден");
    }
}

spl_autoload_register('autoloader');

// Создание
$client = new \App\Client();
$client->setFirstname('Test');
$client->setLastname('Test');
$client->setPhone('+7 (999) 999-99-99');
$client->create();
var_dump(\App\Client::findAll());

// Обновление
$client->setFirstname('Test2');
$client->setLastname('Test2');
$client->setPhone('+7 (999) 999-99-99');
$client->update();
var_dump(\App\Client::findById($client->getId()));

// Удаление
$client->delete();
var_dump(\App\Client::findAll());

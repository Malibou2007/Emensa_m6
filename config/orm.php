<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "emensawebsite",
    "username" => "root",
    "password" => "malte"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

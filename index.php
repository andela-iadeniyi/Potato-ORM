<?php

require 'vendor/autoload.php';

use Ibonly\PotatoORM\User;
use Ibonly\PotatoORM\Schema;
use Ibonly\PotatoORM\Player;


// $sugar = new User();

// echo $sugar->where('id', 'qqq').PHP_EOL.PHP_EOL;
// echo $sugar->getAll().PHP_EOL.PHP_EOL;


// $sugar = new User();
// $sugar->id = NULL;
// $sugar->username = "tunde";
// $sugar->email = "tunde";
// $sugar->password = 3;
// echo $sugar->save();


// $sugar = new Player();
// echo print_r($sugar->find(2));


// $sugar = User::find(13);
// $sugar->username = "wordeded";
// echo $sugar->save();

$sugar = User::destroy(23);
die($sugar);


// $table = new Schema;
// $table->field('increments', 'id');
// $table->field('strings', 'name', 30);
// $table->field('integer', 'number');
// $table->field('primaryKey', 'id');
// echo $table->createTable('players');
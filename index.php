<?php

require 'class/game.php';

$mapFill = [
    [0, 0, 0, 0,'k'],
    [0, 1, 1, 0, 1],
    ['s',1, 0, 0, 1],
    [1, 1, 1, 0, 1],
    ['e',0, 0, 0, 1]
];
$map = new Game($mapFill);

$map->showMap($map->getPlayerMap());


$map->player->setPlayerPos([2, 0]);

$i = 0;
$map->player->setSymbol('p');

while ($map->getFinish() !== true){
    $key = rtrim(fgets(STDIN));
    system('clear');
    $map->movePlayer($key);
    $map->showMap($map->getPlayerMap());
    $i++;
};

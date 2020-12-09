<?php


$name = 'shida';

$number = 3;

switch ($inner = [$name,$number]) {
  case $inner[0]=='soma' && $number ==2:
    echo 'your name is soma and number is two';
    break;

  case $inner[0] == 'shida' && $number == 3:
    echo 'your name is soma and number is three';
    break;
  default:
    echo 'default output';
    break;
}
<?php
ini_set('max_execution_time', 300);
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/12
 * Time: 10:13 AM
 */
include_once("Dueling_Generators.php");
$duel_gen = new Dueling_Generators();
echo "There are ". $duel_gen->judge() ." judge's final count";

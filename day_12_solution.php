<?php
/**
 * Created by PhpStorm.
 * User: Joel.Mnisi
 * Date: 2018/03/08
 * Time: 12:55 PM
 */
include_once('programs.php');
$pro = new programs();
$count = $pro->allProgrammesConnectToZero();
echo "There are $count group that contains program ID 0";
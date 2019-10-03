<?php
session_start();
echo $_SESSION['user'];

$arr=array();
if (!in_array("haode",$arr)){
array_push($arr,"haode ");}
echo $arr[0];
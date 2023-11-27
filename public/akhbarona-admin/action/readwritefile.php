<?php

echo "Hello 1 Test";

$newFileName = '../articalFile/cronstatus.txt';
$newFileContent = 'N';
echo file_put_contents($newFileName, $newFileContent);

echo "=====".file_get_contents($newFileName);


?>
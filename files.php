<?php 

    $file = "example.txt";
    // opens file and w writes
    $handle = fopen($file, 'w');
    // write to file
    fwrite($handle, 'I love PHP and this is fun');

    //reading files
    $handle2 = fopen($file, 'r');
    //second paramter is bites fn filesize() does whole file
    echo $conntent = fread($handle2, 10);
    
    // closes files
    fclose($handle);
    fclose($handle2);

    //deletes files
    unlink("example.txt");
?>
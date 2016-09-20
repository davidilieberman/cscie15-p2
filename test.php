<?php
error_reporting(E_ALL);       # Report Errors, Warnings, and Notices
ini_set('display_errors', 1); # Display errors on page (instead of a log file)
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Test</title>
    <?php

      $lines = file("./words.txt");

     ?>
  </head>

  <?php

    foreach ($lines as $line_num => $line) {
      echo "Line #<b>{$line_num}</b>: ${line} <br/>\n";
    }

    $pwd = "";

    $slice = array_splice($lines, 4, 1);

    echo "<p>Slice is $slice[0]</p>\n";

    foreach ($lines as $line_num => $line) {
      echo "Line #<b>{$line_num}</b>: ${line} <br/>\n";
    }


   ?>
</html>

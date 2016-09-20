<?php
error_reporting(E_ALL);       // Report Errors, Warnings, and Notices
ini_set('display_errors', 1); // Display errors on page (instead of a log file)
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Test</title>
    <?php

      $lines = file('./words.txt');

      function echoLines($lines)
      {
          echo "<p>\n";
          foreach ($lines as $line_num => $line) {
              $l = trim($line);
              echo "Line #<b>{$line_num}</b>: \"${l}\" <br/>\n";
          }
          echo "</p>\n";
      }

     ?>
  </head>

  <?php

    echoLines($lines);

    $pwd = '';
    for ($i = 0; $i < 4; ++$i) {
        $r = mt_rand(0, count($lines)-1);
        $pwd .= trim(array_splice($lines, $r, 1)[0]);
        if ($i < 3) {
            $pwd .= '-';
        }
        echoLines($lines);
        echo "<p>Password is $pwd</p>\n";
    }

   ?>
</html>

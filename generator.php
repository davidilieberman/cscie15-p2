<?php
error_reporting(E_ALL);       // Report Errors, Warnings, and Notices
ini_set('display_errors', 1); // Display errors on page (instead of a log file)
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Test</title>
    <?php
      // Load our source words into an array
      $lines = file('./words.txt');

      // Write the current state of the word array to output
      function echoLines($lines)
      {
          echo "<p>\n";
          foreach ($lines as $line_num => $line) {
              $l = trim($line);
              echo "Line #<b>{$line_num}</b>: \"${l}\" <br/>\n";
          }
          echo "</p>\n";
      }

      // Construct the password
      function concatPwd($pwd, $lines, $numComponents)
      {
          for ($i = 0; $i < $numComponents; ++$i) {
              $r = mt_rand(0, count($lines) - 1);
              $pwd .= trim(array_splice($lines, $r, 1)[0]);
              if ($i < $numComponents - 1) {
                  $pwd .= '-';
              }
              echoLines($lines);
              echo "<p>Password is $pwd</p>\n";
          }
          return $pwd;
      }

     ?>
  </head>

  <?php

    echoLines($lines);

    $pwd = '';
    $pwd = concatPwd($pwd, $lines, 4);
   ?>

   <h3>Final password is <?php echo $pwd ?>
</html>

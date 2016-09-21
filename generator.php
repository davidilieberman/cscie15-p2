<?php

      // Load our source words into an array
      $lines = file('./words.txt');

      // Debugging function: write the current state of the word array to output
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
      function concatPwd($lines, $numComponents)
      {
          $pwd = '';
          for ($i = 0; $i < $numComponents; ++$i) {
              //echoLines($lines);
              $r = mt_rand(0, count($lines) - 1);
              $pwd .= trim(array_splice($lines, $r, 1)[0]);
              if ($i < $numComponents - 1) {
                  $pwd .= '-';
              }
              //echo "<p>$pwd</p>\n";
          }

          return $pwd;
      }

      if (isset($_GET['submitted'])) {
          if ($validation['valid']) {
              $pwd = concatPwd($lines, $validation['num']);
              echo "Your password is $pwd";
          } else {
              echo "<span class='error'>".$validation['msg'].'</span>';
          }
      }

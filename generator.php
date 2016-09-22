<?php

      // Load our source words into an array
      $lines = file('./words.txt');

      // Set up our array of special characters
      $charsArray = array('@', '#', '$', '%', '^', '*', '?', '!');

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

      function getChar($charsArray)
      {
          return $charsArray[mt_rand(0, count($charsArray) - 1)];
      }

      // Construct the password
      function concatPwd($lines, $numComponents, $nums, $charsArray, $params)
      {
          $pwd = '';
          for ($i = 0; $i < $numComponents; ++$i) {
              //echoLines($lines);
              $r = mt_rand(0, count($lines) - 1);
              // We splice the word out of the array so that it is only
              // used once.
              $w = trim(array_splice($lines, $r, 1)[0]);

              // If the user has selected the "special characters" option,
              // we prepend a randomly-selected character to each word
              if (radioState('specialChars', $params)) {
                  debug('generator.php.concatPwd(): handling special characters');
                  $w = getChar($charsArray).$w;
              }

              // Append the word to our passphrase
              $pwd .= $w;
              if ($i < $numComponents - 1) {
                  $pwd .= '-';
              }

              // If the user has selected the "include numbers" option,
              // we inject a random five-digit number in the middle of the
              // passphrase
              if (radioState('includeNums', $params) && $i == floor($numComponents / 2) - 1) {
                  $r = mt_rand(10000, 99999);
                  $pwd .= $r . '-';
              }
          }

          return $pwd;
      }

      if (isset($params['submitted'])) {
          if ($validation['valid']) {
              debug("generator.php: specialChars is $specialChars");
              $pwd = concatPwd($lines, $validation['num'], $includeNums, $charsArray, $params);
              echo "Your password is $pwd";
          } else {
              echo "<span class='error'>".$validation['msg'].'</span>';
          }
      }

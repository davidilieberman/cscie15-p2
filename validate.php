<?php

// The minimum number of words allowed in our passphrase
$MIN_WORDS = 3;

// The maximum number of words allowed in our passphrase
$MAX_WORDS = 10;

function radioState($key)
{
    return isset($_GET[$key]) && $_GET[$key] == 'yes';
}

function getValidation($min, $max, $defaultCount)
{
    debug("getValidation() running");
    $validation = array("valid" => true, "num" => $defaultCount, "msg" => "");
    if (isset($_GET['num_words'])) {
        debug("getValidation(); found num_words parameter in request");
        $nw = $_GET['num_words'];
      // Validate: is the input a number?
      if (!is_numeric($nw)) {
          $validation["msg"] = 'The number of words to include in your passphrase must be, well, a number.';
          $validation["valid"] = false;
      // Validate: is the input a valid number?
      } elseif ($nw < $min || $nw > $max) {
          $validation["msg"] = "The number of words in your catch phase must be no less than $min and no greater than $max";
          $validation["valid"] = false;
      } else {
        $validation["num"] = $nw;
      }
    } else {
      debug("getValidation(): no num_words parameter found in request");
    }
    return $validation;
}

// writes msg to standard error to avoid pushing debug info to the output HTML
// modeled on example found here:
// http://stackoverflow.com/questions/6079492/how-to-print-a-debug-log
function debug($msg) {
  file_put_contents('php://stderr', print_r($msg . "\n", TRUE));
}

$DEFAULT_COUNT = 4;

// State of the inc_nums radio input; default is 'no'
$includeNums = radioState('inc_nums');

// State of the spec_chars input; default is 'no'
$specialChars = radioState('sp_chars');

$validation = getValidation($MIN_WORDS, $MAX_WORDS, $DEFAULT_COUNT);

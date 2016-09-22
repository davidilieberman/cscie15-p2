<?php

// The minimum number of words allowed in our passphrase
$MIN_WORDS = 3;

// The maximum number of words allowed in our passphrase
$MAX_WORDS = 10;

// Gather parameters into an associative array; this allows us
// to switch form methods to support validation testing in one place in our code
$params = array("numWords" => $_POST["num_words"],
                "includeNums" => $_POST["inc_nums"],
                "specialChars" => $_POST["sp_chars"],
                "submitted" => $_POST["submitted"]
              );

debug("validate.php: includeNums = " . $params["includeNums"]);
debug("validate.php: specialChars = " . $params["specialChars"]);

function radioState($key, $params)
{
    return isset($params[$key]) && $params[$key] == 'yes';
}

/**
Returns an associative array with values indicating
a) whether the request is valid,
b) if it is how many words the user has requested, and
c) if it isn't valid provides an error message.
*/
function getValidation($min, $max, $defaultCount, $params)
{
    debug("getValidation() running");
    $validation = array("valid" => true, "num" => $defaultCount, "msg" => "");
    if (isset($params['numWords'])) {
        debug("getValidation(); found num_words parameter in request");
        $nw = $params['numWords'];
      // Validate: is the input a number?
      if (!is_numeric($nw)) {
          $validation["msg"] = 'The number of words to include in your passphrase must be, well, a number.';
          $validation["valid"] = false;
      // Validate: is the input a *valid* number?
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
//$includeNums = radioState('inc_nums');

// State of the spec_chars input; default is 'no'
//$specialChars = radioState('sp_chars');

$validation = getValidation($MIN_WORDS, $MAX_WORDS, $DEFAULT_COUNT, $params);

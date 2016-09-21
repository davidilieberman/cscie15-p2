<?php

function radioState($key)
{
    return isset($_GET[$key]) && $_GET[$key] == 'yes';
}

function setWordCount()
{
    $validation = (object) array('valid' => true, "num" => $DEFAULT_COUNT, "msg" => "");
    if (isset($_GET['num_words'])) {
        $nw = $_GET['num_words'];
      // Validate: is the input a number?
      if (!is_numeric($nw)) {
          $validation->message = 'The number of words to include in your passphrase must be, well, a number.';
          $validation->valid = false;
      // Validate: is the input a valid number?
      } elseif ($nw < $MIN_WORDS || $nw > $MAX_WORDS) {
          $validation->message = "The number of words in your catch phase must be no less than $MIN_WORDS and no greater than $MAX_WORDS";
          $validation->valid = false;
      }
    }
    return $validation;
}

$DEFAULT_COUNT = 4;

// The minimum number of words allowed in our passphrase
$MIN_WORDS = 3;

// The maximum number of words allowed in our passphrase
$MAX_WORDS = 10;

// State of the inc_nums radio input; default is 'no'
$includeNums = radioState('inc_nums');

// State of the spec_chars input; default is 'no'
$specialChars = radioState('sp_chars');

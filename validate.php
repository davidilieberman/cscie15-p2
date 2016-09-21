<?php

function radioState($key) {
  return isset($_GET[$key]) && $_GET[$key] == 'yes';
}

// The minimum number of words allowed in our passphrase
$MIN_WORDS = 3;

// The maximum number of words allowed in our passphrase
$MAX_WORDS = 10;

// State of the inc_nums radio input; default is 'no'
$includeNums = radioState("inc_nums");

// State of the spec_chars input; default is 'no'
$specialChars = radioState("sp_chars");

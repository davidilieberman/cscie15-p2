<?php

// The minimum number of words allowed in our passphrase
$MIN_WORDS = 3;

// The maximum number of words allowed in our passphrase
$MAX_WORDS = 10;

// Gather parameters into an associative array; this allows us
// to switch form methods to support validation testing in one place in our code
$params = array();
// To test validation logic, we support pulling the num_words from a GET
// parameter, so it can be entered directly into the location bar; otherwise
// we find it in posted form data.
$params['numWords'] =
  (isset($_GET['num_words']) ? $_GET['num_words'] : $_POST['num_words']);

$params['includeNums'] = $_POST['inc_nums'];
$params['specialChars'] = $_POST['sp_chars'];

// The presence of the 'submitted' parameter triggers the passphrase generator;
// we allow it to be passed optionally as a GET parameter to support testing
// the validation logic.
$params['submitted'] =
  (isset($_GET['submitted']) ? $_GET['submitted'] : $_POST['submitted']);

debug('validate.php: includeNums = '.$params['includeNums']);
debug('validate.php: specialChars = '.$params['specialChars']);

/**
Convenience function to convert the value of a field configured as a radio
button to a boolean.
*/
function radioState($key, $params)
{
    return isset($params[$key]) && $params[$key] == 'yes';
}

/**
The validation logic runs on every page load, whether or not a request has been submitted. If no request has been submitted, we preset the form values to
defined defaults. This also allows us to retain the user's inputs on page reload to simulate session stickiness.

Returns an associative array with entries:
'valid': boolean flag indicating validation state
'numWords': the number of words to include in the passphrase
'msg': the error message to display if 'valid' is false
 */
function getValidation($min, $max, $defaultCount, $params)
{
    debug('getValidation() running');
    $validation = array('valid' => true, 'num' => $defaultCount, 'msg' => '');
    if (isset($params['numWords'])) {
        debug('getValidation(); found num_words parameter in request');
        $nw = $params['numWords'];
      // Validate: is the input a number?
      if (!is_numeric($nw)) {
          $validation['msg'] = 'The number of words to include in your passphrase must be, well, a number.';
          $validation['valid'] = false;
      // Validate: is the input a *valid* number?
      } elseif ($nw < $min || $nw > $max) {
          $validation['msg'] = "The number of words in your catch phrase must be no less than $min and no greater than $max";
          $validation['valid'] = false;
      } else {
          $validation['num'] = $nw;
      }
    } else {
        debug('getValidation(): no num_words parameter found in request');
    }

    return $validation;
}

/**
I actually prefer reviewing server logs to pushing system error and debugging
information to the rendered HTML. This little function stands in for a richer,
granular logging package.

Writes msg to standard error to avoid pushing debug info to the output HTML
modeled on example found here:
http://stackoverflow.com/questions/6079492/how-to-print-a-debug-log
*/
function debug($msg)
{
    file_put_contents('php://stderr', print_r($msg."\n", true));
}

$DEFAULT_COUNT = 4;

$validation = getValidation($MIN_WORDS, $MAX_WORDS, $DEFAULT_COUNT, $params);

# David Lieberman, CSCI E15
## Fall 2016
### Project 2

## xkcd-Inspired Passphrase Generator

GitHub URL: [https://github.com/davidilieberman/cscie15-p2](https://github.com/davidilieberman/cscie15-p2)

Published URL: [http://p2.davidisadorelieberman.com/](http://p2.davidisadorelieberman.com/)

Video:

The solution pulls sample words from a text file to construct a passphrase of between three and ten randomly selected words. (The list consists of the unique words spoken in the opening soliloquy of Shakespeare's _Richard III_; obviously, such a limited source set significantly improves the likelihood that a password-cracking algorithm would hit on a match, but the intent is to demonstrate the logic rather than to solve the crackability problem.) The logic guarantees that any word will appear in a generated passphrase only once.

The user also has the option of injecting a number and/or randomly selected punctuation characters into the passphrase.

The solution supports validation of the input parameters by verifying that the submitted argument is a numeric value and falls in the range 3 through 10, inclusive. If the argument is non-numeric or is outside of the specified range, the user is presented with an error message. (Note that float values that fall within this range can be applied to the passphrase construction logic through implicit rounding, and are therefore not treated as invalid input.) The flags indicating whether to include numbers or special characters in the passphrase are not validated on input; any input for these flags that cannot be interpreted is defaulted to false.

The solution allows the POST values supplied by the form to be overridden by GET parameters supplied as URL values to support testing of the validation logic. To test the number/not-a-number validation, visit

[http://p2.davidisadorelieberman.com/index.php?num_words=fred&submitted=true](http://p2.davidisadorelieberman.com/index.php?num_words=fred&submitted=true)

To test the numeric range validation, visit

[http://p2.davidisadorelieberman.com/index.php?num_words=12&submitted=true](http://p2.davidisadorelieberman.com/index.php?num_words=12&submitted=true)

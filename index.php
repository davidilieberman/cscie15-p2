<!DOCTYPE html>
<html>
  <head>
    <title>CSCI E15 : Fall, 2016 : David Lieberman : P2 : Nifty Passphrase Generator</title>
    <?php require './validate.php'; ?>
  </head>

  <body>
    <h2>Configure your passphrase:</h2>
    <form method="get" action="./index.php">
      <p>Number of words: <select name="num_words">
        <?php
        for ($i = $MIN_WORDS; $i <= $MAX_WORDS; ++$i) {
            echo "<option value='$i'>$i</option>\n";
        }
        ?>
      </select></p>

      <p>
        Include numbers in your passphrase?
        <input type="radio" name="inc_nums" value="yes"
          <?php if ($includeNums) { echo 'checked'; } ?>
          > Yes
        <input type="radio" name="inc_nums" value="no"
          <?php if (!$includeNums) { echo 'checked'; } ?>
          > No
      </p>

      <p>
        Include special characters in your passphrase?
        <input type="radio" name="sp_chars" value="yes"
          <?php if ($specialChars) { echo 'checked'; } ?>
        > Yes
        <input type="radio" name="sp_chars" value="no" selected="true"
          <?php if (!$specialChars) { echo 'checked'; } ?>
        > No
      </p>

      <input type="submit" value="Generate Passphrase!" name="submitted"/>
    </form>

    <?php require './generator.php'; ?>
  </body>
</html>

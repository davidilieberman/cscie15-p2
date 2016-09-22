<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CSCI E15 : Fall, 2016 : David Lieberman : P2 : Nifty xkcd-Inspired Passphrase Generator</title>
    <meta charset="UTF-8"/>
    <link href="./styles.css" rel="stylesheet"/>
    <?php require './validate.php'; ?>
  </head>

  <body>
    <h1>Nifty xkcd-Inspired Passphrase Generator</h1>
    <h4>David Lieberman : CSCI E15 : Fall, 2016</h4>
    <h2>Configure your passphrase:</h2>

    <form method="post" action="./index.php">

      <p>Number of words: <select name="num_words">
        <?php
        for ($i = $MIN_WORDS; $i <= $MAX_WORDS; ++$i) {
            echo "<option value='$i'";
            if ($i == $validation["num"]) echo " selected ";
            echo ">$i</option>\n";
        }
        ?>
      </select></p>

      <p>
        Include numbers in your passphrase?
        <input type="radio" name="inc_nums" value="yes"
          <?php if (radioState("includeNums", $params)) { echo 'checked'; } ?>
          > Yes
        <input type="radio" name="inc_nums" value="no"
          <?php if (!radioState("includeNums", $params)) { echo 'checked'; } ?>
          > No
      </p>

      <p>
        Include special characters in your passphrase?
        <input type="radio" name="sp_chars" value="yes"
          <?php if (radioState("specialChars", $params)) { echo 'checked'; } ?>
        > Yes
        <input type="radio" name="sp_chars" value="no"
          <?php if (!radioState("specialChars", $params)) { echo 'checked'; } ?>
        > No
      </p>

      <input type="submit" value="Generate Passphrase!" name="submitted"/>
    </form>

    <h3><?php require './generator.php'; ?>&nbsp;</h3>
  </body>
</html>

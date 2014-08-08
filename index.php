<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Generator</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body>
        <section id="wrapper">            
            <header id="header">
                <div class="top">
                    <nav class="navbar navbar-inverse" role="navigation">

                        <div class="container">

                        </div>
                    </nav>
                </div>
            </header>
            <section id="message">
            <?php

class password {

    private $lowercase = "abcdefghijklmnopqrstuvwxyz";
    private $uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $number = "1234567890";
    private $symbol = '~!@#%&*()_-+={}[]\|:;<>,.?/\'^';
    private $msgError = false;
    private $msgSuccess = false;
    private $option;

    public function __construct() {
        
    }

    public function setOption($option) {
        $this->option["lowercase"] = $option["lowercase"];
        $this->option["uppercase"] = $option["uppercase"];
        $this->option["number"] = $option["number"];
        $this->option["symbol"] = $option["symbol"];
        $this->option["size"] = $option["size"];
    }

    public function getMix() {

        $char = '';
        
        if ($this->option["lowercase"] == false && $this->option["uppercase"] == false && $this->option["number"] == false && $this->option["symbol"] == false) {
            $this->msgError = "You must choose at least 1 filter";
        }

        if ($this->option["lowercase"])
            $char .= $this->lowercase;
        if ($this->option["uppercase"])
            $char .= $this->uppercase;
        if ($this->option["number"])
            $char .= $this->number;
        if ($this->option["symbol"])
            $char .= $this->symbol;
        $result = substr(str_shuffle($char), 0, $this->option["size"]);
        return $result;
    }

}
?>
	    </section>
            <section id="content" class="container">
                <img src="https://www.batchheader.co.uk/images/batchheader_logo.png" class="img-responsive logo" alt="BatchHeader Logo">
                <h1>Password Generator</h1>
                <div class="row">
                    <?php if (isset($_POST["passgen"])): ?>
                        <?php
                        if (is_numeric($_POST["length"])):
                            $option = array(
                                "size" => $_POST["length"],
                                "lowercase" => (!empty($_POST["lowercase"])) ? true : false,
                                "uppercase" => (!empty($_POST["uppercase"])) ? true : false,
                                "number" => (!empty($_POST["numbers"])) ? true : false,
                                "symbol" => (!empty($_POST["specialchars"])) ? true : false,
                            );
                            $password = new password();
                            $password->setOption($option);
                            ?>
                            <ul>
                                <li>Password: <?php echo $password->getMix(); ?>

                                </li>
                                <?php if (isset($_POST["hash_check"])) { ?>
                                    <li>Hash (<?php print $_POST["hash"]; ?>) : <?php print hash($_POST["hash"], $password->getMix()); ?></li>
                                <?php } ?>
                            </ul>
                        <?php else: ?>
                            <p class="error">The number of characters must be an integer.</p>
                        <?php endif; ?>
                    <?php else: ?>

                        <form class="form-horizontal" action="index.php" method="post">
                            <fieldset>
                                <legend>Choose filters :</legend>
                                <label class="checkbox">
                                    <input type="checkbox" id="idLowercase" name="lowercase" checked />Lowercase
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="uppercase" name="uppercase" checked />Uppercase
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="idNumbers" name="numbers" checked />Number
                                </label>
                                <label class="checkbox">
                                    <input type="checkbox" id="idSpecialchars" name="specialchars" />Symbole
                                </label>
                                <div class="control-group">
                                    <label class="control-label" for="idLength">Number of character</label>
                                    <div class="controls">
                                        <input type="text" id="idLength" name="length" value="10" />
                                    </div>
                                </div>
                                <p>
                                    <input type="checkbox" id="idSpecialchars" name="hash_check" />
                                    <label for="idHash">Hash</label>
                                    <select id="idHash" name="hash">
                                        <?php
                                        // Get a list of registered hashing algorithms.
                                        $hashes = hash_algos();
                                        ?>
                                        <?php foreach ($hashes as $hash): ?>
                                            <option value="<?php print $hash; ?>"><?php print $hash; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                                <button type="submit" class="btn" name="passgen">Submit</button>
                            </fieldset>
                        </form>

                    <?php endif; ?>

                </div>
            </section>
            <footer id="footer" >
                <div class="container">
                    <p>Site 2014 - BatchHeader Ltd</p>
                </div>
            </footer>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

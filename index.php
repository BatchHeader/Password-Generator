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
                    <nav class="navbar" role="navigation">

                        <div class="container">
		  <div class="col-sm-8 col-sm-offset-2">
                <h1>Password Generator</h1>
		  </div>
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
                <div class="row">
		  <div class="col-sm-6 col-sm-offset-3">
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
			    <div class="well bg-success">
                            <ul>
                                <li>Password: <h3><?php echo $password->getMix(); ?></h3>

                                </li>
                                <?php if (isset($_POST["hash_check"])) { ?>
                                    <li>Hash (<?php print $_POST["hash"]; ?>) : <h3><?php print hash($_POST["hash"], $password->getMix()); ?></h3></li>
                                <?php } ?>
                            </ul>
			    </div>
			    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="btn" class="btn btn-primary btn-lg">Generate Another</a>
                        <?php else: ?>
                            <p class="error">The number of characters must be an integer.</p>
			    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="btn" class="btn btn-primary btn-lg">Generate Another</a>
                        <?php endif; ?>
                    <?php else: ?>

                        <form class="form-horizontal" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <fieldset>
                                <legend>Choose filters :</legend>
				<div class="form-group">
                                	<label class="checkbox col-xs-4">Lowercase</label>
                                	    <input type="checkbox" id="idLowercase" name="lowercase" checked />
				</div>
				<div class="form-group">
	                                <label class="checkbox col-xs-4">Uppercase</label>
	                                    <input type="checkbox" id="uppercase" name="uppercase" checked />
				</div>
				<div class="form-group">
	                                <label class="checkbox col-xs-4">Number</label>
        	                            <input type="checkbox" id="idNumbers" name="numbers" checked />
				</div>
				<div class="form-group">
	                                <label class="checkbox col-xs-4">Symbol</label>
        	                            <input type="checkbox" id="idSpecialchars" name="specialchars" />
        	                </div>
                                <div class="form-group">
                                    <label class="col-xs-4" for="idLength">Number of characters</label>
                                        <input type="text" id="idLength" name="length" value="15" />
                                </div>
                                <div class="form-group">
                                    <label class="checkbox col-xs-4" for="idHash">Hash</label>
                                    <input type="checkbox" id="idSpecialchars" name="hash_check" />
                                    <select id="idHash" name="hash">
                                        <?php
                                        // Get a list of registered hashing algorithms.
                                        $hashes = hash_algos();
                                        ?>
                                        <?php foreach ($hashes as $hash): ?>
                                            <option value="<?php print $hash; ?>"><?php print $hash; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg" name="passgen">Submit</button>
                            </fieldset>
                        </form>

                    <?php endif; ?>
		  </div>
                </div>
            </section>
            <footer id="footer" >
                <div class="container ">
		  <div class="col-sm-6 col-sm-offset-3">
<br/><br/>
		    <p>This is free software, and is released under the terms of the <abbr title="GNU General Public License">GPL</abbr> version 3 or (at your option) any later version. See <a href="license.txt">license.txt</a>.</p>
		    <p>Available on Github<a href="https://github.com/BatchHeader/Password-Generator" role="btn" class="btn" target="_blank">Fork</a> <a href="https://github.com/BatchHeader/Password-Generator/archive/master.zip" role="btn" class="btn" target="_blank">Download</a></p>
                    <p>Site <?php echo date("Y"); ?> - <a href="https://www.batchheader.co.uk"> BatchHeader Ltd</a></p>
		  </div>
                </div>
            </footer>
        </section>
    </body>
</html>

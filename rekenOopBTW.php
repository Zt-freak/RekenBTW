<!DOCTYPE HTML>
<html style="font-family:monospace;">
    <head>
        <meta name="author" content="Bryan Kho">
    </head>
    <body>
        <form action="rekenOopBTW.php" method="get">
            Bedrag: <input type="number" step="0.01" name="bedrag"><br />
            BTW: <input type="number" value="21" step="0.01" name="customBTW"> %<br />
            Dit is een bedrag excl. BTW: <input type="radio" name="toggleBTW" value="0" checked><br />
            Dit is een bedrag incl. BTW: <input type="radio" name="toggleBTW" value="1"><br />
            <input type="submit" value="Submit">
        </form>
        <?php

        ?>
        <?php
            /*
            * Calculator class that calculates a price with and without VAT
            */
            class Calculator
            {
                /* property declaration */

                public $_BTW = 21; // VAT in percentage
                public $_amount; // Amount
                public $_exclOrIncl = 0; // 0 if amount is excluding VAT, 1 if amount is including VAT
                
            
                /* method declaration */

                // Calculate a value exclusing VAT
                public function calcExclBTW($amount) {
                    if ($amount != null) {
                        if (is_numeric($this->_BTW)) {
                            return round(($amount/(100 + $this->_BTW)*100), 2);
                        }
                        else {
                            echo "Ja ik heb niet echt zin om deze error goed af te handelen, zet errors gewoon uit in je XAMPP settings. Of wil je voortaan en getal als BTW gebruiken.<br />";
                            echo "<iframe width='0' height='0' src='https://www.youtube.com/embed/wmin5WkOuPw?autoplay=1' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                        }
                    }
                }

                // Calculate a value including VAT
                public function calcInclBTW($amount) {
                    if ($amount != null) {
                        if (is_numeric($this->_BTW)) {
                            return round($amount/100*$this->_BTW + $amount, 2);
                        }
                        else {
                            echo "Ja ik heb niet echt zin om deze error goed af te handelen, zet errors gewoon uit in je XAMPP settings. Of wil je voortaan en getal als BTW gebruiken.<br />";
                            echo "<iframe width='0' height='0' src='https://www.youtube.com/embed/wmin5WkOuPw?autoplay=1' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                        }
                    }
                }

                // Display the results of the calculation
                public function displayResults() {
                    if ($this->_amount != null) {
                        if (is_numeric($this->_amount)) {
                            if ($this->_exclOrIncl == 1) {
                                $amountExclBTW = $this->calcExclBTW($this->_amount);
                                $amountInclBTW = $this->_amount;
                            }
                            else if ($this->_exclOrIncl == 0) {
                                $amountExclBTW = $this->_amount;
                                $amountInclBTW = $this->calcInclBTW($this->_amount);
                            }
                            else {
                                echo "<b style='color:red'>Een bedrag kan alleen exclusief (toggleBTW=0) of inclusief (toggleBTW=1) BTW zijn.</b><br />";
                                echo "<b style='color:red'>De waarde die u heeft ingevoerd: ".$this->_exclOrIncl.", is geen geldige waarde.</b><br />";
                                $amountExclBTW = "onbekend";
                                $amountInclBTW = "onbekend";
                            }
                        }
                        else {
                            echo "<b style='color:red'>Een bedrag kan alleen een getal zijn.</b><br />";
                            echo "<b style='color:red'>De waarde die u heeft ingevoerd: ".$this->_amount.", is geen geldige waarde.</b><br />";
                            $amountExclBTW = "onbekend";
                            $amountInclBTW = "onbekend";
                        }
                        echo "<b>De BTW bedraagt:</b> ".$this->_BTW."%<br />";
                        echo "<b>De prijs exclusief BTW is: </b>".$amountExclBTW."<br />";;
                        echo "<b>De prijs inclusief BTW is: </b>".$amountInclBTW."<br />";;
                    }
                    else {
                        echo "<b style='color:red;'>Voer een bedrag in.</b>";
                    }
                }
            }

            // Creates a new instance of the calculator when an amount is submitted
            if (isset($_GET["bedrag"])) {
                $calc = new Calculator();
                if (isset($_GET["customBTW"])) {
                    $calc->_BTW = $_GET["customBTW"];
                }
                $calc->_amount = $_GET["bedrag"];
                $calc->_exclOrIncl = $_GET["toggleBTW"];
                $calc->displayResults();
            }
            else {
                echo "<b>Voer een bedrag in.</b>";
            }
        ?>
    </body>
</html>
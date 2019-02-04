<!DOCTYPE HTML>
<html>
    <head>
        <meta name="author" content="Bryan Kho">
    </head>
    <body>
        <form action="rekenBTW.php" method="get">
            Bedrag: <input type="number" step="0.01" name="bedrag"><br />
            Dit is een bedrag excl. BTW: <input type="radio" name="toggleBTW" value="excl" checked><br />
            Dit is een bedrag incl. BTW: <input type="radio" name="toggleBTW" value="incl"><br />
            <input type="submit" value="Submit">
        </form>
        <?php
            if (isset($_GET["bedrag"]) && $_GET["bedrag"] != null) {
                if (isset($_GET["toggleBTW"]) && $_GET["toggleBTW"] != null) {
                    if ($_GET["toggleBTW"] == "excl") {
                        $bedragExclBTW = $_GET["bedrag"];
                        $bedragIncBTW = round($_GET["bedrag"]*1.21, 2);
                    }
                    else if ($_GET["toggleBTW"] == "incl") {
                        $bedragExclBTW = round($_GET["bedrag"]/100*79, 2);
                        $bedragIncBTW = $_GET["bedrag"];
                    }
                    else {
                        echo "<b style='color:red;'>OOF! Je moet niet de HTML direct aanpassen. Kijk wat je hebt gedaan: allemaal undefined variables! Jij monster!</b><br />";
                    }
                    echo "De BTW bedraagt 21%. Dit is hardcoded.";
                    echo "<br />";
                    echo "Bedrag exclusief BTW: ".$bedragExclBTW;
                    echo "<br />";
                    echo "Bedrag inclusief BTW: ".$bedragIncBTW;
                }
                else {
                    echo "OOF! je moet wel kiezen of het inclusief of exclusief BTW is.";
                }
            }
            else {
                echo "Voer een bedrag in.";
            }
        ?>
    </body>
</html>
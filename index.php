<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coola glosor</title>
</head>
<body>

<div class="glosor">

<?php


session_start();
//sätter variablerna för glosan man fick och svaret
$totalscore = 0;
$tagna = array();

//skapar associativ array med alla glosor
$glosorassoc = array("Hej"=>"Hello", "God Morgon"=>"Good Morning", "Vem är du?"=>"Who are you?",
"Godnatt"=>"Good night", "Hund"=>"Dog", "Katt"=>"Cat", "Mat"=>"Food", "Dator"=>"Computer", "Bil"=>"Car", "Cykel"=>"Bike", "Skola"=>"School", "Och"=>"And", 
"Nu"=>"Now", "Honom"=>"Him", "Henne"=>"Her", "Mellan"=>"Between");

//om tagna finns i sessionen ska arrayen sättas till det som sparades
if (isset($_SESSION["tagna"])) {

    //ta bort kommentaren från nästa rad för att cleara session. lägg till den igen efteråt
    //$_SESSION["tagna"] = [];
    $tagna = $_SESSION["tagna"];

}

//samma som för tagna men för glosoassoc
if (isset($_SESSION["glosorassoc"])) {
    
    //ta bort kommentaren från nästa rad för att cleara session. lägg till den igen efteråt
    //$_SESSION["glosorassoc"] =[];
    $glosorassoc = $_SESSION["glosorassoc"];

}

if (isset($_GET["glosa"])){
    $glosa = $_GET["glosa"];
    //echo $glosa;
}

//om man skickat en getrequest ska man få reda på om man svarat rätt eller fel
if (isset($_GET["glosa"]) && isset($_GET["previousdin"])) {

    //echo "<br>" . array_search($previousdin, $glosorassoc) . "ARRAYSEARCH <br>";

    $previousdin = $_GET["previousdin"];

    if ($glosorassoc["$glosa"] == "$previousdin"){
        echo "<br>DU VANN SPELET. DIN GLOSA VAR: ". $previousdin . "DU SVARADE: " . $glosa . "<br>";
        $totalscore++;
    }
    else echo "<br>du fick fel lmao<br>";

}

if (isset($_GET["previousdin"])) {

    $previousdin = $_GET["previousdin"];
    //echo $previousdin;
    array_push($tagna, $previousdin);

    //tar bort det man gissade på från glosorassoc
    unset($glosorassoc["$glosa"]);
    
    //skriv ut array med vilka ord man tagit. Dessa ska tas bort från möjliga glosor.
    echo "<br>TAGNA " .json_encode($tagna) . "<br>GLOSORASSOC ".json_encode($glosorassoc);

}

//skriv ut poäng (måste fixa request för poäng)
if (isset($_GET["score"]))
    $totalscore = $_GET["score"];
    echo "<br> Poäng: " . $totalscore . "<br>";


/*foreach($glosorassoc as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}*/

//skriver ut glosan som man ska svara på om arrayen inte är tom
if (!empty($glosorassoc)) {
    $dinglosavarde = array_rand($glosorassoc);
    $dinglosa = $glosorassoc[$dinglosavarde];
    echo $dinglosa;
}
else echo ("du vann livet grattis");

$_SESSION['glosorassoc'] = $glosorassoc;
$_SESSION['tagna'] = $tagna;

?>

<form action="index.php" method="get">
    
    <select name="glosa">

        <option disabled selected value> -- välj ett ord -- </option>

        <?php

            //skriver ut de alternativen man har att välja mellan
            foreach($glosorassoc as $x => $x_value) {

                echo "<option value='".$x."'>".$x."</option>"; 

            }
        
        ?>

    </select>

    <!--en gömd input skapas för att kunna skicka med vad det var man svarade på-->
    <input type="hidden" value="<?php echo $dinglosa;?>" name="previousdin">
    <input type="hidden" value="<?php echo $totalscore;?>" name="score">

    <input type='submit' value='skicka'>
</form>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoolaGlosor.nu</title>
    <link rel="stylesheet" href="test.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
       <a href="coolaGlosor.html"><p class="titel">CoolaGlosor.nu</p></a>
    </div>

    <div class="testing">
        <p class="svara">Översätt ordet från engelska till svenska</p>
    </div>


<div class="glosor">

<?php

session_start();
//sätter variablerna för glosan man fick och svaret
$score = 0;
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

    //hämtar poängen
    if (isset($_GET["score"])) {
    $score = $_GET["score"];
}

    $previousdin = $_GET["previousdin"];

    if ($glosorassoc["$glosa"] == "$previousdin"){
        echo "<br> DIN GLOSA VAR: ". $previousdin . "<br> DU SVARADE: " . $glosa . "<br>";
        $score++;
        echo "Poäng: " . $score . "<br>";
    }
    else echo "<br>Du fick fel lmao<br>" . "Poäng:" . $score . "<br>" ;

}

if (isset($_GET["previousdin"])) {

    $previousdin = $_GET["previousdin"];
    //echo $previousdin;
    array_push($tagna, $previousdin);

    //tar bort det man gissade på från glosorassoc
    unset($glosorassoc["$glosa"]);
    
    //skriv ut array med vilka ord man tagit. Dessa ska tas bort från möjliga glosor.
    /*echo "<br>TAGNA " .json_encode($tagna). "<br><br>";*/

}



//skriver ut glosan som man ska svara på om arrayen inte är tom
if (!empty($glosorassoc)) {
    $dinglosavarde = array_rand($glosorassoc);
    $dinglosa = $glosorassoc[$dinglosavarde];
    echo "Vad blir " . '"'. $dinglosa. '"' . " på svenska? <br><br>";
}
else echo ("Du genomförde testet, bra jobbat!");

$_SESSION['glosorassoc'] = $glosorassoc;
$_SESSION['tagna'] = $tagna;

?>

<form action="test2.php" method="get">
    
    <select name="glosa" class="ord">

        <option disabled selected value> -- välj ett ord -- </option>

        <?php

            //skriver ut de alternativen man har att välja mellan
            foreach($glosorassoc as $x => $x_value) {

                echo "<option value='".$x."'>".$x."</option>"; 

            }
        
        ?>

    </select>

    <!--en gömd input skapas för att kunna skicka med vad det var man svarade på-->
    <input class="ord" type="hidden" value="<?php echo $dinglosa;?>" name="previousdin">
    <input class="ord" type="hidden" value="<?php echo $score;?>" name="score">

    <input class="ord" type='submit' value='skicka'>
</form>



<br><br>

<form action="clearsess.php" method="POST">
    <input class="rensa" type="submit" value="Rensa session" />
</form> 
<br>


    <div class="tillbaka">
            <button onclick="document.location = 'coolaGlosor.html'" class="back">Tillbaka till start</button>
            </div>

</div>

       

</body>
</html>
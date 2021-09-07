
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


$glosor = file("glos.txt");

$glosorsvar = file("glossvar.txt");


$ordval = rand(0,2);



echo $glosor[$ordval];


//skriv ut glosan som man ska få översätta
/*foreach ($glosor as $arrayitem) {

    echo ($glosor[$ordval]);

    array_shift($glosor);

}*/

//skriver ut svaren som man får välja mellan
echo "<form action='index.php' method='get'><select name='glosa'><option disabled selected value> -- välj ett ord -- </option>" ; 
    
        foreach($glosorsvar as $array2item) {

            echo "<option value ='".current($glosorsvar)."'>".current($glosorsvar)."</option>";
            array_shift($glosorsvar);

        }
        array_unshift($glosorsvar);
        "</select> <br><br> ";

/*if (isset($_GET["glosa"])){

    if ($glosa == $glosor)
        echo "du vann";
    else echo "du vann inte";

}*/



?>
<input type='submit' value='skicka'></form>
</div>

</body>
</html>

 <?php

    echo $_SESSION['loginnaam'];
    if(!isset($session))
    {
        echo 'U moet eerst inloggen voordat u kan bieden.';
    }
    else
    {
    $bedrag = $_POST['InputBedrag'];
    $gebruiker = $session;
    $voorwerp = $_POST['voorwerpID'];
    $rubriek = $_POST['rubriekID'];
     $sql = "insert into bod(voorwerp, bodbedrag, gebruiker)
     values($bedrag, $bedrag, $gebruiker)";
     var_dump($voorwerp);
     var_dump($rubriek);
    $conn = dbConnected();
    $result = sqlsrv_query($conn, $sql, null);
    dbClose($conn);
    header('refresh:5; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
    }
    
?>
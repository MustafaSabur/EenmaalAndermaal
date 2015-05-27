<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Eenmaal Andermaal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/over-ons.css">
    <?php require 'includes/functions.php'; ?>
</head>

<body>

<?php require 'includes/header.php';?>

<div class="container-fluid">
    <div class="row zoekbalk">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" placeholder="Zoek artikel...">
                <div class="input-group-btn search-panel">
                    <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Rubriek</span> <span class="caret"></span>
                    </button> -->
                    <select name="Rubriek" class="btn"> <!-- class="dropdown-menu" role="menu" -->>
                        <option>Alles</option>

                    </select>
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <main class= "row">

        <?php require 'includes/nav-rubriek.php';?>
        <div class="content col-xs-12 col-sm-10">

            <div class="center-box">

                <h3>Thuiswinkel Waarborg</h3>
                <p> <a href="https://www.thuiswinkel.org/bedrijven/lidmaatschap/voorwaarden/algemene-voorwaarden-thuiswinkel" class="voorwaarden"> <img src="images/thuiswinkellogo.jpg" alt="thuiswinkellogo"> </a></p><br>
                <p>Thuiswinkel Waarborg - wat houdt het in?

                    Thuiswinkel Waarborg logoThuiswinkel Waarborg is hét kwaliteitskeurmerk voor het kopen van producten en diensten via internet. Momenteel zijn er meer dan 2.100 gecertificeerde webwinkels die het Thuiswinkel Waarborg voeren. Het keurmerk wordt door de Consumentenbond ondersteund.

                    Sinds 2001 verkrijgen alle leden van Thuiswinkel.org, de belangenvereniging voor webwinkeliers, het Thuiswinkel Waarborg, nadat zij hun uitgebreide certificeringstraject hebben doorlopen.

                    Als consument mag u er op rekenen dat webwinkels met het Thuiswinkel Waarborg-logo voldoen aan een aantal belangrijke criteria op het gebied van financiële stabiliteit, veiligheid, wet- en regelgeving, en de gedragsregels van Thuiswinkel.org. Alle leden worden ieder jaar opnieuw gecertificeerd.
                    De zekerheden van het Thuiswinkel Waarborg

                    <br><br>Dit zijn de belangrijkste zekerheden van het Thuiswinkel Waarborg voor consumenten:

                    <br><br><h5>Financiële stabiliteit:</h5> onze leden doorlopen jaarlijks een financiële check, waarbij wordt gekeken of de webwinkelier financieel gezond genoeg is om aan zijn verplichtingen naar de consument te kunnen voldoen
                <br><br><h5>Duidelijkheid over kosten:</h5> u hoort voorafgaand aan het bestelproces geïnformeerd te worden over alle eventuele bijkomende kosten, zoals verzendkosten, betaalkosten, poliskosten, administratiekosten of afsluitprovisies
                <br><br><h5>Achterafbetaling:</h5> u moet de mogelijkheid krijgen om minimaal 50% van het aankoopbedrag achteraf of bij aflevering te betalen, wanneer het gaat om de aankoop van producten.
                <br><br><h5>14 dagen bedenktijd:</h5> u krijgt een minimale bedenktijd van 14 dagen, waarbinnen u zonder opgave van reden van de koop mag afzien. U krijgt vervolgens alle kosten (van de aankoop zelf én evt. bijkomende kosten zoals heenzending en betaalkosten) binnen uiterlijk 14 dagen teruggestort (met uitzondering van de kosten van de retourzending zelf)
                <br><br><h5>Garantie via de webwinkel:</h5> onze leden dienen zelf zorg te dragen voor herstel / vervanging van uw defecte product, of het restitueren van het aankoopbedrag wanneer dit niet mogelijk is. Zij mogen u niet naar de leverancier / fabrikant doorverwijzen.
                <br><br><h5>Klachtenbemiddeling:</h5> bij klachten krijgt u binnen maximaal 14 dagen een reactie van een lid. Komt u er niet uit met de webwinkelier? Dan biedt Thuiswinkel.org onafhankelijke klachtenbemiddeling.
                <br><br><h5>Privacy:</h5> u dient geïnformeerd te worden over welke gegevens van u worden verkregen en hoe / waarvoor deze gebruikt worden. U moet de mogelijkheid krijgen om bezwaar te maken tegen het verstrekken van uw gegevens aan derden.
                <br><br><h5>E-mail:</h5> uw e-mailadres mag alleen voor commerciële mails worden gebruikt wanneer u daar vooraf expliciet mee heeft ingestemd, of wanneer het een aanbod betreft van soortgelijke producten/diensten die u eerder af heeft genomen. Iedere commerciële e-mail moet u de mogelijkheid bieden tot uitschrijving.
                <br><br><h5>Veiligheid:</h5> wanneer u persoonsgegevens verstrekt of een betaling doet op de website, moet dit via een beveiligde verbinding gebeuren. Thuiswinkel.org kan echter geen garanties op volledige veiligheid geven.</p><br><br><br>


                <p>Klik <a href="ThuiswinkelVoorwaarden.pdf">hier</a> meer te weten over onze gebruikersovereenkomsten.</p>
                <br><br>
            </div>
        </div>
    </main>
</div>
<?php include 'includes/footer.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/jquery.visible.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
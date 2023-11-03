<?php
if(isset($_POST['submit'])){
    $xmlDoc = new DOMDocument("1.0","UTF-8");
    $xmlDoc->preserveWhiteSpace = false;
    $xmlDoc->load('tooted.xml');
    $xmlDoc->formatOutput = true;

    $xml_root = $xmlDoc->documentElement;
    $xmlDoc->appendChild($xml_root);

    $xml_nimi = $xmlDoc->createElement("inimene");
    $xmlDoc->appendChild($xml_nimi);

    $xml_root->appendChild($xml_nimi);

    $xml_nimi->appendChild($xmlDoc->createElement('nimi', $_POST['nimi']));
    $xml_nimi->appendChild($xmlDoc->createElement('lastname', $_POST['lastname']));
    $xml_nimi->appendChild($xmlDoc->createElement('pool', $_POST['pool']));
    $xml_nimi->appendChild($xmlDoc->createElement('onDeath', $_POST['onDeath']));
    $lisad=$xml_nimi->appendChild($xmlDoc->createElement('lapsed'));
    $lisad->appendChild($xmlDoc->createElement('nimi', $_POST['nimi']));
    $lisad->appendChild($xmlDoc->createElement('lastname', $_POST['lastname']));
    $lisad->appendChild($xmlDoc->createElement('pool', $_POST['pool']));
    $lisad->appendChild($xmlDoc->createElement('onDeath', $_POST['onDeath']));
    $lisad=$xml_nimi->appendChild($xmlDoc->createElement('lapsed'));
    $lisad->appendChild($xmlDoc->createElement('nimi', $_POST['nimi']));
    $xmlDoc->save('tooted.xml');
}
$inimene=simplexml_load_file('tooted.xml');

function perepuu($inimene, $tase = 0) {
    $ulgne_tase = "<ul>";
    if($inimene->lapsed->inimene){
        foreach($inimene->lapsed->inimene as $laps){
            $ulgne_tase .= "<li>";
            $ulgne_tase .= "<a href='#'>".$laps->nimi."</a>";
            $ulgne_tase .= perepuu($laps, $tase + 1);
            $ulgne_tase .= "</li>";
        }
    }else{
        $ulgne_tase .= "<li></li>";
    }
    $ulgne_tase .= "</ul>";
    return $ulgne_tase;
}


$inimene = simplexml_load_file('tooted.xml');
?>
<!DOCTYPE html>
<html lang="et">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pere lisamine</title>
</head>

<body>
<h2>Minu pere tree</h2>
<form action="" method="post" name="vorm1">
    <table>
        <tr>
            <td><label for="nimetus">name:</label></td>
            <td><input type="text" name="nimi" id="nimi" autofocus></td>
        </tr>
        <tr>
            <td><label for="kirjeldus">lastname:</label></td>
            <td><input type="text" name="lastname" id="lastname"></td>
        </tr>
        <tr>
            <td><label for="hind">pool</label></td>
            <td><input type="text" name="onDeath" id="onDeath"></td>
        </tr>
        <tr>
            <td><label for="lisa">kuipaljulapsed:</label></td>
            <td><input type="text" name="onDeath" id="onDeath"></td>
        </tr>
        <tr>
            <td><input type="submit" name="lapsed" id="lapsed" value="Sisesta"></td>
            <td></td>
        </tr>

    </table>
</form>
<h2>Start tree</h2>
<table border ="1">
    <?php
        echo "<tr>";
        echo "<td>".$inimene->nimi."</td>";
        echo "<td>".$inimene->lastname."</td>";
        echo "<td>".$inimene->pool."</td>";
        echo "<td>".$inimene->onDeath."</td>";
        echo "<td>".$inimene->kuipaljulapsed."</td>";
        echo "</tr>";
    ?>
</table>
<br>
<h2> <?php echo $inimene->lapsed->inimene->nimi."";?></h2>

<table border ="1">
    <?php
    echo "<tr>";
    echo "<td>".$inimene->lapsed->inimene->nimi."</td>";
    echo "<td>".$inimene->lapsed->inimene->lastname."</td>";
    echo "<td>".$inimene->lapsed->inimene->pool."</td>";
    echo "<td>".$inimene->lapsed->inimene->onDeath."</td>";
    echo "<td>".$inimene->lapsed->inimene->kuipaljulapsed."</td>";
    echo "</tr>";
    ?>
</table>

<br>
<h2> <?php echo $inimene->lapsed->inimene->lapsed->inimene->nimi."";?></h2>

<table border ="1">
    <?php
    echo "<tr>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->nimi."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lastname."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->pool."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->onDeath."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->kuipaljulapsed."</td>";
    echo "</tr>";
    ?>
</table>

<br>
<h2><?php echo $inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->nimi."";?></h2>

<table border ="1">
    <?php
    echo "<tr>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->nimi."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->lastname."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->pool."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->onDeath."</td>";
    echo "<td>".$inimene->lapsed->inimene->lapsed->inimene->lapsed->inimene->kuipaljulapsed."</td>";
    echo "</tr>";
    ?>
</table>

<br>
<h2><?php echo "All family tree;"?></h2>
<div id="perepuu">
    <?php
    echo perepuu($inimene);
    ?>
</div>
<h2><?php echo "All family tree from ,;"?></h2>
<?php
$inimene = simplexml_load_file('tooted.xml');

$nimed = array();
foreach ($inimene->xpath('//nimi') as $nimi) {
    $nimed[] = $nimi;
}

echo implode(", ", $nimed);
?>
<br>
<h2><?php echo "Elu"?></h2>
<?php
$inimene = simplexml_load_file('tooted.xml');

$elu = array();
foreach ($inimene->xpath('//nimi') as $nimi) {
    if ($nimi->elu) {
        $elu[] = $nimi->elu;
    } else {
        $elu[] = "Tallinn";
    }
}

$elu = array_filter($elu);

sort($elu);

echo implode(", ", $elu);
?>

<h2><?php echo "table red"?></h2>
<table border="1">
    <tr>
        <th>Имя</th>
        <th>Количество детей</th>
    </tr>
    <?php
    function countDescendants($person) {
        $count = 0;
        if ($person->lapsed->inimene) {
            $count = count($person->lapsed->inimene);
            foreach ($person->lapsed->inimene as $child) {
                $count += countDescendants($child);
            }
        }
        return $count;
    }

    function addBackgroundColor($count) {
        return $count >= 2 ? 'background-color: yellow;' : '';
    }

    function displayAllPersons($person) {
        $name = $person->nimi;
        $descendantCount = countDescendants($person);
        $backgroundStyle = addBackgroundColor($descendantCount);

        echo "<tr style='{$backgroundStyle}'>";
        echo "<td>{$name}</td>";
        echo "<td>{$descendantCount}</td>";
        echo "</tr>";

        if ($person->lapsed->inimene) {
            foreach ($person->lapsed->inimene as $child) {
                displayAllPersons($child);
            }
        }
    }

    displayAllPersons($inimene);
    ?>
</table>

<h2>Данные из XML</h2>
<table border="1">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Пол</th>
        <th>Смерть</th>
        <th>Количество детей</th>
    </tr>
    <?php
    function countDescendants2($person) {
        $count = 0;
        if ($person->lapsed->inimene) {
            $count = count($person->lapsed->inimene);
            foreach ($person->lapsed->inimene as $child) {
                $count += countDescendants2($child);
            }
        }
        return $count;
    }

    function displayAllPersons2($person) {
        $name = $person->nimi;
        $lastname = $person->lastname;
        $pool = $person->pool;
        $onDeath = $person->onDeath;
        $descendantCount = countDescendants2($person);

        // Проверка на пустые значения
        $pool = $pool ?: 'Нет данных';
        $onDeath = $onDeath ?: 'Нет данных';

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$lastname}</td>";
        echo "<td>{$pool}</td>";
        echo "<td>{$onDeath}</td>";
        echo "<td>{$descendantCount}</td>";
        echo "</tr>";

        if ($person->lapsed->inimene) {
            foreach ($person->lapsed->inimene as $child) {
                displayAllPersons2($child);
            }
        }
    }

    displayAllPersons2($inimene);
    ?>
</table>
</body>
</html>

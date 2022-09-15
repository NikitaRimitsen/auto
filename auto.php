<?php
$xml=simplexml_load_file("auto.xml");
function getAutos($xml){
    $array=getSeeriass($xml);
    return $array;
}
function getSeeriass($auto){
    $result = array($auto);
    $seriass = $auto ;
    //$seriass = $auto -> auto -> seria;
    //$seriass = $auto -> seria -> auto;

    if (empty($seriass))
        return $result;

    foreach ($seriass as $serie){
        $array=getSeeriass($serie);
        $result=array_merge($result, $array);

    }
    return $result;
}

function getParent($autos, $auto){
    if($auto== null) return null;
    foreach ($autos as $parent){
        if(!hasSeriess($parent)) continue;

        foreach ($parent->seria->auto as $child){
            if($child->nimi == $auto->nimi){
                return $parent;
            }
        }
    }
    return null;
}

function hasSeriess($auto){
    return !empty($auto -> serie -> auto);
}

$autos=getAutos($xml);

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Auto kataloog</title>
</head>
<body>
    <h1>Auto kataloog</h1>

<table border="1">
    <tr>
        <th>Mark</th>
        <th>Seeria</th>
        <th>Mudel</th>
        <th>Keretüüp</th>
        <th>Aasta</th>
        <th>Mootor</th>
        <th>Kütus</th>
        <th>Käigukast</th>
    </tr>
    <?php

    foreach ($autos as $auto){

        echo '<tr>';
        echo '<td>'.($auto).'</td>';
        //echo '<td>'.($auto -> nimi).'</td>';
        echo '<td>'.($auto -> seria -> auto -> nimi).'</td>';
        //echo '<td>'.($auto -> nimi).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> nimi).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> keretüüp).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> aasta).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> mootor).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> kütus).'</td>';
        echo '<td>'.($auto -> seria -> auto -> seria -> auto -> käigukast).'</td>';
        echo '</tr>';

    }

    ?>

</table>
</body>
</html>
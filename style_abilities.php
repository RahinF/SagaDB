<?php

// display all abilities of the style selected

$query ='

SELECT
    A.Name,
    A.Description

FROM
    `Styles_Abilities` S 
    JOIN `Abilities` A ON S.AbilityID = A.ID  

WHERE
S.StyleID = :style_id

';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);


while ($row = $statement->fetch()){ 

    $skill_name        = $row['Name'];
    $skill_description = $row['Description'];

?>


<div class="col">

    <div class='row'><?= $skill_name ?></div>
    <div class='row'><?= $skill_description ?></div>

</div>


<?php

}

?>
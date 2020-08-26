<?php

//diplay skills of the same character that styles dont have
$query ='

SELECT 
    S.Name,
    S.Title,
    S.Rarity,
    A.ID,
    A.Name AS Skill,
    A.Class,
    A.Power,
    A.Description,
    A.Cost,
    A.AwakenLimit AS Awaken

FROM 
    `Styles` S 
    JOIN `Characters_Styles` CS ON S.ID = CS.StyleID
    JOIN `Styles_Skills` SS ON CS.StyleID = SS.StyleID
    JOIN `Skills` A ON SS.SkillID = A.ID

WHERE 
    CS.CharacterID = (
        SELECT
            DISTINCT CS.CharacterID
        FROM
            `Characters_Styles` CS
        WHERE
            CS.StyleID = :style_id
    )

AND SS.SkillID NOT IN (
    SELECT
    DISTINCT SS.SkillID
    FROM
    `Styles_Skills` SS
    WHERE
    SS.StyleID = :style_id
)

';

$statement = $connection->prepare($query);
$statement->execute(['style_id' => $style_id]);


while ($row = $statement->fetch()){ 

    $style_name        = $row['Name'];
    $style_title       = $row['Title'];
    $style_rarity      = $row['Rarity'];
    $skill_id          = $row['ID'];
    $skill_name        = $row['Skill'];
    $skill_class       = $row['Class'];
    $skill_power       = $row['Power'];
    $skill_description = $row['Description'];
    $skill_cost        = $row['Cost'];
    $skill_awaken      = $row['Awaken'];

?>


<div class="col">
    <div class="container border-bottom">


        <div class="row">
            <div class="col-sm"><?= $style_name ?></div>
            <div class="col-sm">[<?= $style_title ?>]</div>
            <div class="col-sm">Rarity: <?= $style_rarity ?></div>
        </div>


        <div class="row">
            <div class="col-sm">Skill: <?= $skill_name ?></div>
            <div class="col-sm"><?php print_r($result = get_element_name($connection, $skill_id));?></div>
        </div>


        <div class="row">
            <div class="col-sm">Description: <?= $skill_description ?></div>
        </div>


        <div class="row">
            <div class="col-sm">Class: <?= $skill_class ?></div>
            <div class="col-sm">Power: <?= $skill_power ?></div>
            <div class="col-sm">Initial BP: <?= $skill_cost ?></div>
            <div class="col-sm">Maximum BP Reduction: <?= $skill_cost-$skill_awaken ?></div>
            <div class="col-sm">Awaken Limit: <?= $skill_awaken ?></div>
        </div>


    </div>
</div>



<?php
}
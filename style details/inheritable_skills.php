<div class="container">
    <div class="col">
        <h5 class="p-2 bg-primary text-white rounded-pill text-center">Inheritable Skills</h5>
    </div>

<?php


$data = $query->inheritable_skills($style_id);

if(!empty($data)){
    
    for($i = 0; $i < count($data); $i++){
        
        $inherit_style_name        = $data[$i]['Name'];
        $inherit_style_title       = $data[$i]['Title'];
        $inherit_style_rarity      = $data[$i]['Rarity'];
        $inherit_skill_id          = $data[$i]['ID'];
        $inherit_skill_name        = $data[$i]['Skill'];
        $inherit_skill_class       = $data[$i]['Class'];
        $inherit_skill_power       = $data[$i]['Power'];
        $inherit_skill_description = $data[$i]['Description'];
        $inherit_skill_cost        = $data[$i]['Cost'];
        $inherit_skill_awaken      = $data[$i]['Awaken'];

?>







<div class="col">
    <div class="container border-bottom">


        <div class="row">
            <div class="col-sm"><?= $inherit_style_name ?></div>
            <div class="col-sm">[<?= $inherit_style_title ?>]</div>
            <div class="col-sm">Rarity: <?= $inherit_style_rarity ?></div>
        </div>


        <div class="row">
            <div class="col-sm">Skill: <?= $inherit_skill_name ?></div>


            <div class="col-sm">


                <?php // get the elements of skills
                    $elements = $query->join_query("Skills", "Elements", "skill_id", $inherit_skill_id);

                    if(!empty($elements)){
                        for($k = 0; $k < count($elements); $k++){
                            $element_name = $elements[$k]["Element"];
                ?>


                            <div class="col-sm">Element: <?= $element_name ?></div>




                <?php
                        } // end element for loop
                    } // end element if statement
                ?>



            </div>
        </div>


        <div class="row">
            <div class="col-sm">Description: <?= $inherit_skill_description ?></div>
        </div>


        <div class="row">
            <div class="col-sm">Class: <?= $inherit_skill_class ?></div>
            <div class="col-sm">Power: <?= $inherit_skill_power ?></div>
            <div class="col-sm">Initial BP: <?= $inherit_skill_cost ?></div>
            <div class="col-sm">Maximum BP Reduction: <?= $inherit_skill_cost-$inherit_skill_awaken ?></div>
            <div class="col-sm">Awaken Limit: <?= $inherit_skill_awaken ?></div>
        </div>


    </div>
</div>




<?php
    } // end for loop
} // end if statement
?>


</div>
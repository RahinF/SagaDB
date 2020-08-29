<div class="container">
    <div class="col">
        <h5 class="p-2 bg-primary text-white text-center">Inheritable Skills</h5>
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




<div class="border mb-1 container">


    <div class="border-bottom row">


        <div class="border col-1"><?= "{$inherit_style_name} [{$inherit_style_title}]" ?></div>

        <div class="border col-1">
            <div class="border row">class: <?= $inherit_skill_class ?></div>
            <div class="border row">elemetns
                    
                    <?php // get the elements of skills
                            $elements = $query->join_query("Skills", "Elements", "skill_id", $inherit_skill_id);

                            if(!empty($elements)){
                                for($k = 0; $k < count($elements); $k++){
                                    $element_name = $elements[$k]["Element"];
                        ?>


                                    <div class="col-sm"><?= $element_name ?></div>




                        <?php
                                } // end element for loop
                            } // end element if statement
                        ?>
            </div>
        </div>
        

        <div class="border col">
            <div class="border row">
                <div class="border col"><?= $inherit_skill_name ?></div> 
            </div>

            <div class="border row">
                <div class="border col">power: SSS</div>
                <div class="border col"><?= "BP: {$inherit_skill_cost} ({$inherit_skill_cost}-{$inherit_skill_awaken})" ?></div>
            </div>
            
            <div class="border row"><?= $inherit_skill_description ?></div>
        </div>
    </div>

    



</div>


    









<?php
    } // end for loop
} // end if statement
?>


</div>


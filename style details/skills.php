<div class="container">
    <h2 class="p-2 bg-primary text-white text-center">Skills</h2>

    <div class="row">
    
    <?php

        $data = $query->join_query("Styles_Skills", "Skills", "style_id", $style_id);

        if(!empty($data)){
            
            for($i = 0; $i < count($data); $i++){
                    
                $skill_name         = $data[$i]['Name'];
                $skill_class        = $data[$i]['Class'];
                $skill_power        = $data[$i]['Power'];
                $skill_description  = $data[$i]['Description'];
                $skill_cost         = $data[$i]['Cost'];
                $skill_awaken_limit = $data[$i]['AwakenLimit'];

    ?>

    <div class="col">

        <div class='row'><?= $skill_name ?></div>
        <div class='row'><?= $skill_description ?></div>
        <div class='row'>Class <?= $skill_class ?></div>
        <div class='row'>Power <?= $skill_power ?></div>
        <div class='row'>Awaken Limit <?= $skill_awaken_limit ?></div>
        <div class='row'>Initial Cost <?= $skill_cost ?></div>
        <div class='row'>Min Cost <?= $skill_cost-$skill_awaken_limit ?></div>
        
        

    </div>




    <?php
            }
        }
?>
    </div>
</div>

<div>
    <h2 class="p-2 bg-primary text-white text-center">Abilites</h2>

    <div class="row">




        <?php

            // display all abilities of the style selected
            $data = $query->join_query("Styles_Abilities", "Abilities", "style_id", $style_id);

            if(!empty($data)){
                for($i = 0; $i < count($data); $i++){
                        
                    $ability_name         = $data[$i]['Name'];
                    $ability_description  = $data[$i]['Description'];

        ?>




        <div class="col-md-4">

            <h3 class="text-center border-top border-bottom pt-1 pb-1"><?= $ability_name ?></h3>
            <p><?= $ability_description ?></p>

        </div>




            <?php

                } // for loop
            } // end if statement

            ?>




    </div>
</div>
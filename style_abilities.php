<div class="container">

    <div class="col">
        <h5 class="p-2 bg-primary text-white rounded-pill text-center">Abilites</h5>
    </div>

    <div class="row">


        <?php

            // display all abilities of the style selected
            $data = $query->join_query("Styles_Abilities", "Abilities", "StyleID", $style_id);

            if(!empty($data)){
                for($i = 0; $i < count($data); $i++){
                    
                    $ability_name         = $data[$i]['Name'];
                    $ability_description  = $data[$i]['Description'];

            ?>




        <div class="col">

            <div class='row'><?= $ability_name ?></div>
            <div class='row'><?= $ability_description ?></div>

        </div>




        <?php

            } // for loop
        } // end if statement

        ?>




    </div> <!-- row end -->

</div> <!-- container end -->
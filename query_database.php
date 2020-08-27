<?php

class QueryDatabase extends DatabaseConnection {
    private $query;

    // single table query
    // @table_name {string} - name of the table being queried
    // @condition_column {string} - column in the where condition
    // @condition {string} - value that is searched
    public function basic_query($table_name, $condition_column = '', $condition = ''){

        $this->query = "SELECT * FROM {$table_name}";

        if(isset($condition_column) && isset($condition)){
            $this->query .= " WHERE {$condition_column} = {$condition}";
        }

        $statement = $this->connect()->prepare($this->query);
        $statement->execute();
        
        while($row = $statement->fetch()){
            $result[] = $row;
        }
        
        if(isset($result)){
            return $result;
        }
    }





    // join two tables
    // @first_table {string} - name of the first table being joined
    // @second_table {string} - name of the second table being joined
    // @condition_column {string} - column in the where condition
    // @condition {string} - value that is searched
    public function join_query($first_table, $second_table, $condition_column = '', $condition = '') {

        $this->query = "SELECT * FROM {$first_table} NATURAL JOIN {$second_table}";
        
        if(isset($condition_column) && isset($condition)){
            $this->query .= " WHERE {$condition_column} = {$condition}";
        }
        
        $statement = $this->connect()->prepare($this->query);
        $statement->execute();
        
        while($row = $statement->fetch()){
            $result[] = $row;
        }
        
        if(isset($result)){
            return $result;
        }
    }





    // query based on filters selected
    // @filters {array} - filters (role, rarity, affinity, type) with values selected by the user from the dropdown box
    public function filter_query($filters){

        $this->query = "SELECT * FROM `Styles`";


        $counter = 0;
        foreach($filters as $table_column => $search_value){
        
            // first option selected
            if($counter === 0){
                $this->query .= " WHERE {$table_column} = '{$search_value}'";
                $counter++;
            } 

            // if more than 1 option is selected
            else { 
                $this->query .= " AND {$table_column} = '{$search_value}'"; 
            }


        }

        $statement = $this->connect()->prepare($this->query);
        $statement->execute();


        while($row = $statement->fetch()){
            $result[] = $row;
        }
        
        if(isset($result)){
        return $result;
        }
    }







    //diplay skills of the same character that styles dont have
    public function inheritable_skills($style_id){

        $this->query = "

            SELECT 
                S.Name,
                S.Title,
                S.Rarity,
                A.SkillID AS ID,
                A.Name AS Skill,
                A.Class,
                A.Power,
                A.Description,
                A.Cost,
                A.AwakenLimit AS Awaken
        
            FROM 
                `Styles` S 
                JOIN `Characters_Styles` CS ON S.StyleID = CS.StyleID
                JOIN `Styles_Skills` SS ON CS.StyleID = SS.StyleID
                JOIN `Skills` A ON SS.SkillID = A.SkillID
            
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

        ";


        $statement = $this->connect()->prepare($this->query);
        $statement->execute(['style_id' => $style_id]);


        while($row = $statement->fetch()){
            $result[] = $row;
        }
        
        if(isset($result)){
        return $result;
        }
    }    








}

?>
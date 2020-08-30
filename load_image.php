<?php

    class LoadImage {

        private $folder;
        private $image;
        private $type;

        public function display_image($folder_name, $image_name, $image_type){
            $this->folder = $folder_name;
            $this->image  = $image_name;
            $this->type   = $image_type;
            
            echo "<img src='images/{$this->folder}/{$this->image}.{$this->type}' alt='{$this->image} {$this->folder}'>";
        }

    }


?>

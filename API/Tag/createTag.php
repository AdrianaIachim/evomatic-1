<?php
        function createTag($tag)
        {
            $query = "INSERT INTO $this -> table_name (tag) VALUES (?)";   
            $stmt = $this -> conn -> prepare($query);

            $stmt->bind_param('i', $this -> tag); 
            $stmt->execute();
        }
   ?>

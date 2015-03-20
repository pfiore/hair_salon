<?php
    class Stylist
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO stylist (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylist SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM client WHERE stylist_id = {$this->getId()};");
        }

        static function getAll()
        {
            $all_stylist = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $stylist_to_return = array();
            foreach($all_stylist as $current_stylist) {
                $name = $current_stylist['name'];
                $id = $current_stylist['id'];
                $new_stylist = new Stylist($name, $id);
                array_push($stylist_to_return, $new_stylist);
            }
            return $stylist_to_return;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stylist *;");
        }

        static function find($stylist_search_id)
        {
            $found_stylist = null;
            $all_stylist = Stylist::getAll();
            foreach($all_stylist as $current_stylist) {
                $current_id = $current_stylist->getId();
                if ($current_id == $stylist_search_id) {
                  $found_stylist = $current_stylist;
                }
            }
            return $found_stylist;
        }
    }
?>

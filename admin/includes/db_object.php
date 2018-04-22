<?php 


class Db_object {


    public static function find_all() {
        return self::find_this_query("SELECT * FROM " . self::$db_table . " ");
    } // End find all method

    public static function find_by_id($id) {
        global $database;
        $result_array = self::find_this_query("SELECT * FROM " . self::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    } // End find by id method

    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $object_array[] = self::instantiation($row);
        }
        return $object_array;
    } // End find this query method

    public static function instantiation($record) {
        $the_object = new self;
        foreach ($record as $attribute => $value) {
            if ($the_object->has_attribute($attribute)) {
                $the_object->$attribute = $value;
            }
        }

        return $the_object;
    } // End instantiation method
    
    private function has_attribute($attribute) {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    } // End has_attribute method
}



?>
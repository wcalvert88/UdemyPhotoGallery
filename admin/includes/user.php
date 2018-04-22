<?php 

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function verify($username, $password) {
        global $database;
        $username = $database->escape($username);
        $password = $database->escape($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1 ";
        $result_array = static::find_this_query($sql);

        return !empty($result_array) ? array_shift($result_array) : false;
    } // End verify_user method


    protected function properties() {
        // return get_object_vars($this);
        $properties = array();
        foreach (static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties() {
        global $database;

        $clean_properties = array();

        foreach($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape($value);
        }

        return $clean_properties;
    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->create();

    }

    public function create() {
        global $database;

        $properties = $this->clean_properties();

        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")  VALUES ('" . implode("','", array_values($properties)) . "')";

        if($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
        
    } // End Create Method

    public function update(){
        global $database;

        $properties = $this->clean_properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // End Update Method


    public function delete() {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " WHERE id= " . $database->escape($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // End Delete Method


} // End of Class User






?>
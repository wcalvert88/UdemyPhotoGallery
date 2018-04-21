<?php 

class User {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users() {
        // global $database;
        // $result_set = $database->query("SELECT * FROM users");
        // return $result_set;

        return self::find_this_query("SELECT * FROM users");
    } // End find all users method

    public static function find_user_by_id($id) {
        global $database;
        $result_array = self::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    } // End find user by id method

    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $object_array[] = self::instantiation($row);
        }
        return $object_array;
    } // End find this query method

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape($username);
        $password = $database->escape($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1 ";
        $result_array = self::find_this_query($sql);

        return !empty($result_array) ? array_shift($result_array) : false;
    } // End verify_user method

    public static function instantiation($record) {
        $the_object = new self;
        // $the_object->id = $found_user['id'];
        // $the_object->username = $found_user['username'];
        // $the_object->password = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name = $found_user['last_name'];

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

    protected function properties() {
        // return get_object_vars($this);
        $properties = array();
        foreach (self::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }


    public function save() {
        return isset($this->id) ? $this->update() : $this->create();

    }

    public function create() {
        global $database;

        $properties = $this->properties();

        $sql = "INSERT INTO " . self::$db_table . " (" . implode(",", array_keys($properties)) . ")  VALUES ('" . implode("','", array_values($properties)) . "')";

        if($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
        
    } // End Create Method

    public function update(){
        global $database;

        $properties = $this->properties();
        $property_pairs = array();
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // End Update Method


    public function delete() {
        global $database;
        $sql = "DELETE FROM " . self::$db_table . " WHERE id= " . $database->escape($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    } // End Delete Method


} // End of Class User






?>
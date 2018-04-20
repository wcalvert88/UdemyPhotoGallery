<?php 

class User {

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
    }

    public static function find_user_by_id($id) {
        global $database;
         $result_set = self::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");
        $found_user = mysqli_fetch_array($result_set);
        return $found_user;

    }

    public static function find_this_query($sql) {
        global $database;

        $result_set = $database->query($sql);
        return $result_set;
    }

    public static function instantiation($record) {
        $the_object = new self;
        // $the_object->id = $found_user['id'];
        // $the_object->username = $found_user['username'];
        // $the_object->password = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name = $found_user['last_name'];

        foreach ($record as $attribute => $value) {
            if ($the_object->has_the_attribute($atrribute)) {
                $the_object->$attribute = $value;
            }
        }

        return $the_object;
    }

}





?>
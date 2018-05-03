<?php 

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=image";
    
 
    public function set_file($file) {

        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded here";
            return false;
        } elseif($file['error'] != 0) {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        } else {

        $this->user_image = basename($file['name']);
        $this->tmp_path = $file['tmp_name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        }
    }

    public function upload_photo() {
        if(!empty($this->errors)) {
            return false;
        }

        if (empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = "The file was not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;

        if(file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already exists";
            return false;
        }

        if(move_uploaded_file($this->tmp_path, $target_path)) {
                unset($this->tmp_path);
                return true;
        } else {
            $this->errors[] = "The file directory probably does not have permission to write to";
            return false;
        }
    } // End Save Method

    public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }

    public static function verify_user($username, $password) {
        global $database;
        $username = $database->escape($username);
        $password = $database->escape($password);

        $sql = "SELECT * FROM " . static::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1 ";
        $result_array = static::find_by_query($sql);

        return !empty($result_array) ? array_shift($result_array) : false;
    } // End verify_user method

    public function ajax_save_user_image($user_image, $user_id) {
        $this->user_image = $user_image;
        $this->id = $user_id;
        $this->save();


    } // End ajax_save_user_image method


} // End of Class User






?>
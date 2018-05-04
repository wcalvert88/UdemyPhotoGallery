<?php 

class Session {

    private $signed_in = false;
    public $user_id;
    public $message;
    public $count;

    function __construct() {
        session_start();
        $this->visitor_count();
        $this->check_login();
        $this->check_message();
    } // End __construct method

    public function visitor_count() {
        if(isset($_SESSION['count'])) {
            return $this->count = $_SESSION['count']++;
        } else {
            return $_SESSION['count'] = 1;
        }
    } // End visitor_count method

    // this is a getter method it gets a private value and returns it anywhere
    public function is_signed_in() {
        return $this->signed_in;
    } // End is_signed_in method


    public function login($user) {
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }   // End login method

    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    } // End logout method

    private function check_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    } // End check_login method

    public function message($msg="") {
        if(!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    } // End message method

    

    private function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    } // End check_message method


} // End Session Class

$session = new Session();
?>
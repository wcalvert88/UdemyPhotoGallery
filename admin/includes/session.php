<?php 

class Session {

    private $signed_in = false;
    public $user_id;

    function __construct() {
        session_start();
        $this->check_login();

    }

    // this is a getter method it gets a private value and returns it anywhere
    public function is_signed_in() {
        return $signed_in;
    }


    public function login($user) {
        if($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    public function logout($user) {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }

    private function check_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }


}

$session = new Session();
?>
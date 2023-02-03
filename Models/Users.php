<?php
    namespace School\Models;
    use PDO;
    $pdo = include("../Config/config.php");
    $table_name = "Users";
    function create_user_table() {
        try {
        $stmt = "CREATE TABLE IF NOT EXISTS $table_name(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(255),
            last_name VARCHAR(255),
            email VARCHAR(255),
            login VARCHAR(255),
            phone_number VARCHAR(255)
        )";
        $query = $pdo->execute($stmt);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    class User
    {
        protected $id;
        protected $first_name;
        protected $last_name;
        protected $email;
        protected $login;
        protected $phone_number;
        
        function __construct($first_name, $last_name, $email, $login, $phone_number) {
           if(!$this.check_user_entry_exists($email)) {
            echo "Duplicate entry found.";
           } 
           else {
            $this->set_email($email);
            $this->set_first_name($first_name);
            $this->set_last_name($last_name);
            $this->set_login($login);
            $this->set_phone_number($phone_number);
            $this->transact_user();
           }
        }
        
        //get methods
        public function get_id(){
            return $this->id;
        }
        public function get_full_name(){
            return ucfirst($this->first_name). " " . ucfirst($this->last_name);
        }
        public function get_email(){
            return $this->email;
        }
        public function get_phone_number(){
             return $this->phone_number;
        }
        public function get_login_name(){
            return $this->login;
        }
        //set methods
        public function set_first_name(string $name){
             $this->first_name = $name;
        }
        public function set_last_name(string $name){
            $this->last_name = $name;
        }
        public function set_email(string $email) {
            $this->email = $email;
        }
        public function set_login(string $login){
            $this->login = $login;
        }
        public function set_password(string $password) {
            $this->passowrd = password_hash($password, PASSWORD_BCRYPT);
        }
        public function set_phone_number(string $number){
            $this->phone_number=$number;
        }
        private function check_user_entry_exists($email) {
            global $pdo, $table_name;
            $stmt = "SELECT * FROM $table_name WHERE email=? LIMIT 1";
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            if($result["id"] !== null) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        private function transact_user(){
            global $pdo, $table_name, $create_user_table;
            $create_user_table();
            try {
            $stmt = "
                INSET INTO $table_name(first_name, last_name, email, login, phone_number) VALUES(:first_name, :last_name, :email, :login, :phone_number)
            ";
            $query = $pdo->prepare($stmt);
            $result = $query->execute([
                ":first_name"=> $this->first_name,
                ":last_name"=> $this->last_name,
                ":email"=>$this->email,
                ":login"=>$this->login,
                ":phone_number"=>$this->phone_number
            ]);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
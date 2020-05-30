<?php


namespace app\database;
use PDO;

class database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=HomeworkUsers", 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function insertUser($dbfirstname,$dblastname,$dbemail,$dbpassword){

        $statement = $this->pdo->prepare("insert into users (firstname,lastname,email,password) 
                                                    Values (:firstname, :lastname, :email, :password)");
        $statement->bindParam(':firstname',$dbfirstname);
        $statement->bindParam(':lastname',$dblastname);
        $statement->bindParam(':email',$dbemail);
        $statement->bindParam(':password',$dbpassword);
        return $statement->execute();
    }

    public function getUser($dbemail,$dbpassword){
        $statement = $this->pdo->prepare("SELECT * FROM users where email = :email");
        $statement->bindValue(':email',$dbemail);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(!$user){
            return [false,'user doesnt exists'];
        }
        if(!password_verify($dbpassword,$user[0]['password'])){
            return [false,'Password is incorrect'];
        } else return true;
    }






}
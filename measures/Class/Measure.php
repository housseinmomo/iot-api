<?php

 class Measure{

    public $conn ; 
    public $table = "mean" ; 
    
    public $id ; 
    public $value ; 
    public $timestamp ;
    public $read ; 
    public $fired ; 

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read(){

        $query = "SELECT * FROM mean" ;

        try{
            $statement = $this->conn->prepare($query);
        } catch(Exception $e){
            echo $e->getMessage();
        }

        $statement->execute();

        return $statement ;

    }
    
    public function read_single(){
        $query = "SELECT * FROM mean WHERE id = ?";

        try{
            $statement = $this->conn->prepare($query);
            $statement->bindParam(1 , $this->id);
        }catch(Exception $e){
            echo $e->getMessage();
        }

        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->value = $row['value'];
        $this->timestamp = $row["timestamp"];
        $this->read = $row['read'];
        $this->fired = $row['fired'];


    }

    public function create(){

        $query = " INSERT INTO `mean`(`value`) VALUES (?) ";

        $statement = $this->conn->prepare($query);

        $this->value = htmlspecialchars(strip_tags($this->value));

        $statement->bindParam(1 , $this->value);

        if($statement->execute()){
            return true ;
        } else{
            printf("Error : %s \n" , $statement->error);
            return false;
        }

    }

    public function laserUpdate(){

        $query = " UPDATE `mean` SET fired = ? WHERE id = ? " ;

        $statement = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->fired = htmlspecialchars(strip_tags($this->fired));

        $statement->bindParam(1 , $this->fired);
        $statement->bindParam(2 , $this->id);

        if($statement->execute()){
            return true ;
        } else{
            printf("Error Update fired : %s \n" , $statement->error);
            return false ;
        }

    }


    public function feedbackUpdate(){

        $query = "UPDATE mean SET `read` = ?  WHERE id = ? " ;

        $statement = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->fired = htmlspecialchars(strip_tags($this->read));

        $statement->bindParam(1 , $this->read);
        $statement->bindParam(2 , $this->id);

        if($statement->execute()){
            return true ;
        } else{
            printf("Error Update read : %s \n" , $statement->error);
            return false ;
        }

    }

    public function delete(){

        $query = "DELETE FROM mean WHERE id = ?" ;

        $statement =  $this->conn->prepare($query);

       $this->id = htmlspecialchars(strip_tags($this->id));
       
       $statement->bindParam(1 , $this->id);

       if($statement->execute()){
           return true ;
       } else{
           printf("Error %s \n" , $statement->error);
           return false ;
       }
        

    }
    
}

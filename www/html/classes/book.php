<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/inc/db.php');

    class books {

        protected $host = DB_HOST;
        protected $dbName = DB_NAME;
        protected $user = DB_USER;
        protected $pass = DB_PASS;
    
        protected $dbh;
        protected $error;
    
    /**
    *
    * // ------> Database <--------
    *
    * */
        public function __construct(){
            //dsn for mysql
          $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
          $options = array(
              PDO::ATTR_PERSISTENT    => true,
              PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
              );
          
          try{
              $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
          }
          //catch any errors
          catch (PDOException $e){
              $this->error = $e->getMessage();
          }
          
        }

        /**
        *
        * // ------> Add Books <--------
        *
        * */
        public function addBooks($data)
        {

            $title = $data[0];
            $author = $data[1];            
            $publisher = $data[2];
            $copyright = $data[3];
            $isbn = $data[4];
            $pages = $data[5];
            $version = $data[6];


            $result = $this->dbh->prepare("INSERT INTO book VALUES(default, ?, ?, ?, ?, ?, ?, ?)");
            $result->execute(array($title, $author, $publisher, $copyright, $isbn, $pages, $version));

            return;

        }

        /**
        *
        * // ------> Display Books Table <--------
        *
        * */
        public function displayBooksTable()
        {

            $stmt = $this->dbh->prepare("SELECT id, title, author, publisher, copyright, isbn, pages, versions FROM book");
            $stmt->execute();
            $ret = array();
            if($stmt->rowCount() > 0) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $ret[] = $row;
                }
            }

            return $ret;

        }

    }

    
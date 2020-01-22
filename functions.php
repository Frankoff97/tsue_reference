<?php

function add_slesh( $arr ) {
    $find = '';

    for ( $i = 0; $i < strlen( $arr );
    $i++ ) {

        if ( $arr[$i] == "'" ) {
            $find .= '\\' . $arr[$i];

        } else {
            $find .= $arr[$i];
        }

    }
    return $find;
}
    class Events {

        public $pdo; 

        public function __construct()
        {
            $this-> pdo = new PDO('mysql:host=localhost;dbname=information', 'root', ''); 
        }

        public function SELECT($table, $value){
            $sql = "SELECT * FROM $table WHERE `fullname` LIKE '%".$value."%' or `passport`='" . $value . "'" ;
            $query = $this-> pdo-> prepare($sql);
            $query-> execute();
            return $query-> fetchAll(PDO::FETCH_ASSOC);
        }

        public function INSERT( $table, $data ) {
            $key = array_keys($data);
            $string = implode( ',', $key );
            $value = ":". implode( ', :', $key );
            $sql = "INSERT INTO $table ($string) VALUES ($value)";
           
            $query = $this->pdo->prepare( $sql );
            $query->execute( $data );
        }

        public function DELETE($table, $passport){
            $sql = "DELETE FROM $table WHERE passport = '$passport'";
            $query = $this->pdo->prepare($sql);
            $query -> execute();
        }

        public function UPDATE($table, $row ){
            $keys = array_keys($row);
            $sql= "UPDATE `$table` SET"; 
            foreach($keys as $key){ $sql .= $key . '=' . "'" .$row[$key] . "'";};
            $sql .=  " WHERE `passport`=" . $row['passport'];
            $query=$this->pdo->prepare($sql);
            $query->execute();

        }
    }


?>

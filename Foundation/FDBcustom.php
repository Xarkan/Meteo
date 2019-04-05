<?php
class FDBcustom {

    public function list($obj) {
        if ($obj instanceof EUser) {
            $fc = new FConnection();
            $mail = $obj->getMail();
            $sql = "SELECT * FROM station WHERE mail = ?";

            $statement = $fc->connection->prepare($sql);
            $statement->bindParam(1, $mail);
            $statement->execute();

            $result = $statement->fetchAll();

            for ($i=0; $i < count($result) ; $i++) { 
                list($mail, $name, $alt, $lat, $long, $id) = $result[$i];
                $user = new EUser($mail, '');
                $stations[$i] = new EStation($user, $name, $alt, $lat, $long);
                $stations[$i]->setId($id);
            }
            $vars = $stations;
        }
        if($obj instanceof EStation) {
            $dbname = 'station'.strval($obj->getId());
            $fc = new FConnection($dbname); 

            $sql = "SELECT * FROM measure";

            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $vars = $statement->fetchAll();
        } 
        return $vars;
    }

    public function limit($station, $num, $desc = true) {
        $dbname = 'station'.strval($station->getId());
        $fc = new FConnection($dbname);
        if ($desc) {
            $x = 'DESC ';
        }else{
            $x = '';
        }
        $sql = 'SELECT * FROM measure ORDER BY time '.$x.'LIMIT '.$num;

        $statement = $fc->connection->prepare($sql);
        $statement->bindParam(1, $dbname);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function load_station_sensors($station) {
        $dbname = 'station'.strval($station->getId());
        $fc = new FConnection($dbname);

        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ?";

        $statement = $fc->connection->prepare($sql);
        $statement->bindParam(1, $dbname);
        $statement->execute();

        /*if ($string == 'index') {
            $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        }else{  */         
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //}
        return $result;
    }

    public function load_station_measures($id, $sensors, DateTime $from, DateTime $to) {
        $dbname = 'station'.strval($id);
        $fc = new FConnection($dbname);

        $columns = '';
        for ($i=0; $i < count($sensors) ; $i++) { 
            $columns = $columns.", ".$sensors[$i];
        }

        $min = $from->format('Y-m-d H:i:s');
        $max = $to->format('Y-m-d H:i:s');

        $sql = "SELECT time".$columns." FROM measure WHERE time > ? AND time < ?";

        $statement = $fc->connection->prepare($sql);
        $statement->bindParam(1, $min);
        $statement->bindParam(2, $max);
        $statement->execute();

        $result = $statement->fetchAll();  //PDO::FETCH_ASSOC);

        return $result;
    }

    


}    
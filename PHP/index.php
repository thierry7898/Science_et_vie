<?php

class Constants
{
    //DATABASE DETAILS
    static $DB_SERVER="savemysunday.com:3306";
    static $DB_NAME="duth1917_revues";
    static $DB_TABLE="science";   // pas de table dans exemple
    static $USERNAME="duth1917_thierry";
    static $PASSWORD="Annouchka1961";

    //STATEMENTS
    static $SQL_SELECT_ALL="SELECT * FROM science";   // voir pourquoi codage en dur a remplacer

}

class Livres
{
    /*******************************************************************************************************************************************/
    /*
       1.CONNECT TO DATABASE.
       2. RETURN CONNECTION OBJECT
    */
    public function connect()
    {
        $con=new mysqli(Constants::$DB_SERVER,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DB_NAME);
        if($con->connect_error)
        {
            // echo "Unable To Connect"; - For debug
            return null;
        }else
        {
         //   echo "Connected"; //- For debug
            return $con;
        }
    }
    /*******************************************************************************************************************************************/
    /*
       1.SELECT FROM DATABASE.
    */
    public function select()
    {
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query(Constants::$SQL_SELECT_ALL);
            if($result->num_rows>0)
            {
                $livres=array();
                while($row=$result->fetch_array())
                {
                    array_push($livres, array("reference"=>$row['reference'],"numero"=>$row['numero'],
                    "illustration"=>$row['illustration'],"sommaire"=>$row['sommaire'],
                    "possession"=>$row['possesion'],"etat"=>$row['etat'],"estimation"=>$row['estimation']));
                }
                print(json_encode(array_reverse($livres)));
            }else
            {
                print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
            }
            $con->close();

        }else{
            print(json_encode(array("PHP EXCEPTION : CAN'T CONNECT TO MYSQL. NULL CONNECTION.")));
        }
    }
}
$livres=new Livres();
$livres->select();

//end
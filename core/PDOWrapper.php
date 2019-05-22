<?php
class PDOWrapper
{
    
    static private $WrapperInstance = null;


    private $PDOInstance = null; 

    private function __construct($dsn, $username=false, $password=false, $driver_options=false) 
    {
        try 
        {
            $this->PDOInstance = new PDO($dsn, $username, $password, $driver_options);
        } 
        catch (PDOException $e) 
        { 
            die("PDO connect error: " . $e->getMessage() . "<br/>");
        }
    }

    public static function getInstance($dsn, $username=false, $password=false, $driver_options=false)
    {
        if(null === self::$WrapperInstance)
        {
            self::$WrapperInstance = new self($dsn, $username, $password, $driver_options);
        }
        return self::$WrapperInstance;
    }
    public function InsertAssoc($tableName, $values = array())
    {
        $sql = sprintf(
           'INSERT INTO %s (%s) VALUES (:%s)',
            $tableName,
            implode(',',array_keys($values)),
            implode(', :',array_keys($values))
        );
        //echo ($sql . "</br>");
        $sth = $this->PDOInstance->prepare($sql);
        foreach($values as $key => &$value){
           // echo('<br>:'.$key. " " . $value);
            $sth->bindParam(':'.$key, $value);
        }
        
        print_r($sth);
        return $sth->execute();
    }
    public function ExecuteAndFetchAll($sqlquery, $args = array())
    {
        $sth = $this->PDOInstance->prepare($sqlquery);
        $sth->execute($args);
        return $sth->fetchAll();
    }
    public function Execute($sqlquery, $args = array())
    {
        $sth = $this->PDOInstance->prepare($sqlquery);
        return $sth->execute($args);
    }
}
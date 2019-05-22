<?php

class User
{
    protected $id = null;
    protected $img = null;
    protected $username = null;
    protected $title = null;
    protected $location = null;

    function __construct($id)
    {
        $this->getUser($id);
    }
    private function getUser($id)
    {
        include("core/config.php");
        $pdo = PDOWrapper::getInstance($dsn, $username, $password, $default_attributes);
        $result = $pdo->ExecuteAndFetchAll("SELECT * FROM users WHERE id=?", [$id]);
        if($result != null) {
            $this->id = $id;
            $this->img = $result[0]['imglocation'];
            $this->username = $result[0]['fullname'];
            $this->title = $result[0]['title'];
            $this->location = $result[0]['location'];
        }
    }
    public function getArray()
    {
        if($this->id == null) return false;
        return ["id" => $this->id,
            "imglocation" => $this->img,
            "fullname" => $this->username,
            "title" => $this->title,
            "location" => $this->location];
    }
}
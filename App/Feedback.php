<?php


class Feedback
{
    private $fname, $email, $message;
    public function __construct($f, $e, $m)
    {
        $this->fname = $f;
        $this->email = $e;
        $this->message = $m;

    }
    public function sendFeedback()
    {
        include("core/config.php");
        $pdo = PDOWrapper::getInstance($dsn, $username, $password, $default_attributes);
        $pdo->insertAssoc('feedback', ['fullname' => $this->fname, "email" => $this->email, "message" => $this->message]);
    }
}
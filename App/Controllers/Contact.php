<?php

require_once("App/Users.php");
require_once("App/Feedback.php");
class Contact extends Controller
{
    public function drawContact($id)
    {
        $user = new User($id);
        $userData = $user->getArray();
        if($userData == false)
        {
            echo("404");
            return;
        }
        $userData["page"] = $this->page;
        echo render_template('header.php', $userData);
        echo render_template('contact.php', $userData);
        echo render_template('footer.php');
        return;
    }
    public function sendFeedback()
    {
        if(isset($_POST['message']))
        {
            //var_dump($_POST);
            $sentFeedback = new Feedback($_POST['fullname'], $_POST['email'], $_POST['message']);
            $sentFeedback->sendFeedback();
        }
    }
}
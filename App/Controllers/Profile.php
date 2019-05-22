<?php

require_once("App/Users.php");
class Profile extends Controller
{
    public function showProfile($id)
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
        echo render_template('profile.php', $userData);
        echo render_template('footer.php');
        return;
    }
}
<?php
namespace Model;

class UserModel
{

    public function createUser($username, $password, $email)
    {

        if (!username_exists($username)) {
            if (wp_create_user($username, $password, $email)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUser($username, $default = null)
    {
        $user = get_user_by('login', $username);

        return $user ? $user : $default;
    }

    public function identify($username, $password)
    {
        $user = get_user_by('login', $username);

        if ($user && wp_check_password($password, $user->data->user_pass, $user->ID))
            return true;
        else
            return false;
    }

    public function getUserVote($username, $default = null)
    {
        $user = get_user_by('login', $username);
        $vote = get_user_meta($user->ID, 'dancer_vote',TRUE);

        return $vote ? $vote : $default;
    }

    public function setUserVote($username, $dancer)
    {
        $user = get_user_by('login', $username);
        update_user_meta($user->ID, 'dancer_vote', $dancer);
    }

}
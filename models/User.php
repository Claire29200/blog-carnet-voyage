<?php

namespace Models;

class User extends Model
{

    protected $lastName;
    protected $firstName;
    protected $pseudo;
    protected $email;
    protected $pswd;
    protected $userRole;

    //GETTERS

    function getLastName()
    {
        return $this->lastName;
    }

    function getFirstName()
    {
        return $this->firstName;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPseudo()
    {
        return $this->pseudo;
    }

    function getPswd()
    {
        return $this->pswd;
    }

    function getUserRole()
    {
        return $this->userRole;
    }


    //SETTERS

    function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setPseudo($pseudo)
    {
        $this->pseudo= $pseudo;
    }

    function setPswd($pswd)
    {
        $this->pswd = $pswd;
    }

    function setUserRole($userRole)
    {
        $this->userRole = $userRole;
    }
}

<?php

class Admin extends User
{
    use Model;

    protected $table = 'admin';
    protected $allowedColumns = ['email', 'password', 'token', 'level'];
}

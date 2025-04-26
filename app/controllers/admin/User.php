<?php

class User
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $user = new Patient();
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $userModel= $user->getAllPatients();

        $data=[
            'patient'=> $userModel,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver
        ];
        // var_dump( $data );
        $this->view('admin/user', $data);
    }

    // add other methods like edit, update, delete, etc.
}

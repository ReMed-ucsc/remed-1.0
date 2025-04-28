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
        $this->view('admin/user', $data);
    }

}

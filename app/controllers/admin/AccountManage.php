<?php

class AccountManage
{
    use Controller;

    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {

        $admin= new Admin();
        $msg = new Pharmacy();
        $driver = new Driver();
        $Msg = $msg->notification("pending");
        $MsgDriver = $driver->notificationDriver('pending');
        $Admin=$admin->get_admin();


        $data=[
            'admin'=>$Admin,
            'notification'=>$Msg,
            'notificationDriver'=>$MsgDriver
        ];
        $this->view('admin/accountManage', $data);
    }

    // add other methods like edit, update, delete, etc.
}

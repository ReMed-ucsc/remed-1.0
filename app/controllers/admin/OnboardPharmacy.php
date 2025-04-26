<?php

class OnboardPharmacy
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');

        $data=[
            'notification'=>$Msg,
            'notificationDriver'=>$MsgDriver
        ];
        $this->view('admin/onboardPharmacy', $data);
    }
}

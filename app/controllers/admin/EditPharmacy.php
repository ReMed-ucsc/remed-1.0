<?php

class EditPharmacy
{
    use Controller;
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
        $this->view('admin/editPharmacy', $data);
    }
}

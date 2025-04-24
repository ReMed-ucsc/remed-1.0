<?php
class NewPharmacy
{
    use Controller;
    public function index()
    {
        // $user = new User;
        $msg = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $msg->notification('pending');
        $data=[
            'notification'=>$Msg,
            'notificationDriver'=>$MsgDriver
        ];
        $this->view('admin/newPharmacy', $data);
    }
}

<?php
class PendingDriver
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        $driverModel=new Driver();
        $msg = new Pharmacy();

        $Msg = $msg -> notification('pending');
        $MsgDriver = $driverModel->notificationDriver('pending');
        $drivers=$driverModel->getDrivers("pending");

        $data = [
            'drivers'=>$drivers,
            'notification'=>$Msg,
            'notificationDriver'=>$MsgDriver
        ];
        
        $this->view('admin/pendingDriver', $data);
    }
    public function OnboardDrivers($id){
        $driverModel= new Driver;
        $pharmacy= new Pharmacy();

        $Msg = $pharmacy->notification('pending');
        $MsgDriver = $driverModel->notificationDriver('pending');
        $driver = $driverModel->getDriverId($id);
        if(!$driver){
            redirect("admin/PendingDriver");
            exit();
        }

        $data=[
            'driver'=> $driver,
            'notification'=>$Msg,
            'notificationDriver'=>$MsgDriver
        ];

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $data=[
                'driverName'=>$_POST['driverName'],
                'vehicalLicenseNo'=>$_POST['vehicalLicenseNo'],
                'email'=>$_POST['email'],
                'telNo'=>$_POST['telNo'],
                'deliveryTime'=>$_POST['deliveryTime'],
                'status'=>'APPROVED'
            ];
     

            if ($driverModel->validate($data)) {
                $driverModel->update($id, $data, 'driverId');
                redirect('admin/DriverDetails');
                exit();
            } else {
                $data['errors'] = $driverModel->errors;
            }
        }
         $this->view('admin/onboardDriver', $data);
    }
    public function reject($id){
        $driverModel = new Driver();

        $driverModel->rejectDriver($id);
        redirect("admin/PendingDriver");
    }
    
}
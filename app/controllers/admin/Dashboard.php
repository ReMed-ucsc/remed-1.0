<?php

class Dashboard
{
    use Controller;

    public function index()
    {
        

        // Get session data
        $AdminID = $this->getSession('id');
        $adminEmail = $this->getSession('email');
        $authToken = $this->getSession('auth_token');

        $pharmacy = new pharmacy();
        $approvedPharmacy = $pharmacy->getlastId("APPROVED");
        $pendingPharmacy=$pharmacy->getlastId("pending");

        $driver = new Driver();
        $approvedDrivers = $driver->getlastId("APPROVED");
        $pendingDrivers=$driver->getlastId("pending");

        $petient = new Patient();
        $patientCount = $petient->getlastId();

        // Get all pharmacies
        $AdminModel = new Admin();
        

        $Msg = $pharmacy->notification('pending');
        $MsgDriver = $driver->notificationDriver('pending');
        $admin = $AdminModel->findAll();
        
        if ($admin === false) {
            $data['error_message'] = 'Error loading pharmacy data. Please try again later.';
        } else {
            $data=[
                'admin'=>$admin,
                'notification'=>$Msg,
                'notificationDriver'=> $MsgDriver            ];
        }
        // Pass session data to the view
        $data = [
            'email' => $adminEmail,
            'id' => $AdminID,
            'authToken' => $authToken,
            'admin' => $admin,
            'approved_pharmacy' => $approvedPharmacy,
            'pending_pharmacy'=>$pendingPharmacy,
            'approved_drivers' => $approvedDrivers,
            'pending_drivers' => $pendingDrivers,
            'patientCount' => $patientCount,
            'notification'=>$Msg,
            'notificationDriver'=> $MsgDriver   
        ];

        $this->unsetSession('error_message');
        $this->unsetSession('success_message');

        $this->view('admin/dashboard', $data);
    }
   
    // add other methods like edit, update, delete, etc.
}

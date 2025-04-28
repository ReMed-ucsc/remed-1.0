<?php

class PharmacyDetails
{
    use Controller;
    public function __construct(){
        $this->protectRoute();
    }
    public function index()
    {
        
        $PharmacyID = $this->getSession('pharmacy_id');
        $name = $this->getSession('pharmacy_name');
        $authToken = $this->getSession('auth_token');

        $PharmacyModel = new Pharmacy();
        $Msg = $PharmacyModel->notification('pending');
        $pharmacy = $PharmacyModel->getPharmacies('APPROVED');


        $data = [
            'pharmacyName' => $name,
            'PharmacyID' => $PharmacyID,
            'authToken' => $authToken,
            'pharmacy' => $pharmacy,
            'notification' => $Msg
        ];



        $this->view('admin/pharmacyDetails', $data);
    }

    public function edit($id)
    {


        $pharmacyModel = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacyModel->notification('pending');
        $pharmacy = $pharmacyModel->first(['PharmacyId' => $id]);


        if (!$pharmacy) {
            redirect('admin/PharmacyDetails');
            exit();
        }

        $data = [
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver,
            'pharmacy' => $pharmacy,
            'errors'=>[]
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name=$_POST['name'] ;
            $pharmacist=$_POST['pharmacistName'];
            $RegNo=$_POST['RegNo'];
            $contactNo=$_POST['contactNo'];
            $address=$_POST['pharmacy-address'];
            $email=$_POST['email'];
            $latitude=$_POST['latitude'];
            $longitude=$_POST['longitude'];


            if(empty($name)){
                $data['errors']['name']="Pharmacy Name is required !";
            }
            if(empty($pharmacist)){
                $data['errors']['pharmacistName']="Pharmacist's Name is required !";
            }
            if(empty($RegNo)){
                $data['errors']['RegNo']="Pharmacy License is required !";
            }
            if(empty($contactNo)){
                $data['errors']['contactNo']="Contact is required !";
            }
            if(empty($email)){
                $data['errors']['email']="Email is required !";
            }
            
            if(empty($longitude) && empty($latitude) && empty($address)){
                $data['errors']['longitude']="Pharmacy address is required !";
            }
            if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
                $data['errors']['email']="Wrrong Email !";
            }
            $UpdateData = [

                'name' => $name,
                'pharmacistName' => $pharmacist,
                'RegNo' => $RegNo,
                'contactNo' => $contactNo,
                'email' => $email,
                'address' => $address,
                'notification' => $Msg,
                'notificationDriver' => $MsgDriver,
                'latitude'=>$latitude,
                'longitude'=>$longitude
            ];
            if(empty($data['errors'])){
                $pharmacyModel->update($id,$UpdateData,'PharmacyID');
                redirect('admin/PharmacyDetails');
                exit;
            }else{
                $data['errors'] = array_merge($data['errors'], $pharmacyModel->errors ?? []);
            }
        }

        $this->view('admin/editPharmacy', $data);
    }

    public function create()
    {

        
        $pharmacy = new Pharmacy();

        $data=[
            'pharmacy'=>$pharmacy,
            'errors'=>[]
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name=$_POST['name'] ;
            $pharmacist=$_POST['pharmacistName'];
            $RegNo=$_POST['RegNo'];
            $contactNo=$_POST['contactNo'];
            $address=$_POST['pharmacy-address'];
            $email=$_POST['email'];
            $document=$_FILES['document']['name'];
            $latitude=$_POST['latitude'];
            $longitude=$_POST['longitude'];

            $existError=$pharmacy->existingPharmacy($RegNo);

            if(empty($name)){
                $data['errors']['name']="Pharmacy Name is required !";
            }
            if(empty($pharmacist)){
                $data['errors']['pharmacistName']="Pharmacist's Name is required !";
            }
            if(empty($RegNo)){
                $data['errors']['RegNo']="Pharmacy License is required !";
            }
            if(!empty($existError)){
                $data['errors']['RegNo']="License Number Is Exist !";
            }
            if(empty($contactNo)){
                $data['errors']['contactNo']="Contact is required !";
            }
            if(empty($email)){
                $data['errors']['email']="Email is required !";
            }
            if(empty($document)){
                $data['errors']['document']="NMRA report should Submit !";
            }
            
            if(empty($longitude) && empty($latitude) && empty($address)){
                $data['errors']['longitude']="Pharmacy address is required !";
            }
            if(!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)){
                $data['errors']['email']="Wrrong Email !";
            }

            $Newdata = [
                'name' => $name,
                'pharmacistName' => $pharmacist,
                'RegNo' => $RegNo,
                'contactNo' => $contactNo,
                'address' => $address,
                'email' => $email,
                'status' => 'APPROVED',
                'document' => $document,
                'latitude'=>$latitude,
                'longitude'=>$longitude
                
            ];
            
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/NMRA/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $filename = uniqid() . '_' . basename($_FILES['document']['name']);
                $uploadPath = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath)) {
                    $Newdata['document'] = $filename;
                } else {
                    $data['errors']['document'] = 'File upload failed';
                }
            }


            if(empty($data['errors'])){
                $pharmacy->insert($Newdata);
                redirect('admin/PharmacyDetails');
                exit;
            }else{
                $data['errors'] = array_merge($data['errors'], $pharmacy->errors ?? []);
            }
        }


        $this->view('admin/newPharmacy', $data);
    }
    public function delete($id)
    {


        $pharmacyModel = new Pharmacy();
        $pharmacyModel->delete($id, 'PharmacyID');
        redirect('admin/PharmacyDetails');
        exit();
    }

}

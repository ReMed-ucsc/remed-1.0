<?php

class PendingPharmacy
{
    use Controller;
    public function __construct()
    {
        $this->protectRoute();
    }
    public function index()
    {
        $pharmacy = new Pharmacy;
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacy->notification('pending');
        $pharmacyModel = $pharmacy->getPharmacies("pending");
        $data = [
            'pharmacy' => $pharmacyModel,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver
        ];
        $this->view('admin/pendingPharmacy', $data);
    }
    public function onboardPharmacy($id)
    {
        $pharmacyModel = new Pharmacy();
        $driver = new Driver();

        $MsgDriver = $driver->notificationDriver('pending');
        $Msg = $pharmacyModel->notification('pending');
        $pharmacy = $pharmacyModel->getPharmacyById($id);

        if (!$pharmacy) {
            redirect("admin/pendingPharmacy");
            exit();
        }

        $data = [
            'pharmacy' => $pharmacy,
            'notification' => $Msg,
            'notificationDriver' => $MsgDriver,
            'errors' => []
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $pharmacist = $_POST['pharmacistName'];
            $RegNo = $_POST['RegNo'];
            $contactNo = $_POST['contactNo'];
            $email = $_POST['email'];
            $address = $_POST['pharmacy-address'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $document = $_FILES['document']['name'] ?? null;


            if (empty($name)) {
                $data['errors']['name'] = "Pharmacy Name is required !";
            }
            if (empty($pharmacist)) {
                $data['errors']['pharmacistName'] = "Pharmacist's Name is required !";
            }
            if (empty($RegNo)) {
                $data['errors']['RegNo'] = "Pharmacy License is required !";
            }
            if (!empty($existError)) {
                $data['errors']['RegNo'] = "License Number Is Exist !";
            }
            if (empty($contactNo)) {
                $data['errors']['contactNo'] = "Contact Number is required !";
            }
            if (empty($address)) {
                $data['errors']['address'] = "Address is required !";
            }
            if (empty($email)) {
                $data['errors']['email'] = "Email is required !";
            }
            if (empty($document)) {
                $data['errors']['document'] = "NMRA report should Submit !";
            }

            if (empty($longitude) && empty($latitude)) {
                $data['errors']['longitude'] = "Address Name is required !";
            }
            if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
                $data['errors']['email'] = "Wrrong Email !";
            }

            $updateData = [
                'notification' => $Msg,
                'notificationDriver' => $MsgDriver,
                'name'=>$name,
                'pharmacistName'=>$pharmacist,
                'RegNo'=>$RegNo,
                'contactNo'=>$contactNo,
                'email'=>$email,
                'address'=>$address,
                'longitude'=>$longitude,
                'latitude'=>$latitude,
                'status'=>"APPROVED",
                'document'=>$document
            ];
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/NMRA/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $filename = uniqid() . '_' . basename($_FILES['document']['name']);
                $uploadPath = $uploadDir . $filename;
                if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath)) {
                    $data['document'] = $filename;
                } else {
                    $data['errors']['document'] = 'File upload failed';
                }
            }

            
            if (empty($data['errors'])) {

                $pharmacyModel->update($id, $updateData, 'PharmacyID');
                redirect('admin/PharmacyDetails');
                exit();
            } else {
                $data['errors'] = array_merge($data['errors'], $pharmacyModel->errors ?? []);
            }
        }

        $this->view('admin/onboardPharmacy', $data);
    }
    public function reject($id)
    {
        $pharmacyModel = new Pharmacy();

        $pharmacyModel->rejectPharmacy($id);
        redirect("admin/PendingPharmacy");
    }



}



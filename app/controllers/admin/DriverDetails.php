<?php
class DriverDetails
{
    use Controller;
    public function index()
    {
        $driverDetails = new Driver();
        $driver = $driverDetails->getDrivers("APPROVED  ");

        $data = [
            "driver" => $driver,
        ];

        $this->view('admin/driverDetails', $data);
    }

    // public function create()
    // {
    //     // Protect the route
    //     // $this->protectRoute();
    //     $driver = new Driver();

    //     $lastID = $driver->getLastInsertedId();

    //     $nextID = $lastID + 1;

    //     $data = [ 'driverID'=> $nextID ];

    //     if ($_SERVER['REQUEST_METHOD'] == "POST") {


    //         // Prepare basic data
    //         $data = [
    //             'driverName' => $_POST['driverName'] ?? '',
    //             'telNo' => $_POST['telNo'] ?? '',
    //             'vehicalLicenseNo' => $_POST['vehicalLicenseNo'] ?? '',
    //             'email' => $_POST['email'] ?? '',
    //             'deliveryTime' => $_POST['deliveryTime'],
    //             'status' => 'APPROVED',
    //             'document' => ''
    //         ];

    //         show($data);
    //         // File upload handling
    //         if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
    //             $uploadDir = BASE_PATH . '/uploads/Drivinglicense/';

    //             // Create directory if it doesn't exist
    //             if (!is_dir($uploadDir)) {
    //                 mkdir($uploadDir, 0777, true);
    //             }

    //             // Generate unique filename
    //             $filename = uniqid() . '_' . basename($_FILES['document']['name']);
    //             $uploadPath = $uploadDir . $filename;

    //             // Move uploaded file
    //             if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath)) {
    //                 $data['document'] = $filename;
    //             } else {
    //                 // Handle upload error
    //                 $data['errors']['document'] = "File upload failed";
    //             }
    //         }

    //         // Validate and insert
    //         if ($driver->validate($data)) {
    //             $result = $driver->insert($data);

    //             // show($result);
    //             if ($result) {
    //                 redirect('admin/DriverDetails');
    //                 exit();
    //             } else {
    //                 $data['errors']['general'] = "Failed to create pharmacy";
    //             }
    //         } else {
    //             // show('error');
    //             $data['errors'] = $driver->errors;
    //         }
    //     }

    //    redirect('admin/driverDetails');
    //     // $this->view('admin/pharmacyDetails', $data);
    // }
    public function create()
    {


        // Get the last inserted driver ID
        // $lastID = $driverModel->getLastInsertedId();
        // $nextID = $lastID + 1;


        // Prepare data for the view
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $driver = new Driver();
            // Prepare driver data
            $data = [
                'driverName' => $_POST['driverName'] ?? '',
                'telNo' => $_POST['telNo'] ?? '',
                'email' => $_POST['email'] ?? '',
                'deliveryTime' => $_POST['deliveryTime'] ?? '',
                'vehicalLicenseNo' => $_POST['vehicalLicenseNo'] ?? '',
                'document' => '',
                'token' => md5(uniqid()),
                'fcmToken' => md5(uniqid())
            ];
            show($data);
            // Handle file upload
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/Drivinglicense/';
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
            
            // Validate and save
            if ($driver->validate($data)) {
                $result = $driver->insert($data);
                if ($result) {
                    redirect('admin/driverDetails');
                    exit();
                } else {
                    $data['errors']['general'] = 'Failed to create driver';
                }
            } else {
                $data['errors'] = $driver->errors;
            }
        }

        redirect('admin/driverDetails');
    }

    // add other methods like edit, update, delete, etc.
}


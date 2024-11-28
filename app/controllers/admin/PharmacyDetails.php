<?php

class PharmacyDetails
{
    use Controller;

    public function index()
    {
        // Protect the route
        $this->protectRoute();

        // Get session data
        $PharmacyID = $this->getSession('pharmacy_id');
        $name = $this->getSession('pharmacy_name');
        $authToken = $this->getSession('auth_token');

        // Get all pharmacies
        $PharmacyModel = new Pharmacy();
        $pharmacy = $PharmacyModel->findAll();

        if ($pharmacy === false) {
            $data['error_message'] = 'Error loading pharmacy data. Please try again later.';
        } else {
            $data['pharmacy'] = $pharmacy;
        }
        // Pass session data to the view
        $data = [
            'pharmacyName' => $name,
            'PharmacyID' => $PharmacyID,
            'authToken' => $authToken,
            'pharmacy' => $pharmacy
        ];

        $this->unsetSession('error_message');
        $this->unsetSession('success_message');

        $this->view('admin/pharmacyDetails', $data);
    }

    public function edit($id)
    {
        // Protect the route
        // Protect the route
        $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $pharmacy = $pharmacyModel->first(['PharmacyId' => $id]);

        if (!$pharmacy) {
            redirect('admin/PharmacyDetails');
            exit();
        }

        $data = ['pharmacy' => $pharmacy];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = [
                'name' => $_POST['name'],
                'pharmacistName' => $_POST['pharmacistName'],
                'RegNo' => $_POST['RegNo'],
                'contactNo' => $_POST['contactNo'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'document' => $_FILES['document'] ?? null
            ];


            if ($pharmacyModel->validate($data)) {

                $pharmacyModel->update($id, $data, 'PharmacyID');
                redirect('admin/PharmacyDetails');
                exit();
            } else {
                $data['errors'] = $pharmacyModel->errors;
            }
        }

        $this->view('admin/editPharmacy', $data);
    }

    public function create()
    {
        // Protect the route
        $this->protectRoute();

        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pharmacy = new Pharmacy();

            // Prepare basic data
            $data = [
                'pharmacyName' => $_POST['name'] ?? '',
                'pharmacistName' => $_POST['pharmacistName'] ?? '',
                'RegNo' => $_POST['RegNo'] ?? '',
                'contactNo' => $_POST['contactNo'] ?? '',
                'address' => $_POST['address'] ?? '',
                'email' => $_POST['email'] ?? '',
                'status' => 'APPROVED',
                'document' => ''
            ];

            // File upload handling
            if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/uploads/license/';

                // Create directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Generate unique filename
                $filename = uniqid() . '_' . basename($_FILES['document']['name']);
                $uploadPath = $uploadDir . $filename;

                // Move uploaded file
                if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadPath)) {
                    $data['document'] = $filename;
                } else {
                    // Handle upload error
                    $data['errors']['document'] = "File upload failed";
                }
            }

            // Validate and insert
            if ($pharmacy->validate($data)) {
                $result = $pharmacy->insert($data);

                if ($result) {
                    redirect('admin/PharmacyDetails');
                    exit();
                } else {
                    $data['errors']['general'] = "Failed to create pharmacy";
                }
            } else {
                $data['errors'] = $pharmacy->errors;
            }
        }

        $this->view('admin/pharmacyDetails', $data);
    }
    public function delete($id)
    {
        // Protect the route
        $this->protectRoute();

        $pharmacyModel = new Pharmacy();
        $pharmacyModel->delete($id, 'PharmacyID');
        redirect('admin/PharmacyDetails');
        exit();
    }
}

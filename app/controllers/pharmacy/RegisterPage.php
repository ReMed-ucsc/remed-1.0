<?php

class RegisterPage
{
    use Controller;

    public function index()
    {
        $data['username'] = [];
        $this->view('pharmacy/registerPage', $data);
    }

    public function apiSubmit()
    {
        $response = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Step 1: Validate Email
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Please enter a valid email address.";
            }

            // Step 2: Validate Password
            if (empty($_POST['password']) || empty($_POST['confirm-password'])) {
                $errors[] = "Password fields cannot be empty.";
            } else {
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm-password'];

                if (strlen($password) < 8 || !preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*]/', $password)) {
                    $errors[] = "Password must be at least 8 characters, contain a number and a special character.";
                }

                if ($password !== $confirmPassword) {
                    $errors[] = "Passwords do not match.";
                }
            }

            // Step 3: Validate Address and Contact Number
            if (empty($_POST['pharmacy-address']) || empty($_POST['contact-number'])) {
                $errors[] = "Please fill in all required fields.";
            }

            // Step 4: Validate Names
            if (empty($_POST['pharmacy-name']) || empty($_POST['pharmacist-name'])) {
                $errors[] = "Please fill in all required fields.";
            }

            // Step 5: Validate License Photo Upload
            if (empty($_FILES['license-photo']['name'])) {
                $errors[] = "Please upload a license photo.";
            }

            // If there are errors, return them as JSON
            if (!empty($errors)) {
                $response['success'] = false;
                $response['message'] = implode("\n", $errors);
                echo json_encode($response);
                return;
            }

            // If validation passes, save the data to the database
            $pharmacy = new Pharmacy();
            $pharmacyData = [
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'address' => $_POST['pharmacy-address'],
                'contactNo' => $_POST['contact-number'],
                'name' => $_POST['pharmacy-name'],
                'pharmacistName' => $_POST['pharmacist-name'],
                'license' => $_FILES['license-photo']['name']
            ];

            // Save the license photo to the server
            move_uploaded_file($_FILES['license-photo']['tmp_name'], BASE_PATH . "/uploads/license/" . $_FILES['license-photo']['name']);

            $pharmacy->insert($pharmacyData);

            // Return success response
            $response['success'] = true;
            echo json_encode($response);
        }
    }
}

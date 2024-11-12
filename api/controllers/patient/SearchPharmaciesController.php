<?php

require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class SearchPharmaciesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();

            // Get query parameters
            if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['productIDs'])) {
                $latitude = $_GET['latitude'];
                $longitude = $_GET['longitude'];
                $productIDs = explode(',', $_GET['productIDs']); // Assume productIDs are comma-separated in the query
                $range = isset($_GET['range']) ? $_GET['range'] : 10; // Default range is 10 km


                try {
                    $patient = $patientModel->first(['token' => $authToken]);

                    if ($patient) {
                        // Validate latitude and longitude values
                        if (is_numeric($latitude) && is_numeric($longitude)) {
                            try {
                                $pharmacies = $patientModel->searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range);

                                if (!empty($pharmacies)) {
                                    $response['data'] = $pharmacies;
                                    $result->setErrorStatus(false);
                                    $result->setMessage("Pharmacy list ready");
                                } else {
                                    $result->setErrorStatus(true);
                                    $result->setMessage("No pharmacies found within the specified range");
                                }
                            } catch (Exception $e) {
                                $result->setErrorStatus(true);
                                $result->setMessage("Something went wrong: " . $e->getMessage());
                            }
                        } else {
                            $result->setErrorStatus(true);
                            $result->setMessage("Invalid latitude or longitude values");
                        }
                    } else {
                        $result->setErrorStatus(true);
                        $result->setMessage("Invalid auth token");
                    }
                } catch (Exception $e) {
                    $result->setErrorStatus(true);
                    $result->setMessage("Something went wrong" . $e->getMessage());
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Missing required query parameters");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Invalid Authorization header format");
        }


        // Set result in response
        $response['error'] = $result->isError();
        $response['message'] = $result->getMessage();

        echo json_encode($response);
    }
}

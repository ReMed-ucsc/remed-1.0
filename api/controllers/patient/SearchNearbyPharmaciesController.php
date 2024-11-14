<?php

require_once BASE_PATH . '/app/models/Patient.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class SearchNearbyPharmaciesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $_SERVER['HTTP_AUTH'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();

            if (isset($_GET['latitude']) && isset($_GET['longitude'])) {
                $latitude = $_GET['latitude'];
                $longitude = $_GET['longitude'];
                $range = isset($_GET['range']) ? $_GET['range'] : 10; // Default range is 10 km

                try {
                    $patient = $patientModel->first(['token' => $authToken]);

                    if ($patient) {
                        $pharmacyList = $patientModel->searchNearbyPharmacy($latitude, $longitude, $range);

                        if (!empty($pharmacyList)) {
                            $response['data'] = $pharmacyList;
                            $result->setErrorStatus(false);
                            $result->setMessage("Nearby pharmacies found");
                        } else {
                            $result->setErrorStatus(true);
                            $result->setMessage("No pharmacies found within the range");
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
                $result->setMessage("Latitude and longitude are required");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Invalid Authorization header format");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}

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

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $authToken = $matches[1];

            $patientModel = new Patient();

            if (!empty($data['latitude']) && !empty($data['longitude'])) {
                $latitude = $data['latitude'];
                $longitude = $data['longitude'];
                $range = $data['range'] ?? 10;

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
                    $result->setMessage("Something went wrong");
                }
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Latitude and longitude are required");
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Invalid Authorization header format");
        }

        $response['error'] = $result->isError();
        $response['message'] = $result->getMessage();
        echo json_encode($response);
    }
}

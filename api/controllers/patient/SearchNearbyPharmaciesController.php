<?php

require_once BASE_PATH . '/app/models/Pharmacy.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class SearchNearbyPharmaciesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // Get query parameters
        if (isset($_GET['latitude']) && isset($_GET['longitude'])) {
            $latitude = $_GET['latitude'];
            $longitude = $_GET['longitude'];
            $range = isset($_GET['range']) ? $_GET['range'] : 10; // Default range is 10 km

            try {
                $pharmacyModel = new Pharmacy();
                $pharmacyList = $pharmacyModel->searchNearbyPharmacy($latitude, $longitude, $range);

                if (!empty($pharmacyList)) {
                    $response['data'] = $pharmacyList;
                    $result->setErrorStatus(false);
                    $result->setMessage("Nearby pharmacies found");
                } else {
                    $result->setErrorStatus(true);
                    $result->setMessage("No pharmacies found within the range");
                }
            } catch (Exception $e) {
                $result->setErrorStatus(true);
                $result->setMessage("Something went wrong: " . $e->getMessage());
            }
        } else {
            $result->setErrorStatus(true);
            $result->setMessage("Latitude and longitude are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}

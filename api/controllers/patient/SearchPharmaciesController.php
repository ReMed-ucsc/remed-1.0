<?php

require_once BASE_PATH . '/app/models/InventoryView.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class SearchPharmaciesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // Get query parameters
        if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['productIDs'])) {
            $latitude = $_GET['latitude'];
            $longitude = $_GET['longitude'];
            $productIDs = explode(',', $_GET['productIDs']); // Assume productIDs are comma-separated in the query
            $range = isset($_GET['range']) ? $_GET['range'] : 10; // Default range is 10 km

            try {
                $inventoryModel = new InventoryView();
                $pharmacies = $inventoryModel->searchPharmaciesWithMedicines($latitude, $longitude, $productIDs, $range);

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
            $result->setMessage("Latitude, longitude, and productIDs are required");
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}

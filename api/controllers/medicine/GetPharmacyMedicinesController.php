<?php

require_once BASE_PATH . '/app/models/MedicineProductView.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetPharmacyMedicinesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        // Get search and pagination parameters from the request
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

        try {
            $inventoryViewModel = new DrugInventory();
            $productIDList = $inventoryViewModel->getPhramcyInventoryMedicines($_GET['pharmacyID']);

            $productIDs = array_map(function ($item) {
                return $item->ProductID;
            }, $productIDList);


            $medicineModel = new MedicineProductView();
            $medicineList = $medicineModel->getPharmacyMedicineList($productIDs, $searchQuery, $limit, $offset);

            if (!empty($medicineList)) {
                $response['data'] = $medicineList;
                $result->setErrorStatus(false);
                $result->setMessage("Medicine list ready");
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("No medicines found");
            }
        } catch (Exception $e) {
            $result->setErrorStatus(true);
            $result->setMessage("Something went wrong: " . $e->getMessage());
        }

        $response['result']['error'] = $result->isError();
        $response['result']['message'] = $result->getMessage();
        echo json_encode($response);
    }
}

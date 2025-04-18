<?php

require_once BASE_PATH . '/app/models/MedicineProductView.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class CheckForOverTheCounterController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        $productIDs = isset($_GET['productIDs']) ? $_GET['productIDs'] : null;

        $productIDs = explode(',', $productIDs);

        try {
            $manufacturedDrugModel = new ManufacturedDrug();
            $drugIDs = $manufacturedDrugModel->getDrugIDs($productIDs);

            // show($drugIDs);
            $drugModel = new Drug();
            $overTheCounterbility = $drugModel->checkForOverTheCounter($drugIDs);

            if ($overTheCounterbility) {
                $result->setErrorStatus(false);
                $result->setMessage("All drugs are over the counter");
            } else {
                $result->setErrorStatus(true);
                $result->setMessage("Some drugs are not over the counter");
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

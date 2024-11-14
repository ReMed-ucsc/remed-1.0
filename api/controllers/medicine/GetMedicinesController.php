<?php

require_once BASE_PATH . '/app/models/Medicine.php';
require_once BASE_PATH . '/app/core/init.php';
require_once BASE_PATH . '/app/core/helper_classes.php';

class GetMedicinesController
{
    public function index()
    {
        $response = array();
        $result = new Result();

        try {
            $medicineModel = new Medicine();
            $medicineList = $medicineModel->getMedicineList();

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

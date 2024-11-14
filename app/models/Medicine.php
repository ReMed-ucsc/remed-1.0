<?php

class Medicine
{
    use Model;

    protected $table = 'MedicineProducts';
    protected $allowedColumns = ['ProductID', 'ProductName', '	genericName', 'ManufactureName', '	strength'];
    protected $order_column = "ProductID";

    public function getMedicineList()
    {
        $medicines = $this->selectWhere(['ProductName'], [], []);
        $medicineNames = array_map(function ($medicine) {
            return $medicine->ProductName;
        }, $medicines);

        return $medicineNames;
    }
}

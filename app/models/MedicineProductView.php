<?php

class MedicineProductView
{
    use Model;

    protected $table = 'MedicineProducts';
    protected $allowedColumns = ['ProductID', 'ProductName', 'genericName', 'ManufactureName', 'strength'];
    protected $order_column = "ProductID";

    public function getFilteredMedicineList($searchQuery = '', $limit = 10, $offset = 0)
    {
        $this->setLimit($limit);
        $this->setOffset($offset);

        $where = [];
        if (!empty($searchQuery)) {
            $where = [
                'ProductName' => ['operator' => 'LIKE', 'value' => '%' . $searchQuery . '%'],
                // 'strength' => ['operator' => '!=', 'value' => '20mg']
                // 'strength' => ['in' => ['25mg', '20mg']]
            ];
            // $where = ['ProductName' => '%' . $searchQuery . '%'];
        }

        $medicines = $this->selectWhere(['ProductID', 'ProductName'], $where);
        // $medicineNames = array_map(function ($medicine) {
        //     return $medicine->ProductName;
        // }, $medicines);

        return $medicines;
    }
}

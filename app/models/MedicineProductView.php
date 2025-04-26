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

    public function getPharmacyMedicineList($productIDs, $searchQuery = '', $limit = 10, $offset = 0)
    {
        $this->setLimit($limit);
        $this->setOffset($offset);

        $where = [
            'ProductID' => ['in' => $productIDs]
        ];

        if (!empty($searchQuery)) {
            $where = [
                'ProductName' => ['operator' => 'LIKE', 'value' => '%' . $searchQuery . '%'],
                'ProductID' => ['in' => $productIDs]
            ];
        }

        return $this->selectWhere(['ProductID', 'ProductName'], $where);
    }

    public function getNewMedicineList($productIDs, $searchQuery = '', $limit = 10, $offset = 0)
    {
        $this->setLimit($limit);
        $this->setOffset($offset);

        $where = [
            'ProductID' => ['not in' => $productIDs],
        ];

        if (!empty($productIDs)) {
            $where = [
                'ProductName' => ['operator' => 'LIKE', 'value' => '%' . $searchQuery . '%'],
                'ProductID' => ['not in' => $productIDs],
            ];
        }

        return $this->selectWhere(['ProductID', 'ProductName'], $where);
    }

    public function getMedicineName($productId)
    {
        $result =  $this->selectWhere(['ProductName'], ['productId' => $productId]);

        if ($result) {
            return $result[0]->ProductName;
        }

        return null; // Return null if no result is found
    }
}

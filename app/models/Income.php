<?php

class Income
{
    use Model;

    protected $table = "medicineOrder";
    protected $allowedColumns = ['PharmacyID', 'totalBill', 'orderId'];

    public function getIncome($pharmacyId, $month, $year)
    {

        $query = "
            SELECT medicineOrder.orderId, medicineOrder.totalBill, medicineOrder.patientId, medicineOrder.date
            FROM medicineOrder
            WHERE PharmacyID = :pharmacyId
            AND MONTH(medicineOrder.date) = :Month
            AND YEAR(medicineOrder.date) = :Year;
        ";
        $data = [
            'pharmacyId' => $pharmacyId,
            'Month' => $month,
            'Year' => $year
        ];

        $income = $this->query($query, $data);

        //show($income);

        return $income;
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
class ImportExcel implements ToModel, WithChunkReading,WithStartRow	
{
    public function model(array $row)
    {
    	// calling transform date function
    	$data = $this->transformDate($row[5]);
    	// calling transform date function

        return new PracticalTests([
            'order_id'     => $row['0'],
            'pin_type_id'    => $row['1'], 
            'payment_type'    => $row['2'], 
            'customer_name'    => $row['3'], 
            'full_address'    => $row['4'], 
            'order_date'    => $data->format('Y-m-d H:i:s'), 
            'price'    => $row['6'], 
            'quantity'    => $row['7'], 
            'product_name'    => $row['8'], 
        ]);
    }
      public function chunkSize(): int
    {
        return 1000;
    }
      public function startRow(): int
    {
        return 2;
    }
    public function transformDate($value, $format = 'Y-m-d')
	{
	    try {
	        return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
	    } catch (\ErrorException $e) {
	        return \Carbon\Carbon::createFromFormat($format, $value);
	    }
	}


}

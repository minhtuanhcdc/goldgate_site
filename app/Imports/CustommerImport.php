<?php

namespace App\Imports;

use App\Models\Custommer;
use App\Models\Billtest;
use App\Models\Billname;
use App\Models\Ousent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Carbon\Carbon;

class CustommerImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError
{
use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {



        foreach ($rows as $row)
        {
            if(($row['ma_thinprep'] !=null && $row['donvi_guimau'] !=null) || ($row['ma_hpv'] !=null && $row['donvi_guimau'] !=null)){
//Stt	ma_thinprep	hpv_code	ten_benhnhan	nam_sinh	donvi_guimau	dia_chi	para	so_dienthoai
//bacsi_chidinh	chidinh_xetnghiem	ngay_laymau	kinhchot	ngay_nhanmau	ghi_chu
$checkHpv = Billtest::where('hpv_code',$row['ma_hpv'])->first();
$checkThin = Billtest::where('thinprep_code',$row['ma_thinprep'])->first();

                if(!$checkHpv || !$checkThin){
                $custommerId = Custommer::insertGetId([
                    'name' => $row['ten_benhnhan'],
                    'gender' => 0,
                    'birthday' => $row['nam_sinh'],
                    'address' => $row['dia_chi'],
                    'phone' => $row['so_dienthoai'],

                ]);

           $readCode =   substr ( $row['ma_thinprep'] ,0, 2 );
           $ousentGet = Ousent::where('name', 'like', '%' . $row['donvi_guimau'] . '%')->first();
           $IdOusent = $ousentGet? $ousentGet->id:34;
                $Id_bill=Billtest::insertGetId([
                'custommer_id' =>$custommerId,
                'ousent_id' => $IdOusent,
                //'ousent_id' => $row['donvi_guimau'],

                'doctor_indi' => $row['bacsi_chidinh'],
                //'diagnose' => $row['diagnose'],
                'para' => $row['para'],
                'kinhchot' => $row['kinhchot'],


                'thinprep_code' => $row['ma_thinprep'],
                'read_code' => $readCode,
                'hpv_code' => $row['ma_hpv'],
                'asign_view' => $row['an_nguoiki'],
                'note' => $row['ghi_chu'],

                'date_sent' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_laymau'])->format('Y-m-d'),
                'date_receive' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_nhanmau'])->format('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),

            ]);

            Billname::create([
                'billtest_id' =>$Id_bill,
                'testname_id' => $row['chidinh_xetnghiem'],
            ]);
      }
      }

    }
   }

    public function rules(): array
    {
        return [


            'ma_thinprep'=>'nullable|unique:billtests,thinprep_code',
            'ma_hpv'=>'nullable|unique:billtests,hpv_code',
        ];
    }

    public function customValidationMessages()
        {
            return [
             //'name.required' => 'Tên trống',
            'ma_thinprep.unique' => 'Trùng mã Thinrep_code',
            'ma_hpv.unique' => 'Trùng mã hpv',

            ];
        }

}





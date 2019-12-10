<?php

namespace App\Exports;

use App\Product;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Id',
            'Nombre',
            'Email',
            'Precio Total',
        ];
    }

    private $vInicio;
    private $vFin;
    public function __construct($Inicio,$Fin)
    {
      $this->vInicio=$Inicio;
      $this->vFin=$Fin;
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {

         $orders=DB::table('orders')
         ->join('users','user_id','=','users.id')
         ->whereBetween('orders.created_at',[$this->vInicio." 00:00:00 ",$this->vFin." 23:59:59 "])
         ->select('orders.id','orders.name','users.email','orders.totalPrice')
         ->get();
           return $orders;
         // var_dump($this->r1->inicio);

    }
}

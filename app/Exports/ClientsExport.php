<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Clients;

class ClientsExport implements FromCollection,WithHeadings {

  public function headings(): array {
    return [
       "first_name","last_name","phone_number"
    ];
  }

  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {

     return collect(Clients::getClients());
  }
}
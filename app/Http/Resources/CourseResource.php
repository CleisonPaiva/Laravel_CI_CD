<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //Retona tudo
        //Exemplo :
        //"data": {
        //        "name": "Curso 1",
        //        "description": "Descrição curso 1",
        //        "uuid": "410086f3-2469-44c5-a433-a44c65a35f25",
        //        "updated_at": "2021-10-22T21:46:08.000000Z",
        //        "created_at": "2021-10-22T21:46:08.000000Z",
        //        "id": 1
        //    }
       // return parent::toArray($request);


        //Retorna o campo que quiser,ou ate mesmo muda o nome dele  :  'identify'=>$this->uuid,
        // ou formatar campos de data com o Carvon como no exemplo abaixo
        //Exemplo :
        // "data": {
        //         "uui": "a78e1bf7-327b-4702-bbac-243800179df8",
        //        "name": "Curso 5",
        //        "description": "Descrição curso 5",
        //        "date": "22-10-2021
        //  }

        return[
           'uui'=>$this->uuid,
           'name'=>$this->name,
           'description'=>$this->description,
            'date'=>Carbon::make($this->created_at)->format('d-m-Y')
        ];
    }
}

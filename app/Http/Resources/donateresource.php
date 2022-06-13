<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class donateresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'amount'=>$this->amount,
            'reason'=>$this->reason,
            'explain'=>$this->explain,
            'message'=>$this->message,
           "referencecode"=>$this->referencecode,
        ];
    }
}

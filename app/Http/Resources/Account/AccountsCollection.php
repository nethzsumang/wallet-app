<?php

namespace App\Http\Resources\Account;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Formats resource response
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $data = $response->getData(true);
        unset($data['meta']['links']);
        unset($data['links']);
        $response->setData($data);
    }
}

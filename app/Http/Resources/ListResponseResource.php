<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResponseResource extends JsonResource
{
    //define properti
    public $status;
    public $message;
    public $resource;
    public $page;
    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $message, $page, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
        $this->page = $page;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'page'      => $this->page,
            'data'      => $this->resource
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Content extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'type'        => $this->type,
            'week'        => $this->week,
            'day'         => $this->day,
            'title'       => $this->title,
            'content'     => $this->content,
            'source'      => $this->source,
            'source_type' => $this->source_type,
            'preview'     => $this->preview,
        ];
    }
}

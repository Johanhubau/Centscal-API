<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title." - ".$this->association->name,
            'groupId' => $this->asso_id,
            'start' => $this->start,
            'end' => $this->end,
            'allDay' => (boolval($this->all_day) ? 'true' : 'false'),
            'color' => $this->association->color,
            'url' => $this->url,
            'source' => $this->source
        ];
    }
}

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
        $ret = [
            'id' => $this->id,
            'title' => $this->title." - ".$this->association->name,
            'start' => $this->start,
            'end' => $this->end,
            'assoId' => $this->asso_id,
            'color' => $this->association->color,
            'allDay' => (boolval($this->all_day) ? 'true' : 'false'),
        ];
        if ($this->url != null){
            $ret['url'] = $this->url;
        }
        if ($this->source != null){
            $ret['source'] = $this->source;
        }
        return $ret;
    }
}

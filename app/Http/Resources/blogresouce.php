<?php

namespace App\Http\Resources;

use App\Models\comment;
use App\Models\likes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class blogresouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'heading'=>$this->heading,
            'body'=>$this->body,
            'author'=>$this->author,
            'comment'=>optional(comment::where('blog_id', $this->blog_id))->comment,
            'like'=>optional(likes::where('blog_id', $this->blog_id))->is_like
        ];
    }
}

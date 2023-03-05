<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // instance model users for get data users
        $user = new User();
        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'user' => $user->where('id', $this->users_id)->first(),
                'artikel' => ArticlesResource::collection($this->articles)
            ];
    }
}

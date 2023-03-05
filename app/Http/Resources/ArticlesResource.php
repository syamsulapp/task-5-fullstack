<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = new User();
        return
            [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'image' => storage_path($this->image),
                'users' => $user->where('id', $this->users_id)->first()
            ];
    }
}

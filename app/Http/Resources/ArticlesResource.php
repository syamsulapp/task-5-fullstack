<?php

namespace App\Http\Resources;

use App\Models\Categories;
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
        $category = new Categories();
        return
            [
                'id' => $this->id,
                'title' => $this->title,
                'content' => $this->content,
                'image' => url('img_articles', $this->image),
                'users' => $user->where('id', $this->users_id)->first(),
                'created_at' => date($this->created_at),
                'updated_at' => date($this->updated_at),
                'category' => $category->where('id', $this->category_id)->first()
            ];
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles as DataArticle;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class Articles extends Controller
{
    protected $article;
    protected $user;
    public function __construct(DataArticle $article, User $user)
    {
        $this->article = $article;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $limit = 50; // limit default

        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        $data = $this->article->when($request->name, function ($query) use ($request) {
            return $query->where('title', 'LIKE', "%{$request->name}%");
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('users_id', $request->user_id);
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })
            ->orderBy('id')
            ->paginate($limit);

        return $this->resBuilder($data->items());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($validate->fails()) {
            $result = $this->customError(collect($validate->errors()));
        } else {
            $data = $request->only('title', 'content', 'image', 'users_id', 'category_id');
            $data['users_id'] = $this->user->user()->id;
            $data['image'] = $request->file('image')->store('image');
            $result =  $this->resBuilder($this->article->create($data), 200, 'Successfully Create Articles');
        }
        return $result;
    }
    public function update($id, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($validate->fails()) {
            $result = $this->customError(collect($validate->errors()));
        } else {
            $update = $request->only('title', 'content', 'image', 'category_id');

            if ($request->image != null) {
                $update['image'] = $request->file('image')->store('image');
                !$this->article->where('id', $id)->first() ? $result = $this->resBuilder($request, 422, 'id tidak di temukan') :
                    $result = $this->resBuilder($this->article->where('id', $id)->update($update), 200, 'Successfully update articles');
            } else {
                !$this->article->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
                    $result = $this->resBuilder($this->article->where('id', $id)->update($update), '200', 'Successfully Update Articles');
            }
        }

        return $result;
    }
    public function delete($id)
    {
        !$this->article->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
            $result = $this->resBuilder($this->article->where('id', $id)->delete(), 200, 'successfully delete articles');
        return $result;
    }
}

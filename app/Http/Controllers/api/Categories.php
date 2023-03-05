<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\DetailResource;
use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\Categories as DataCategory;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class Categories extends Controller
{
    protected $category;
    protected $user;
    public function __construct(DataCategory $category, User $user)
    {
        $this->category = $category;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $limit = 50; // limit default

        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        $data = $this->category->when($request->name, function ($query) use ($request) {
            return $query->where('name', 'LIKE', "%{$request->name}%");
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('users_id', $request->user_id);
        })
            ->orderBy('id')
            ->paginate($limit);

        return $this->resBuilder(['categories' => $data->items(), 'total' => $this->category->count()]);
    }

    public function detail($id)
    {
        !$this->category->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
            $result = $this->resBuilder(DetailResource::collection($this->category->whereId($id)->with('articles')->get()), 200, 'Successfuly Detail Category');
        return $result;
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validate->fails()) {
            $result = $this->customError(collect($validate->errors()));
        } else {
            $data = $request->only('name', 'users_id');
            $data['users_id'] = $this->user->user()->id;
            $result =  $this->resBuilder($this->category->create($data), 200, 'Successfully Create category');
        }
        return $result;
    }
    public function update($id, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validate->fails()) {
            $result = $this->customError(collect($validate->errors()));
        } else {
            !$this->category->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
                $result = $this->resBuilder($this->category->where('id', $id)->update($request->only('name')), 200, 'Successfully update categories');
        }

        return $result;
    }
    public function delete($id)
    {
        !$this->category->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
            $result = $this->resBuilder($this->category->where('id', $id)->delete(), 200, 'successfully delete category');
        return $result;
    }
}

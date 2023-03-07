<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticlesResource;
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

    public function detail($id)
    {
        if ($this->article->where('id', $id)->first())
            return $this->resBuilder($this->article->whereId($id)->first(), 200, 'Successfully Detail Articles');

        return $this->resBuilder($id, 422, 'id tidak di temukan');
    }

    public function index(Request $request)
    {
        $limit = 50; // limit default 50

        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }

        // search data
        $data = $this->article->when($request->name, function ($query) use ($request) {
            return $query->where('title', 'LIKE', "%{$request->name}%");
        })->when($request->user_id, function ($query) use ($request) {
            return $query->where('users_id', $request->user_id);
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })
            ->orderBy('id')
            // pagination
            ->paginate($limit);

        return $this->resBuilder(['articles' => ArticlesResource::collection($data->items()), 'total' => $this->article->count()]);
    }

    public function store(Request $request)
    {

        // validate request untuk request tambah
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
            // request for upload foto
            $foto = $request->file('image');
            $nama_file = time() . "-" . $foto->getClientOriginalName();
            $file_up = 'img_articles';
            $foto->move($file_up, $nama_file);
            //save name file foto
            $data['image'] = $nama_file;
            $result =  $this->resBuilder($this->article->create($data), 200, 'Successfully Create Articles');
        }
        return $result;
    }
    public function update($id, Request $request)
    {
        // validate request untuk request update
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
            // jika imagenya di kosongkan maka gambar tidak di update
            if ($request->image != null) {
                // request update foto
                $foto = $request->file('image');
                $nama_file = time() . "-" . $foto->getClientOriginalName();
                $file_up = 'img_articles';
                $foto->move($file_up, $nama_file);

                //put the image for update
                $update['image'] = $nama_file;
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
        // delete menggunakan id articles
        !$this->article->where('id', $id)->first() ? $result = $this->resBuilder($id, 422, 'id tidak di temukan') :
            $result = $this->resBuilder($this->article->where('id', $id)->delete(), 200, 'successfully delete articles');
        return $result;
    }
}

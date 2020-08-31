<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class PostService
{
    /**
     * @param Request $request
     * @return Post|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|string
     */
    public function getAllPosts(Request $request)
    {
        $inputs = $request->all();
        if (empty($inputs)) {
            $posts = Post::all();
        } else {
            $posts = DB::table('posts');
            foreach ($inputs as $key => $value) {
                switch ($key) {
                    case 'title':
                        $posts -> where('title', 'LIKE', '%' . $value . '%');
                        break;
                }
            }
            $posts = $posts->get();
        }

        if ($posts) {
            return $posts;
        }

        return 'Data not found';
    }

    /**
     * @param $id
     * @return string
     */
    public function getPost($id)
    {
        if ($id) {
            $post = Post::findOrFail($id);

            if ($post) {
                return $post;
            }

            return 'Data not found';
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createPost(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = Post::create($input);

        return $post;
    }

    public function updateAction()
    {
        // TODO: Implement updateAction() method.
    }

    public function deleteAction()
    {
        // TODO: Implement deleteAction() method.
    }
}

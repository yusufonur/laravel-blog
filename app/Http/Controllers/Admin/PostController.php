<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\Post;

class PostController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = Post::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostService $postService, Request $request, Authenticatable $auth)
    {
        $posts = $postService->getPaginated(config('app.url_admin').'/posts');
        $canEdit = $auth->can('edit', $this->modelPolicy->find(1));
        $canDelete = $auth->can('destroy', $this->modelPolicy->find(1));

        $this->isEmptyPaginated($posts, $request);

        return view(config('app.theme').'admin.posts.index', [
            'posts' => $posts,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryService $categoryService, TagService $tagService, Authenticatable $auth)
    {
        return view(config('app.theme').'admin.posts.create', [
            'tags' => $tagService->getAllNameId(),
            'categories' => $categoryService->getAllTitleId(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostService $postService, Authenticatable $auth)
    {
        $postService->create($request->all(), $request->relationData, $auth);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostService $postService, CategoryService $categoryService, TagService $tagService, Authenticatable $auth)
    {
        $post = $postService->getByIdWithSeo($id);

        return view(config('app.theme').'admin.posts.edit', [
            'post' => $post,
            'tags' => $tagService->getAllNameId(),
            'selectedTags' => $tagService->getId($post->tags),
            'categories' => $categoryService->getAllTitleId(),
            'selectedCategories' => $categoryService->getId($post->categories),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id, PostService $postService, Authenticatable $auth)
    {
		// get current logged in user
		$user = Auth::user();

		// load post
		$post = Post::find(1);

		if ($user->can('update', $post)) {
			echo "Current logged in user is allowed to update the Post: {$post->id}";
		} else {
			echo 'Not Authorized.';
		}

		$this->authorize('view', $post);

        $postService->update($request->all(), $request->relationData, $id, $auth);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostService $postService, Authenticatable $auth)
    {
        $postService->destroy($id);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }
}

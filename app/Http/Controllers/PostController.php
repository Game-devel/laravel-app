<?php

namespace App\Http\Controllers;

use App\Models\post\Post;
use App\Models\post\repositories\PostRepository;
use App\Models\post\requests\PostRequest;
use App\Services\DummyJsonService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    protected $dummyJsonService;
    protected $postRepository;

    public function __construct(DummyJsonService $dummyJsonService, PostRepository $postRepository)
    {
        $this->dummyJsonService = $dummyJsonService;
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        $dummyPost = $this->dummyJsonService->getPostById(rand(0, 150));
        foreach ($posts as $post) {
            $post->title = $dummyPost['title'];
            $post->body = $dummyPost['body'];
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request)
    {
        // dummyJson always get 151 id, not create
        $dummyPost = $this->dummyJsonService->createPost($request->all());
        $post = Post::create(Auth::id(), $dummyPost['id']);
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $post = $this->postRepository->findOrFail($id);
        // Get random dummyPost (0, 150)
        $dummyPost = $this->dummyJsonService->getPostById(rand(0, 150));
        $post->title = $dummyPost['title'];
        $post->body = $dummyPost['body'];
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit($id)
    {
        $post = $this->postRepository->findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post');
        }

        $dummyPost = $this->dummyJsonService->getPostById(rand(0, 150));
        $post->title = $dummyPost['title'];
        $post->body = $dummyPost['body'];

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->postRepository->findOrFail($id);
        if ($post->user_id !== Auth::id()) { // Проверяем, что пользователь является автором поста
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post');
        }

        $dummyPost = $this->dummyJsonService->updatePost(rand(0, 150), $request->all());
        if (empty($dummyPost)) {
            return redirect()->route('posts.index')->with('error', 'Dummy Post not updated');
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $post = $this->postRepository->findOrFail($id);
        if ($post->user_id !== Auth::id()) { // Проверяем, что пользователь является автором поста
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post');
        }
        $dummyPost = $this->dummyJsonService->deletePost(rand(0, 150));
        if (empty($dummyPost)) {
            return redirect()->route('posts.index')->with('error', 'Dummy Post not deleted');
        }

        $this->postRepository->delete($post);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}

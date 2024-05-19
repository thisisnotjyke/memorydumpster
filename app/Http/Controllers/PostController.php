<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return response()->view('posts.index', compact('posts'));
    }

    public function create(): Response
    {
        return response()->view('posts.form');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $post = new Post($validated);

        if ($request->hasFile('featured_image')) {
            $filePath = $request->file('featured_image')->store('images/posts/featured-images', 'public');
            $post->featured_image = $filePath;
        }

        $post->save();
        session()->flash('notif.success', 'Memory created successfully!');
        return redirect()->route('posts.index');
    }

    public function show(Post $post): Response
    {
        return response()->view('posts.show', compact('post'));
    }

    public function edit(Post $post): Response
    {
        return response()->view('posts.form', compact('post'));
    }

    public function update(UpdateRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            Storage::disk('public')->delete($post->featured_image);
            $filePath = $request->file('featured_image')->store('images/posts/featured-images', 'public');
            $validated['featured_image'] = $filePath;
        }

        $post->update($validated);
        session()->flash('notif.success', 'Memory updated successfully!');
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
        Storage::disk('public')->delete($post->featured_image);
        $post->delete();
        session()->flash('notif.success', 'Memory deleted successfully!');
        return redirect()->route('posts.index');
    }
}

<?php

class PostsController extends BaseController {

    protected $title = 'Posts';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('posts.index')->with(array(
            'entities' => Post::all(),
            'title' => $this->title
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('posts.create')->with('title', $this->title .' - Cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $post = new Post(Input::all());
        if($post->save()){
            return Redirect::route('admin.posts.index');
        }

        return Redirect::back()->withInput()->withErrors($post->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(!$post) {
            return Redirect::back()->withInput()->withErrors(array('not_found' => 'Post não encontrado'));
        }

        return View::make('posts.edit')->with(array('entity' => $post, 'title' => $this->title .' - Editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $post = Post::find($id);
        $post->fill(Input::all());
        if($post->save()){
            return Redirect::route('admin.posts.index');
        }

        return Redirect::back()->withInput()->withErrors($post->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}

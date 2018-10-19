<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivateDiscussion;

class privateDiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group_id)
    {
        //

        return view("groups.privateDiscussions.create")->with('group_id',$group_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group_id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
                // Create Post
        $post = new PrivateDiscussion;
        $post->category = $request->input('category');
        $post->title = $request->input('title');
        $post->user_id = auth()->user()->id;
        $post->group_id = $group_id;
        $post->content = $request->input('body');
        $post->save();

        return redirect('groups/'.$group_id)->with('success', 'Discusson Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id,$discussion_id)
    {
        //
        $post = PrivateDiscussion::find($discussion_id);

        return view("groups.privateDiscussions.show")->with("post",$post)->with('group_id',$group_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id,$user_id)
    {
        //
        $post = PrivateDiscussion::find($user_id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('groups/'.$group_id)->with('error', 'Unauthorized Page');
        }

        return view('groups.privateDiscussions.edit')->with('post', $post)->with('group_id',$group_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group_id,$id)
    {


        $post = PrivateDiscussion::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('body');

        $post->save();

        return redirect('groups/'.$group_id.'/discussions/'.$id)->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id,$id)
    {
        //
        $post = PrivateDiscussion::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('groups/'.$group_id)->with('error', 'Unauthorized Page');
        }



        $post->delete();
        return redirect('groups/'.$group_id)->with('success', 'Post Removed');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use App\Channel;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel)
    {
        $threads = [];
        if ($channel->exists)
        {
            $threads = $channel->threads()->latest()->get();
        } else
        {
            $threads = Thread::latest()->get();
        }
        return view('threads.index', compact('threads', 'channel'));
    }

    /**
     * Show the form for creating a new thread.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Persist a newly created thread in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
             'slug' =>   'required',
             'body' =>    'required'
            ]);
        auth()->user()->startConversation($request->all());

        return redirect('/threads');
    }

    public function reply(Request $request, Channel $channel, Thread $thread)
    {
        $this->validate($request, [
             'body' =>    'required'
            ]);
        $thread->addReply($request->all());

        return redirect($thread->link());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        $thread = $thread->load('replies', 'creator');
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

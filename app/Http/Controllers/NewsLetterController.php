<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\newsletter\storeNewsLetter;
use App\Http\Requests\admin\newsletter\updateNewsLetter;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = NewsLetter::query()->orderBy("created_at","desc")->get();
        return view('admin.newsletter.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeNewsLetter $request)
    {
        NewsLetter::query()->create([
            'email' => $request->email,
        ]);


        return redirect()->route('newsletters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsletter =NewsLetter::find($id);

        return view('admin.newsletter.edit', compact( 'newsletter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateNewsLetter $request, $id)
    {
        $newsletter=NewsLetter::find($id);
        $newsletter->email=$request->email;
        $newsletter->save();
        return redirect()->route('newsletters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter =NewsLetter::find($id);
        $newsletter->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();
    }
}

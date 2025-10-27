<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::orderBy('id', 'DESC')->get();
        return view('community', compact('communities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:200',
            'descr'   => 'required|string|max:1500',
            'author'  => 'required|string',
        ], [
            'title.required'  => 'Please enter a title.',
            'descr.required'  => 'Please write a description.',
            'author.required' => 'Please provide the author name.',
        ]);

        $filter = new ProfanityFilter(config('profanity'), []);

        $filteredTitle = $filter->filter($request->title);
        $filteredDescr = $filter->filter($request->descr);

        if ($filteredTitle !== $request->title || $filteredDescr !== $request->descr) {
            return redirect()->back()->withErrors([
                'title' => 'Your post contains inappropriate words.'
            ])->withInput();
        }


        Community::create([
            'title'   => $filteredTitle,
            'descr'   => $filteredDescr,
            'author'  => $request->author,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('community.index')->with('success', 'Post created successfully!');
    }
}

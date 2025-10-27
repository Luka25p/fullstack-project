<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Manga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;


class ChapterController extends Controller
{
    public function showChapter($id)
    {
        $manga = Manga::findOrFail($id);
        $chapters = Chapter::where('manga_id', $id)->get();

        return view('pages.chapter', compact('manga', 'chapters'));
    }


    public function uploadChapter(Request $request, $id)
    {
        $manga = Manga::findOrFail($id);

        if ($manga->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to add chapters to this manga.');
        }

        $request->validate([
            'title' => 'required|string',
        ]);

        $filter = new ProfanityFilter(config('profanity'), []);

        $filteredTitle = $filter->filter($request->title);

        if ($filteredTitle !== $request->title) {
            return back()->withErrors(['title' => 'Your chapter title contains inappropriate words.']);
        }

        $lastNumber = Chapter::where('manga_id', $manga->id)->max('number');
        $chapterNumber = $lastNumber ? $lastNumber + 1 : 1;

        Chapter::create([
            'title'    => $filteredTitle,
            'manga_id' => $manga->id,
            'number'   => $chapterNumber,
            'user_id'  => Auth::id(),
        ]);

        return back()->with('success', 'Chapter uploaded successfully!');
    }


}

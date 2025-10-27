<?php
namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\MangaPanels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MangaPanelsController extends Controller
{
    public function showMangaPanel($id)
    {
        $chapter = Chapter::findOrFail($id);

        $panels = MangaPanels::where('chapter_id', $id)->get();

        return view('pages.mangaPanel', compact('chapter', 'panels'));
    }

    public function uploadImages(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        if ($chapter->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to upload images to this chapter.');
        }

        $request->validate([
            'images'   => 'required|array|max:15',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads/chapters'), $filename);

                MangaPanels::create([
                    'chapter_id' => $chapter->id,
                    'path' => 'uploads/chapters/' . $filename,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully!');
    }



}


<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Community;
use App\Models\Manga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;

class MangaController extends Controller
{
    public function view(){
        return view('index');
    }
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $mangaQuery = Manga::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $mangaQuery->where(function($query) use ($search) {
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('descr', 'LIKE', "%$search%")
                    ->orWhere('auth', 'LIKE', "%$search%");
            });
        }

        $manga = $mangaQuery->paginate(10);

        if ($request->ajax()) {
            // For AJAX search: return only the cards partial
            return view('partials.manga-list', compact('manga'))->render();
        }

        // For normal page load: pass both manga and search
        return view('index', compact('manga', 'search'));
    }


    public function showregistration() {
        return view('pages.registration'); 
    }

    public function showLog() {
        return view('pages.log');
    }

    public function fantastic(){

        $fantastic = Manga::where('genre', 'FANTASTIC')
                    ->orWhere('genre', 'fantastic')
                    ->get();

        return view('pages.fantastic', compact('fantastic',));
    }

    public function historic(){

        $historic = Manga::where('genre', 'HISTORIC')
                        ->orWhere('genre', 'historic')
                        ->get();

        return view('pages.historic', compact('historic'));
    }

    public function show($id) {
        $manga = Manga::findOrFail($id);

        $dates = Manga::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day')
              ->distinct()
              ->orderBy('year', 'desc')
              ->orderBy('month', 'desc')
              ->orderBy('day', 'desc')
              ->get();
        
        $chapterNumber = Chapter::where('manga_id', $id)
        ->orderBy('number', 'desc')
        ->value('number');

        return view('details', compact('manga', 'dates', 'chapterNumber'));
    }

    public function store(Request $request){
    $request->validate([
        'title'   => 'required|string',
        'descr'   => 'required|string',
        'image'   => 'required|mimes:png,jpg,jpeg,webp',
        'genre'   => 'required|string',
        'auth'    => 'required|string',
    ]);

        $filter = new ProfanityFilter(config('profanity'), []);

        // Filter title and description
        $filteredTitle = $filter->filter($request->title);
        $filteredDescr = $filter->filter($request->descr);

        // Block manga if bad words exist
        if ($filteredTitle !== $request->title || $filteredDescr !== $request->descr) {
            return redirect()->back()->withErrors(['title' => 'Your manga contains inappropriate words.']);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/manga/';
            $file->move($path, $filename);
        }

        Manga::create([
            'title'   => $filteredTitle,
            'descr'   => $filteredDescr,
            'image'   => $path . $filename,
            'genre'   => strtoupper($request->genre),
            'auth'    => $request->auth,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Manga created successfully!');
    }

    public function remove($id)
    {
        $manga = Manga::find($id);

        if ($manga) {
            $imagePath = public_path($manga->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $manga->delete();

            return redirect('dashboard')->with('status', "Data deleted successfully");
        }

        return redirect('dashboard')->with('error', "Manga not found");
    }


    public function create(){

        return view('pages.manga');
    }

    
}

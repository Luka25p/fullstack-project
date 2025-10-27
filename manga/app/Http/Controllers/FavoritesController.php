<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorites;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller{
    
public function toggle(Request $request){
    $mangaId = $request->manga_id;
    $userId = Auth::id();

    $favorite = Favorites::where('user_id', $userId)
                         ->where('manga_id', $mangaId)
                         ->first();
    if($userId == false){
        return view('pages.log');
    }
    else{
        if ($favorite) {
            $favorite->delete();
            return back()->with('delete', 'favorite is removed!');
        } else {
            Favorites::create([
                'user_id' => $userId,
                'manga_id' => $mangaId,
            ]);
            return back()->with('success', 'Manga added to favorites!');
        }
    }
}

public function index()
{
    $favorites = Favorites::where('user_id', Auth::id())
                          ->with('manga') 
                          ->get();

    return view('favorites', compact('favorites'));
}



   
}

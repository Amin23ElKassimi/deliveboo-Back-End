<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class FoodItemController extends Controller
{
    //
    // INDEX
    public function index()
    {
        $foodItems = FoodItem::all();
        return response()->json([
            'success' => true,
            'results' => $foodItems,

        ]);
    }
    // SHOW
    public function show(FoodItem $foodItem)
    {
        return response()->json([
            'success' => true,
            'results' => $foodItem,
        ]);
    }

    public function search(Request $request)
    {
        // Request 
        $data = $request->all();

        // Se data ha find e' settato 
        if (isset($data['find'])) {
            $stringa = $data['find'];
            //                           vvv la colonna dove va a cercare  
            $foodItems = FoodItem::where('name', 'LIKE', "%{$stringa}%")->get();
        } elseif (is_null($data['find'])) {
            $foodItems = FoodItem::all();
        }
        // Altrimenti avbort
        else {
            abort(404);
        }

        return response()->json([
            "success" => true,
            "results" => $foodItems,
            // Contsa quanti proggetti hai trovato  
            "matches" => count($foodItems)
        ]);
    }
}

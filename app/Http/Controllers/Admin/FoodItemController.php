<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\FoodItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
{
    private $validations = [
        'name' => ['required', 'string', 'max:255'],
        'restaurant_id' => ['required', 'exists:restaurants,id'],
        'description' => ['required', 'string', 'min:10', 'max:255'],
        'ingredients' => ['required', 'string', 'min:4', 'max:255'],
        'price' => ['required', 'numeric', 'between:0.01,199.99'],
        'available' => ['required'],
        'image_url' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
    ];
    private $messageError = [
        'name.required' => 'Campo richiesto, inserisci il nome del piatto.',
        'name.max' => 'Superato il numero massimo di 255 caratteri, si prega di ridurre il  numero.',
        'description' => 'Inserisci una descrizione tra i 10 ed i 255 caratteri.',
        'ingredients' => 'Inserisci ingredienti, tra i 4 caratteri ed i 255 caratteri.',
        'price.required' => 'Inserire un prezzo, tra 0.01 e 199.99.',
        'price.numeric' => 'Inserisci un numero.',
        'price.between' => 'Inserire valori positivi tra 0.01 e 199.99.',
        'image_url.required' => 'Inserire un\'immagine.',
        'image_url.image' => 'inserisci un immagine',
        'image_url.max' => 'Supera i limiti di 2048KB consentiti',
        'image_url.mimes' => 'Il file caricato deve essere un formato JPEG, PNG, JPG o GIF.',
        'available' => 'Inserire disponibilità',
    ];
    public function index()
    {
        $user = Auth::user()->id;
        /* $foodItems = FoodItem::where();
        $posts = Post::where('user_id', Auth::id())->orderBy('date')->get(); */

        $foodItems = FoodItem::where('restaurant_id', $user)->get();
        /* $foodItems = FoodItem::getTable('food_items')->where('restaurant_id', $user)->get(); */
        $restaurants = Restaurant::all();
        return view('admin.fooditems.index', compact('foodItems', 'restaurants'));
    }
    public function create()
    {
        $foodItem = new FoodItem();
        $restaurant = Auth::user()->restaurant;
        return view('admin.fooditems.create', compact('foodItem', 'restaurant'));
    }

    public function store(Request $request)
    {
        $price = str_replace(',', '.', $request->price);
        $request->merge(['price' => $price]);
        $foodItemData = $request->validate($this->validations, $this->messageError);

        if ($request->hasFile('image_url')) {
            $image_path = Storage::disk('public')->put('uploads/food_Items', $request->file('image_url'));
            $foodItemData['image_url'] = $image_path;
        }

        $foodItem = FoodItem::create($foodItemData);

        return redirect()->route('admin.fooditems.show', $foodItem);
    }
    // if ($restaurant->user_id !=  Restaurant::where('id', Auth::id())->pluck('id')->first()) {
    //     return to_route('admin.restaunrant.index')->with('Messaggio', 'Non ci sono piatti da visualizzare.');


    public function show(string $id)
    {

        $foodItem = FoodItem::findOrFail($id);
        if (!Gate::allows('edit-foodItem', $foodItem)) {
            abort(403);
        }
        return view('admin.fooditems.show', compact('foodItem'));
    }

    public function edit(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        if (!Gate::allows('edit-foodItem', $foodItem)) {
            abort(403);
        }
        $restaurant = Auth::user()->restaurant;
        return view('admin.fooditems.edit', compact('foodItem', 'restaurant'));
    }


    public function update(Request $request, FoodItem $fooditem)
    {

        $price = str_replace(',', '.', $request->price);
        $request->merge(['price' => $price]);
        $data = $request->validate($this->validations, $this->messageError);
        $image_path = Storage::disk('public')->put('uploads/food_Items', $data['image_url']);
        $data['image_url'] = $image_path;
        $fooditem->update($data);
        $restaurant = Auth::user()->restaurant;

        return redirect()->route('admin.fooditems.show', compact('fooditem', 'restaurant'));
    }

    public function destroy(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        $foodItem->delete();

        return redirect()->route('admin.fooditems.index');
    }
}

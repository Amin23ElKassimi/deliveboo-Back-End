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
        'image_url' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
    ];

    private $messageError = [
        'name.required' => 'Campo richiesto, inserisci il nome del piatto.',
        'name.max' => 'Superato il numero massimo di 255 caratteri, si prega di ridurre il numero.',
        'description.required' => 'Inserisci una descrizione tra i 10 ed i 255 caratteri.',
        'description.min' => 'Inserisci una descrizione di almeno 10 caratteri.',
        'description.max' => 'Inserisci una descrizione di massimo 255 caratteri.',
        'ingredients.required' => 'Inserisci gli ingredienti del piatto.',
        'ingredients.min' => 'Inserisci almeno 4 caratteri per gli ingredienti.',
        'ingredients.max' => 'Inserisci massimo 255 caratteri per gli ingredienti.',
        'price.required' => 'Inserire un prezzo, tra 0.01 e 199.99.',
        'price.numeric' => 'Inserisci un prezzo valido.',
        'price.between' => 'Inserire un prezzo compreso tra 0.01 e 199.99.',
        'image_url.image' => 'Il file caricato deve essere un\'immagine.',
        'image_url.max' => 'Supera i limiti di 2048KB consentiti.',
        'image_url.mimes' => 'Il file caricato deve essere di tipo JPEG, PNG, JPG o GIF.',
        'available.required' => 'Inserire la disponibilità del piatto.',
    ];

    public function index()
    {
        $user = Auth::user()->id;
        $foodItems = FoodItem::where('restaurant_id', $user)->get();
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
        $request->validate($this->validations, $this->messageError);
        $price = str_replace(',', '.', $request->price);
        $image_path = null;

        if ($request->hasFile('image_url')) {
            $image_path = $request->file('image_url')->store('uploads/food_Items', 'public');
        }

        FoodItem::create([
            'name' => $request->name,
            'restaurant_id' => $request->restaurant_id,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $price,
            'available' => $request->available,
            'image_url' => $image_path,
        ]);

        return redirect()->route('admin.fooditems.index');
    }

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
        $request->validate($this->validations, $this->messageError);
        $price = str_replace(',', '.', $request->price);
        $data = [
            'name' => $request->name,
            'restaurant_id' => $request->restaurant_id,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'price' => $price,
            'available' => $request->available,
        ];

        if ($request->hasFile('image_url')) {
            Storage::disk('public')->delete($fooditem->image_url); // Delete old image
            $data['image_url'] = $request->file('image_url')->store('uploads/food_Items', 'public');
        }

        $fooditem->update($data);

        return redirect()->route('admin.fooditems.show', $fooditem);
    }

    public function destroy(string $id)
    {
        $foodItem = FoodItem::findOrFail($id);
        Storage::disk('public')->delete($foodItem->image_url);
        $foodItem->delete();
        return redirect()->route('admin.fooditems.index');
    }
}

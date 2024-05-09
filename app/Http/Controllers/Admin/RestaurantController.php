<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Restaurant;
use App\Models\Category;


class RestaurantController extends Controller
{

    private $validations = [
        'name' => ['required', 'min:2', 'max:100'],
        'vat' => ['required', 'numeric', 'digits:11'],
        'address' => ['required', 'max:255'],
        'phone_number' => ['required', 'numeric'],
        'email' => ['required', 'email'],
        'image_url' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
        'categories' => ['required'],
    ];
    private $messageError = [
        'name.required' => 'Il campo nome è obbligatorio.',
        'name.min' => 'Il campo nome deve essere di almeno 5 caratteri.',
        'name.max' => 'Il campo nome non può superare i 100 caratteri.',
        'vat.required' => 'Il campo partita IVA è obbligatorio.',
        'vat.numeric' => 'Il campo partita IVA deve essere numerico.',
        'vat.digits' => 'La partita IVA deve essere composta da 11 cifre.',
        'address.required' => 'Il campo indirizzo è obbligatorio.',
        'address.max' => 'Il campo indirizzo non può superare i 255 caratteri.',
        'phone_number.required' => 'Il campo numero di telefono è obbligatorio.',
        'phone_number.numeric' => 'Il campo numero di telefono deve essere numerico.',
        'phone_number.digits_between' => 'Il numero di telefono deve essere composto da 9 o 10 cifre.',
        'email.required' => 'Il campo email è obbligatorio.',
        'email.email' => 'Il formato dell\'email non è valido.',
        'image_url.required' => 'Il campo Immagine dell\'immagine è obbligatorio.',
        'image_url.image' => 'inserisci un immagine',
        'image_url.max' => 'Supera i limiti di 2048KB consentiti',
        'image_url.mimes' => 'Il file caricato deve essere un formato JPEG, PNG, JPG o GIF.',
        'categories.required' => 'È richiesta almeno una categoria.',
    ];

    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::id())->get();
        return view('admin.restaurant.index', compact('restaurants'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->restaurant !== null) {
            return redirect()->route('admin.restaurants.index');
        }
        $restaurant = new Restaurant();
        $categories = Category::all();
        return view('admin.restaurant.create', compact('restaurant', 'categories'));
    }

    public function store(Request $request)
    {
        // request + validation
        $data = $request->validate($this->validations, $this->messageError);

        $image_path = Storage::put('uploads/restaurants', $data['image_url']);
        $data['image_url'] = $image_path;

        //Query Select  
        $data['user_id'] = Auth::id();

        $data['categories'] = isset($data['categories']) ? $data['categories'] : [];

        //Query Select  
        $restaurant = Restaurant::create($data);
        $restaurant->categories()->sync($data['categories']);

        // Redirect View
        return redirect()->route('admin.restaurants.index', $restaurant);
    }

    public function show(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::id()) {
            abort(403);
        }
        // Redirect View
        return view('admin.restaurant.show', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant)
    {
        if (!Gate::allows('edit-restaurant', $restaurant)) {
            abort(403);
        }
        if ($restaurant->user_id !== Auth::id()) {
            return redirect()->route('admin.restaurants.index');
        }
        //Query Select  
        $categories = Category::all();
        // Redirect View
        return view('admin.restaurant.edit', compact('restaurant', 'categories'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        if (!Gate::allows('update-restaurant', $restaurant)) {
            abort(403);
        }
        if ($restaurant->user_id !== Auth::id()) {
            abort(403);
        }
        // request + validation
        $data = $request->validate($this->validations, $this->messageError);
        $data['user_id'] = Auth::id();

        $image_url = Storage::put('uploads/restaurants', $data['image_url']);
        $data['image_url'] = $image_url;

        $data['categories'] = isset($data['categories']) ? $data['categories'] : [];

        $restaurant->update($data);

        $restaurant->categories()->sync($data['categories']);

        return redirect()->route('admin.restaurants.index', $restaurant);
    }
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->user_id !== Auth::id()) {
            abort(403); // Accesso negato
        }
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }
}

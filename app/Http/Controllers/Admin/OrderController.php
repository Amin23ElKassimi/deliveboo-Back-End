<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    private $rules = [
        'user_address' => ['required', 'string'], // Campo obbligatorio e deve essere una stringa
        'customer' => ['required', 'string'], // Campo obbligatorio e deve essere una stringa
        'status' => ['required', 'numeric'], // Campo obbligatorio e deve essere una stringa
        'total' => ['required', 'numeric'], // Campo obbligatorio e deve essere un numero
        'user_mail' => ['required', 'email'], // Campo obbligatorio e deve essere un indirizzo email valido
        'user_phone_number' => ['required', 'string'], // Campo obbligatorio e deve essere un numero
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $restaurantId = Auth::user()->id; // ID del ristorante desiderato (puoi passarlo come parametro o recuperarlo da una variabile, ad esempio)
        // dd($restaurantId);
        $orders = Order::whereHas('foodItems.restaurant', function ($query) use ($restaurantId) {
            $query->where('id', $restaurantId);
        })->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $orders = Order::all();
        $order = new Order();
        return view('admin.orders.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate($this->rules);
        $order = Order::create($data);

        return redirect()->route('admin.orders.show',  compact('order'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $order = Order::with('foodItems')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
        $data = $request->all();
        $order->update($data);
        return redirect()->route('admin.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('admin.orders.index');
    }
}

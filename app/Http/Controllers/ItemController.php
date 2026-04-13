<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('category')->withCount(['detailLendings as total_lending' => function ($q) {
            $q->whereHas('lending', function ($q) {
                $q->whereNull('return_date');
            });
        }])->get();

        if(Auth::user()->role == 'admin') {
            return view('item.index', compact('items'));
        }
        return view('item.operator', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required',
        ]);

        Item::create($request->all());

        return redirect()->back()->with('success', 'Item added succeccfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'total' => 'required|numeric',
            'new_repair' => 'nullable|numeric|min:0'
        ]);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'total' => $request->total,
            'repair' => $item->repair + ($request->new_repair ?? 0)
        ]);

        return redirect()->route('item.index')->with('success', 'Item updated succeccfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}

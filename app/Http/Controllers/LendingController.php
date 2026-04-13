<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\DetailLending;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lendings = Lending::with('detailLendings.item', 'user')->withCount('detailLendings')->withSum('detailLendings as total_qty', 'qty')->get();
        return view('lending.index', compact('lendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('lending.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'notes' => 'required',
            'items' => 'required|array|min:1',
            'totals' => 'required|array|min:1'
        ]);

        foreach ($request->items as $i => $itemId) {
            $qty = $request->totals[$i];

            $item = Item::findOrFail($itemId);

            $available = $item->total - $item->repair - $item->detailLendings()
                ->whereHas('lending', function ($q) {
                    $q->whereNull('return_date');
            })->sum('qty');

            if ($qty > $available) {
                return redirect()->back()->with('error', 'Total items more than available');
            }
        }

        $lending = Lending::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'notes' => $request->notes,
            'borrow_date' => now(),
        ]);

        foreach ($request->items as $i => $itemId) {
            $qty = $request->totals[$i];

            DetailLending::create([
                'lending_id' => $lending->id,
                'item_id' => $itemId,
                'qty' => $qty
            ]);
        }

        return redirect()->route('lending.index')->with('success', 'Lending added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        $item->loadCount(['detailLendings as total_lending' => fn($q) => $q->whereHas('lending', fn($q) => $q->whereNull('return_date'))]);

        $lendings = Lending::whereHas('detailLendings', fn($q) => $q->where('item_id', $item->id))->whereNull('return_date')->with(['detailLendings', 'user'])->get();

        return view('Lending.show', compact('lendings', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lending $lending)
    {
        if ($lending->return_date != null) {
            return redirect()->back()->with('error', 'Lending already returned');
        }

        $lending->update([
            'return_date' => now()
        ]);

        return redirect()->back()->with('success', 'Lending returned successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lending $lending)
    {
        if ($lending->return_date == null) {
            foreach ($lending->detailLendings as $detail) {
                $item = $detail->item;
            }
        }

        $lending->detailLendings()->delete();
        $lending->delete();

        return redirect()->back()->with('success', 'Lendingd deleted successfully');
    }
    
    // public function export()
    // {
    //     return Excel::download(new LendingExport, 'lendings.xlsx');
    // }

}

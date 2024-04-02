<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmInventory;

class FarmInventoryController extends Controller
{
    //
    public function index()
    {
        $farms = FarmInventory::paginate(5);
        return response()->json(['farms' => $farms]);
    }

    public function show($id)
    {
        $farms = FarmInventory::findOrFail($id);
        return response()->json(['farms' => $farms]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'input_name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'total' => 'required|numeric', 
            'purchase_date' => 'required|date',
        ]);

        $farms = FarmInventory::create($request->all());
    
        return response()->json(['message' => 'Inventory item created successfully', 'farms' => $farms]);
    }

    public function destroy($id)
    {
        $farms = FarmInventory::findOrFail($id);
        $farms->delete();

        return response()->json(['message' => 'Farm inventory item deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $farms = FarmInventory::findOrFail($id);

        $request->validate([
            'input_name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'total' => 'required|numeric',
            'purchase_date' => 'required|date'
        ]);

        $farms->update($request->all());

        return response()->json(['message' => 'Farm inventory item updated successfully', 'farms' => $farms]);
    }

    public function search($keyword)
    {
        $farms = FarmInventory::where('input_name', 'like', "%$keyword%")->paginate(5);
        return response()->json(['farms' => $farms]);
    }

    public function totalInputCost()
    {
        $data = FarmInventory::all();

        $totals = [
            'total' => $data->sum('total')
        ];

        return response()->json(['totals' => $totals]);
    }

    public function totalInputs()
    {
        $inputs = FarmInventory::count();

        return response()->json(['inputs' => $inputs]);
    }
}

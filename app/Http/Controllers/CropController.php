<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use Illuminate\Http\Request;

class CropController extends Controller
{
    //
    public function index()
    {
        $crops = Crop::paginate(5);
        return response()->json(['crops' => $crops]);
    }

    public function show($id)
    {
        $crops = Crop::findOrFail($id);
        return response()->json(['crops' => $crops]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'harvesting_date' =>'required|date',
        ]);

        $crops = Crop::create($request->all());

        return response()->json(['message' => 'Crop created successfully', 'crops' => $crops]);
    }

    public function destroy($id)
    {
        $crops = Crop::findOrFail($id);
        $crops->delete();

        return response()->json(['message' => 'Crop deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $crops = Crop::findOrFail($id);

        $request->validate([
            'crop_name' => 'required|string|max:255',
            'crop_type' => 'required|string|max:255',
            'planting_date' => 'required|date',
            'harvesting_date' =>'required|date',
        ]);

        $crops->update($request->all());

        return response()->json(['message' => 'Crop updated successfully', 'crops' => $crops]);
    }

    public function search($keyword)
    {
        $crops = Crop::where('crop_name', 'like', "%$keyword%")->paginate(5);
        return response()->json(['crops' => $crops]);
    }
}

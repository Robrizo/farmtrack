<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    
    public function index()
    {
        $finances = Finance::paginate(5);
        return response()->json(['finances' => $finances]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'trans_type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'trans_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $finances = Finance::create($request->all());

        return response()->json(['message' => 'Finance record created successfully', 'finances' => $finances]);
    }

    public function destroy($id)
    {
        $finances = Finance::findOrFail($id);
        $finances->delete();

        return response()->json(['message' => 'Finance record deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $finances = Finance::findOrFail($id);

        $request->validate([
            'trans_type' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'trans_date' => 'required|date',
            'description' => 'required|string|max:255',
        ]);

        $finances->update($request->all());

        return response()->json(['message' => 'Finance record updated successfully', 'finances' => $finances]);
    }

    public function search($keyword)
    {
        $finances = Finance::where('trans_type', 'like', "%$keyword%")->paginate(5);
        return response()->json(['finances' => $finances]);
    }

    public function totalPayments()
    {
        $data = Finance::all();

        $payments = [
            'amount' => $data->sum('amount')
        ];

        return response()->json(['payments' => $payments]);
    }
}

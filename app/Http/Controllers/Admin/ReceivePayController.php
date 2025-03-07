<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReceivePayment;
use Illuminate\Support\Facades\Validator;

class ReceivePayController extends Controller
{
    public function index()
    {
        return response()->json(ReceivePayment::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'breif' => 'required|string|max:255',
            'paymenttype' => 'required|string',
            'transactiondate' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'userid' => 'required|exists:users,id',
        ]);

        return response()->json(ReceivePayment::create($validated), 201);
    }

    public function show(ReceivePayment $receivePayment)
    {
        return response()->json($receivePayment);
    }

    public function update(Request $request, ReceivePayment $receivePayment)
    {
        $validated = $request->validate([
            'breif' => 'sometimes|string|max:255',
            'paymenttype' => 'sometimes|string',
            'transactiondate' => 'sometimes|date',
            'amount' => 'sometimes|numeric|min:0',
            'userid' => 'sometimes|exists:users,id',
        ]);

        $receivePayment->update($validated);
        return response()->json($receivePayment);
    }

    public function destroy(ReceivePayment $receivePayment)
    {
        $receivePayment->delete();
        return response()->json(['message' => 'Receive payment deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transactions = Transaction::all();
        return response()->json(['transactions' => $transactions], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'canceled' => 'required|boolean',
            'description' => 'nullable|string|max:255',
        ]);
        $transaction = Transaction::create($validatedData);
        return response()->json(['transaction' => $transaction], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $transaction = Transaction::findOrFail($id);
        $validatedData = $request->validate([
            'canceled' => 'required|boolean',
            'description' => 'nullable|string|max:255',
        ]);
        $transaction->update($validatedData);

        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return response()->json(['transaction' => $transaction], Response::HTTP_OK);
    }
}

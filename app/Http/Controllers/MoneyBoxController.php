<?php

namespace App\Http\Controllers;

use App\Models\MoneyBox;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $moneyBoxes = MoneyBox::all();
        return response()->json(['moneyBoxes' => $moneyBoxes], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|string|size:3',
        ]);
        $moneyBox = MoneyBox::create($validatedData);
        return response()->json(['moneyBox' => $moneyBox], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $moneyBox = MoneyBox::findOrFail($id);
        return response()->json(['moneyBox' => $moneyBox], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $moneyBox = MoneyBox::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|string|size:3',
        ]);
        $moneyBox->update($validatedData);

        return response()->json(['moneyBox' => $moneyBox], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $moneyBox = MoneyBox::findOrFail($id);
        $moneyBox->delete();

        return response()->json(['moneyBox' => $moneyBox], Response::HTTP_OK);
    }
}

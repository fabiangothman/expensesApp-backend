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
        $entriesArray = MoneyBox::all();
        return response()->json([
            'success' => true,
            'data' => $entriesArray,
            'error' => null,
        ], Response::HTTP_OK);
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
        $entryObject = MoneyBox::create($validatedData);
        return response()->json([
            'success' => true,
            'data' => $entryObject,
            'error' => null,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $entryObject = MoneyBox::find($id);
        if (!$entryObject) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => "Entry with $id was not found in ".class_basename(get_class($this)).".",
            ], Response::HTTP_NOT_FOUND);
        }
        
        return response()->json([
            'success' => true,
            'data' => $entryObject,
            'error' => null,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $entryObject = MoneyBox::find($id);
        if (!$entryObject) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => "Entry with $id was not found in ".class_basename(get_class($this)).".",
            ], Response::HTTP_NOT_FOUND);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'currency_code' => 'required|string|size:3',
        ]);
        $entryObject->update($validatedData);
        return response()->json([
            'success' => true,
            'data' => $entryObject,
            'error' => null,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $entryObject = MoneyBox::find($id);
        if (!$entryObject) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => "Entry with $id was not found in ".class_basename(get_class($this)).".",
            ], Response::HTTP_NOT_FOUND);
        }
        
        $entryObject->delete();
        return response()->json([
            'success' => true,
            'data' => $entryObject,
            'error' => null,
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ExpenseGroup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $entriesArray = ExpenseGroup::all();
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
            'name' => 'required|string|max:100',
            'group_key' => 'required|string|size:40|unique:expense_groups,group_key',
            'moneybox_id' => 'required|exists:money_boxes,id',
        ]);
        $entryObject = ExpenseGroup::create($validatedData);
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
        $entryObject = ExpenseGroup::find($id);
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
        $entryObject = ExpenseGroup::find($id);
        if (!$entryObject) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => "Entry with $id was not found in ".class_basename(get_class($this)).".",
            ], Response::HTTP_NOT_FOUND);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'group_key' => 'required|string|size:40|unique:expense_groups,group_key',
            'moneybox_id' => 'required|exists:money_boxes,id',
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
        $entryObject = ExpenseGroup::find($id);
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

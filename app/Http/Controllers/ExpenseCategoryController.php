<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $expenseCategories = ExpenseCategory::all();
        return response()->json(['ExpenseCategory' => $expenseCategories], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        ExpenseCategory::create($request->all());
        return response()->json(['message' => 'ExpenseCategory created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return response()->json(['ExpenseCategory' => $expenseCategory], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->update($request->all());

        return response()->json(['message' => 'ExpenseCategory updated successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();

        return response()->json(['message' => 'ExpenseCategory deleted successfully'], Response::HTTP_OK);
    }
}

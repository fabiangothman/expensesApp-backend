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
        return response()->json(['expenseCategories' => $expenseCategories], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'parentcategory_id' => 'nullable|exists:expense_categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        $expenseCategory = ExpenseCategory::create($validatedData);
        return response()->json(['expenseCategory' => $expenseCategory], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return response()->json(['expenseCategory' => $expenseCategory], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'parentcategory_id' => 'nullable|exists:expense_categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        $expenseCategory->update($validatedData);

        return response()->json(['expenseCategory' => $expenseCategory], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();

        return response()->json(['expenseCategory' => $expenseCategory], Response::HTTP_OK);
    }
}

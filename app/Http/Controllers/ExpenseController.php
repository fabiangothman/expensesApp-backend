<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $expenses = Expense::all();
        return response()->json(['expenses' => $expenses], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'transaction_type' => 'required|in:IN,OUT,NONE',
            'value' => 'required|integer',
            'processed' => 'required|boolean',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'expensecategory_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        $expense = Expense::create($validatedData);
        return response()->json(['expense' => $expense], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        return response()->json(['expense' => $expense], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'transaction_type' => 'required|in:IN,OUT,NONE',
            'value' => 'required|integer',
            'processed' => 'required|boolean',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'expensecategory_id' => 'required|exists:expense_categories,id',
            'description' => 'nullable|string|max:255',
        ]);
        $expense->update($validatedData);

        return response()->json(['expense' => $expense], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return response()->json(['expense' => $expense], Response::HTTP_OK);
    }
}

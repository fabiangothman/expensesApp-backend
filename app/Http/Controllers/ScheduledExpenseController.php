<?php

namespace App\Http\Controllers;

use App\Models\ScheduledExpense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScheduledExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $scheduledExpenses = ScheduledExpense::all();
        return response()->json(['scheduledExpenses' => $scheduledExpenses], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'transaction_type' => 'required|in:IN,OUT,NONE',
            'value' => 'required|integer',
            'frequency_type' => 'required|in:DAILY,MONTHLY,YEARLY',
            'frequency' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'active' => 'required|boolean',
            'description' => 'nullable|string|max:255',
        ]);
        $scheduledExpense = ScheduledExpense::create($validatedData);
        return response()->json(['scheduledExpense' => $scheduledExpense], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $scheduledExpense = ScheduledExpense::findOrFail($id);
        return response()->json(['scheduledExpense' => $scheduledExpense], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $scheduledExpense = ScheduledExpense::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'transaction_type' => 'required|in:IN,OUT,NONE',
            'value' => 'required|integer',
            'frequency_type' => 'required|in:DAILY,MONTHLY,YEARLY',
            'frequency' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'expensegroup_id' => 'required|exists:expense_groups,id',
            'active' => 'required|boolean',
            'description' => 'nullable|string|max:255',
        ]);
        $scheduledExpense->update($validatedData);

        return response()->json(['scheduledExpense' => $scheduledExpense], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $scheduledExpense = ScheduledExpense::findOrFail($id);
        $scheduledExpense->delete();

        return response()->json(['scheduledExpense' => $scheduledExpense], Response::HTTP_OK);
    }
}

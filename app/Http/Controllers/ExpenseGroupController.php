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
        $expenseGroups = ExpenseGroup::all();
        return response()->json(['expenseGroups' => $expenseGroups], Response::HTTP_OK);
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
        $expenseGroup = ExpenseGroup::create($validatedData);
        return response()->json(['expenseGroup' => $expenseGroup], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        return response()->json(['expenseGroup' => $expenseGroup], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'group_key' => 'required|string|size:40|unique:expense_groups,group_key',
            'moneybox_id' => 'required|exists:money_boxes,id',
        ]);
        $expenseGroup->update($validatedData);

        return response()->json(['expenseGroup' => $expenseGroup], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        $expenseGroup->delete();

        return response()->json(['expenseGroup' => $expenseGroup], Response::HTTP_OK);
    }
}

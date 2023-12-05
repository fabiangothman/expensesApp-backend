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
        return response()->json(['ExpenseGroups' => $expenseGroups], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        ExpenseGroup::create($request->all());
        return response()->json(['message' => 'ExpenseGroup created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        return response()->json(['ExpenseGroup' => $expenseGroup], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        $expenseGroup->update($request->all());

        return response()->json(['message' => 'ExpenseGroup updated successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expenseGroup = ExpenseGroup::findOrFail($id);
        $expenseGroup->delete();

        return response()->json(['message' => 'ExpenseGroup deleted successfully'], Response::HTTP_OK);
    }
}

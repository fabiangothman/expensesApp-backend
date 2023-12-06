<?php

namespace App\Http\Controllers;

use App\Models\ExpenseGroupUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseGroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $expenseGroupUsers = ExpenseGroupUser::all();
        return response()->json(['expenseGroupUsers' => $expenseGroupUsers], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'expensegroup_id' => 'required|exists:expense_groups,id',
        ]);
        $expenseGroupUser = ExpenseGroupUser::create($validatedData);
        return response()->json(['expenseGroupUser' => $expenseGroupUser], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $expenseGroupUser = ExpenseGroupUser::findOrFail($id);
        return response()->json(['expenseGroupUser' => $expenseGroupUser], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $expenseGroupUser = ExpenseGroupUser::findOrFail($id);
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'expensegroup_id' => 'required|exists:expense_groups,id',
        ]);
        $expenseGroupUser->update($validatedData);

        return response()->json(['expenseGroupUser' => $expenseGroupUser], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $expenseGroupUser = ExpenseGroupUser::findOrFail($id);
        $expenseGroupUser->delete();

        return response()->json(['expenseGroupUser' => $expenseGroupUser], Response::HTTP_OK);
    }
}

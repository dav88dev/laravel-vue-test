<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Validator;

class TeamController extends Controller
{

    /**
     * TeamController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return object
     */
    public function index()
    {
        return Team::all(['id', 'name']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $team = new Team();
        $team->name = $request->name;
        $team->saveOrFail();
        return response()->json('success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Team $team)
    {
        return response()->json($team, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team    $team
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $team->name = $request->name;
        $team->saveOrFail();
        return response()->json('resource updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json('resource deleted successfully', 204);
    }

    /**
     * Get team resource and it's related players
     *
     * @param Team $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPlayers(Team $team)
    {
        return response()->json(['team'=>$team, 'players'=>$team->players], 200);
    }

}

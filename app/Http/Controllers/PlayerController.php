<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Validator;

class PlayerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Player::paginate(9), 200);
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
            'team_id' => 'required|numeric|exists:teams,id',
            'name' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $player = new Player();
        $player->team_id = $request->team_id;
        $player->name = $request->name;
        $player->saveOrFail();
        return response()->json('success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return response()->json($player, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Player  $player
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(Request $request, Player $player)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|numeric|exists:teams,id',
            'name' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $player->team_id = $request->team_id;
        $player->name = $request->name;
        $player->saveOrFail();
        return response()->json('resource updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Player $player
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json('resource deleted successfully', 204);
    }
}

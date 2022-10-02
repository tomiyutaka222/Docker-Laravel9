<?php

namespace App\Http\Repository;

use Illuminate\Http\Request;
use App\Models\Rank;

class RankingRepository
{
    /**
     * ランキングをscore順に最大20件取得します
     * 
     * @return List ランキングリスト
     */
    public function findAll() {
        return Rank::select(
            'id as id',
            'player_name as playerName',
            'score as score'
            )
            ->orderBy('score', 'desc')
            ->limit(20)
            ->get();
    }

    /**
     * ランキングにscoreを新規登録します
     * 
     * @param Request $request ランキングの登録リスト
     * @return void
     */
    public function saveRanking($request) {
        Rank::create([
            'player_name' => $request['playerName'],
            'score' => $request['score'],
        ]);
    }
}

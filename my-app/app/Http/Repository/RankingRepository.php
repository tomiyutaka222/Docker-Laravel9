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
        $rankingModel = new Rank;
        return $rankingModel->select(
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
     * @return List メッセージ
     */
    public function saveRanking($request) {
        $rankingModel = new Rank;

        $rankingModel->create([
            'player_name' => $request['playerName'],
            'score' => $request['score'],
        ]);
    }
}

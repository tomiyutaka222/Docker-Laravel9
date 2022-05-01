<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\RankingService;


class RankingController extends Controller
{
    /**
     * ランキングをscore順に最大20件取得します
     * 
     * @return List ランキングリスト
     */
    public function findAll() {
        $rankingService = new RankingService;
        return $rankingService->findAll();
    }

    /**
     * ランキングにscoreを新規登録します
     * 
     * @return List メッセージ
     */
    public function storeRanking(Request $request) {
        $rankingService = new RankingService;
        return $rankingService->storeRanking($request);
    }
}

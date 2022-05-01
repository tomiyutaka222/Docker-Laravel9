<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use App\Http\Repository\RankingRepository;

class RankingService
{
    /**
     * ランキングをscore順に最大20件取得します
     * 
     * @return List ランキングリスト
     */
    public function findAll() {
        // リポジトリをインスタンス化
        $rankingRepository = new RankingRepository;

        // ランキングの順位番号を作成してreturnする
        return $this->appendRankingNumber($rankingRepository->findAll()->toArray());
    }

    /**
     * ランキングにscoreを新規登録します
     * 
     * @return List ソート後の配列
     */
    public function storeRanking($request) {
        // リポジトリをインスタンス化
        $rankingRepository = new RankingRepository;
        // ランキングを新規登録する
        $rankingRepository->saveRanking($request);

        return [
            'message' => 'ランキングの登録が完了しました'
        ];
    }

    /**
     * score順に順位を付けます
     * 
     * @param List rankingList
     * @return List ソート後の配列
     */
    private function appendRankingNumber($rankingList) {
        // ランキングが登録されていなかった場合、メッセージを返します
        if(empty($rankingList)) {
            return [
                'message' => '現在登録されているランキングはありません'
            ];
        }

        // ランキングの順位番号をリストに追加する
        for($i = 1;$i <= count($rankingList);$i++){
            // 現在の配列キー
            $currentKey = $i-1;
            // 一個前の配列キー
            $previousKey = $i-2;

            // 初回のループの場合
            if($i == 1) {
                // ランキングを追加
                $rankingList[$currentKey] = $rankingList[$currentKey] + array('ranking'=> $i);
                continue;
            }
            
            // 一個前のスコアが同じだった場合
            if($rankingList[$currentKey]['score'] == $rankingList[$previousKey]['score']){
                $rankingList[$currentKey] = $rankingList[$currentKey]['ranking'];
            } 
            // それ以外の場合
            else {
                $rankingList[$currentKey] = $rankingList[$currentKey] + array('ranking'=> $i);
            }
        }

        return $rankingList;
    }
}

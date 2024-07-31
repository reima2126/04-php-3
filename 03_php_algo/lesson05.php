<?php

// 手札
// $cards = [
//     ['suit'=>'heart', 'number'=>12],
//     ['suit'=>'joker', 'number'=>0],
//     ['suit'=>'spade', 'number'=>1],
//     ['suit'=>'diamond', 'number'=>2],
//     ['suit'=>'club', 'number'=>13],
// ];

// function judge($cards) {
//     // この関数内に処理を記述
// }
$cards = [
    ['suit' => 'heart', 'number' => 12],
    ['suit' => 'joker', 'number' => 0],
    ['suit' => 'spade', 'number' => 1],
    ['suit' => 'diamond', 'number' => 2],
    ['suit' => 'club', 'number' => 13],
];

function judge($cards)
{
    echo "手札は";
    echo "<br>";
    foreach ($cards as $card) {
        echo $card["suit"] . $card["number"] . " ";
    }
    echo "<br>";

    // 不正チェック
    $valid_suits = ['heart', 'club', 'diamond', 'spade', 'joker'];
    $valid_numbers = range(0, 13); // 0を含める
    $card_combinations = [];

    $is_valid = true;

    foreach ($cards as $card) {
        if (!in_array($card['suit'], $valid_suits) || !in_array($card['number'], $valid_numbers)) {
            $is_valid = false;
            echo "手札は不正です";
            break;
        }

        $card_combination = $card['suit'] . $card['number'];
        if (in_array($card_combination, $card_combinations)) {
            $is_valid = false;
            echo "手札は不正です";
            break;
        }
        $card_combinations[] = $card_combination;
    }

    if ($is_valid) {
        // ジョーカーの数をカウント
        $joker_count = 0;
        foreach ($cards as $card) {
            if ($card['suit'] == 'joker' && $card['number'] == 0) {
                $joker_count++;
            }
        }

        // ジョーカー以外のカードを取得
        $non_joker_cards = array_filter($cards, function ($card) {
            return !($card['suit'] == 'joker' && $card['number'] == 0);
        });

        $numbers = array_column($non_joker_cards, 'number');
        $number_counts = array_count_values($numbers);

        // フルハウスの判定
        $has_three_of_a_kind = false;
        $has_pair = false;

        foreach ($number_counts as $count) {
            if ($count + $joker_count == 3) {
                $has_three_of_a_kind = true;
            }
            if ($count + $joker_count == 2) {
                $has_pair = true;
            }
        }

        if ($has_three_of_a_kind && $has_pair) {
            echo "役はフルハウスです";
        } else {
            // ワンペア、ツーペアの判定
            $pair_count = 0;
            foreach ($number_counts as $count) {
                if ($count + $joker_count == 2) {
                    $pair_count++;
                }
            }

            if ($pair_count == 1) {
                echo "役はワンペアです";
            } elseif ($pair_count == 2) {
                echo "役はツーペアです";
            }

            // スリーカード、フォーカードの判定
            foreach ($number_counts as $count) {
                if ($count + $joker_count == 3) {
                    echo "役はスリーカードです";
                } elseif ($count + $joker_count == 4) {
                    echo "役はフォーカードです";
                }
            }
        }

        $suits = array_column($non_joker_cards, "suit");
        sort($numbers);
        $is_straight = false;
        $is_flush = false;
        $is_straight_flush = false;
        $is_royal_straight_flush = false;

        // ストレートの判定
        $unique_numbers = array_unique($numbers);
        $unique_count = count($unique_numbers);
        if ($unique_count + $joker_count >= 5) {
            $is_straight = true;
        } else {
            for ($i = 0; $i < $unique_count - 1; $i++) {
                if ($unique_numbers[$i + 1] - $unique_numbers[$i] != 1) {
                    $is_straight = false;
                    break;
                }
                $is_straight = true;
            }
        }

        // フラッシュの判定
        if (count(array_unique($suits)) == 1 || (count(array_unique($suits)) == 2 && $joker_count > 0)) {
            $is_flush = true;
        }

        // ストレートフラッシュの判定
        if ($is_straight && $is_flush) {
            $is_straight_flush = true;

            // ロイヤルストレートフラッシュの判定
            if (array_intersect([1, 10, 11, 12, 13], $unique_numbers) == [1, 10, 11, 12, 13] || ($joker_count > 0 && count(array_intersect([1, 10, 11, 12, 13], $unique_numbers)) == 4)) {
                $is_royal_straight_flush = true;
            }
        }

        if ($is_royal_straight_flush) {
            echo "役はロイヤルストレートフラッシュです";
        } elseif ($is_straight_flush) {
            echo "役はストレートフラッシュです";
        } elseif ($is_flush) {
            echo "役はフラッシュです";
        } elseif ($is_straight) {
            echo "役はストレートです";
        }
    }
}



// 関数「judge」を呼び出して結果を表示する
judge($cards);

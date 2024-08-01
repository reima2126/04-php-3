<?php

// "ワンペア"
// $cards = [
//     ['suit' => 'culb', 'number' => 12],
//     ['suit' => 'heart', 'number' => 11],
//     ['suit' => 'heart', 'number' => 13],
//     ['suit' => 'heart', 'number' => 11],
//     ['suit' => 'heart', 'number' => 10],
// ];

// "ツーペア"
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 11],
//     ['suit' => 'culb', 'number' => 12],
//     ['suit' => 'heart', 'number' => 12],
//     ['suit' => 'heart', 'number' => 11],
// ];

// "スリーカード";
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'culb', 'number' => 11],
//     ['suit' => 'heart', 'number' => 11],
//     ['suit' => 'heart', 'number' => 11],
// ];

// "フォーカード";
// $cards = [
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'culb', 'number' => 5],
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'heart', 'number' => 11],
// ];

// "フラッシュ";
// $cards = [
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'heart', 'number' => 10],
//     ['suit' => 'heart', 'number' => 3],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 11],
// ];

// "フルハウス";
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'culb', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
// ];

// "ストレート";
// $cards = [
//     ['suit' => 'heart', 'number' => 9],
//     ['suit' => 'culb', 'number' => 8],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'heart', 'number' => 7],
//     ['suit' => 'heart', 'number' => 10],
// ];

// "ストレートフラッシュ";
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 3],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'heart', 'number' => 4],
// ];

"ロイヤルストレートフラッシュ";
$cards = [
    ['suit' => 'heart', 'number' => 1],
    ['suit' => 'heart', 'number' => 13],
    ['suit' => 'heart', 'number' => 12],
    ['suit' => 'heart', 'number' => 11],
    ['suit' => 'heart', 'number' => 10],
];

// "手札不正";
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 12],
//     ['suit' => 'heart', 'number' => 11],
//     ['suit' => 'heart', 'number' => 18],
// ];


function judge($cards)
{
    echo "手札は";
    echo "<br>";
    foreach ($cards as $card) {
        echo $card["suit"] . $card["number"] . " ";
    }
    echo "<br>";


    // 不正チェック
    $valid_suits = ['heart', 'club', 'diamond', 'spade'];
    $valid_numbers = range(1, 13);
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


        // フルハウスの判定
        $numbers = array_column($cards, 'number');
        $number_counts = array_count_values($numbers);

        $has_three_of_a_kind = false;
        $has_pair = false;

        foreach ($number_counts as $count) {
            if ($count == 3) {
                $has_three_of_a_kind = true;
            }
            if ($count == 2) {
                $has_pair = true;
            }
        }

        if ($has_three_of_a_kind && $has_pair) {
            echo "役はフルハウスです";
        } else {
            // ワンペア、ツーペアの判定
            $pair_count = 0;
            foreach ($number_counts as $count) {
                if ($count == 2) {
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
                if ($count == 3) {
                    echo "役はスリーカードです";
                } elseif ($count == 4) {
                    echo "役はフォーカードです";
                }
            }
        }

        $suits = array_column($cards, "suit");
        sort($numbers);
        $is_straight = false;
        $is_flush = false;
        $is_straight_flush = false;
        $is_royal_straight_flush = false;

        // ストレートの判定
        if (count(array_unique($numbers)) == 5 && ($numbers[4] - $numbers[0] == 4 || ($numbers == [1, 10, 11, 12, 13]))) {
            $is_straight = true;
        }

        // フラッシュの判定
        if (count(array_unique($suits)) == 1) {
            $is_flush = true;
        }

        // ストレートフラッシュの判定
        if ($is_straight && $is_flush) {
            $is_straight_flush = true;

            // ロイヤルストレートフラッシュの判定
            if ($numbers == [1, 10, 11, 12, 13]) {
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

// function judge($cards)
// {
//     // この関数内に処理を記述
//     // カードの不正チェック
//     // カードの並び替え

//     // 役判定

//     // 結果を返す
// }

// 関数「judge」を呼び出して結果を表示する

judge($cards);

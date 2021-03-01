<?php
/* ◯アウトプット
テレビの合計視聴時間
テレビのチャンネル 視聴分数 視聴回数
テレビのチャンネル 視聴分数 視聴回数
...

ただし、閲覧したチャンネルだけ出力するものとする。

視聴時間：時間数を出力すること。小数点一桁までで、端数は四捨五入すること

◯インプット例

1 30 5 25 2 30 1 15

◯アウトプット例

1.7
1 45 2
2 30 1
5 25 1

◯実行コマンド例
php quiz1.php 1 30 5 25 2 30 1 15 */

/*
*タスク分解する
*
*データ構造を決める
*入力値を取得する
*データを処理しやすい形に変換する
*合計時間を算出する
*チャンネルごとの視聴分数と視聴回数を算出する
*表示する
*
*データ構造を決める
*[ch => [min,min], ch => [min,min], ...]
*/

const SPLIT_LENGTH = 2;

function getInput()
{
    $argument = array_slice($_SERVER['argv'], 1);
    return array_chunk($argument, SPLIT_LENGTH);
    // [[1, 30], [5,25]];
}

function groupChannelViewingPeriods(array $inputs): array
{
    $channelViewingPeriods = [];
    foreach ($inputs as $input) {
        $chan = $input[0];
        $min = $input[1];
        $mins = [$min];

        if (array_key_exists($chan, $channelViewingPeriods)) {
            $mins = array_merge($channelViewingPeriods[$chan], $mins);
        }

        $channelViewingPeriods[$chan] = $mins;
    }
    return $channelViewingPeriods;
    // [ch => [min,min], ...];
}

function calculateTotalHour(array $channelViewingPeriods): float
{
    $viewingTimes = [];
    foreach ($channelViewingPeriods as $period) {
        $viewingTimes = array_merge($viewingTimes, $period);
    }
    $totalMin = array_sum($viewingTimes);
    return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void
{
    $totalHour = calculateTotalHour($channelViewingPeriods);
    echo $totalHour . PHP_EOL;
    foreach ($channelViewingPeriods as $chan => $mins) {
        echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
    }
}

$inputs = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);

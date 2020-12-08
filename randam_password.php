<?php

/**
 * ランダム文字列生成 (英数字)
 * $length 生成する文字数
 */
function makeRandStr($length) {
	$str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'), ['@', '#', '$', '%', '&', '(', ')', '=', '~', '|', '[', ']', '{', '}', '?']);
	$r_str = null;
	for ($i = 0; $i < $length; $i++) {
		$r_str .= $str[rand(0, count($str) - 1)];
	}
	return $r_str;
}
$pass = makeRandStr(8);

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta charset="UTF-8">
		<title>ランダムパスワード</title>
	</head>
	<body>
		<p>パスワード案<br>&thinsp;<?= $pass ?></p>
		<button type="button" onclick="location.href=''">生成</button>
	</body>
</html>

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
		<form method="POST">
			<span>パスワードの長さ</span>
			<br>
			<select size="1" name="length">
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8" selected="selected">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
			<p>
				<input type="submit" value="生成">
			</p>
		</form>
	</body>
</html>

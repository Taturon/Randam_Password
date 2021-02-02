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

/**
 * 重複確率を求める
 * $length 生成した文字列長
 * $quantity 生成した文字列の総数
 */
function calculateProbability($length, $quantity) {
	return (77 ** $length) ** $quantity;
}

for ($i = 1; $i <= $_POST['quantity']; $i++) {
	$passwords[] = isset($_POST['length']) ? makeRandStr($_POST['length']) : makeRandStr(8);
}

?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta charset="UTF-8">
		<link rel="apple-touch-icon" type="image/png" href="/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/favicon/icon-192x192.png">
		<title>ランダムパスワード</title>
	</head>
	<body>
		<form method="POST">
			<p>
				<span>パスワードの長さ</span>
				<br>
				<select size="1" name="length">
					<?php for ($i = 4; $i <= 12; $i++): ?>
						<option value="<?= $i ?>" <?php if (isset($_POST['length']) && $_POST['length'] == $i) echo 'selected' ?>>
							<?= $i ?>
						</option>
					<?php endfor; ?>
				</select>
			</p>
			<p>
				<span>生成個数</span>
				<br>
				<select size="1" name="quantity">
					<?php for ($i = 1; $i <= 5; $i++): ?>
						<option value="<?= $i ?>" <?php if (isset($_POST['quantity']) && $_POST['quantity'] == $i) echo 'selected' ?>>
							<?= $i ?>
						</option>
					<?php endfor; ?>
				</select>
			</p>
			<p>
				<input type="submit" value="生成">
				<button type="button" onclick="location.href='/'">戻る</button>
			</p>
		</form>
		<p>
			パスワード案<br>
			<?php foreach ($passwords as $password): ?>
				<?= $password ?><br>
			<?php endforeach; ?>
			<?php if ($passwords !== array_unique($passwords)): ?>
				<small>
					パスワードが重複しました<br>
					これは<?= calculateProbability($_POST['length'], count($passwords) - count(array_unique($passwords))) ?>分の一の確率です
				</small>
			<?php endif; ?>
		</p>
	</body>
</html>

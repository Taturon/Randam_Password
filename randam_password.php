<?php

/**
 * 選択された文字種の配列を生成する
 *
 * @param array $types 選択された文字種
 * @return array 選択された各文字種の配列
 */
function addChars(array $types) {
	$chars = [];
	if (in_array('lower', $types)) {
		$chars = array_merge($chars, range('a', 'z'));
	}
	if (in_array('upper', $types)) {
		$chars = array_merge($chars, range('A', 'Z'));
	}
	if (in_array('symbol', $types)) {
		$chars = array_merge($chars, ['@', '#', '$', '%', '&', '=', '~', '|', '!', '?', '(', ')', '[', ']', '{', '}', '<', '>']);
	}
	if (in_array('number', $types)) {
		$chars = array_merge($chars, range('0', '9'));
	}
	return $chars;
}

/**
 * ランダム文字列を生成する
 *
 * @param int $length 生成する文字列の長さ
 * @param array $chars 元になる文字の配列
 * @return string 生成された文字列
 */
function makeRandStr(int $length, array $chars) {
	$randam_chars = null;
	for ($i = 0; $i < $length; $i++) {
		$randam_chars .= $chars[rand(0, count($chars) - 1)];
	}
	return $randam_chars;
}

/**
 * 場合の数を求める
 *
 * @param int $chars 生成元の文字配列の文字数
 * @param int $length 生成した文字列長
 * @param int $quantity 生成した文字列の総数
 * @return int 場合の数
 */
function calculateProbability(int $chars, int $length, int $quantity) {
	return ($chars ** $length) ** $quantity;
}

if (isset($_POST['types'], $_POST['length'])) {
	$chars = addChars($_POST['types']);
	for ($i = 1; $i <= $_POST['quantity']; $i++) {
		$passwords[] = makeRandStr($_POST['length'], $chars);
	}
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
				<span>文字種</span>
				<br>
				<label>
					<input type="checkbox" name="types[]" value="lower" <?php if (!isset($_POST['types']) || in_array('lower', $_POST['types'])) echo 'checked'; ?>>
					小文字英字
				</label>
				<br>
				<label>
					<input type="checkbox" name="types[]" value="upper" <?php if (!isset($_POST['types']) || in_array('upper', $_POST['types'])) echo 'checked'; ?>>
					大文字英字
				</label>
				<br>
				<label>
					<input type="checkbox" name="types[]" value="symbol" <?php if (!isset($_POST['types']) || in_array('symbol', $_POST['types'])) echo 'checked'; ?>>
					記号（@, #, $, %, &, =, ~, |, !, ?, (, ), [, ], {, }, <, >）
				</label>
				<br>
				<label>
					<input type="checkbox" name="types[]" value="number" <?php if (!isset($_POST['types']) || in_array('number', $_POST['types'])) echo 'checked'; ?>>
					数字
				</label>
			</p>
			<p>
				<span>パスワードの長さ</span>
				<br>
				<select size="1" name="length">
					<?php for ($i = 4; $i <= 12; $i++): ?>
						<option value="<?= $i ?>" <?php if (isset($_POST['length']) && $_POST['length'] == $i) echo 'selected'; ?>>
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
						<option value="<?= $i ?>" <?php if (isset($_POST['quantity']) && $_POST['quantity'] == $i) echo 'selected'; ?>>
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
					これは<?= calculateProbability(count($chars), $_POST['length'], count($passwords) - count(array_unique($passwords))); ?>分の一の確率です
				</small>
			<?php endif; ?>
		</p>
	</body>
</html>

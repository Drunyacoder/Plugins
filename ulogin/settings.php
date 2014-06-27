<?php

$output	= '';
$conf_pach = R.'sys/plugins/before_view_ulogin/config.json';

$config = json_decode(file_get_contents($conf_pach), true);

function config_write($set, $config, $conf_pach) {
	array_push($config, $set);
	print_r($config);
	file_put_contents($conf_pach, json_encode($config));
	return '<div class="warning">Сохранено!<br><br></div>';
}

if (isset($_POST['send'])) {
	$config['fields'] = $_POST['fields'];
	$config['optional'] = $_POST['optional'];
	$config['providers'] = $_POST['providers'];
	$config['hidden'] = $_POST['hidden'];
	file_put_contents($conf_pach, json_encode($config));
	$output .= '<div class="warning">Сохранено!<br><br></div>';
}

$output	.=  '<style>
			.ib {font-weight: bold; font-style: italic;}
			.right {width: 50%;}
			input[type="text"] {height: auto}
			</style>

			<form action="" method="post">
			<div class="list">
				<div class="title">Управление плагином авторизации через uLogin</div>
				<div class="level1">

					<div class="items">
						<div class="setting-item">
							<div class="title" style="padding: 20px; text-align:center;">Вывести виджет на страницу можно с помощью метки {{ ulogin }}</div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Список всех полей, отдаваемых uLogin:</div>
							<div class="right"> <span class="ib">first_name</span> - имя пользователя,<br>
												<span class="ib">last_name</span> - фамилия,<br>
												<span class="ib">email</span> - e-mail,<br>
												<span class="ib">nickname</span> - псевдоним,<br>
												<span class="ib">bdate</span> - дата рождения,<br>
												<span class="ib">sex</span> - пол,<br>
												<span class="ib">phone</span> - телефон,<br>
												<span class="ib">city</span> - город</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Обязательные поля:<br><small>Если поле не передано то регистрация не продолжится, пока в появившееся окно пользователь не введёт недостающие данные</small></div>
							<div class="right">
								<input type="text" size="100" name="fields" value="' . $config['fields'] . '">
							</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Необязательные поля:</div>
							<div class="right">
								<input type="text" size="100" name="optional" value="' . $config['optional'] . '">
							</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Список всех доступных сервисов:</div>
							<div class="right">vkontakte, odnoklassniki, mailru, facebook, twitter, google, yandex, livejournal, openid, lastfm, linkedin, liveid, soundcloud, steam, flickr, vimeo, youtube, webmoney, foursquare, tumblr, googleplus</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Отображаемые сервисы:</div>
							<div class="right">
								<input type="text" size="100" name="providers" value="' . $config['providers'] . '">
							</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="left">Сервисы, которые видны только после наведения мыши:<br><small>Примечание: чтобы не перечислять все сервисы, можно вывести все оставшиеся параметром other</small></div>
							<div class="right">
								<input type="text" size="100" name="hidden" value="' . $config['hidden'] . '">
							</div>
							<div class="clear"></div>
						</div>
					</div>

					<div class="items">
						<div class="setting-item">
							<div class="title" style="padding: 20px; text-align:center;"><input name="send" type="submit" value="Записать" class="save-button"></div>
						</div>
					</div>
				</div>							
			</div>
			</form>';

?>
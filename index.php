<?php

/**
 * @package church_cms
 * @author Psalm62
 * @link https://github.com/psalm62/.../
 * @license http://opensource.org/licenses/MIT MIT License
 */

// устанавливаем константу содержащую путь к папке проекта
//define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__) . '/church_m/');
// устанавливаем константу содержащую путь к папке "app"
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

// загрузка конфигурационного файла
require_once APP . 'core/config.php';

//require_once (APP . 'libs/helper.php');

// загрузка класса приложения
require_once APP . 'core/app.php';
require_once APP . 'core/controller.php';
require_once APP . 'core/view.php';

// запуск приложения
$app = new App();

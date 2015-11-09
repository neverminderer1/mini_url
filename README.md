Минимизатор URL

Для правильной работы, необходимо в базе данных Mysql таблицы со следующей структурой:

Таблица данных URL
CREATE TABLE mini_table (
  id int(11) NOT NULL AUTO_INCREMENT,
  long_url varchar(1000) NOT NULL,
  mini varchar(255) NOT NULL,
  create_time datetime DEFAULT NULL,
  life_time datetime DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX mini (mini)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;


Таблица для сбора статистики
CREATE TABLE user_data (
  id int(11) NOT NULL AUTO_INCREMENT,
  mini varchar(255) DEFAULT NULL,
  device varchar(50) DEFAULT NULL,
  browser varchar(50) DEFAULT NULL,
  os varchar(50) DEFAULT NULL,
  country varchar(100) DEFAULT NULL,
  ip char(20) DEFAULT NULL,
  time datetime DEFAULT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
CHARACTER SET utf8
COLLATE utf8_general_ci;

Для запуска необходимо клонировать репозиторий и выполнить установку дополнительных компонентов 
с поощью composer. Файл запуска проекта index.html. Файл визуализации статистики chart.php.

Проект содержит следующие недоработки и ошибки:

1. Недоработан вывод статистики кликов и его подсчет.
    а)Подсчет переходов по ссылке не считает уникальные переходы.
    б)Недоработан внешний вид статистики.
    в)Недоработана генерация и вывод URL статистики для пользовотеля.
2. Код не документирован и не покрыт тестами.
3. Коду необходим рефакторинг.

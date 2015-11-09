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

Для запуска необходимо клонировать репозиторий на виртуальный сервер и запустить index.html
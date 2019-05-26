1. Даём папке проекта все права
2. Запускаем
	docker-compose up
3. После запуска сервисов тянем библиотеки
	docker exec php composer install
4. Запускаем инициализацию в режиме production ( выбрать 1 )
	docker exec -it php ./init

фронтенд находится по адресу
localhost:1111
Бекенд
localhost:2222

Вход в бекенд (и фронтенд)
login: admin
password: 111111

Само задание в файле test_task.pdf

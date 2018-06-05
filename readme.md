## Описание

Прием сообщений чата и хранение в кэше Redis.

Запрос на добавление комментария
Put 
http://chat.loc/api/chat/add?lang=Ru-ru&user_id=11&message=Сообщение чата 11

Запрос на удаление всех сообщений по id пользователя.
Delete
http://chat.loc/api/chat/del/10

Запрос на получение всех сообщений.
Get
http://chat.loc/api/chat

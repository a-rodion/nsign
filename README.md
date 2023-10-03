## Задача

Тестовая задача для разработчика на Yii2. 
 
Необходимо реализовать модуль подписки на события системы.  
События могут быть вызваны из любого места системы. 
При вызове события должна быть произведена полезная работа , отправлено E-mail \ SMS сообщение , добавлена запись в бд и т.д.

## Запуск

### Запустить контейнеры
   ```
   docker-compose up -d
   ```

### Выполнить `composer install`
   ```
   docker-compose exec php composer install    
   ```

### Выполнить миграции
   ```
   docker-compose exec php yii migrate-app/up    
   docker-compose exec php yii migrate-events/up    
   ```

### Проект доступен по адресу
   ```
   http://localhost:8000
   ```

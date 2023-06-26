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

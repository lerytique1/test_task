
### Подготовка к упаковке в Git

1. Инициализируйте Git-репозиторий:

    ```sh
    git init
    ```

2. Создайте `.gitignore` файл, чтобы исключить ненужные файлы и директории:

    ```gitignore
    /vendor/
    /runtime/
    /web/assets/
    .env
    .env-example
    /docker-compose.override.yml
    ```

3. Добавьте все файлы в репозиторий и закоммитьте:

    ```sh
    git add .
    git commit -m "Initial commit"
    ```

4. Свяжите локальный репозиторий с удаленным (например, на GitHub):

    ```sh
    git remote add origin <repository_url>
    ```

5. Запушьте изменения в удаленный репозиторий:

    ```sh
    git push -u origin master
    ```

### Пример deploy.sh скрипта

Убедитесь, что у вас есть `deploy.sh` скрипт для развертывания проекта:

```sh
#!/bin/bash
set -e

echo "Развертывание начинается..."

if ! [ -x "$(command -v docker)" ]; then
   echo "Ошибка: Docker не установлен." >&2
   exit 1
fi

if ! [ -x "$(command -v docker-compose)" ]; then
   echo "Ошибка: Docker Compose не установлен." >&2
   exit 1
fi

# Останавливаются и удаляются только если есть запущенные контейнеры
if [ "$(docker ps -q)" ]; then
    echo "Остановка и удаление старых контейнеров..."
    docker stop "$(docker ps -q)"
    docker rm "$(docker ps -aq)"
fi

echo "Сборка и запуск контейнеров..."
docker-compose up --build -d

echo "Ожидание инициализации Postgres..."
sleep 10

echo "Проверка переменных окружения в контейнере php..."
docker-compose exec php env | grep POSTGRES

echo "Проверка конфигурации базы данных..."
docker-compose exec php php -r "require '/var/www/html/config/db.php'; var_dump(require '/var/www/html/config/db.php');"

echo "Выполнение миграций базы данных и других задач..."
docker-compose exec php php yii migrate --interactive=0

echo "Развертывание завершено успешно. Проверьте работоспособность сайта."

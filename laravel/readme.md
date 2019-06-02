# Laravel. Queues

> docker-compose pull \
> docker-compose up -d 
>
> \# initiate \
> docker-compose run --rm composer composer install \ 
> cp .env.example .env \
> docker-compose exec php php artisan key:generate
>
> \# run server \
> docker-compose exec php php artisan serve --port=8000 --host=0.0.0.0
>
> \# run queue
> docker-compose exec php php artisan queue:work --tries=3
>
>
> docker-compose exec php php artisan make:job \<job name\>

> \# show beanstalk stats \
> echo -e "stats\r\n" | nc 127.0.0.1 11300

## Sync \ Async operations
```
# sync

curl -XPUT -H "Content-Type: application/json" \
    http://127.0.0.1:8000/api/queue/sync \
    -d"{\
        \"data\": \"some_text\",\
        \"complexity\":1000 \
    }"

# async

curl -XPUT -H "Content-Type: application/json" \
    http://127.0.0.1:8000/api/queue/async \
    -d"{\
        \"data\": \"some_text\",\
        \"complexity\":1000 \
    }"
```

## Failed Jobs

> docker-compose exec php php artisan queue:failed-table \
> docker-compose exec php php artisan migrate \
> docker-compose exec php php artisan queue:failed \
> docker-compose exec php php artisan queue:retry <ID>
```
curl -XPUT http://127.0.0.1:8000/api/queue/fail 
```

## Broadcasting

> docker-compose run --rm node npm install \
> docker-compose run --rm node ./node_modules/.bin/laravel-echo-server init \

Run 
> docker-compose run --rm -p 6001:6001 node ./node_modules/.bin/laravel-echo-server start \
> docker-compose run --rm node npm run watch \
> docker-compose exec php php artisan serve --port=8000 --host=0.0.0.0 \
> docker-compose exec php php artisan queue:work --tries=1
```
curl -XPOST http://127.0.0.1:8000/api/message -H "Content-Type: application/json" -d"{\
    \"message\": \"text\"\
}"
```

# Laravel. Queues

## Installation

> docker-compose pull \
> docker-compose up -d 
>
> docker-compose run --rm composer composer install \
> docker-compose run --rm node npm install \
> cp .env.example .env \
> docker-compose exec php php artisan key:generate \
> docker-compose exec php php artisan migrate:install

## Running

> \# Run server\
> docker-compose exec php php artisan serve --port=8000 --host=0.0.0.0 \
> \#Run queue\
> docker-compose exec php php artisan queue:work --tries=3 \
> \# Run echo-server\
> docker-compose run --rm -p 6001:6001 node ./node_modules/.bin/laravel-echo-server start \
> \# Run webpack\
> docker-compose run --rm node npm run watch

Then open http://localhost:8000 in browser.

## Stop

Close server, queue, echo-server and webpack by Ctrl+C, and then run command:

> docker-compose stop

or

> docker-compose down

the last will remove all data saved in containers (e.g. data in database)

## Useful commands

```
 # queue commands 
 php artisan queue:work beanstalkd 
    --tries=1                     # count of attempts 
    --queue=notifications,email   # priority 
    --timeout=30                  # maximum time of execution 
    --sleep=30                    # delay time

 # stops the queue when it is empty
 php artisan queue:work --stop-when-empty

 # wait for finishing the current job and restarts the queue 
 php artisan queue:restart

 # create job's class 
 docker-compose exec php php artisan make:job \<job name\>

 # show beanstalk stats 
 echo -e "stats\r\n" | nc 127.0.0.1 11300

 # failed job commands 
 docker-compose exec php php artisan queue:failed-table 
 docker-compose exec php php artisan migrate

 docker-compose exec php php artisan queue:failed 
 docker-compose exec php php artisan queue:retry <ID> 
 docker-compose exec php php artisan queue:forget <ID> 
 docker-compose exec php php artisan queue:flush
```

## Requests
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

# failed job

curl -XPUT http://127.0.0.1:8000/api/queue/fail 

# send a message to chat

curl -XPOST http://127.0.0.1:8000/api/message -H "Content-Type: application/json" -d"{\
    \"message\": \"text\",\
    \"author\": \"user name\"\
}"
```

## Broadcasting

Details:

[Laravel. Broadcasting](https://laravel.com/docs/5.8/broadcasting)

[laravel-echo-server](https://github.com/tlaverdure/laravel-echo-server)

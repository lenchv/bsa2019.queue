# Gearman Example

## Installation on Ubuntu:

> sudo apt-get install gearman php-gearman gearman-tools

Run the example:

> \# start gearman server \
> sudo gearmand -d
>
> \# run worker \
> php worker.php
>
> \# run client \
> php client.php
>

Usefull commands:

> gearadmin --show-jobs \
> gearadmin --workers

## Using Docker:

First change `"host"` in `src/config.php` on "gearman", and then execute following commands:

> docker-compose build \
> docker-compose up -d
>
> \# run worker \
> docker-compose run --rm php php /myapp/worker.php
>
> \# run client \
> docker-compose run --rm php php /myapp/client.php
>
> \# show gearman status \
> docker-compose exec gearman gearadmin --status \
> docker-compose exec gearman gearadmin --show-jobs \
> docker-compose exec gearman gearadmin --workers

More details:

[https://www.php.net/manual/en/book.gearman.php](https://www.php.net/manual/en/book.gearman.php)

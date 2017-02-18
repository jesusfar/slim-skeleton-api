# Upmarlin API

### How to run 

First of all you need to clone The wired docker environment  please see: https://gitlab.com/nidarbox/wired

### 1. Run upmarlin environment

```
$ cd wired

$ docker-compose -f common/docker-compose.yml up -d
$ docker-compose -f mysql/docker-compose.yml up -d
$ docker-compose -f upmarlin-api/docker-compose.yml up -d && docker-compose -f upmarlin-api/docker-compose.yml logs -f
```
Only once you have to create upmarlin database:
```
$ docker-compose -f mysql/docker-compose.yml exec mysql mysql -u root -ptoor -e "create database upmarlin;"
$ docker-compose -f mysql/docker-compose.yml exec mysql mysql -u root -ptoor -e "show databases;;"
```

### 2 Run composer

```
$ docker-compose -f upmarlin-api/docker-compose.yml exec upmarlin-api composer install
```

### 3 Run migrations

Migrations status
```
$ docker-compose -f upmarlin-api/docker-compose.yml exec upmarlin-api composer migrations:status
```

Execute migration
```
$ docker-compose -f upmarlin-api/docker-compose.yml exec upmarlin-api composer migrations:migrate
```

Generate migration
```
$ docker-compose -f upmarlin-api/docker-compose.yml exec upmarlin-api composer migrations:generate
```

You can see available scripts in composer.json

## Nidarbox 2017

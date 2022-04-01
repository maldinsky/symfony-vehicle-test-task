# Тестовое задание с использованием Symfony

Описание задачи:

Create an application using Symfony (version >= 5.4) and use Doctrine as ORM
Create entities with the following schema. The fields below are required but you may add any indexes/fields that feel are necessary to
complete the task:

#### VehicleType
- code
- description
#### Make
- code
- description
- type - should have ManyToOne relationship to VehicleType entity
#### Model
- description
- type - should have ManyToOne relationship to VehicleType entity
- make code (group property in models.json) should have ManyToOne relationship to Make an entity
#### SearchLog
- vehicle type
- make abbr
- number of models found in the database
- request time
- IP address
- user agent

Create fixtures and load data to the database from files:
- vehicle_types.json
- makes.json
- models.json

Create "/" route
You will need to display an HTML page showing the list of vehicle types alphabetically. This list should have a link to makes a route (#5).
Create "/makes/{type}" route
You need to display the HTML page with a dropdown that will show a list of makes for the selected vehicle type.
If a make is selected from the dropdown list you will need to send an ajax request to load the JSON data from the model route (# 6) and
display a list of models underneath the makes dropdown or display a message if no models are available.
Create "/models/{type}/{makeCode}" route to return JSON list of models for specific make and vehicle type.
You should log all requests for models route to the database (SearchLog entity)

## Окружение

Для запуска требуется:
- Docker compose

## Установка и сборка

Клонирование проекта:
```
git clone git@github.com:maldinsky/symfony-vehicle-test-task.git
```

Перейти в папку с проектом и запустить:

```
make init
```

Откройте браузер и перейдите к `http://localhost:8082/`

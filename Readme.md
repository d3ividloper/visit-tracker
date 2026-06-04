# Tree Planting :: Visit Tracker

A Symfony + Vue + Docker application that tracks customer visits and rewards them by planting trees.

---

## Features

- Receive visit events from devices
- Track visits per customer
- Store last connection time
- Plant one tree every configurable number of visits
- Dashboard displaying visits aggregated by hour
- SQLite persistence
- Dockerized environment
- Unit tests

---

## Architecture

The project follows a lite DDD + Hexagonal Architecture approach.

### Backend

Symfony 7

Contexts:

- Customer
- Visit
- Analytics

Layers:

- Domain
- Application
- Infrastructure

Persistence:

- Doctrine ORM
- SQLite

### Frontend

Vue 3 + Vite + Chart.js

---

## Running the project

### Start services

```bash
make start
```

### Create SQLite database
```bash
make migrate
```

### Backend
```bash
http://localhost:8000
```

### Frontend
```bash 
http://localhost:5173
```

## Configuration (env vars)
```bash
VISITS_PER_TREE=5
DEFAULT_TZ=Europe/Madrid
```
Meaning: 5 visits = 1 Tree.


## API
### Register visit
***POST /api/visits***

Request:

```JSON
{
    "customerId": "550e8400-e29b-41d4-a716-446655440000"
}
```

Response:
```JSON
{
  "status": "ok"
}
```

### Hourly Visits
***GET /api/dashboard/hourly-visits***

Response:
```JSON
[
    {
        "hour": "2026-06-03 10:00",
        "visits": 2
    },
    {
        "hour": "2026-06-03 11:00",
        "visits": 7
    },
    {
        "hour": "2026-06-03 13:00",
        "visits": 5
    }
]
```

## Database inspection
### Customers:
```bash
make db-show-customers
```

### Visits:
```bash
make db-show-visits
```

>[!NOTE]
ℹ️ For further Makefile commands use Help command
```bash
make help
```



## Assumptions I made
* Devices are trusted.
* No authentication required.
* One visit equals one customer visit.
* No matter which shop is visited so I ommit use this entity.
* SQLite is sufficient as persisting layer.
* Tree Planting is only represented by a counter due to test specifications.


## Improvements
#### BE
* Implement Authorization and authentication.
* Give most entity to Shop Context (Multi-shop)
* Thinking in Event-driven architecture. We could think in visits as Domain Events and model like this.
* Limit rate visit in order to avoid atacks.
* Use CQRS and/or Event Bus (Rabbit, Symfony messenger...).
#### FE
* Use real-time updates.
* Improve Dashboard visualization adding other data observability.
#### Devops
* CI/CD pipelines with Github actions.


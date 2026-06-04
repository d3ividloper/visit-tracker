.PHONY: start stop logs backend-shell frontend-shell composer-install npm-install migrate migration-diff test db-visits db-customers

help: ## Show available commands
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | \
		sort | \
		awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-20s\033[0m %s\n", $$1, $$2}'

start: ## Start the project and its dependencies
	@docker compose up -d --build

stop: ## Stop the project
	@docker compose down

logs: ## Show project logs
	@docker compose logs -f

clean: ## Remove containers and images
	@docker system prune -a

be-shell: ## Enter the backend shell
	@docker compose exec backend sh

fe-shell: ## Enter the frontend shell
	@docker compose exec frontend sh

composer-install: ## Install composer dependencies
	@docker compose exec backend composer install

npm-install: ## Install npm dependencies
	@docker compose exec frontend npm install

migrate: ## Run migrations
	@docker compose exec backend php bin/console doctrine:migrations:migrate --no-interaction

migration-diff: ## Check database schema diff
	@docker compose exec backend php bin/console doctrine:migrations:diff

migration-list: ## Show migration list
	@docker compose exec backend php bin/console doctrine:migrations:list

test: ## Run tests
	@docker compose exec backend php bin/phpunit

db-remove: ## Remove database
	@docker compose exec backend rm -rf var/data.db

db-show-visits: ## Show table visits content
	@docker compose exec backend sqlite3 var/data.db "SELECT * FROM visits;"

db-show-customers: ## Show table customers content
	@docker compose exec backend sqlite3 var/data.db "SELECT * FROM customers;"
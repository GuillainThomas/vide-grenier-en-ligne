#!/bin/bash

echo "🚀 Démarrage de l'environnement PROD..."

git checkout main

git pull origin main

docker-compose --env-file .env.prod -f docker-compose.yml -f docker-compose.prod.yml -p vide-grenier-prod up -d --build

echo "✅ Environnement PROD démarré sur http://localhost:8000"

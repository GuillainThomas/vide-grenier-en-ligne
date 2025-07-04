#!/bin/bash

echo "🚀 Démarrage de l'environnement PROD..."

git checkout main

git pull origin main

docker-compose --env-file .env.prod -p vide-grenier-prod up -d --build
# docker-compose --env-file .env.prod -f docker-compose.prod.yml -p videtoncube up -d --build

echo "✅ Environnement PROD démarré sur http://localhost:8000"

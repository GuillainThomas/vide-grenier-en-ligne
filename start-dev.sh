#!/bin/bash

echo "🚀 Démarrage de l'environnement DEV..."

docker-compose --env-file .env.dev -f docker-compose.yml -f docker-compose.dev.yml -p vide-grenier-dev up -d --build

echo "✅ Environnement DEV démarré sur http://localhost:9000"

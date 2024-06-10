#!/bin/sh
npm run dev & php artisan serve & stripe listen --forward-to 127.0.0.1:8000/stripe/webhook

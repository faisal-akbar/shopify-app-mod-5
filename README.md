## How to Run  

1. Clone the repository  
2. Run composer install  
3. Run cp .env.example .env  
4. Run php artisan key:generate  
5. update environment variables in .env file  
    - DB_DATABASE=  
    - DB_USERNAME=root  
    - DB_PASSWORD=  
    - SHOPIFY_API_KEY=  
    - SHOPIFY_API_SECRET=  
6. Run php artisan migrate  
7. Run php artisan serve  
8. Go to link localhost:8000 - as this is shopify app, you need to connect using ngrok and update the url in shopify app settings
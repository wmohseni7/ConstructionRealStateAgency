## 🚀 Launching the Laravel Project

Follow these steps to get the Laravel app running locally:

```bash
# Navigate into your project directory
cd ConstructionRealStateAgency

# Install PHP dependencies using composer.json
composer install

# Copy the example environment file
cp .env.example .env

# Generate the application key
php artisan key:generate

# Update .env with your database credentials
# You can use nano or any editor. Here's nano:
nano .env
# Example changes inside .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=your_database_name
# DB_USERNAME=your_db_user
# DB_PASSWORD=your_db_password

# Run database migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Install frontend dependencies
npm install

# Compile frontend assets
npm run dev

# Start

## ✅ Project Setup Instructions

1. Clone the repository

```sh
git clone https://github.com/Mirza-Md-Golam-Nabi/block-verse.git
```

2. Goto project folder

```sh
cd block-verse
```

3. Install dependencies using Composer

```sh
composer install
```

4. Create the **.env** file

Copy the example environment file:

```sh
cp .env.example .env
```

5. Run this command:

```sh
php artisan key:generate
```

6. Create the database

Create a database named:

```sh
block_verse
```

7. Run migrations and seeders

Run the following command to migrate and seed the database:

```sh
php artisan migrate --seed
```

8. Set passport client

```sh
php artisan passport:client --personal
```

**Client Name = BlockVerseTest**

9. Run the application

```sh
php artisan serve
```

✅ When the seeder file is executed, a default **Admin User** is created in the users table.
The login credentials are:

-   email: test@example.com

-   Password: password


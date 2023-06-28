# FOSNAS (FORUM OSIS NASIONAL)


## How To Install

1). Clone / Save project to your direcory

```sh
git clone https://github.com/ilhamhafidz404/fosnas-iconfest.git
```

2). Change Direcory to project folder

```sh
cd fosnas-iconfest
```

3). Setup Project and Install Package

```sh
npm install
```

after complete "npm install", next to :

```sh
composer install
```

4). Copy .env.example file to .env on the root folder.

```sh
cp .env.example .env
```

5). Open your .env file and change the database name (DB_DATABASE) according to the database you have, Default Database Name "laravel"

6). Generate APP KEY

```sh
php artisan key:generate
```

5). Run Migration and seeder (Make sure your XAMPP/Laragon or something is running)

```sh
php artisan migrate
```

and for run seeder

```sh
php artisan db:seed
```

6). Run the project

```sh
php artisan serve
```

in another terminal, run this:

```sh
npm run dev
```

7). For an initial account, first log in with the admin role, please log in with the following account:

```sh
Super Admin
email: admin@gmail.com
password: admin

School Admin
email: adminpertiwi@gmail.com
password: adminpertiwi

School Admin
email: adminpertiwi@gmail.com
password: adminpertiwi

Pengurus OSIS
email: penguruspertiwi@gmail.com
password: penguruspertiwi
```

## Laravel Dashboard with AdminLTE3

1. Clone the repository with git clone

2. Run cp .env.example .env file to copy example file to .env
Then edit your .env file with DB credentials and other settings.

3. Run composer install command

4. Run php artisan migrate --seed command.
Notice: seed is important, because it will create the first admin user for you.

5. Run php artisan key:generate command.

And that's it, go to your domain and login:

Username:	admin@admin.com
Password:	password

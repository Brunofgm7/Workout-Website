# Workout-Website

To start using this code you need to import the database to your phpmyadmin.

1. Create a database with the name "workout". Use the file "workout(2).sql".

About the code:

- "index.php" is the home page.
- "cabecalho.php" is the navbar, and is used in several pages.
- "database.php" has the connections to the database.
- "errors.php" is invoked when the pages has an error.
- "footer.php" has the footer of the page, only used in the homepage.
- "functions.php" never used, old file.
- "login.php" is the login page.
- "perfil.php" is the profile page.
- "registo.php" is the page to register in the website.
- "server.php" 
  - Create the user in the database, in the table "utilizadores", sends an email to the new user saying he registered in the website.
  - Has the funtion when a user logins it creates session variables to know what user is logged in.
  - Has the function to logout.
  - Has the code to code to recover the lost password.
  - Has the code to change the password knowing the current password.
 -"verificacao.php" has the code to set the account activated in database.

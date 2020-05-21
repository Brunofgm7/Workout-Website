# Workout-Website

This project was developed for a class.

## Getting Started

To start using this code you need to import the database to your phpmyadmin.

1. Create a database with the name "workout". Upload the file "workout(2).sql" and it creates all the tables you need.
2. Unzip PHPmailer.zip and place it in the root of your folder.

For now was only tested in localhost.

### Prerequisites

To start using this code you only need XAMPP.


[About it](https://github.com/xampp-phoenix/xampp/blob/master/README.md)


### About the code

- "index.php" is the home page.
- "cabecalho.php" is the navbar, and is used in several pages.
- "database.php" has the connections to the database.
- "errors.php" is invoked when the pages has an error.
- "footer.php" has the footer of the page, only used in the homepage.
- "functions.php" never used, old file.
- "login.php" is the login page.
- "meustreinos.php" we are still working on it.
- "mudarPass.php" has the form to change the password when logged in (knowing the current password).
- "perfil.php" is the profile page.
- "registo.php" is the page to register in the website.
- "server.php" 
  - Create the user in the database, in the table "utilizadores", sends an email to the new user saying he registered in the website.
  - Has the funtion when a user logins it creates session variables to know what user is logged in.
  - Has the function to logout.
  - Has the code to code to recover the lost password.
  - Has the code to change the password knowing the current password.
- "upload.php" has the code to change the the profile photo, and all the execptions.
- "validacaoPass.php" has the code when a user forgets the password and ask for the recovery it, its goes to this page and can redefine it.
- "verificacao.php" has the code to set the account activated in database.

About the folders:
- "css" has the css of the pages.
- "fotos" this is where the photos are stored when you change your profile picture.
- "img" has the photos used in the website.
- "js" has the js code used in the website.
- "PHPmailer" has the stuff you need to send emails.

## Built With

* [PHP](https://www.php.net/)
* [XAMPP](https://www.apachefriends.org/index.html)
* [Code](https://code.visualstudio.com/)


## Versioning

1.3

## Authors

* **Bruno Moreira** 
* **Leonardo Oliveira** 
* **Nuno Dias** 



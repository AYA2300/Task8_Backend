<h2>postman to test api  <a href=https://documenter.getpostman.com/view/26758994/2sA3BuW8rP>Api</a></h2>
<h1>Instructions before running the project</h1>
#1#- <h2>insatll Xampp control panel from  <a href=https://www.apachefriends.org/download.html>Download Xampp</a></h2>
#2-<h2> Download and run <a href=https://getcomposer.org/Composer-Setup.exe>Composer-Setup.exe</a> - it will install the latest composer version whenever it is executed.  </h2>
#3-<h2>install VS Vode <a href=https://code.visualstudio.com/Download>VsCode install</a> </h2>
#4-<h1>Connect to the database</h1>
    <h2>To allow our Laravel application to interact with the newly formed database, we must first establish a connection. To do so, we’ll need to add our database credentials to the .env file:</h2>
<h3> 
DB_CONNECTION=mysql<br>
DB_HOST=127.0.0.1<br>
DB_PORT=3306<br/>
DB_DATABASE=database name<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>
</h3><br/>


#5- <h1>Make the migrations</h1>

<h2>The User table migration comes preinstalled in Laravel, so all we have to do is run it to create the table in our database. To create the User table, use the following command:</h2>

  <h2>php artisan migrate</h2>

#6- <h1>Test the application</h1>

<h2>Before we move to Postman and start testing the API endpoints, we need to start our Laravel application.

Run the below command to start the Laravel application:</h2>

<h1> php artisan serve</h1>


# MiniProject-eVoting-PHP
<p>A simple project demonstrating eVoting system using php allows users to register as voter/admin with a unique username. During login based on their role will be redirected to admin/voter panel. Admins can create elections with an access key, add candidates,  delete elections and can view results. Admins can specify start and end date of elections.</p>

<p>Only ongoing elections are displayed to the voters. Voters can select an election and should enter the access key provided by the admin to vote the candidates. Each voter can vote only once in each election.</p>

<h1>To Run :</h1>
<h3>Extract the folder in htdocs folder</h3>
<ul>
  <li>Open Xammp control panel</li>
  <li>Start server and Mysql</li>
  <li>Open MySQL Admin (In browser-> localhost/phpmyadmin) and create a database named "evotingdb". Open it and import the sql file present in database schema folder.</li>
  <li>All the tables with primary key, foreign key constraints will be created.</li>
  <li>In browser type-> localhost/MiniProject-eVoting-PHP-main/index.php</li>
</ul>

<h3>As of now it is not responsive. Created a desktop version. <a href="https://evoting.free.nf" target="_blank">Experience it live!!!</a></h3>

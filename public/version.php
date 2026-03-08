<?php
$pdo = new PDO('mysql:host=YOUR_HOST;dbname=YOUR_DB', 'YOUR_USER', 'YOUR_PASS');
echo $pdo->query('SELECT VERSION()')->fetchColumn();
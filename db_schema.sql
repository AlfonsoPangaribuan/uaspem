const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME
});

connection.connect((err) => {
  if (err) {
    console.error('Error connecting to the database:', err.stack);
    return;
  }
  console.log('Connected to the database');
});

// Skrip SQL untuk membuat database dan tabel
const createDatabaseQuery = 'CREATE DATABASE IF NOT EXISTS uas_pemrograman;';
const useDatabaseQuery = 'USE uas_pemrograman;';
const createTableQuery = `
  CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
`;

connection.query(createDatabaseQuery, (err, result) => {
  if (err) throw err;
  console.log('Database created or already exists');
});

connection.query(useDatabaseQuery, (err, result) => {
  if (err) throw err;
  console.log('Using database');
});

connection.query(createTableQuery, (err, result) => {
  if (err) throw err;
  console.log('Table created or already exists');
});

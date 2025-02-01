const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const mysql = require('mysql');

app.use(bodyParser.json());

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'coffee'
});

app.post('/insert', (req, res) => {
  const { name, age } = req.body;
  const sql = 'INSERT INTO users (username, password) VALUES (?, ?)';
  connection.query(sql, [name, age], (err, result) => {
    if (err) {
      return res.status(500).send(err);
    }
    res.status(200).send('Data inserted successfully');
  });
});

app.listen(3000, () => {
  console.log('Server running on port 3000');
});

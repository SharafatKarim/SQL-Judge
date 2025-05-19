<?php
session_start();
$_SESSION["page"] = "cheatsheet";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Cheatsheet</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
  <link rel="stylesheet" href="../styles/code_block.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h1 id="toc-1">My SQL</h1>
        <p>This is a cheat sheet of MySQL for easier references. MySQL is an open-source
          relational database management system. It is a central component of the LAMP
          open-source web application
          software stack. MySQL is used by
          many database-driven web applications, including Drupal, Joomla, phpBB, and
          WordPress.</p>
      </div>
      <div class="card">
        <h2 id="toc-2">Installation</h2>
        <p>To get started with MySQL, you can download it from <a href="https://dev.mysql.com/downloads/mysql/">here</a>
          or, simply use <a href="https://www.apachefriends.org/download.html">xampp</a>,
          which uses
          <code>maria-db</code>, a drop in replacement of MySQL. To run MySQL, in linux
          environment or, docker/ podman
          container, I've a guide for you!
        </p>
        <ul>
          <li><a href="https://sharafat.pages.dev/database-containers/">Database setup
              with podman/ Docker
              containers</a></li>
        </ul>
      </div>
      <div class="card">
        <h2 id="toc-3">User</h2>
        <pre><code class="lang-bash">mysql -u root -p</code></pre>
        <pre><code class="lang-sql">SELECT User, Host FROM MYSQL.USER;</code></pre>
        <pre><code class="lang-sql">CREATE USER 'someuser'@'localhost' IDENTIFIED BY 'somepassword';</code></pre>
        <pre><code class="lang-sql">GRANT ALL PRIVILEGES ON * . * TO 'someuser'@'localhost';
FLUSH PRIVILEGES;</code></pre>
        <pre><code class="lang-sql">SHOW GRANTS FOR 'someuser'@'localhost';</code></pre>
        <pre><code class="lang-sql">REVOKE ALL PRIVILEGES, GRANT OPTION FROM 'someuser'@'localhost';</code></pre>
        <pre><code class="lang-sql">DROP USER 'someuser'@'localhost';</code></pre>
        <pre><code class="lang-sql">EXIT;</code></pre>
      </div>
      <div class="card">
        <h2 id="toc-14">Data Types</h2>
        <b>Integers:</b>
        <pre><code class="lang-sql">INT
TINYINT
SMALLINT
MEDIUMINT
BIGINT</code></pre>
        <b>Float:</b>
        <pre><code class="lang-sql">FLOAT(M,D)</code></pre>
        <b>Double:</b>
        <pre><code class="lang-sql">DOUBLE(M,D)</code></pre>
        <b>Decimal:</b>
        <pre><code class="lang-sql">DECIMAL(M,D)</code></pre>
        <b>Date:</b>
        <pre><code class="lang-sql">DATE -- Format - (YYYY-MM-DD)</code></pre>
        <b>Date Time:</b>
        <pre><code class="lang-sql">DATETIME -- Format - (YYYY-MM-DD HH:MM:SS)</code></pre>
        <b>Time:</b>
        <pre><code class="lang-sql">TIME -- Format - (HH:MM:SS)</code></pre>
        <b>String:</b>
        <pre><code class="lang-sql">CHAR(M)
VARCHAR(M)
BLOB or TEXT</code></pre>
      </div>
      <div class="card">
        <h2 id="toc-23">Comments</h2>
        <pre><code class="lang-sql">/* Multi
line
comment */</code></pre>
        <pre><code class="lang-sql"># Single Line Comment</code></pre>
        <pre><code class="lang-sql">-- Single Line Comment</code></pre>
      </div>
      <div class="card">
        <h2 id="toc-24">Data Definition Language (DDL)</h2>
        <pre><code class="lang-sql">CREATE DATABASE cheatsheet;
SHOW DATABASES;
USE cheatsheet;</code></pre>
        <pre><code class="lang-sql">CREATE TABLE employee (
    employee_id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    dept_number INT,
    age INT,
    salary REAL
);</code></pre>
        <pre><code class="lang-sql">SHOW TABLES;
SHOW CREATE TABLE employee;
DESCRIBE employee;
DESC employee;
SHOW COLUMNS IN employee;</code></pre>
        <pre><code class="lang-sql">RENAME TABLE employee TO employee_table;
ALTER TABLE employee_table RENAME TO employee;</code></pre>
        <pre><code class="lang-sql">ALTER TABLE employee CHANGE COLUMN employee_id emp_id INT;</code></pre>
        <pre><code class="lang-sql">ALTER TABLE employee CHANGE COLUMN first_name first_name VARCHAR(50) NOT NULL;</code></pre>
        <pre><code class="lang-sql">ALTER TABLE employee ADD COLUMN salary REAL;</code></pre>
        <pre><code class="lang-sql">ALTER TABLE employee DROP COLUMN salary;</code></pre>
        <pre><code class="lang-sql">ALTER TABLE employee MODIFY COLUMN salary INT;</code></pre>
        <pre><code class="lang-sql">TRUNCATE employee;</code></pre>
        <pre><code class="lang-sql">DROP TABLE department;
DROP DATABASE cheatsheet;</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-41">Data Manipulation Language (DML)</h1>
        <h2 id="toc-42">Insertion (Complete)</h2>
        <pre><code class="lang-sql">INSERT INTO employee (
    employee_id, 
    first_name, 
    last_name, 
    dept_number, 
    age, 
    salary
) VALUES (
    1, 
    "Anurag", 
    "Peddi", 
    1, 
    20, 
    93425.63
);

INSERT INTO employee VALUES (
    2, 
    "Anuhya", 
    "Peddi", 
    2, 
    20, 
    83425.63
);
</code></pre>
        <h2 id="toc-43">Insertion (Partial)</h2>
        <pre><code class="lang-sql">INSERT INTO employee (
    employee_id, 
    first_name
) VALUES (
    3, 
    "Vageesh"
);
</code></pre>
        <h2 id="toc-44">Updating all rows</h2>
        <pre><code class="lang-sql">UPDATE employee 
SET salary = 1.1 * salary;
</code></pre>
        <h2 id="toc-45">Updating a specified row</h2>
        <pre><code class="lang-sql">UPDATE employee 
SET salary = 1.2 * salary 
WHERE employee_id = 1;
</code></pre>
        <h2 id="toc-46">Delete a specified row</h2>
        <pre><code class="lang-sql">DELETE FROM employee 
WHERE employee_id = 2;
</code></pre>
        <h2 id="toc-47">Delete all rows</h2>
        <pre><code class="lang-sql">DELETE FROM employee;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-48">Data Query Language (DQL)</h1>
        <h2 id="toc-49">Display Table</h2>
        <pre><code class="lang-sql">SELECT * 
FROM employee;
</code></pre>
        <h2 id="toc-50">Select only specified columns</h2>
        <pre><code class="lang-sql">SELECT 
    employee_id, 
    first_name 
FROM 
    employee;
</code></pre>
        <h2 id="toc-51">Select only few rows</h2>
        <pre><code class="lang-sql">SELECT 
    employee_id, 
    first_name 
FROM 
    employee 
WHERE 
    age &gt; 25;
</code></pre>
        <h2 id="toc-52">Where Clause</h2>
        <h3 id="toc-53">Greater than(&gt;)</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary &gt; 3100;
</code></pre>
        <h3 id="toc-54">Greater than equal to(&gt;=)</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary &gt;= 3100;
</code></pre>
        <h3 id="toc-55">Less than(&lt;)</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary &lt; 4500;
</code></pre>
        <h3 id="toc-56">Less than equal to(&lt;=)</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary &lt;= 4350;
</code></pre>
        <h3 id="toc-57">Range</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary &gt; 3000 
AND salary &lt; 4000;
</code></pre>
        <h3 id="toc-58">BETWEEN and AND</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary BETWEEN 3000 AND 4000;
</code></pre>
        <h3 id="toc-59">OR</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary = 3000 
OR salary = 4000;
</code></pre>
        <h3 id="toc-60">Null</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary IS NULL;
</code></pre>
        <h3 id="toc-61">Not null</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE salary IS NOT NULL;
</code></pre>
        <h3 id="toc-62">ORDER BY Clause</h3>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
ORDER BY salary DESC;
</code></pre>
        <h4 id="toc-63">Like Operator</h4>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE name LIKE '%Jo%';          -- Similar to *Jo* in regrex
</code></pre>
        <pre><code class="lang-sql">SELECT * 
FROM employee 
WHERE name LIKE 'Jo_';           -- Similar to Jo. in regrex
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-64">Views</h1>
        <h2 id="toc-65">Create a view</h2>
        <pre><code class="lang-sql">CREATE VIEW personal_info AS 
SELECT 
    first_name, 
    last_name, 
    age 
FROM 
    employees;
</code></pre>
        <h2 id="toc-66">Displaying view</h2>
        <pre><code class="lang-sql">SELECT * 
FROM personal_info;
</code></pre>
        <h2 id="toc-67">Updating in view</h2>
        <pre><code class="lang-sql">UPDATE personal_info 
SET salary = 1.1 * salary;
</code></pre>
        <h2 id="toc-68">Deleting record from view</h2>
        <pre><code class="lang-sql">DELETE FROM personal_info 
WHERE age &lt; 40;
</code></pre>
        <h2 id="toc-69">Droping a view</h2>
        <pre><code class="lang-sql">DROP VIEW personal_info;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-70">Joins</h1>
        <h2 id="toc-71">Inner join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
INNER JOIN project AS p 
ON e.eid = p.eid;

-- or

SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
JOIN project AS p 
ON e.eid = p.eid;
</code></pre>
        <h2 id="toc-72">Full outer join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
LEFT OUTER JOIN project AS p 
ON e.eid = p.eid
UNION
SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
RIGHT OUTER JOIN project AS p 
ON e.eid = p.eid;
</code></pre>
        <h2 id="toc-73">Left outer join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
LEFT OUTER JOIN project AS p 
ON e.eid = p.eid;
</code></pre>
        <h2 id="toc-74">Right outer join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
RIGHT OUTER JOIN project AS p 
ON e.eid = p.eid;
</code></pre>
        <h2 id="toc-75">Left outer join - inner join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
LEFT OUTER JOIN project AS p 
ON e.eid = p.eid 
WHERE p.pname IS NULL;
</code></pre>
        <h2 id="toc-76">Right outer join - inner join</h2>
        <pre><code class="lang-sql">SELECT 
    e.fname, 
    p.pname 
FROM 
    employees AS e 
RIGHT OUTER JOIN project AS p 
ON e.eid = p.eid 
WHERE e.fname IS NULL;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-77">Aggregation</h1>
        <h2 id="toc-78">Sum function</h2>
        <pre><code class="lang-sql">SELECT 
    SUM(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <h2 id="toc-79">Average function</h2>
        <pre><code class="lang-sql">SELECT 
    AVG(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <h2 id="toc-80">Count function</h2>
        <pre><code class="lang-sql">SELECT 
    district, 
    COUNT(district) 
FROM 
    city 
GROUP BY district;
</code></pre>
        <h2 id="toc-81">Maximum function</h2>
        <pre><code class="lang-sql">SELECT 
    MAX(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <h2 id="toc-82">Minimum function</h2>
        <pre><code class="lang-sql">SELECT 
    MIN(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <h2 id="toc-83">Standard deviation function</h2>
        <pre><code class="lang-sql">SELECT 
    STDDEV(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <h2 id="toc-84">Group concat function</h2>
        <pre><code class="lang-sql">SELECT 
    GROUP_CONCAT(population) 
FROM 
    city 
GROUP BY population;
</code></pre>
        <blockquote>
          <p>Only COUNT function considers NULL values</p>
        </blockquote>
      </div>
      <div class="card">
        <h1 id="toc-85">Procedure</h1>
        <h2 id="toc-86">Creating procedure</h2>
        <pre><code class="lang-sql">CREATE PROCEDURE display_dbs()
SHOW DATABASES;</code></pre>
        <h2 id="toc-87">Calling procedure</h2>
        <pre><code class="lang-sql">CALL display_dbs();
</code></pre>
        <h3 id="toc-88">Drop procedure</h3>
        <pre><code class="lang-sql">DROP PROCEDURE display_dbs;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-89">Transaction</h1>
        <h2 id="toc-90">Begin transaction</h2>
        <pre><code class="lang-sql">START TRANSACTION;
</code></pre>
        <h2 id="toc-91">Create savepoint</h2>
        <pre><code class="lang-sql">SAVEPOINT sv_pt;
</code></pre>
        <pre><code class="lang-sql">DELETE FROM city;       -- changing data in table
</code></pre>
        <h2 id="toc-92">Rollback</h2>
        <pre><code class="lang-sql">ROLLBACK TO sv_pt;
</code></pre>
        <h2 id="toc-93">Releasing savepoint</h2>
        <pre><code class="lang-sql">RELEASE SAVEPOINT sv_pt;
</code></pre>
        <h2 id="toc-94">Commiting changes</h2>
        <pre><code class="lang-sql">COMMIT;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-95">Constraints</h1>
        <h2 id="toc-96">Not Null</h2>
        <pre><code class="lang-sql">ALTER TABLE Employee
CHANGE
    Age
    Age INT NOT NULL;
</code></pre>
        <h2 id="toc-97">Unique</h2>
        <pre><code class="lang-sql">ALTER TABLE Employee
ADD CONSTRAINT u_q UNIQUE(ID);
</code></pre>
        <pre><code class="lang-sql">ALTER TABLE Employee -- drop the constraint
DROP CONSTRAINT u_q;
</code></pre>
        <h2 id="toc-98">Primary Key</h2>
        <pre><code class="lang-sql">ALTER TABLE Employee
ADD CONSTRAINT p_k PRIMARY KEY(ID);
</code></pre>
        <pre><code class="lang-sql">ALTER TABLE Employee -- drop the constraint
DROP CONSTRAINT p_k;
</code></pre>
        <h2 id="toc-99">Check</h2>
        <pre><code class="lang-sql">ALTER TABLE Employee
ADD CONSTRAINT Age CHECK (age&gt;=30);
</code></pre>
        <pre><code class="lang-sql">ALTER TABLE Employee -- drop the constraint
DROP CHECK Age;
</code></pre>
        <h2 id="toc-100">Default</h2>
        <pre><code class="lang-sql">ALTER TABLE Employee
ALTER Age SET DEFAULT 10;
</code></pre>
        <pre><code class="lang-sql">ALTER TABLE Employee -- drop the constraint
ALTER Age DROP DEFAULT;
</code></pre>
        <h2 id="toc-101">Cloning</h2>
        <h2 id="toc-102">Duplicate a Table Schema</h2>
        <pre><code class="lang-sql">CREATE TABLE emp_dup LIKE employee;
</code></pre>
        <h2 id="toc-103">Duplicate a Table</h2>
        <pre><code class="lang-sql">CREATE TABLE emp_dup SELECT * FROM employee;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-104">Access Controls</h1>
        <h2 id="toc-105">Creating New User</h2>
        <pre><code class="lang-sql">CREATE USER 'username'@'localhost' 
IDENTIFIED BY 'password';
</code></pre>
        <p>the hostname part is set to <code>localhost</code>, so the user will be able to
          connect to the MySQL server
          only from the localhost.<br>To grant access from another host, change the
          hostname part with the remote
          machine IP. </p>
        <pre><code class="lang-sql">CREATE USER 'username'@'172.8.10.5' 
IDENTIFIED BY 'user_password';
</code></pre>
        <p>To create a user that can connect from any host, '%' is used in the hostname part:
        </p>
        <pre><code class="lang-sql">CREATE USER 'username'@'%' 
IDENTIFIED BY 'user_password';
</code></pre>
        <h2 id="toc-106">Grant All Permissions</h2>
        <pre><code class="lang-sql">GRANT ALL PRIVILEGES ON * . * 
TO 'username'@'localhost';
</code></pre>
        <p>Asterisks(*) refers to the database and table names respectively.<br>By using
          asterisks we can give access of
          all the databases <strong>or</strong> tables to the user.</p>
        <h2 id="toc-107">Flush Privileges</h2>
        <pre><code class="lang-sql">FLUSH PRIVILEGES
</code></pre>
        <p>All the changes won't be in effect unless this query is fired.</p>
        <h2 id="toc-108">Specific User Permissions</h2>
        <pre><code class="lang-sql">GRANT type_of_permission 
ON database_name.table_name 
TO 'username'@'localhost';
</code></pre>
        <p><code>type_of_permission</code> may have one of these value:</p>
        <ul>
          <li><strong>ALL PRIVILEGES</strong> - Allows user full access to a designated
            database (or if no database is
            selected, global access across the system).</li>
          <li><strong>CREATE</strong> - allows them to create new tables or databases.
          </li>
          <li><strong>DROP</strong> - allows them to them to delete tables or databases.
          </li>
          <li><strong>DELETE</strong> - allows them to delete rows from tables.</li>
          <li><strong>INSERT</strong> - allows them to insert rows into tables.</li>
          <li><strong>SELECT</strong> - allows them to use the <code>SELECT</code> command
            to read through databases.
          </li>
          <li><strong>UPDATE</strong> - allow them to update table rows.</li>
          <li><strong>GRANT OPTION</strong> - allows them to grant or remove other users’
            privileges.<br>Multiple
            permissions are given with commas.</li>
        </ul>
        <h2 id="toc-109">Revoking permissions</h2>
        <pre><code class="lang-sql">REVOKE type_of_permission 
ON database_name.table_name 
FROM 'username'@'localhost';
</code></pre>
        <h2 id="toc-110">Show User's Current Permissions</h2>
        <pre><code class="lang-sql">SHOW GRANTS FOR 'username'@'localhost';
</code></pre>
        <h2 id="toc-111">Delete a User</h2>
        <pre><code class="lang-sql">DROP USER 'username'@'localhost';
</code></pre>
        <h2 id="toc-112">Set new password to a user</h2>
        <pre><code class="lang-sql">USE mysql;
UPDATE user 
SET authentication_string=PASSWORD("<new2-password>") 
WHERE User='<user>';
FLUSH PRIVILEGES;
</code></pre>
        <h2 id="toc-113">Reset Root Password</h2>
        <p>Stop MySQL service</p>
        <pre><code>sudo systemctl stop mysql
</code></pre>
        <p>Restart MySQL service without loading grant tables</p>
        <pre><code class="lang-bash">sudo mysqld_safe --skip-grant-tables &
</code></pre>
        <p>The apersand (&amp;) will cause the program to run in the background and
          <code>--skip-grant-tables</code>
          enables everyone to to connect to the database server without a password and
          with all privileges granted.
          Login to shell
        </p>
        <pre><code><span class="hljs-attribute">mysql -u root</span>
</code></pre>
        <p>Set new password for root</p>
        <pre><code class="lang-sql">ALTER USER 'root'@'localhost' 
IDENTIFIED BY 'MY_NEW_PASSWORD';
FLUSH PRIVILEGES;
</code></pre>
        <p>Stop and start the server once again</p>
        <pre><code>mysqladmin -u root -p shutdown
sudo systemctl start mysql
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-114">Programming</h1>
        <h2 id="toc-115">Declare variables</h2>
        <pre><code class="lang-sql">SET @num = 10;
SET @name = 'Anurag';
</code></pre>
        <h2 id="toc-116">Print them</h2>
        <pre><code class="lang-sql">SELECT @name;
</code></pre>
        <h2 id="toc-117">For loop</h2>
        <pre><code class="lang-sql">SET @n = 21;
SELECT REPEAT("* ", @n := @n - 1) 
FROM information_schema.tables 
WHERE @n > 0;
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-118">Miscellaneous</h1>
        <h2 id="toc-119">Enabling foreign key checks</h2>
        <pre><code class="lang-sql">SET foreign_key_checks = 1;
</code></pre>
        <h2 id="toc-120">Disabling foreign key checks</h2>
        <pre><code class="lang-sql">SET foreign_key_checks = 0;
</code></pre>
        <h2 id="toc-121">Round</h2>
        <pre><code class="lang-sql">SELECT ROUND(3.141596, 3);
</code></pre>
        <h2 id="toc-122">Repeated concatenation</h2>
        <pre><code class="lang-sql">SELECT REPEAT("* ", 20);
</code></pre>
        <h2 id="toc-123">Random float</h2>
        <pre><code class="lang-sql">SELECT RAND();
</code></pre>
        <h2 id="toc-124">Typecast to Int</h2>
        <pre><code class="lang-sql">SELECT CAST(23.01245 AS SIGNED);
</code></pre>
        <h2 id="toc-125">Concatenation</h2>
        <pre><code class="lang-sql">SELECT CONCAT("Mahesh", " ", "Chandra", " ", "Duddu", "!");
</code></pre>
        <h2 id="toc-126">Extract Month</h2>
        <pre><code class="lang-sql">SELECT MONTH("1998-12-30");
</code></pre>
        <h2 id="toc-127">Extract Year</h2>
        <pre><code class="lang-sql">SELECT YEAR("1998-12-30");
</code></pre>
      </div>
      <div class="card">
        <h1 id="toc-128">Also thanks to</h1>
        <ul>
          <li><a
              href="https://github.com/Cheatsheet-lang/MySQL-cheatsheet">https://github.com/Cheatsheet-lang/MySQL-cheatsheet</a>
          </li>
          <li><a
              href="https://github.com/GunaPalanivel/The-MySQL-Code-Sheet">https://github.com/GunaPalanivel/The-MySQL-Code-Sheet</a>
          </li>
          <li><a
              href="https://github.com/AbdGhazall/MySQL-Cheat-Sheet">https://github.com/AbdGhazall/MySQL-Cheat-Sheet</a>
          </li>
          <li><a
              href="https://gist.github.com/bradtraversy/c831baaad44343cc945e76c2e30927b3">https://gist.github.com/bradtraversy/c831baaad44343cc945e76c2e30927b3</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <div class="card">
        <h2>Table of Contents</h2>
        <ul>
          <li><a href="#toc-1">My SQL</a></li>
          <ul>
            <li><a href="#toc-2">Installation</a></li>
            <li><a href="#toc-3">User</a></li>
            <ul>
              <li><a href="#toc-4">Login</a></li>
              <li><a href="#toc-5">Show Users</a></li>
              <li><a href="#toc-6">Create User</a></li>
              <li><a href="#toc-7">Grant All Privileges On All Databases</a>
              </li>
              <li><a href="#toc-8">Show Grants</a></li>
              <li><a href="#toc-9">Remove Grants</a></li>
              <li><a href="#toc-10">Delete User</a></li>
              <li><a href="#toc-11">Exit</a></li>
            </ul>
          </ul>
          <li><a href="#toc-12">Database</a></li>
          <ul>
            <li><a href="#toc-13">General Commands</a></li>
            <li><a href="#toc-14">Data Types</a></li>
            <ul>
              <li><a href="#toc-15">Integers</a></li>
              <li><a href="#toc-16">Float</a></li>
              <li><a href="#toc-17">Double</a></li>
              <li><a href="#toc-18">Decimal</a></li>
              <li><a href="#toc-19">Date</a></li>
              <li><a href="#toc-20">Date Time</a></li>
              <li><a href="#toc-21">Time</a></li>
              <li><a href="#toc-22">String</a></li>
            </ul>
            <li><a href="#toc-23">Comments</a></li>
          </ul>
          <li><a href="#toc-24">Data Definition Language (DDL)</a></li>
          <ul>
            <li><a href="#toc-25">Create Database</a></li>
            <li><a href="#toc-26">Show Databases</a></li>
            <li><a href="#toc-27">Use Database</a></li>
            <li><a href="#toc-28">Create Table</a></li>
            <li><a href="#toc-29">Show Tables</a></li>
            <li><a href="#toc-30">Show Table Code</a></li>
            <li><a href="#toc-31">Describe Table</a></li>
            <li><a href="#toc-32">Rename Table</a></li>
            <li><a href="#toc-33">Renaming Column</a></li>
            <li><a href="#toc-34">Add Constraint to Column</a></li>
            <li><a href="#toc-35">Add Column</a></li>
            <li><a href="#toc-36">Drop Column</a></li>
            <li><a href="#toc-37">Modify the Datatype of column</a></li>
            <li><a href="#toc-38">Truncate Table</a></li>
            <li><a href="#toc-39">Drop Table</a></li>
            <li><a href="#toc-40">Drop Database</a></li>
          </ul>
          <li><a href="#toc-41">Data Manipulation Language (DML)</a></li>
          <ul>
            <li><a href="#toc-42">Insertion (Complete)</a></li>
            <li><a href="#toc-43">Insertion (Partial)</a></li>
            <li><a href="#toc-44">Updating all rows</a></li>
            <li><a href="#toc-45">Updating a specified row</a></li>
            <li><a href="#toc-46">Delete a specified row</a></li>
            <li><a href="#toc-47">Delete all rows</a></li>
          </ul>
          <li><a href="#toc-48">Data Query Language (DQL)</a></li>
          <ul>
            <li><a href="#toc-49">Display Table</a></li>
            <li><a href="#toc-50">Select only specified columns</a></li>
            <li><a href="#toc-51">Select only few rows</a></li>
            <li><a href="#toc-52">Where Clause</a></li>
            <ul>
              <li><a href="#toc-53">Greater than(>)</a></li>
              <li><a href="#toc-54">Greater than equal to(>=)</a></li>
              <li><a href="#toc-55">Less than(<)< /a>
              </li>
              <li><a href="#toc-56">Less than equal to(<=)< /a>
              </li>
              <li><a href="#toc-57">Range</a></li>
              <li><a href="#toc-58">BETWEEN and AND</a></li>
              <li><a href="#toc-59">OR</a></li>
              <li><a href="#toc-60">Null</a></li>
              <li><a href="#toc-61">Not null</a></li>
              <li><a href="#toc-62">ORDER BY Clause</a></li>
              <ul>
                <li><a href="#toc-63">Like Operator</a></li>
              </ul>
            </ul>
          </ul>
          <li><a href="#toc-64">Views</a></li>
          <ul>
            <li><a href="#toc-65">Create a view</a></li>
            <li><a href="#toc-66">Displaying view</a></li>
            <li><a href="#toc-67">Updating in view</a></li>
            <li><a href="#toc-68">Deleting record from view</a></li>
            <li><a href="#toc-69">Droping a view</a></li>
          </ul>
          <li><a href="#toc-70">Joins</a></li>
          <ul>
            <li><a href="#toc-71">Inner join</a></li>
            <li><a href="#toc-72">Full outer join</a></li>
            <li><a href="#toc-73">Left outer join</a></li>
            <li><a href="#toc-74">Right outer join</a></li>
            <li><a href="#toc-75">Left outer join - inner join</a></li>
            <li><a href="#toc-76">Right outer join - inner join</a></li>
          </ul>
          <li><a href="#toc-77">Aggregation</a></li>
          <ul>
            <li><a href="#toc-78">Sum function</a></li>
            <li><a href="#toc-79">Average function</a></li>
            <li><a href="#toc-80">Count function</a></li>
            <li><a href="#toc-81">Maximum function</a></li>
            <li><a href="#toc-82">Minimum function</a></li>
            <li><a href="#toc-83">Standard deviation function</a></li>
            <li><a href="#toc-84">Group concat function</a></li>
          </ul>
          <li><a href="#toc-85">Procedure</a></li>
          <ul>
            <li><a href="#toc-86">Creating procedure</a></li>
            <li><a href="#toc-87">Calling procedure</a></li>
            <ul>
              <li><a href="#toc-88">Drop procedure</a></li>
            </ul>
          </ul>
          <li><a href="#toc-89">Transaction</a></li>
          <ul>
            <li><a href="#toc-90">Begin transaction</a></li>
            <li><a href="#toc-91">Create savepoint</a></li>
            <li><a href="#toc-92">Rollback</a></li>
            <li><a href="#toc-93">Releasing savepoint</a></li>
            <li><a href="#toc-94">Commiting changes</a></li>
          </ul>
          <li><a href="#toc-95">Constraints</a></li>
          <ul>
            <li><a href="#toc-96">Not Null</a></li>
            <li><a href="#toc-97">Unique</a></li>
            <li><a href="#toc-98">Primary Key</a></li>
            <li><a href="#toc-99">Check</a></li>
            <li><a href="#toc-100">Default</a></li>
            <li><a href="#toc-101">Cloning</a></li>
            <li><a href="#toc-102">Duplicate a Table Schema</a></li>
            <li><a href="#toc-103">Duplicate a Table</a></li>
          </ul>
          <li><a href="#toc-104">Access Controls</a></li>
          <ul>
            <li><a href="#toc-105">Creating New User</a></li>
            <li><a href="#toc-106">Grant All Permissions</a></li>
            <li><a href="#toc-107">Flush Privileges</a></li>
            <li><a href="#toc-108">Specific User Permissions</a></li>
            <li><a href="#toc-109">Revoking permissions</a></li>
            <li><a href="#toc-110">Show User's Current Permissions</a></li>
            <li><a href="#toc-111">Delete a User</a></li>
            <li><a href="#toc-112">Set new password to a user</a></li>
            <li><a href="#toc-113">Reset Root Password</a></li>
          </ul>
          <li><a href="#toc-114">Programming</a></li>
          <ul>
            <li><a href="#toc-115">Declare variables</a></li>
            <li><a href="#toc-116">Print them</a></li>
            <li><a href="#toc-117">For loop</a></li>
          </ul>
          <li><a href="#toc-118">Miscellaneous</a></li>
          <ul>
            <li><a href="#toc-119">Enabling foreign key checks</a></li>
            <li><a href="#toc-120">Disabling foreign key checks</a></li>
            <li><a href="#toc-121">Round</a></li>
            <li><a href="#toc-122">Repeated concatenation</a></li>
            <li><a href="#toc-123">Random float</a></li>
            <li><a href="#toc-124">Typecast to Int</a></li>
            <li><a href="#toc-125">Concatenation</a></li>
            <li><a href="#toc-126">Extract Month</a></li>
            <li><a href="#toc-127">Extract Year</a></li>
          </ul>
          <li><a href="#toc-128">Also thanks to</a></li>
        </ul>
      </div>
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>
</body>

</html>
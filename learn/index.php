<?php
session_start();
$_SESSION["page"] = "learn";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Judge | Learn</title>
  <link rel="stylesheet" href="../styles/body.css">
  <link rel="stylesheet" href="../styles/grid.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h1 id="toc-1">My SQL</h1>
        <p>This is a cheat sheet of MySQL for easier references. MySQL is an open-source relational database management
          system. It is a central component of the LAMP open-source web application software stack. MySQL is used by
          many database-driven web applications, including Drupal, Joomla, phpBB, and WordPress.</p>
        <h2 id="toc-2">Installation</h2>
        <p>To get started with MySQL, you can download it from <a href="https://dev.mysql.com/downloads/mysql/">here</a>
          or, simply use <a href="https://www.apachefriends.org/download.html">xampp</a>, which uses
          <code>maria-db</code>, a drop in replacement of MySQL. To run MySQL, in linux environment or, docker/ podman
          container, I've a guide for you!</p>
        <ul>
          <li><a href="https://sharafat.pages.dev/database-containers/">Database setup with podman/ Docker
              containers</a></li>
        </ul>
        <h2 id="toc-3">User</h2>
        <h3 id="toc-4">Login</h3>
        <pre><code class="lang-bash"><span class="hljs-attribute">mysql -u root -p</span>
</code></pre>
        <h3 id="toc-5">Show Users</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">User</span>, 
    Host 
<span class="hljs-keyword">FROM</span> 
    MYSQL.USER;
</code></pre>
        <h3 id="toc-6">Create User</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'someuser'</span>@<span class="hljs-string">'localhost'</span> 
<span class="hljs-keyword">IDENTIFIED</span> <span class="hljs-keyword">BY</span> <span class="hljs-string">'somepassword'</span>;
</code></pre>
        <h3 id="toc-7">Grant All Privileges On All Databases</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">GRANT</span> ALL <span class="hljs-keyword">PRIVILEGES</span> <span class="hljs-keyword">ON</span> * . * 
<span class="hljs-keyword">TO</span> <span class="hljs-string">'someuser'</span>@<span class="hljs-string">'localhost'</span>;
<span class="hljs-keyword">FLUSH</span> <span class="hljs-keyword">PRIVILEGES</span>;
</code></pre>
        <h3 id="toc-8">Show Grants</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">GRANTS</span> <span class="hljs-keyword">FOR</span> <span class="hljs-string">'someuser'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h3 id="toc-9">Remove Grants</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">REVOKE</span> ALL <span class="hljs-keyword">PRIVILEGES</span>, <span class="hljs-keyword">GRANT</span> <span class="hljs-keyword">OPTION</span> 
<span class="hljs-keyword">FROM</span> <span class="hljs-string">'someuser'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h3 id="toc-10">Delete User</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">DROP</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'someuser'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h3 id="toc-11">Exit</h3>
        <pre><code class="lang-sql">EXIT<span class="hljs-comment">;</span>
</code></pre>
        <h1 id="toc-12">Database</h1>
        <h2 id="toc-13">General Commands</h2>
        <p>To run SQL files</p>
        <pre><code class="lang-sql">SOURCE &lt;filename&gt;.sql<span class="hljs-comment">;</span>
</code></pre>
        <h2 id="toc-14">Data Types</h2>
        <h3 id="toc-15">Integers</h3>
        <pre><code class="lang-sql"><span class="hljs-built_in">INT</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-attribute">TINYINT</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-attribute">SMALLINT</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-attribute">MEDIUMINT</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-attribute">BIGINT</span>
</code></pre>
        <h3 id="toc-16">Float</h3>
        <pre><code class="lang-sql"><span class="hljs-function"><span class="hljs-title">FLOAT</span><span class="hljs-params">(M,D)</span></span>
</code></pre>
        <h3 id="toc-17">Double</h3>
        <pre><code class="lang-sql"><span class="hljs-function"><span class="hljs-title">DOUBLE</span><span class="hljs-params">(M,D)</span></span>
</code></pre>
        <h3 id="toc-18">Decimal</h3>
        <pre><code class="lang-sql"><span class="hljs-function"><span class="hljs-title">DECIMAL</span><span class="hljs-params">(M,D)</span></span>
</code></pre>
        <h3 id="toc-19">Date</h3>
        <pre><code class="lang-sql"><span class="hljs-built_in">DATE</span> -- <span class="hljs-built_in">Format</span> - (YYYY-MM-DD)
</code></pre>
        <h3 id="toc-20">Date Time</h3>
        <pre><code class="lang-sql">DATETIME -- Format - (<span class="hljs-name">YYYY-MM-DD</span> HH<span class="hljs-symbol">:MM</span><span class="hljs-symbol">:SS</span>)
</code></pre>
        <h3 id="toc-21">Time</h3>
        <pre><code class="lang-sql">TIME -- Format - (<span class="hljs-name">HH</span><span class="hljs-symbol">:MM</span><span class="hljs-symbol">:SS</span>)
</code></pre>
        <h3 id="toc-22">String</h3>
        <pre><code class="lang-sql"><span class="hljs-function"><span class="hljs-title">CHAR</span><span class="hljs-params">(M)</span></span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-function"><span class="hljs-title">VARCHAR</span><span class="hljs-params">(M)</span></span>
</code></pre>
        <pre><code class="lang-sql">BLOB <span class="hljs-built_in">or</span> <span class="hljs-built_in">TEXT</span>
</code></pre>
        <h2 id="toc-23">Comments</h2>
        <pre><code class="lang-sql"><span class="hljs-comment">/* Multi
line
comment */</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-meta"># Single Line Comment</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-comment">-- Single Line Comment</span>
</code></pre>
        <h1 id="toc-24">Data Definition Language (DDL)</h1>
        <h2 id="toc-25">Create Database</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">DATABASE</span> cheatsheet;
</code></pre>
        <h2 id="toc-26">Show Databases</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">DATABASES</span>;
</code></pre>
        <h2 id="toc-27">Use Database</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">USE</span> <span class="hljs-title">cheatsheet</span>;
</code></pre>
        <h2 id="toc-28">Create Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> employee (
    employee_id <span class="hljs-built_in">INT</span> PRIMARY <span class="hljs-keyword">KEY</span>,              <span class="hljs-comment">-- Setting primary key(1st method)</span>
    first_name <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>),
    last_name <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>),
    dept_number <span class="hljs-built_in">INT</span>,
    age <span class="hljs-built_in">INT</span>,
    salary <span class="hljs-built_in">REAL</span>
);

<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> department (
    dept_number <span class="hljs-built_in">INT</span>,
    dept_name <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>),
    dept_location <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>),
    emp_id <span class="hljs-built_in">INT</span>,
    PRIMARY <span class="hljs-keyword">KEY</span>(dept_number)                <span class="hljs-comment">-- Setting primary key(2nd method)</span>
);

<span class="hljs-comment">-- Create table for classroom</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> classroom (
    building        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">15</span>),
    room_number     <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">7</span>),
    <span class="hljs-keyword">capacity</span>        <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">4</span>,<span class="hljs-number">0</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">0</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (building, room_number)
);

<span class="hljs-comment">-- Create table for department</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> department (
    dept_name       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>), 
    building        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">15</span>), 
    budget          <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">12</span>,<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (budget &gt; <span class="hljs-number">0</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">0.00</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (dept_name)
);

<span class="hljs-comment">-- Create table for course</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> course (
    course_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>), 
    title           <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>), 
    dept_name       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>),
    credits         <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">2</span>,<span class="hljs-number">0</span>) <span class="hljs-keyword">CHECK</span> (credits &gt; <span class="hljs-number">0</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">0</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (course_id),
    FOREIGN <span class="hljs-keyword">KEY</span> (dept_name) <span class="hljs-keyword">REFERENCES</span> department (dept_name)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">SET</span> <span class="hljs-literal">NULL</span>
);

<span class="hljs-comment">-- Create table for instructor</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> instructor (
    <span class="hljs-keyword">ID</span>              <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>), 
    <span class="hljs-keyword">name</span>            <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>) <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>, 
    dept_name       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>), 
    salary          <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">8</span>,<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (salary &gt; <span class="hljs-number">29000</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">30000.00</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>),
    FOREIGN <span class="hljs-keyword">KEY</span> (dept_name) <span class="hljs-keyword">REFERENCES</span> department (dept_name)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">SET</span> <span class="hljs-literal">NULL</span>
);

<span class="hljs-comment">-- Create table for section</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> <span class="hljs-keyword">section</span> (
    course_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>), 
    sec_id          <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>),
    semester        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">6</span>) <span class="hljs-keyword">CHECK</span> (semester <span class="hljs-keyword">IN</span> (<span class="hljs-string">'Fall'</span>, <span class="hljs-string">'Winter'</span>, <span class="hljs-string">'Spring'</span>, <span class="hljs-string">'Summer'</span>)), 
    <span class="hljs-keyword">year</span>            <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">4</span>,<span class="hljs-number">0</span>) <span class="hljs-keyword">CHECK</span> (<span class="hljs-keyword">year</span> &gt; <span class="hljs-number">1701</span> <span class="hljs-keyword">AND</span> <span class="hljs-keyword">year</span> &lt; <span class="hljs-number">2100</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">2021</span>, 
    building        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">15</span>),
    room_number     <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">7</span>),
    time_slot_id    <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">4</span>),
    PRIMARY <span class="hljs-keyword">KEY</span> (course_id, sec_id, semester, <span class="hljs-keyword">year</span>),
    FOREIGN <span class="hljs-keyword">KEY</span> (course_id) <span class="hljs-keyword">REFERENCES</span> course (course_id)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>,
    FOREIGN <span class="hljs-keyword">KEY</span> (building, room_number) <span class="hljs-keyword">REFERENCES</span> classroom (building, room_number)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">SET</span> <span class="hljs-literal">NULL</span>
);

<span class="hljs-comment">-- Create table for teaches</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> teaches (
    <span class="hljs-keyword">ID</span>              <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>), 
    course_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>),
    sec_id          <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>), 
    semester        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">6</span>),
    <span class="hljs-keyword">year</span>            <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">4</span>,<span class="hljs-number">0</span>),
    PRIMARY <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>, course_id, sec_id, semester, <span class="hljs-keyword">year</span>),
    FOREIGN <span class="hljs-keyword">KEY</span> (course_id, sec_id, semester, <span class="hljs-keyword">year</span>) <span class="hljs-keyword">REFERENCES</span> <span class="hljs-keyword">section</span> (course_id, sec_id, semester, <span class="hljs-keyword">year</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>,
    FOREIGN <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>) <span class="hljs-keyword">REFERENCES</span> instructor (<span class="hljs-keyword">ID</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>
);

<span class="hljs-comment">-- Create table for student</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> student (
    <span class="hljs-keyword">ID</span>              <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>), 
    <span class="hljs-keyword">name</span>            <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>) <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>, 
    dept_name       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">20</span>), 
    tot_cred        <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">3</span>,<span class="hljs-number">0</span>) <span class="hljs-keyword">CHECK</span> (tot_cred &gt;= <span class="hljs-number">0</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">0</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>),
    FOREIGN <span class="hljs-keyword">KEY</span> (dept_name) <span class="hljs-keyword">REFERENCES</span> department (dept_name)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">SET</span> <span class="hljs-literal">NULL</span>
);

<span class="hljs-comment">-- Create table for takes</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> takes (
    <span class="hljs-keyword">ID</span>              <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>), 
    course_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>),
    sec_id          <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>), 
    semester        <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">6</span>),
    <span class="hljs-keyword">year</span>            <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">4</span>,<span class="hljs-number">0</span>),
    grade           <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">2</span>) <span class="hljs-keyword">DEFAULT</span> <span class="hljs-string">'NA'</span>,
    PRIMARY <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>, course_id, sec_id, semester, <span class="hljs-keyword">year</span>),
    FOREIGN <span class="hljs-keyword">KEY</span> (course_id, sec_id, semester, <span class="hljs-keyword">year</span>) <span class="hljs-keyword">REFERENCES</span> <span class="hljs-keyword">section</span> (course_id, sec_id, semester, <span class="hljs-keyword">year</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>,
    FOREIGN <span class="hljs-keyword">KEY</span> (<span class="hljs-keyword">ID</span>) <span class="hljs-keyword">REFERENCES</span> student (<span class="hljs-keyword">ID</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>
);

<span class="hljs-comment">-- Create table for advisor</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> advisor (
    s_ID            <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>),
    i_ID            <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">5</span>),
    PRIMARY <span class="hljs-keyword">KEY</span> (s_ID),
    FOREIGN <span class="hljs-keyword">KEY</span> (i_ID) <span class="hljs-keyword">REFERENCES</span> instructor (<span class="hljs-keyword">ID</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">SET</span> <span class="hljs-literal">NULL</span>,
    FOREIGN <span class="hljs-keyword">KEY</span> (s_ID) <span class="hljs-keyword">REFERENCES</span> student (<span class="hljs-keyword">ID</span>)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>
);

<span class="hljs-comment">-- Create table for time_slot</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> time_slot (
    time_slot_id    <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">4</span>),
    <span class="hljs-keyword">day</span>             <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">1</span>),
    start_hr        <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (start_hr &gt;= <span class="hljs-number">0</span> <span class="hljs-keyword">AND</span> start_hr &lt; <span class="hljs-number">24</span>),
    start_min       <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (start_min &gt;= <span class="hljs-number">0</span> <span class="hljs-keyword">AND</span> start_min &lt; <span class="hljs-number">60</span>),
    end_hr          <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (end_hr &gt;= <span class="hljs-number">0</span> <span class="hljs-keyword">AND</span> end_hr &lt; <span class="hljs-number">24</span>),
    end_min         <span class="hljs-built_in">NUMERIC</span>(<span class="hljs-number">2</span>) <span class="hljs-keyword">CHECK</span> (end_min &gt;= <span class="hljs-number">0</span> <span class="hljs-keyword">AND</span> end_min &lt; <span class="hljs-number">60</span>),
    PRIMARY <span class="hljs-keyword">KEY</span> (time_slot_id, <span class="hljs-keyword">day</span>, start_hr, start_min)
);

<span class="hljs-comment">-- Create table for prereq</span>
<span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> prereq (
    course_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>), 
    prereq_id       <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">8</span>),
    PRIMARY <span class="hljs-keyword">KEY</span> (course_id, prereq_id),
    FOREIGN <span class="hljs-keyword">KEY</span> (course_id) <span class="hljs-keyword">REFERENCES</span> course (course_id)
        <span class="hljs-keyword">ON</span> <span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">CASCADE</span>,
    FOREIGN <span class="hljs-keyword">KEY</span> (prereq_id) <span class="hljs-keyword">REFERENCES</span> course (course_id)
);
</code></pre>
        <h2 id="toc-29">Show Tables</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">TABLES</span>;
</code></pre>
        <h2 id="toc-30">Show Table Code</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> employee;
</code></pre>
        <h2 id="toc-31">Describe Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DESCRIBE</span> employee;
DESC employee;
<span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">COLUMNS</span> <span class="hljs-keyword">IN</span> employee;
</code></pre>
        <h2 id="toc-32">Rename Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">RENAME</span> <span class="hljs-keyword">TABLE</span> employee <span class="hljs-keyword">TO</span> employee_table;
<span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee_table <span class="hljs-keyword">RENAME</span> <span class="hljs-keyword">TO</span> employee;
</code></pre>
        <h2 id="toc-33">Renaming Column</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee 
<span class="hljs-keyword">CHANGE</span> <span class="hljs-keyword">COLUMN</span> employee_id emp_id <span class="hljs-built_in">INT</span>;
</code></pre>
        <h2 id="toc-34">Add Constraint to Column</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee 
<span class="hljs-keyword">CHANGE</span> <span class="hljs-keyword">COLUMN</span> first_name first_name <span class="hljs-built_in">VARCHAR</span>(<span class="hljs-number">50</span>) <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h2 id="toc-35">Add Column</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee 
<span class="hljs-keyword">ADD</span> <span class="hljs-keyword">COLUMN</span> salary <span class="hljs-built_in">REAL</span>;
</code></pre>
        <h2 id="toc-36">Drop Column</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee 
<span class="hljs-keyword">DROP</span> <span class="hljs-keyword">COLUMN</span> salary;
</code></pre>
        <h2 id="toc-37">Modify the Datatype of column</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> employee 
<span class="hljs-keyword">MODIFY</span> <span class="hljs-keyword">COLUMN</span> salary <span class="hljs-built_in">INT</span>;
</code></pre>
        <h2 id="toc-38">Truncate Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">TRUNCATE</span> employee;
</code></pre>
        <blockquote>
          <p>Trancute means to delete all the rows from the table but the table structure remains the same.</p>
        </blockquote>
        <h2 id="toc-39">Drop Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DROP</span> <span class="hljs-keyword">TABLE</span> department;
</code></pre>
        <h2 id="toc-40">Drop Database</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DROP</span> <span class="hljs-keyword">DATABASE</span> cheatsheet;
</code></pre>
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
    <span class="hljs-number">1</span>, 
    <span class="hljs-string">"Anurag"</span>, 
    <span class="hljs-string">"Peddi"</span>, 
    <span class="hljs-number">1</span>, 
    <span class="hljs-number">20</span>, 
    <span class="hljs-number">93425.63</span>
);

INSERT INTO employee VALUES (
    <span class="hljs-number">2</span>, 
    <span class="hljs-string">"Anuhya"</span>, 
    <span class="hljs-string">"Peddi"</span>, 
    <span class="hljs-number">2</span>, 
    <span class="hljs-number">20</span>, 
    <span class="hljs-number">83425.63</span>
);
</code></pre>
        <h2 id="toc-43">Insertion (Partial)</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">INSERT</span> <span class="hljs-keyword">INTO</span> employee (
    employee_id, 
    first_name
) <span class="hljs-keyword">VALUES</span> (
    <span class="hljs-number">3</span>, 
    <span class="hljs-string">"Vageesh"</span>
);
</code></pre>
        <h2 id="toc-44">Updating all rows</h2>
        <pre><code class="lang-sql">UPDATE employee 
<span class="hljs-keyword">SET</span> salary <span class="hljs-comment">= 1.1 * salary</span>;
</code></pre>
        <h2 id="toc-45">Updating a specified row</h2>
        <pre><code class="lang-sql">UPDATE employee 
<span class="hljs-keyword">SET</span> salary <span class="hljs-comment">= 1.2 * salary</span> 
WHERE <span class="hljs-comment">employee_id = 1</span>;
</code></pre>
        <h2 id="toc-46">Delete a specified row</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> employee_id = <span class="hljs-number">2</span>;
</code></pre>
        <h2 id="toc-47">Delete all rows</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">FROM</span> employee;
</code></pre>
        <h1 id="toc-48">Data Query Language (DQL)</h1>
        <h2 id="toc-49">Display Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee;
</code></pre>
        <h2 id="toc-50">Select only specified columns</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    employee_id, 
    first_name 
<span class="hljs-keyword">FROM</span> 
    employee;
</code></pre>
        <h2 id="toc-51">Select only few rows</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    employee_id, 
    first_name 
<span class="hljs-keyword">FROM</span> 
    employee 
<span class="hljs-keyword">WHERE</span> 
    age &gt; <span class="hljs-number">25</span>;
</code></pre>
        <h2 id="toc-52">Where Clause</h2>
        <h3 id="toc-53">Greater than(&gt;)</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary &gt; <span class="hljs-number">3100</span>;
</code></pre>
        <h3 id="toc-54">Greater than equal to(&gt;=)</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary &gt;= <span class="hljs-number">3100</span>;
</code></pre>
        <h3 id="toc-55">Less than(&lt;)</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary &lt; <span class="hljs-number">4500</span>;
</code></pre>
        <h3 id="toc-56">Less than equal to(&lt;=)</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary &lt;= <span class="hljs-number">4350</span>;
</code></pre>
        <h3 id="toc-57">Range</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary &gt; <span class="hljs-number">3000</span> 
<span class="hljs-keyword">AND</span> salary &lt; <span class="hljs-number">4000</span>;
</code></pre>
        <h3 id="toc-58">BETWEEN and AND</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary <span class="hljs-keyword">BETWEEN</span> <span class="hljs-number">3000</span> <span class="hljs-keyword">AND</span> <span class="hljs-number">4000</span>;
</code></pre>
        <h3 id="toc-59">OR</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary = <span class="hljs-number">3000</span> 
<span class="hljs-keyword">OR</span> salary = <span class="hljs-number">4000</span>;
</code></pre>
        <h3 id="toc-60">Null</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary <span class="hljs-keyword">IS</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h3 id="toc-61">Not null</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> salary <span class="hljs-keyword">IS</span> <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h3 id="toc-62">ORDER BY Clause</h3>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">ORDER</span> <span class="hljs-keyword">BY</span> salary <span class="hljs-keyword">DESC</span>;
</code></pre>
        <h4 id="toc-63">Like Operator</h4>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> <span class="hljs-keyword">name</span> <span class="hljs-keyword">LIKE</span> <span class="hljs-string">'%Jo%'</span>;          <span class="hljs-comment">-- Similar to *Jo* in regrex</span>
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> employee 
<span class="hljs-keyword">WHERE</span> <span class="hljs-keyword">name</span> <span class="hljs-keyword">LIKE</span> <span class="hljs-string">'Jo_'</span>;           <span class="hljs-comment">-- Similar to Jo. in regrex</span>
</code></pre>
        <h1 id="toc-64">Views</h1>
        <h2 id="toc-65">Create a view</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">VIEW</span> personal_info <span class="hljs-keyword">AS</span> 
<span class="hljs-keyword">SELECT</span> 
    first_name, 
    last_name, 
    age 
<span class="hljs-keyword">FROM</span> 
    employees;
</code></pre>
        <h2 id="toc-66">Displaying view</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> * 
<span class="hljs-keyword">FROM</span> personal_info;
</code></pre>
        <h2 id="toc-67">Updating in view</h2>
        <pre><code class="lang-sql">UPDATE personal_info 
<span class="hljs-keyword">SET</span> salary <span class="hljs-comment">= 1.1 * salary</span>;
</code></pre>
        <h2 id="toc-68">Deleting record from view</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">FROM</span> personal_info 
<span class="hljs-keyword">WHERE</span> age &lt; <span class="hljs-number">40</span>;
</code></pre>
        <h2 id="toc-69">Droping a view</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DROP</span> <span class="hljs-keyword">VIEW</span> personal_info;
</code></pre>
        <h1 id="toc-70">Joins</h1>
        <h2 id="toc-71">Inner join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">INNER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid;

<span class="hljs-comment">-- or</span>

<span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid;
</code></pre>
        <h2 id="toc-72">Full outer join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">LEFT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid
<span class="hljs-keyword">UNION</span>
<span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">RIGHT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid;
</code></pre>
        <h2 id="toc-73">Left outer join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">LEFT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid;
</code></pre>
        <h2 id="toc-74">Right outer join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">RIGHT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid;
</code></pre>
        <h2 id="toc-75">Left outer join - inner join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">LEFT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid 
<span class="hljs-keyword">WHERE</span> p.pname <span class="hljs-keyword">IS</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h2 id="toc-76">Right outer join - inner join</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    e.fname, 
    p.pname 
<span class="hljs-keyword">FROM</span> 
    employees <span class="hljs-keyword">AS</span> e 
<span class="hljs-keyword">RIGHT</span> <span class="hljs-keyword">OUTER</span> <span class="hljs-keyword">JOIN</span> <span class="hljs-keyword">project</span> <span class="hljs-keyword">AS</span> p 
<span class="hljs-keyword">ON</span> e.eid = p.eid 
<span class="hljs-keyword">WHERE</span> e.fname <span class="hljs-keyword">IS</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h1 id="toc-77">Aggregation</h1>
        <h2 id="toc-78">Sum function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">SUM</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <h2 id="toc-79">Average function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">AVG</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <h2 id="toc-80">Count function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    district, 
    <span class="hljs-keyword">COUNT</span>(district) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> district;
</code></pre>
        <h2 id="toc-81">Maximum function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">MAX</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <h2 id="toc-82">Minimum function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">MIN</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <h2 id="toc-83">Standard deviation function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">STDDEV</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <h2 id="toc-84">Group concat function</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> 
    <span class="hljs-keyword">GROUP_CONCAT</span>(population) 
<span class="hljs-keyword">FROM</span> 
    city 
<span class="hljs-keyword">GROUP</span> <span class="hljs-keyword">BY</span> population;
</code></pre>
        <blockquote>
          <p>Only COUNT function considers NULL values</p>
        </blockquote>
        <h1 id="toc-85">Procedure</h1>
        <h2 id="toc-86">Creating procedure</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-function"><span class="hljs-keyword">PROCEDURE</span> <span class="hljs-title">display_dbs</span><span class="hljs-params">()</span>
<span class="hljs-title">SHOW</span> <span class="hljs-title">DATABASES</span>;</span>
</code></pre>
        <h2 id="toc-87">Calling procedure</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CALL</span> display_dbs<span class="hljs-comment">()</span>;
</code></pre>
        <h3 id="toc-88">Drop procedure</h3>
        <pre><code class="lang-sql">DROP <span class="hljs-function"><span class="hljs-keyword">PROCEDURE</span> <span class="hljs-title">display_dbs</span>;</span>
</code></pre>
        <h1 id="toc-89">Transaction</h1>
        <h2 id="toc-90">Begin transaction</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">START</span> <span class="hljs-keyword">TRANSACTION</span>;
</code></pre>
        <h2 id="toc-91">Create savepoint</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SAVEPOINT</span> sv_pt;
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">DELETE</span> <span class="hljs-keyword">FROM</span> city;       <span class="hljs-comment">-- changing data in table</span>
</code></pre>
        <h2 id="toc-92">Rollback</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ROLLBACK</span> <span class="hljs-keyword">TO</span> sv_pt;
</code></pre>
        <h2 id="toc-93">Releasing savepoint</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">RELEASE</span> <span class="hljs-keyword">SAVEPOINT</span> sv_pt;
</code></pre>
        <h2 id="toc-94">Commiting changes</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">COMMIT</span>;
</code></pre>
        <h1 id="toc-95">Constraints</h1>
        <h2 id="toc-96">Not Null</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee
<span class="hljs-keyword">CHANGE</span>
    Age
    Age <span class="hljs-built_in">INT</span> <span class="hljs-keyword">NOT</span> <span class="hljs-literal">NULL</span>;
</code></pre>
        <h2 id="toc-97">Unique</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee
<span class="hljs-keyword">ADD</span> <span class="hljs-keyword">CONSTRAINT</span> u_q <span class="hljs-keyword">UNIQUE</span>(<span class="hljs-keyword">ID</span>);
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee <span class="hljs-comment">-- drop the constraint</span>
<span class="hljs-keyword">DROP</span> <span class="hljs-keyword">CONSTRAINT</span> u_q;
</code></pre>
        <h2 id="toc-98">Primary Key</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee
<span class="hljs-keyword">ADD</span> <span class="hljs-keyword">CONSTRAINT</span> p_k PRIMARY <span class="hljs-keyword">KEY</span>(<span class="hljs-keyword">ID</span>);
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee <span class="hljs-comment">-- drop the constraint</span>
<span class="hljs-keyword">DROP</span> <span class="hljs-keyword">CONSTRAINT</span> p_k;
</code></pre>
        <h2 id="toc-99">Check</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee
<span class="hljs-keyword">ADD</span> <span class="hljs-keyword">CONSTRAINT</span> Age <span class="hljs-keyword">CHECK</span> (age&gt;=<span class="hljs-number">30</span>);
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee <span class="hljs-comment">-- drop the constraint</span>
<span class="hljs-keyword">DROP</span> <span class="hljs-keyword">CHECK</span> Age;
</code></pre>
        <h2 id="toc-100">Default</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee
<span class="hljs-keyword">ALTER</span> Age <span class="hljs-keyword">SET</span> <span class="hljs-keyword">DEFAULT</span> <span class="hljs-number">10</span>;
</code></pre>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">TABLE</span> Employee <span class="hljs-comment">-- drop the constraint</span>
<span class="hljs-keyword">ALTER</span> Age <span class="hljs-keyword">DROP</span> <span class="hljs-keyword">DEFAULT</span>;
</code></pre>
        <h2 id="toc-101">Cloning</h2>
        <h2 id="toc-102">Duplicate a Table Schema</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> emp_dup <span class="hljs-keyword">LIKE</span> employee;
</code></pre>
        <h2 id="toc-103">Duplicate a Table</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">TABLE</span> emp_dup <span class="hljs-keyword">SELECT</span> * <span class="hljs-keyword">FROM</span> employee;
</code></pre>
        <h1 id="toc-104">Access Controls</h1>
        <h2 id="toc-105">Creating New User</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span> 
<span class="hljs-keyword">IDENTIFIED</span> <span class="hljs-keyword">BY</span> <span class="hljs-string">'password'</span>;
</code></pre>
        <p>the hostname part is set to <code>localhost</code>, so the user will be able to connect to the MySQL server
          only from the localhost.<br>To grant access from another host, change the hostname part with the remote
          machine IP. </p>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'172.8.10.5'</span> 
<span class="hljs-keyword">IDENTIFIED</span> <span class="hljs-keyword">BY</span> <span class="hljs-string">'user_password'</span>;
</code></pre>
        <p>To create a user that can connect from any host, '%' is used in the hostname part:</p>
        <pre><code class="lang-sql"><span class="hljs-keyword">CREATE</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'%'</span> 
<span class="hljs-keyword">IDENTIFIED</span> <span class="hljs-keyword">BY</span> <span class="hljs-string">'user_password'</span>;
</code></pre>
        <h2 id="toc-106">Grant All Permissions</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">GRANT</span> ALL <span class="hljs-keyword">PRIVILEGES</span> <span class="hljs-keyword">ON</span> * . * 
<span class="hljs-keyword">TO</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <p>Asterisks(*) refers to the database and table names respectively.<br>By using asterisks we can give access of
          all the databases <strong>or</strong> tables to the user.</p>
        <h2 id="toc-107">Flush Privileges</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">FLUSH</span> <span class="hljs-keyword">PRIVILEGES</span>
</code></pre>
        <p>All the changes won't be in effect unless this query is fired.</p>
        <h2 id="toc-108">Specific User Permissions</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">GRANT</span> type_of_permission 
<span class="hljs-keyword">ON</span> database_name.table_name 
<span class="hljs-keyword">TO</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <p><code>type_of_permission</code> may have one of these value:</p>
        <ul>
          <li><strong>ALL PRIVILEGES</strong> - Allows user full access to a designated database (or if no database is
            selected, global access across the system).</li>
          <li><strong>CREATE</strong> - allows them to create new tables or databases.</li>
          <li><strong>DROP</strong> - allows them to them to delete tables or databases.</li>
          <li><strong>DELETE</strong> - allows them to delete rows from tables.</li>
          <li><strong>INSERT</strong> - allows them to insert rows into tables.</li>
          <li><strong>SELECT</strong> - allows them to use the <code>SELECT</code> command to read through databases.
          </li>
          <li><strong>UPDATE</strong> - allow them to update table rows.</li>
          <li><strong>GRANT OPTION</strong> - allows them to grant or remove other users’ privileges.<br>Multiple
            permissions are given with commas.</li>
        </ul>
        <h2 id="toc-109">Revoking permissions</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">REVOKE</span> type_of_permission 
<span class="hljs-keyword">ON</span> database_name.table_name 
<span class="hljs-keyword">FROM</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h2 id="toc-110">Show User's Current Permissions</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SHOW</span> <span class="hljs-keyword">GRANTS</span> <span class="hljs-keyword">FOR</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h2 id="toc-111">Delete a User</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">DROP</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'username'</span>@<span class="hljs-string">'localhost'</span>;
</code></pre>
        <h2 id="toc-112">Set new password to a user</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">USE</span> mysql;
<span class="hljs-keyword">UPDATE</span> <span class="hljs-keyword">user</span> 
<span class="hljs-keyword">SET</span> authentication_string=<span class="hljs-keyword">PASSWORD</span>(<span class="hljs-string">"&lt;new2-password&gt;"</span>) 
<span class="hljs-keyword">WHERE</span> <span class="hljs-keyword">User</span>=<span class="hljs-string">'&lt;user&gt;'</span>;
<span class="hljs-keyword">FLUSH</span> <span class="hljs-keyword">PRIVILEGES</span>;
</code></pre>
        <h2 id="toc-113">Reset Root Password</h2>
        <p>Stop MySQL service</p>
        <pre><code>sudo systemctl <span class="hljs-built_in">stop</span> mysql
</code></pre>
        <p>Restart MySQL service without loading grant tables</p>
        <pre><code class="lang-bash">sudo mysqld_safe <span class="hljs-comment">--skip-grant-tables &amp;</span>
</code></pre>
        <p>The apersand (&amp;) will cause the program to run in the background and <code>--skip-grant-tables</code>
          enables everyone to to connect to the database server without a password and with all privileges granted.
          Login to shell</p>
        <pre><code><span class="hljs-attribute">mysql -u root</span>
</code></pre>
        <p>Set new password for root</p>
        <pre><code class="lang-sql"><span class="hljs-keyword">ALTER</span> <span class="hljs-keyword">USER</span> <span class="hljs-string">'root'</span>@<span class="hljs-string">'localhost'</span> 
<span class="hljs-keyword">IDENTIFIED</span> <span class="hljs-keyword">BY</span> <span class="hljs-string">'MY_NEW_PASSWORD'</span>;
<span class="hljs-keyword">FLUSH</span> <span class="hljs-keyword">PRIVILEGES</span>;
</code></pre>
        <p>Stop and start the server once again</p>
        <pre><code>mysqladmin -u root -<span class="hljs-selector-tag">p</span> shutdown
sudo systemctl start mysql
</code></pre>
        <h1 id="toc-114">Programming</h1>
        <h2 id="toc-115">Declare variables</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SET</span> @num <span class="hljs-comment">= 10</span>;
<span class="hljs-keyword">SET</span> @name <span class="hljs-comment">=</span> <span class="hljs-comment">'Anurag'</span>;
</code></pre>
        <h2 id="toc-116">Print them</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> @<span class="hljs-keyword">name</span>;
</code></pre>
        <h2 id="toc-117">For loop</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SET</span> @n = <span class="hljs-number">21</span>;
<span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">REPEAT</span>(<span class="hljs-string">"* "</span>, @n := @n - <span class="hljs-number">1</span>) 
<span class="hljs-keyword">FROM</span> information_schema.tables 
<span class="hljs-keyword">WHERE</span> @n &gt; <span class="hljs-number">0</span>;
</code></pre>
        <h1 id="toc-118">Miscellaneous</h1>
        <h2 id="toc-119">Enabling foreign key checks</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SET</span> foreign_key_checks <span class="hljs-comment">= 1</span>;
</code></pre>
        <h2 id="toc-120">Disabling foreign key checks</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SET</span> foreign_key_checks <span class="hljs-comment">= 0</span>;
</code></pre>
        <h2 id="toc-121">Round</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">ROUND</span>(<span class="hljs-number">3.141596</span>, <span class="hljs-number">3</span>);
</code></pre>
        <h2 id="toc-122">Repeated concatenation</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">REPEAT</span>(<span class="hljs-string">"* "</span>, <span class="hljs-number">20</span>);
</code></pre>
        <h2 id="toc-123">Random float</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">RAND</span>();
</code></pre>
        <h2 id="toc-124">Typecast to Int</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">CAST</span>(<span class="hljs-number">23.01245</span> <span class="hljs-keyword">AS</span> SIGNED);
</code></pre>
        <h2 id="toc-125">Concatenation</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">CONCAT</span>(<span class="hljs-string">"Mahesh"</span>, <span class="hljs-string">" "</span>, <span class="hljs-string">"Chandra"</span>, <span class="hljs-string">" "</span>, <span class="hljs-string">"Duddu"</span>, <span class="hljs-string">"!"</span>);
</code></pre>
        <h2 id="toc-126">Extract Month</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">MONTH</span>(<span class="hljs-string">"1998-12-30"</span>);
</code></pre>
        <h2 id="toc-127">Extract Year</h2>
        <pre><code class="lang-sql"><span class="hljs-keyword">SELECT</span> <span class="hljs-keyword">YEAR</span>(<span class="hljs-string">"1998-12-30"</span>);
</code></pre>
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
              <li><a href="#toc-7">Grant All Privileges On All Databases</a></li>
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
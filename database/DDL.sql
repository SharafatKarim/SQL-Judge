CREATE DATABASE IF NOT EXISTS sql_judge;
USE sql_judge;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    country VARCHAR(50),
    institution VARCHAR(100),
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    is_verified BOOLEAN DEFAULT FALSE,
    verification_code VARCHAR(255),
    verification_code_expiry DATETIME,
    reset_token VARCHAR(255),
    reset_token_expiry DATETIME,
    profile_picture VARCHAR(255),
    bio TEXT,
    gender VARCHAR(10),
    date_of_birth DATE,
    phone_number VARCHAR(20),
    address VARCHAR(255),
    website VARCHAR(255),
    github VARCHAR(255),
    twitter VARCHAR(255),
    linkedin VARCHAR(255),
    facebook VARCHAR(255),
    telegram VARCHAR(255),
    last_login DATETIME,
    total_solved INT DEFAULT 0,
    total_submissions INT DEFAULT 0,
    total_contributions INT DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS feedback;
CREATE TABLE feedback (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    feedback TEXT NOT NULL,
    website VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(ID)
);

DROP TABLE IF EXISTS blogs;
CREATE TABLE blogs (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL, -- HTML content
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME ON UPDATE CURRENT_TIMESTAMP,
    is_published BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (author_id) REFERENCES users(ID)
);

-- A trigger to increment total_contributions for the author when a new blog is published
DELIMITER $$
CREATE TRIGGER increment_contributions_after_insert
AFTER INSERT ON blogs
FOR EACH ROW
BEGIN
    IF NEW.is_published = TRUE THEN
        UPDATE users
        SET total_contributions = total_contributions + 5
        WHERE ID = NEW.author_id;
    END IF;
END$$
DELIMITER ;

-- Trigger to decrement total_contributions when a blog is updated from published to draft
DELIMITER $$
CREATE TRIGGER decrement_contributions_after_update_to_draft
AFTER UPDATE ON blogs
FOR EACH ROW
BEGIN
    IF OLD.is_published = TRUE AND NEW.is_published = FALSE THEN
        UPDATE users
        SET total_contributions = total_contributions - 5
        WHERE ID = NEW.author_id;
    END IF;
END$$
DELIMITER ;

-- Trigger to increment total_contributions when a blog is updated from draft to published
DELIMITER $$
CREATE TRIGGER increment_contributions_after_update_to_publish
AFTER UPDATE ON blogs
FOR EACH ROW
BEGIN
    IF OLD.is_published = FALSE AND NEW.is_published = TRUE THEN
        UPDATE users
        SET total_contributions = total_contributions + 5
        WHERE ID = NEW.author_id;
    END IF;
END$$
DELIMITER ;

DROP TABLE IF EXISTS blog_comments;
CREATE TABLE blog_comments (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    blog_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (blog_id) REFERENCES blogs(ID),
    FOREIGN KEY (user_id) REFERENCES users(ID)
);

-- Trigger to increment total_contributions by 1 when a new comment is added
DELIMITER $$
CREATE TRIGGER increment_contributions_after_comment
AFTER INSERT ON blog_comments
FOR EACH ROW
BEGIN
    UPDATE users
    SET total_contributions = total_contributions + 1
    WHERE ID = NEW.user_id;
END$$
DELIMITER ;

DROP TABLE IF EXISTS blog_reactions;
CREATE TABLE blog_reactions (
    blog_id INT,
    user_id INT,
    reaction ENUM('like', 'dislike') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (blog_id, user_id),
    FOREIGN KEY (blog_id) REFERENCES blogs(ID),
    FOREIGN KEY (user_id) REFERENCES users(ID)
);

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    subscribed_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS contests;
CREATE TABLE contests (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    is_public BOOLEAN DEFAULT TRUE,
    created_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(ID)
);

DROP TABLE IF EXISTS contest_registrations;
CREATE TABLE contest_registrations (
    user_id INT NOT NULL,
    contest_id INT NOT NULL,
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, contest_id),
    FOREIGN KEY (user_id) REFERENCES users(ID),
    FOREIGN KEY (contest_id) REFERENCES contests(ID)
);

DROP TABLE IF EXISTS problems;
CREATE TABLE problems (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    contest_id INT,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    time_limit INT DEFAULT 2, -- in seconds
    memory_limit INT DEFAULT 256, -- in MB
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (contest_id) REFERENCES contests(ID)
);

DROP TABLE IF EXISTS test_cases;
CREATE TABLE test_cases (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    problem_id INT NOT NULL,
    input TEXT,
    expected_output TEXT,
    is_hidden BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (problem_id) REFERENCES problems(ID)
);

DROP TABLE IF EXISTS submissions;
CREATE TABLE submissions (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    problem_id INT NOT NULL,
    code TEXT NOT NULL,
    status ENUM('pending', 'running', 'accepted', 'wrong_answer', 'time_limit_exceeded', 'runtime_error') DEFAULT 'pending',
    execution_time FLOAT,
    memory_used INT,
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(ID),
    FOREIGN KEY (problem_id) REFERENCES problems(ID)
);

-- Trigger to increment total_submissions by 1 when a new submission is added
DELIMITER $$
CREATE TRIGGER increment_total_submissions_after_insert
AFTER INSERT ON submissions
FOR EACH ROW
BEGIN
    UPDATE users
    SET total_submissions = total_submissions + 1
    WHERE ID = NEW.user_id;
END$$
DELIMITER ;

DROP TABLE IF EXISTS user_scores;
CREATE TABLE user_scores (
    user_id INT NOT NULL,
    contest_id INT NOT NULL,
    problem_id INT NOT NULL,
    PRIMARY KEY (user_id, contest_id, problem_id),
    FOREIGN KEY (user_id) REFERENCES users(ID),
    FOREIGN KEY (contest_id) REFERENCES contests(ID),
    FOREIGN KEY (problem_id) REFERENCES problems(ID)
);

-- Trigger to increment total_solved by 1 when a new user_scores entry is added
DELIMITER $$
CREATE TRIGGER increment_total_solved_after_user_score_insert
AFTER INSERT ON user_scores
FOR EACH ROW
BEGIN
    UPDATE users
    SET total_solved = total_solved + 1
    WHERE ID = NEW.user_id;
END$$
DELIMITER ;

-- View to get the top 5 users based on total_solved
CREATE VIEW top_rated_5 as
SELECT username, first_name, last_name, total_solved 
FROM users 
ORDER BY total_solved DESC LIMIT 5;

-- View to get the top 5 users based on total_contributions
CREATE VIEW top_contributors_5 as
SELECT username, first_name, last_name, total_contributions 
FROM users 
ORDER BY total_contributions DESC LIMIT 5;
# SQL Judge

An SQL learning platform that allows users to learn and practice SQL queries. It it provides a set of
features including user registration, problem submission, and a leaderboard. And last but not least, it has built in Blog and chatsheet.

## How to run?

### Getting Started

1. **Clone the repository:**

  ```bash
  git clone https://github.com/SharafatKarim/SQL-Judge
  ```

2. **Navigate to the project directory:**

  ```bash
  cd SQL-Judge
  ```

3. **Ensure MySQL is installed and running.**

4. **Create the database and tables:**

- Run the SQL script located at `database/DDL.sql`.

5. **Ensure PHP is installed.**

6. **Set up environment variables:**

- Copy the example environment file:

    ```bash
    cp .env.example .env
    ```

- Alternatively, create a `.env` file manually in the root directory.
- Fill in your database credentials in the `.env` file.

7. **Start the development server:**

  ```bash
  php -S localhost:8000
  ```

## To-DO

- [x] Problemsets and contests (initial stage).
- [x] DB trigger to automatically update total_contribution, total_submission and total_solved per user.
- [ ] Admin page implementation.
- [ ] Friends list and add friends functionality.

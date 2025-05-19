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
  <link rel="stylesheet" href="../styles/table.css">
</head>

<body>
  <?php require '../components/header.php'; ?>
  <?php require '../components/navbar.php'; ?>

  <div class="row">
    <!-- left column -->
    <div class="leftcolumn">
      <div class="card">
        <h2>Index Journey Map!</h2>
        <p>Let's embark on our journey... </br>
        You can read the tutorial part online, or download a pdf/ pptx copy from the below table.</p>


        <table border="1">
          <thead>
            <tr>
              <th>Chapter</th>
              <th>Download Formats</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="3"><strong>Part 1: Overview</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=1&lesson=1">1. Introduction</a></td>
              <td>
                <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch1.pptx">pptx</a>,
                <a href="https://www.db-book.com/slides-dir/PDF-dir/ch1.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 1: Relational Languages</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=2&lesson=1">2. Introduction to the Relational Model</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch2.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch2.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=3&lesson=1">3. Introduction to SQL</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch3.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch3.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=4&lesson=1">4. Intermediate SQL</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch4.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch4.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=5&lesson=1">5. Advanced SQL</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch5.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch5.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 2: Database Design</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=6&lesson=1">6. Database Design Using The E-R Model</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch6.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch6.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=7&lesson=1">7. Relational Database Design</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch7.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch7.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 3: Application Design and Development</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=8&lesson=1">8. Complex Data Types</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch8.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch8.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=9&lesson=1">9. Application Development</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch9.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch9.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 4: Big Data Analytics</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=10&lesson=1">10. Big Data</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch10.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch10.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=11&lesson=1">11. Data Analysis</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch11.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch11.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 4: Storage Management</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=12&lesson=1">12. Physical Storage Systems</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch12.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch12.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=13&lesson=1">13. Data Storage Structures</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch13.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch13.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=14&lesson=1">14. Indexing</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch14.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch14.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 5: Querying</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=15&lesson=1">15. Query Processing</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch15.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch15.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=16&lesson=1">16. Query Optimization</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch16.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch16.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 6: Transaction Management</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=17&lesson=1">17. Transactions</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch17.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch17.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=18&lesson=1">18. Concurrency Control</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch18.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch18.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=19&lesson=1">19. Recovery System</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch19.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch19.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 7: Parallel and Distributed Databases</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=20&lesson=1">20. Database System Architectures</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch20.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch20.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=21&lesson=1">21. Parallel and Distributed Storage</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch21.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch21.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=22&lesson=1">22. Parallel and Distributed Query Processing</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch22.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch22.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=23&lesson=1">23. Parallel and Distributed Transaction Processing</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch23.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch23.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 8: Advanced Topics</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=24&lesson=1">24. Advanced Indexing Techniques</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch24.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch24.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=25&lesson=1">25. Advanced Application Development</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch25.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch25.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=26&lesson=1">26. Blockchain Databases</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch26.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch26.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td colspan="3"><strong>Part 10: Online Chapters</strong></td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=27&lesson=1">27. Formal-Relational Query Languages</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch27.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch27.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=28&lesson=1">28. Advanced Relational Database Design</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch28.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch28.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=29&lesson=1">29. Object-Based Databases</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch29.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch29.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=30&lesson=1">30. XML</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch30.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch30.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td><a href="./read.php?chapter=31&lesson=1">31. Information Retrieval</a></td>
              <td>
              <a href="https://www.db-book.com/slides-dir/PPTX-dir/ch31.pptx">pptx</a>,
              <a href="https://www.db-book.com/slides-dir/PDF-dir/ch31.pdf">pdf</a>
              </td>
            </tr>
            <tr>
              <td>32. PostgreSQL</td>
              <td>... (not available)</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Copyright notice -->
      <div class="card">
        <h2>Copyright Note</h2>
        <p> The slides and figures above are copyright Silberschatz, Korth. Sudarshan, 2019.
          The slides and figures are authorized for personal use,
          and for use in conjunction with a course for which Database System Concepts is the prescribed text.
          Instructors are free to modify the slides to their taste,
          as long as the modified slides acknowledge the source and the fact that they have been modified.
          Paper copies of the slides may be sold strictly at the price of reproduction,
          to students of courses where the book is the prescribed text.
          Any use that differs from the above, and any for profit sale of the slides (in any form)
          requires the consent of the copyright owners;
          contact Avi Silberschatz (avi@cs.yale.edu) to obtain the copyright owners consent. </p>

        <p>Source is taken <a href="https://www.db-book.com/slides-dir/index.html">from this website</a>.</p>
      </div>
    </div>

    <!-- right column -->
    <div class="rightcolumn">
      <?php include '../components/right_sidebar.php' ?>
    </div>
  </div>

  <?php require '../components/footer.php'; ?>

  <?php
  // Close the connection
  unset($conn);
  ?>
</body>

</html>
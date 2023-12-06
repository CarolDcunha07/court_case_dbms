<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Legal Insights - Legal Command Center</title>
    <link rel="stylesheet" href="casemanagement.css"> 
</head>

<body>

    <header>
        <h1>Legal Insights Hub</h1>
    </header>

    <main>
        <section id="searchForm">
            <h2>Uncover Legal Wisdom</h2>
            <form action="#" method="post" onsubmit="searchLegalDatabase(event)">

                <label for="category">Select a Realm:</label>
                <select name="category" id="category">
                    <option value="all">All Categories</option>
                    <option value="legal_precedents">Legal Precedents</option>
                    <option value="court_procedures">Court Procedures</option>
                </select>

                <br><br>

                <button type="submit">Embark on a Journey</button>
            </form>
        </section>

        <section id="searchResults">
            <h2>Discoveries Await</h2>
            <div id="resultsContainer">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $category = $_POST["category"];

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "login_sample_db1";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT title, content, description FROM articles WHERE category = '$category'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div><h3>" . $row["title"] . "</h3><p>" . $row["content"] . "</p><p><strong>Description:</strong> " . $row["description"] . "</p></div>";
                        }
                    } else {
                        echo "<p>No results found. Explore other realms.</p>";
                    }

                    $conn->close();
                }
                ?>
            </div>
        </section>

        <button id="closeButton" onclick="goBack()">Close Insights</button>
    </main>

    <footer>
        <p>&copy; 2023 Legal Command Center. All rights reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>

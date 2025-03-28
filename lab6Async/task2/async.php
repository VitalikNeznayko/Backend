        <?php
        $data = file_get_contents("php://input");
        $json = json_decode($data);
        $dsn = "mysql:host=localhost;dbname=lab6";

        foreach ($json as $key => $value) {
            if (strlen($value) > 0) {
                $$key = $value;
            }
        }
        if ($action === "create") {
            if (isset($title) && isset($text)) {
                try {
                    $pdo = new PDO($dsn, 'root', '');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM notes WHERE title = :title LIMIT 1";
                    $sth = $pdo->prepare($sql);
                    $sth->bindValue(":title", $title);
                    $sth->execute();

                    $values = [
                        "id" => null,
                        "title" => $title,
                        "text" => $text,
                    ];
                    create($pdo, $values);
                } catch (PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                    return;
                }
            }
        } else if ($action === "delete") {
            try {
                $pdo = new PDO($dsn, 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM notes WHERE id = :id";
                $sth = $pdo->prepare($sql);
                $sth->bindValue(":id", $id);
                $sth->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return;
            }
        } else if ($action === "edit") {
            try {
                $pdo = new PDO($dsn, 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
                return;
            }

            $sql = "UPDATE notes SET title = :title, text = :text WHERE id = :id";
            $sth = $pdo->prepare($sql);
            $sth->bindValue(":id", $id);
            $sth->bindValue(":title", $title);
            $sth->bindValue(":text", $text);

            $sth->execute();
        } else if ($action === "getContent") {
            try {
                $pdo = new PDO($dsn, 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
                return;
            }

            getContent($pdo);
        }
        function create($pdo, $values)
        {
            $sql = "INSERT INTO notes (title, text) VALUES (:title, :text)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $values['title']);
            $stmt->bindParam(':text', $values['text']);

            $stmt->execute();
        }
        function getContent($pdo)
        {
            $sql = "SELECT * FROM notes ORDER BY id ASC";
            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data);
        }

<?php
    $sql = "SELECT * FROM news ORDER BY news_date DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

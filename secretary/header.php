<?php global $page_name;

//$page_name = isset($_GET['page']) ? $_GET['page'] : '';
//    header("Location: /gabi/404");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary Dashboard</title>
    <?php
    $stylesheets = [
        "index" => ["../assets/css/common.css"],
        "home" => ["../../assets/css/common.css"],
        "dashboard" => ["../assets/css/common.css"],
        "files" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
        "files_barangay" => [
            "../../../assets/css/common.css",
            "../../../assets/css/files/index.css"
        ],
        "residents" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
        "reports" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
        "seminar" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
        "gov ben" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
        "barangay_info" => [
            "../../assets/css/common.css",
            "../../assets/css/files/index.css"
        ],
    ];

    $current_stylesheets = $stylesheets[$page_name] ?? [];

    foreach ($current_stylesheets as $stylesheet) {
        echo '<link rel="stylesheet" href="' . htmlspecialchars($stylesheet, ENT_QUOTES, 'UTF-8') . '">';
    }
    ?>
</head>

<body>
<header>
    <div class="title">
        <li><a href="/gabi/secretary" class="nav-link">Secretary</a></li>
    </div>
    <?php
    $menuItems = [
        'home' => '/gabi/secretary/home/',
        'files' => '/gabi/secretary/files/',
        'residents' => '/gabi/secretary/residents/',
        'reports' => '/gabi/secretary/reports/',
        'seminar' => '/gabi/secretary/seminar/',
        'gov ben' => '/gabi/secretary/benefits/',
        'barangay info' => '/gabi/secretary/barangay_info/'
    ];
    ?>

    <nav>
        <ul class="navbar">
            <?php foreach ($menuItems as $name => $url): ?>
                <li>
                    <a href="<?php echo $url; ?>"
                       class="nav-link <?php echo ($page_name === $name) ? 'active' : ''; ?>">
                        <?php echo ucfirst($name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li><a href="/../gabi/logout.php" class="nav-link logout-btn">Login</a></li>
        </ul>
    </nav>

</header>
</body>
</html>
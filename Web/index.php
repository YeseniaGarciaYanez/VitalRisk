<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Dinámico</title>
    <script defer src="js/header.js"></script>
    <style>
        #header {
            background-color: #333;
            color: white;
            padding: 10px;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
        }
        nav ul li {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header id="header"></header>
</body>
</html>

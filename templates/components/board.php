<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='UTF-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Devoir-php/public/assets/css/style.css">
</head>

<body>
    <main>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Départ</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Places</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($line = 1; $line <= 7; $line++): ?>
                        <tr>
                            <?php for ($col = 1; $col <= 7; $col++): ?>
                                <td> xxx <?= $line ?>, xxx <?= $col ?></td>
                            <?php endfor; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
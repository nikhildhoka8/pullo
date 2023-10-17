<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'head.php'; ?>
    <title>View Size</title>
</head>

<body>
    <div class="header_main">
        <?php require_once 'headerNav.php'; ?>
    </div>
    <?php require_once 'adminSecondNav.php'; ?>
    <?php

    $size = [
        [
            'id' => 1,
            'name' => '6'
        ],
        [
            'id' => 2,
            'name' => '7'
        ],
        [
            'id' => 3,
            'name' => '8'
        ],
        [
            'id' => 4,
            'name' => '9'
        ],
        [
            'id' => 5,
            'name' => '10'
        ],
        [
            'id' => 6,
            'name' => '11'
        ],
        [
            'id' => 7,
            'name' => '12'
        ],
        [
            'id' => 8,
            'name' => '13'
        ]
    ];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Check if $size is an array before iterating over it
        if (is_array($size)) {
            // Use foreach with key to get the index of the item to remove
            foreach ($size as $key => $value) {
                if ($value['id'] == $id) {
                    unset($size[$key]);
                }
            }
        }
    }
    ?>
    <br><div class="buttons clearfix">
        <div class="pull-right"><a class="btn btn-primary" href="./addSize.php">Add Size</a>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Size ID</th>
                <th>Size Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($size as $size) {
                echo "<tr>";
                echo "<td>" . $size['id'] . "</td>";
                echo "<td>" . $size['name'] . "</td>";
                echo "<td><a href='viewSize.php?id=" . $size['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
    <?php require_once 'footerNav.php'; ?>
</body>

</html>
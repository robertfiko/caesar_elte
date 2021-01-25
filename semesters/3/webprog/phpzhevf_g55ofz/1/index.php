<?php
$activities = [
    1 => [
        "name" => "alvás",
        "difficulty" => 0.05
    ],
    2 => [
        "name" => "bányászás",
        "difficulty" => 0.6
    ],
    3 => [
        "name" => "család",
        "difficulty" => 0.4
    ],
    4 => [
        "name" => "programozás",
        "difficulty" => 0.95
    ],
    5 => [
        "name" => "zsákmányolás",
        "difficulty" => 0.7
    ],
    6 => [
        "name" => "vadászat",
        "difficulty" => 0.6
    ],
    7 => [
        "name" => "játék",
        "difficulty" => 0.0
    ],
    8 => [
        "name" => "főzés",
        "difficulty" => 0.6
    ]
];
$goblins = [
    "WEB'LIN" => [
        [
            "startHour" => 0,
            "activityKey" => 3
        ],
        [
            "startHour" => 1,
            "activityKey" => 3
        ],
        [
            "startHour" => 3,
            "activityKey" => 5
        ],
        [
            "startHour" => 4,
            "activityKey" => 4
        ],
        [
            "startHour" => 5,
            "activityKey" => 4
        ],
        [
            "startHour" => 7,
            "activityKey" => 1
        ]
    ],
    "HUN'TER" => [
        [
            "startHour" => 0,
            "activityKey" => 1
        ],
        [
            "startHour" => 1,
            "activityKey" => 6
        ],
        [
            "startHour" => 3,
            "activityKey" => 3
        ],
        [
            "startHour" => 4,
            "activityKey" => 3
        ],
        [
            "startHour" => 5,
            "activityKey" => 6
        ],
        [
            "startHour" => 7,
            "activityKey" => 6
        ]
    ],
    "MOT'HER" => [
        [
            "startHour" => 0,
            "activityKey" => 3
        ],
        [
            "startHour" => 1,
            "activityKey" => 3
        ],
        [
            "startHour" => 3,
            "activityKey" => 6
        ],
        [
            "startHour" => 4,
            "activityKey" => 8
        ],
        [
            "startHour" => 5,
            "activityKey" => 8
        ],
        [
            "startHour" => 7,
            "activityKey" => 3
        ]
    ],
    "GOB'KID" => [
        [
            "startHour" => 0,
            "activityKey" => 7
        ],
        [
            "startHour" => 1,
            "activityKey" => 7
        ],
        [
            "startHour" => 3,
            "activityKey" => 7
        ],
        [
            "startHour" => 4,
            "activityKey" => 7
        ],
        [
            "startHour" => 5,
            "activityKey" => 7
        ],
        [
            "startHour" => 7,
            "activityKey" => 7
        ]
    ]
];
$keys = array_keys($goblins);
$acts = [];

for ($i = 0; $i < count($goblins); $i++) {
    $acts[$i] = [];
    $tmp = 0;
    for ($j = 0; $j < count($goblins[$keys[$i]]);) {

        if ($goblins[$keys[$i]][$j]["startHour"] == $tmp) {
            $acts[$i][$tmp] = $goblins[$keys[$i]][$j];
            $j++;
        } else {
            $acts[$i][$tmp] = [
                "startHour" => $tmp,
                "activityKey" => 0
            ];
        }
        $tmp++;
    }
    for ($j = $tmp; $j < 8; $j++) {
        $acts[$i][$j] = [
            "startHour" => $j,
            "activityKey" => 0
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>1. feladat</title>
      <style>
      table,
      td,
      th {
            border: 1px black solid;
            border-collapse: collapse;
      }

      td {
            text-align: center;
      }
      </style>
</head>

<body>
      <h1>1. feladat</h1>
      <h2>Időbeosztás</h2>
      <table>
            <tr>
                  <th>Óra</th>
                  <?php

            for ($i = 0; $i < count($keys); $i++) {
                echo "<th>" . $keys[$i] . "</th>";
            }

            ?>
            </tr>


            <?php

        for ($j = 0; $j < 8; $j++) {
            echo "<tr>";
            echo "<td>" . $j . "</td>";

            for ($i = 0; $i < count($goblins); $i++) {
                $val = $acts[$i][$j]["activityKey"];
                if ($val == 0) {
                    $color = "white";
                } else {
                    $diff = $activities[$val]["difficulty"];
                    if ($diff > 0 && $diff <= 0.5) {
                        $color = "lightgreen";
                    } else if ($diff < 0.8) {
                        $color = "orange";
                    } else {
                        $color = "red";
                    }
                }
                $des = "";
                if ($acts[$i][$j]["activityKey"] != 0) {
                    $des =  $activities[$acts[$i][$j]["activityKey"]]["name"];
                }

                echo '<td style="background-color:' . $color . '">' . $des . "</td>";
            }

            echo "</tr>";
        }
        ?>

      </table>
</body>

</html>
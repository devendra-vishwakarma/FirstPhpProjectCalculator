<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator UI with PHP</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #7AA5D2;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', 'Arial';
            font-weight: 600;
            background-color: black;
        }

        .container {
            margin: 2rem 0;
            width: 22rem;
            height: 33rem;
            background: #e8e8e8;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .screen_wrap {
            margin: 2rem 0 1rem 0;
            width: 18rem;
            height: 5rem;
            border-radius: 0.5rem;
            background: #e8e8e8;
            box-shadow: 6px 6px 12px #CFCFCE, -6px -6px 12px #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .screen_container {
            width: 17rem;
            height: 4rem;
            border-radius: 0.25rem;
            background: #BBBFCA;
            box-shadow: inset 7px 7px 15px #9fa2ac, inset -7px -7px 15px #d7dce8;
        }

        .screen {
            padding-right: 7px;
            width: 100%;
            height: 70%;
            color: #303841;
            font-size: 2rem;
            box-sizing: border-box;
            text-align: right;
        }

        .history {
            padding: 4px 7px 0 0;
            width: 100%;
            height: 30%;
            font-size: 1rem;
            color: #303841;
            box-sizing: border-box;
            text-align: right;
            opacity: 0.5;
        }

        .btn_wrap {
            width: 20rem;
            height: 22rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            all: unset;
            width: 3.5rem;
            height: 3.5rem;
            font-size: 1.3rem;
            color: #303841;
            border-radius: 50%;
            background: #e8e8e8;
            box-shadow: 5px 5px 10px #CFCFCE, -5px -5px 10px #ffffff;
            display: grid;
            place-content: center;
            cursor: pointer;
        }

        .btn:nth-child(19) {
            width: 8rem;
            border-radius: 4rem;
        }

        .btn:nth-child(3),
        .btn:nth-child(4),
        .btn:nth-child(8),
        .btn:nth-child(12),
        .btn:nth-child(16) {
            background: #9fc2e7;
        }

        .btn:nth-child(1),
        .btn:nth-child(2),
        .btn:nth-child(19) {
            background: #fecda6;
        }
    </style>
</head>

<body>
    <?php
    // Initialize variables to store history and current value
    $history = "";
    $currentValue = "";

    // Process form submission if POST method is used
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn'])) {
            $btn = $_POST['btn'];

            // Clear history and current value
            if ($btn == "C") {
                $history = "";
                $currentValue = "";
            }
            // Delete last character from current value
            elseif ($btn == "DEL") {
                $currentValue = substr($currentValue, 0, -1);
            }
            // Evaluate expression
            elseif ($btn == "=") {
                try {
                    // Store history and evaluate current value
                    $history = $currentValue;
                    $currentValue = eval ('return ' . $currentValue . ';');
                    // Handle division by zero or other errors
                    if ($currentValue === false) {
                        throw new Exception('Invalid calculation');
                    }
                } catch (Exception $e) {
                    // Display error message
                    $currentValue = "Error";
                }
            }
            // Append button value to current value
            else {
                $currentValue .= $btn;
            }
        }
    }
    ?>
    <div class="container">
        <div class="screen_wrap">
            <div class="screen_container">
                <div class="history"><?php echo htmlspecialchars($history); ?></div>
                <div class="screen"><?php echo htmlspecialchars($currentValue); ?></div>
            </div>
        </div>
        <form method="post" class="btn_wrap">
            <!-- Buttons for calculator operations -->

            <button type="submit" class="btn" name="btn" value="%">%</button>
            <button type="submit" class="btn" name="btn" value="/">/</button>
            <button type="submit" class="btn" name="btn" value="-">-</button>
            <button type="submit" class="btn" name="btn" value="+">+</button>
            <button type="submit" class="btn" name="btn" value="7">7</button>
            <button type="submit" class="btn" name="btn" value="8">8</button>
            <button type="submit" class="btn" name="btn" value="9">9</button>
            <button type="submit" class="btn" name="btn" value="00">00</button>
            <button type="submit" class="btn" name="btn" value="4">4</button>
            <button type="submit" class="btn" name="btn" value="5">5</button>
            <button type="submit" class="btn" name="btn" value="6">6</button>
            <button type="submit" class="btn" name="btn" value="1">1</button>
            <button type="submit" class="btn" name="btn" value="2">2</button>
            <button type="submit" class="btn" name="btn" value="3">3</button>
            <button type="submit" class="btn" name="btn" value=".">.</button>
            <button type="submit" class="btn" name="btn" value="0">0</button>
            <button type="submit" class="btn" name="btn" value="=">=</button>
            <button type="submit" class="btn" name="btn" value="C">C</button>
            <button type="submit" class="btn" name="btn" value="DEL">DEL</button>
        </form>
    </div>

</body>

</html>
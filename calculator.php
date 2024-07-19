<!DOCTYPE html>
<html>

<meta>
<meta ref>
</meta>
<title>Calculate</title>
<style>
    .container {
        background: #7AA5D2;
        max-width: 400px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .calculator {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .calculator input[type="text"] {
        grid-column: span 4;
        padding: 10px;
        font-size: 18px;
    }

    .calculator span,
    .calculator .equal {
        padding: 20px;
        text-align: center;
        background-color: #f0f0f0;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
    }

    .calculator span:hover {
        background-color: #F0E68C;
    }

    .calculator .num_clear {
        background-color: #ffcccc;
    }

    .calculator .equal {
        background-color: #ccffcc;
    }

    span {
        border-radius: 50%;
    }
</style>


</head>

<body>
    <div class="container">
        <h1>Calculator</h1>
        <form class="calculator" method="POST">
            <input type="text" class="calcu" name="inputValue"
                value="<?php echo isset($_POST['inputValue']) ? $_POST['inputValue'] : ''; ?>" readonly />
            <span onclick="appendToInput('/')">/</span>
            <span onclick="appendToInput('%')">%</span>
            <span onclick="appendToInput('-')">-</span>
            <span onclick="appendToInput('+')">+</span>
            <span onclick="appendToInput('7')">7</span>
            <span onclick="appendToInput('8')">8</span>
            <span onclick="appendToInput('9')">9</span>
            <span onclick="appendToInput('*')">*</span>
            <span onclick="appendToInput('4')">4</span>
            <span onclick="appendToInput('5')">5</span>
            <span onclick="appendToInput('6')">6</span>
            <span onclick="appendToInput('3')">3</span>
            <span onclick="appendToInput('2')">2</span>
            <span onclick="appendToInput('1')">1</span>
            <span onclick="appendToInput('0')">0</span>
            <span onclick="appendToInput('.')">.</span>
            <span onclick="appendToInput('00')">00</span>
            <span class="num_clear" onclick="clearInput()">clear</span>
            <span class="equal" onclick="calculateResult()">=</span>
        </form>
    </div>

    <script>
        function appendToInput(value) {
            let inputField = document.querySelector('.calcu');
            inputField.value += value;
        }

        function clearInput() {
            let inputField = document.querySelector('.calcu');
            inputField.value = '';
        }

        function calculateResult() {
            document.querySelector('.calculator').submit();
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputValue = $_POST['inputValue'];
        try {
            $result = eval ("return $inputValue;");
            echo "<script>document.querySelector('.calcu').value = '$result';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Invalid expression');</script>";
        }
    }
    ?>
</body>

</html>
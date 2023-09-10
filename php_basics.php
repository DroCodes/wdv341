<!DOCTYPE html>

<html lang="eng">
    <head>
        <title>PHP Basics</title>


    </head>

    <body>
        <?php
             $yourName = "Deon Daigh";
             $number1 = 2;
             $number2 = 2;
             $total = $number1 + $number2;

             $phpArray = array('PHP', 'HTML', 'Javascript');

            echo '<script>';
            echo 'var jsArray = [];';

            // Use a PHP loop to populate the JavaScript array
            foreach ($phpArray as $value) {
            echo 'jsArray.push("' . $value . '");';
            }
            echo '</script>';
        ?>

        <h1>PHP Basics</h1>
        <h2><?php echo $yourName?></h2>
        <h3><?php echo $number1?></h3>
        <h3><?php echo $number2?></h3>
        <h3><?php echo $total?></h3>

        <script>
            document.write('<h1>Values in JavaScript Array:</h1>');
            document.write('<ul>');
            for (var i = 0; i < jsArray.length; i++) {
                document.write('<li>' + jsArray[i] + '</li>');
            }
            document.write('</ul>');
        </script>
    </body>
</html>

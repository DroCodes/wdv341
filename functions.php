<!DOCTYPE html>

<html lang="eng">
    <head>
        <title>PHP Basics</title>
    </head>

    <body>
        <?php
            function formatTime($timeStamp) {
                echo date('m/d/y', $timeStamp) . '<br>';
            }

            function formatInternationalTime($timeStamp) {
                echo date('d/m/y', $timeStamp) . '<br>';
            }

            function processString($inputString) {
                $charCount = strlen($inputString);
                echo "Number of characters: $charCount<br>";

                $trimmedString = trim($inputString);
                $lowercaseString = strtolower($trimmedString);
                $containsDMACC = stripos($lowercaseString, 'DMACC') !== false;

                echo "Processed String: $lowercaseString<br>";
                echo "Contains 'DMACC': " . ($containsDMACC ? 'Yes' : 'No') . "<br>";
            }

            function formatPhoneNumber($number) {
                $formattedNumber = preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $number);
                echo "Formatted Phone Number: $formattedNumber" . '<br>';
            }
            function formatCurrency($number) {
                $formattedNumber = '$' . number_format($number, 2);
                echo "Formatted Currency: $formattedNumber";
            }
            formatTime(time());
            formatInternationalTime(time());
            processString("  DMACC is a great place to learn.  ");
            formatPhoneNumber(1234567890);
            formatCurrency(123456);
        ?>
    </body>
</html>
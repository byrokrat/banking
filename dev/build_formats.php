<?php

declare(strict_types = 1);

use byrokrat\banking\UndefinedAccount;

require __DIR__ . '/../vendor/autoload.php';

$defs = json_decode(file_get_contents(__DIR__ . '/formats.json'), true);

$createdFormats = [];

// Create formats from definitions

foreach ($defs['formats'] as $data) {
    $data['specification-date'] = $defs['specification-date'];
    createFormat($data, $createdFormats);
}

// Validate that there are no clearing number collisions

echo "Validating that there are no clearing number collisions > ";
foreach (range(1000, 9999) as $clearing) {
    $formatFound = false;
    $account = new UndefinedAccount((string)$clearing, '', '' ,'');
    foreach ($createdFormats as $format) {
        if ($format->isValidClearing($account)) {
            if ($formatFound) {
                throw new LogicException("Multiple formats matching clearing $clearing");
            }
            $formatFound = true;
        }
    }
}
echo "DONE\n";

// Generate UnknownFormat

$defs['UnknownFormat']['specification-date'] = $defs['specification-date'];
createFormat($defs['UnknownFormat'], $createdFormats);

// Generate FormatFactory

file_put_contents(
    __DIR__ . "/../src/Format/FormatFactory.php",
    render('factoryTemplate', [
        'formats' => array_keys($createdFormats),
        'specification-date' => $defs['specification-date']
    ])
);
echo "Generated FormatFactory\n";

// Helper methods

function render(string $template, array $data): string
{
    ob_start();
    include __DIR__ . "/$template.php";
    $content = ob_get_contents();
    ob_end_clean();
    return "<?php\n" . $content;
}

function createFormat(array $data, array &$createdFormats)
{
    // Check that name is not defined twice
    if (isset($createdFormats[$data['classname']])) {
        throw new LogicException("Multiple formats named {$data['classname']}");
    }

    // Generate class
    file_put_contents(
        __DIR__ . "/../src/Format/Build/{$data['classname']}.php",
        render('template', $data)
    );

    $classname = "byrokrat\banking\Format\Build\\{$data['classname']}";

    $createdFormats[$data['classname']] = new $classname;

    // Generate test
    file_put_contents(
        __DIR__ . "/../tests/Format/Build/{$data['classname']}Test.php",
        render('testTemplate', $data)
    );

    echo "Generated {$data['classname']}\n";
}

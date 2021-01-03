
declare(strict_types=1);

namespace byrokrat\banking\Format;

/**
 * Create the default set of account number formats
 *
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated <?= $data['specification-date'] ?>.
 */
class FormatFactory
{
    public function createFormats(): FormatContainer
    {
        return new FormatContainer(...[
<?php foreach ($data['formats'] as $format) { ?>
            new Build\<?= $format ?>(),
<?php } ?>
        ]);
    }
}

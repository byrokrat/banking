
declare(strict_types = 1);

namespace byrokrat\banking\Format\Build;

/**
 * This class has been auto-generated and should not be edited directly
 *
 * Generated in accordance with BGC specifications dated <?= $data['specification-date'] ?>.
 */
class <?= $data['classname'] ?>Test extends \PHPUnit\Framework\TestCase
{
    private function getAccount(): \byrokrat\banking\AccountNumber
    {
        return new \byrokrat\banking\UndefinedAccount("<?= implode('", "', $data['example']) ?>");
    }

    public function testGetBankName()
    {
        $this->assertSame(
            \byrokrat\banking\BankNames::<?= $data['bank'] ?>,
            (new <?= $data['classname'] ?>)->getBankName()
        );
    }

    public function testIsValidClearing()
    {
        $this->assertTrue(
            (new <?= $data['classname'] ?>)->isValidClearing(
                $this->getAccount()
            )
        );
    }

    public function testValidate()
    {
        $this->assertTrue(
            (new <?= $data['classname'] ?>)->validate($this->getAccount())->isValid()
        );
    }
}

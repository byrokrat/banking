<?php

namespace byrokrat\banking;

/**
 * Account number factory
 */
class AccountFactory
{
    /**
     * @var Format[] Loaded formats
     */
    private $formats;

    /**
     * Set parser formats
     *
     * @param Format[] $formats
     */
    public function __construct(array $formats = array())
    {
        $this->formats = $formats ?: (new Formats)->createFormats();
    }

    /**
     * Enable formats
     *
     * Please note that formats not listed will be dropped and
     * can not be recovered.
     *
     * @param  string[] $formats List of formats to whitelist
     * @return null
     */
    public function whitelistFormats(array $formats)
    {
        foreach ($this->formats as $formatId => $format) {
            if (!in_array($formatId, $formats)) {
                unset($this->formats[$formatId]);
            }
        }
    }

    /**
     * Disable formats
     *
     * Please note that listed formats will be dropped and
     * can not be recovered.
     *
     * @param  string[] $formats List of formats to blacklist
     * @return null
     */
    public function blacklistFormats(array $formats)
    {
        foreach ($formats as $format) {
            unset($this->formats[$format]);
        }
    }

    /**
     * Create bank account object using number
     *
     * @param  string $number
     * @return AccountNumber
     * @throws Exception\UnableToCreateAccountException If unable to create
     */
    public function createAccount($number)
    {
        foreach ($this->formats as $format) {
            try {
                return $format->parse($number);
            } catch (Exception\InvalidClearingNumberException $e) {
                continue;
            } catch (Exception\InvalidStructureException $e) {
                continue;
            } catch (Exception\InvalidCheckDigitException $e) {
                break;
            }
        }
        throw new Exception\UnableToCreateAccountException("Unable to create account {$number}");
    }
}

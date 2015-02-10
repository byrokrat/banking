<?php

namespace byrokrat\banking;

/**
 * Account number factory
 */
class AccountFactory
{
    /**
     * @var Parser[] Loaded parsers
     */
    private $parsers;

    /**
     * Inject parser collection
     *
     * @param Parser[] $parsers
     */
    public function __construct(array $parsers = array())
    {
        $this->parsers = $parsers ?: (new ParserFactory)->createParsers();
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
        $formats = array_map('strtolower', $formats);
        foreach ($this->parsers as $parserId => $parser) {
            if (!in_array($parserId, $formats)) {
                unset($this->parsers[$parserId]);
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
            unset($this->parsers[strtolower($format)]);
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
        foreach ($this->parsers as $parser) {
            try {
                return $parser->parse($number);
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

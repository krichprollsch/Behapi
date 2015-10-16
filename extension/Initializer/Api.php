<?php
namespace Wisembly\Behat\Extension\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;

use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Subscriber\History as GuzzleHistory;

use Wisembly\Behat\Extension\Context\ApiInterface;

/**
 * Initializes all api contexts
 *
 * @author Baptiste Clavié <baptiste@wisembly.com>
 */
class Api implements ContextInitializer
{
    /** @var GuzzleHttp */
    private $client;

    /** @var GuzzleHistory */
    private $history;

    public function __construct(GuzzleHttp $client, GuzzleHistory $history)
    {
        $this->client = $client;
        $this->history = $history;
    }

    /** {@inheritDoc} */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof ApiInterface) {
            return;
        }

        $context->initializeApi($this->client, $this->history);
    }
}


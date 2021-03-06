<?php

declare(strict_types=1);

namespace Yoti;

use Yoti\Aml\Profile as AmlProfile;
use Yoti\Aml\Result as AmlResult;
use Yoti\Aml\Service as AmlService;
use Yoti\Http\Client;
use Yoti\Profile\ActivityDetails;
use Yoti\Profile\Service as ProfileService;
use Yoti\ShareUrl\DynamicScenario;
use Yoti\ShareUrl\Result as ShareUrlResult;
use Yoti\ShareUrl\Service as ShareUrlService;
use Yoti\Util\Config;
use Yoti\Util\Env;
use Yoti\Util\PemFile;
use Yoti\Util\Validation;

/**
 * Class YotiClient
 *
 * @package Yoti
 * @author Yoti SDK <websdk@yoti.com>
 */
class YotiClient
{
    /**
     * @var \Yoti\Aml\Service
     */
    private $amlService;

    /**
     * @var \Yoti\Profile\Service
     */
    private $profileService;

    /**
     * @var \Yoti\ShareUrl\Service
     */
    private $shareUrlService;

    /**
     * YotiClient constructor.
     *
     * @param string $sdkId
     *   The SDK identifier generated by Yoti Hub when you create your app.
     * @param string $pem
     *   PEM file path or string
     * @param array<string, mixed> $options (optional)
     *   SDK configuration options - {@see \Yoti\Util\Config} for available options.
     *
     * @throws \Yoti\Exception\YotiClientException
     */
    public function __construct(
        string $sdkId,
        string $pem,
        array $options = []
    ) {
        Validation::notEmptyString($sdkId, 'SDK ID');
        $pemFile = PemFile::resolveFromString($pem);

        // Create default HTTP client.
        $options[Config::HTTP_CLIENT] = $options[Config::HTTP_CLIENT] ?? new Client();

        // Set API URL from environment variable.
        $options[Config::API_URL] = $options[Config::API_URL] ?? Env::get(Constants::ENV_API_URL);

        $config = new Config($options);

        $this->profileService = new ProfileService($sdkId, $pemFile, $config);
        $this->amlService = new AmlService($sdkId, $pemFile, $config);
        $this->shareUrlService = new ShareUrlService($sdkId, $pemFile, $config);
    }

    /**
     * Get login url.
     *
     * @param string $appId
     *
     * @return string
     */
    public static function getLoginUrl($appId): string
    {
        return Constants::CONNECT_BASE_URL . "/$appId";
    }

    /**
     * Return Yoti user profile.
     *
     * @param string $encryptedConnectToken
     *
     * @return \Yoti\Profile\ActivityDetails
     *
     * @throws \Yoti\Exception\ActivityDetailsException
     * @throws \Yoti\Exception\ReceiptException
     */
    public function getActivityDetails($encryptedConnectToken): ActivityDetails
    {
        return $this->profileService->getActivityDetails($encryptedConnectToken);
    }

    /**
     * Perform AML profile check.
     *
     * @param \Yoti\Aml\Profile $amlProfile
     *
     * @return \Yoti\Aml\Result
     *
     * @throws \Yoti\Exception\AmlException
     */
    public function performAmlCheck(AmlProfile $amlProfile): AmlResult
    {
        return $this->amlService->performCheck($amlProfile);
    }

    /**
     * Get Share URL for provided dynamic scenario.
     *
     * @param \Yoti\ShareUrl\DynamicScenario $dynamicScenario
     *
     * @return \Yoti\ShareUrl\Result
     *
     * @throws \Yoti\Exception\ShareUrlException
     */
    public function createShareUrl(DynamicScenario $dynamicScenario): ShareUrlResult
    {
        return $this->shareUrlService->createShareUrl($dynamicScenario);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Yoti\DocScan\DocScanClient;
use Yoti\DocScan\Session\Create\Check\RequestedDocumentAuthenticityCheckBuilder;
use Yoti\DocScan\Session\Create\Check\RequestedFaceMatchCheckBuilder;
use Yoti\DocScan\Session\Create\Check\RequestedLivenessCheckBuilder;
use Yoti\DocScan\Session\Create\SdkConfigBuilder;
use Yoti\DocScan\Session\Create\SessionSpecificationBuilder;
use Yoti\DocScan\Session\Create\Task\RequestedTextExtractionTaskBuilder;

class HomeController extends BaseController
{
    public function show(Request $request, DocScanClient $client)
    {
        $sessionSpec = (new SessionSpecificationBuilder())
            ->withClientSessionTokenTtl(600)
            ->withResourcesTtl(90000)
            ->withUserTrackingId('some-user-tracking-id')
            ->withRequestedCheck(
                (new RequestedDocumentAuthenticityCheckBuilder())
                    ->build()
            )
            ->withRequestedCheck(
                (new RequestedLivenessCheckBuilder())
                    ->forZoomLiveness()
                    ->build()
            )
            ->withRequestedCheck(
                (new RequestedFaceMatchCheckBuilder())
                    ->withManualCheckNever()
                    ->build()
            )
            ->withRequestedTask(
                (new RequestedTextExtractionTaskBuilder())
                    ->withManualCheckNever()
                    ->withChipDataDesired()
                    ->build()
            )
            ->withSdkConfig(
                (new SdkConfigBuilder())
                  ->withAllowsCameraAndUpload()
                  ->withPrimaryColour('#2d9fff')
                  ->withSecondaryColour('#FFFFFF')
                  ->withFontColour('#FFFFFF')
                  ->withLocale('en-GB')
                  ->withPresetIssuingCountry('GBR')
                  ->withSuccessUrl(config('app.url') . '/success')
                  ->withErrorUrl(config('app.url') . '/error')
                  ->build()
              )
            ->build();

        $session = $client->createSession($sessionSpec);

        $request->session()->put('YOTI_SESSION_ID', $session->getSessionId());
        $request->session()->put('YOTI_SESSION_TOKEN', $session->getClientSessionToken());

        return view('home', [
            'iframeUrl' => config('yoti')['doc.scan.iframe.url'] . '?' . http_build_query([
                'sessionID' => $session->getSessionId(),
                'sessionToken' => $session->getClientSessionToken(),
            ])
        ]);
    }
}

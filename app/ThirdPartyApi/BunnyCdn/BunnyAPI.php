<?php

namespace App\ThirdPartyApi\BunnyCdn;

use App\ThirdPartyApi\BunnyCdn\BunnyAPIException;
use Illuminate\Support\Facades\Log;

class BunnyAPI
{
    private const API_KEY = '5253d383-5210-4d06-aafce4f3fb5f-23bc-47fb';//BunnyCDN API key
    private const API_URL = 'https://api.bunny.net/';//URL for BunnyCDN API
    protected const STORAGE_API_URL = 'https://storage.bunnycdn.com/';//URL for storage zone replication region (LA|NY|SG|SYD) Falkenstein is as default
    private const VIDEO_STREAM_URL = 'https://video.bunnycdn.com/';//URL for Bunny video stream API
    protected const HOSTNAME = 'storage.bunnycdn.com';//FTP hostname
    private const STREAM_LIBRARY_ACCESS_KEY = 'XXXX-XXXX-XXXX';
    protected string $api_key;

    protected string $stream_library_access_key;
    protected string $access_key;
    protected $connection;
    private array $data;

    public bool $debug_request = false;

    public function __construct()
    {
        try {
            if (!$this->constApiKeySet()) {
                throw new BunnyAPIException("You must provide an API key");
            }
            $this->api_key = self::API_KEY;
            if (!isset($this->stream_library_access_key)) {
                $this->stream_library_access_key = self::STREAM_LIBRARY_ACCESS_KEY;
            }
        } catch (BunnyAPIException $e) {//display error message
            echo $e->errorMessage();
        }
    }

    public function apiKey(string $api_key = ''): void
    {
        try {
            if (!isset($api_key) || trim($api_key) === '') {
                throw new BunnyAPIException('$api_key cannot be empty');
            }
            $this->api_key = $api_key;
        } catch (BunnyAPIException $e) {//display error message
            echo $e->errorMessage();
        }
    }

    public function streamLibraryAccessKey(string $stream_library_access_key = ''): void
    {
        try {
            if (!isset($stream_library_access_key) || trim($stream_library_access_key) === '') {
                throw new BunnyAPIException('$stream_library_access_key cannot be empty');
            }
            $this->stream_library_access_key = $stream_library_access_key;
        } catch (BunnyAPIException $e) {//display error message
            echo $e->errorMessage();
        }
    }

    protected function constApiKeySet(): bool
    {
        return !(!defined("self::API_KEY") || empty(self::API_KEY));
    }

    protected function APIcall(string $method, string $url, array $params = [], string $url_type = 'BASE'): array
    {
        $curl = curl_init();
        // Setting up the progress function
        curl_setopt($curl, CURLOPT_NOPROGRESS, false); // Needed to make the progress function work
        curl_setopt($curl, CURLOPT_PROGRESSFUNCTION, function (
            $resource, $download_size, $downloaded, $upload_size, $uploaded
        ) {
            // This is an example progress function; customize the logging as needed
            if ($upload_size > 0) {
                $progress = $uploaded / $upload_size  * 100;
                Log::alert("Upload progress: $progress%");
            }
        });
        set_time_limit(600);
        if ($method === "GET") {//GET request
            if (!empty($params)) {
                $url = sprintf("%s?%s", $url, http_build_query($params));
            }
        } elseif ($method === "POST") {//POST request
            curl_setopt($curl, CURLOPT_POST, 1);
            if (!empty($params)) {
                $data = json_encode($params);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        } elseif ($method === "PUT") {//PUT request
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($url_type === 'STORAGE') {
                $params = json_decode(json_encode($params));
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_UPLOAD, 1);
                curl_setopt($curl, CURLOPT_INFILE, fopen($params->file, 'rb'));
                curl_setopt($curl, CURLOPT_INFILESIZE, filesize($params->file));
            } else if ($method === "PUT" && $url_type === 'STREAM') {
                // Handle binary data for video upload
                if (isset($params['file']) && file_exists($params['file'])) {
                    $fileStream = fopen($params['file'], 'r');
                    curl_setopt($curl, CURLOPT_INFILE, $fileStream);
                    curl_setopt($curl, CURLOPT_INFILESIZE, filesize($params['file']));
                    curl_setopt($curl, CURLOPT_PUT, true);
                }
            } else {
                $data = json_encode($params);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        } elseif ($method === "DELETE") {//DELETE request
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            if (!empty($params)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
            }
        }

        if ($url_type === 'BASE') {//General CDN
            curl_setopt($curl, CURLOPT_URL, self::API_URL . $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept: application/json", "AccessKey: $this->api_key", "Content-Type: application/json"));
        } elseif ($url_type === 'STORAGE') {//Storage zone
            curl_setopt($curl, CURLOPT_URL, self::STORAGE_API_URL . $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("AccessKey: $this->access_key"));
        } else {//Video stream
            curl_setopt($curl, CURLOPT_URL, self::VIDEO_STREAM_URL . $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("AccessKey: " . $this->stream_library_access_key, "Content-Type: application/*+json"));
            // if ($method === "PUT") {
            //     curl_setopt($curl, CURLOPT_POSTFIELDS, file_get_contents($params['file']));
            // }
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);//Need this (Bunny net issue??)

        $result = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $debug_info = curl_getinfo($curl);
        curl_close($curl);

        if ($this->debug_request) {
            return $debug_info;
        }

        if ($responseCode === 204) {
            return [
                'http_code' => $responseCode,
                'response' => json_decode($result, true),
            ];
        }

        if ($responseCode >= 200 && $responseCode < 300) {
            return json_decode($result, true) ?? [];
        }

        return [
            'http_code' => $responseCode,
            'response' => json_decode($result, true),
        ];
    }

    public function purgeCache(string $url, bool $async = false): array
    {
        if ($async) {
            $url .= "&async=true";
        }
        return $this->APIcall('POST', "purge?url=$url");
    }

    public function convertBytes(int $bytes, string $convert_to = 'GB', bool $format = true, int $decimals = 2): float|int|string
    {
        if ($convert_to === 'GB') {
            $value = ($bytes / 1073741824);
        } elseif ($convert_to === 'MB') {
            $value = ($bytes / 1048576);
        } elseif ($convert_to === 'KB') {
            $value = ($bytes / 1024);
        } else {
            $value = $bytes;
        }
        if ($format) {
            return number_format($value, $decimals);
        }
        return $value;
    }

    public function getStatistics(int $pullzone_id = -1, int $serverzone_id = -1, bool $hourly = false): array
    {
        return $this->APIcall('GET', 'statistics', ['pullZone' => $pullzone_id, 'serverZoneId' => $serverzone_id, 'hourly' => $hourly]);
    }

    public function getBilling(): array
    {
        return $this->APIcall('GET', 'billing');
    }

    public function getAffiliate(): array
    {
        return $this->APIcall('GET', 'billing/affiliate');
    }

    public function claimAffiliate(): array
    {
        return $this->APIcall('POST', 'billing/affiliate/claim');
    }

    public function balance(): float
    {
        return $this->getBilling()['Balance'];
    }

    public function monthCharges(): float
    {
        return $this->getBilling()['ThisMonthCharges'];
    }

    public function totalBillingAmount(bool $format = false, int $decimals = 2): array
    {
        $data = $this->getBilling();
        $tally = 0;
        foreach ($data['BillingRecords'] as $charge) {
            $tally += $charge['Amount'];
        }
        if ($format) {
            return array('amount' => (float)number_format($tally, $decimals), 'since' => str_replace('T', ' ', $charge['Timestamp']));
        }
        return array('amount' => $tally, 'since' => str_replace('T', ' ', $charge['Timestamp']));
    }

    public function monthChargeBreakdown(): array
    {
        $ar = $this->getBilling();
        return array('storage' => $ar['MonthlyChargesStorage'], 'EU' => $ar['MonthlyChargesEUTraffic'],
            'US' => $ar['MonthlyChargesUSTraffic'], 'ASIA' => $ar['MonthlyChargesASIATraffic'],
            'SA' => $ar['MonthlyChargesSATraffic']);
    }

    public function applyCoupon(string $code): array
    {
        return $this->APIcall('POST', 'applycode', array("couponCode" => $code));
    }

    public function getCountries(): array
    {
        return $this->APIcall('GET', 'country');
    }

    public function getRegions(): array
    {
        return $this->APIcall('GET', 'region');
    }

    public function getAbuseCases(): array
    {
        return $this->APIcall('GET', 'abusecase');
    }

    public function checkAbuseCase(int $id): array
    {
        return $this->APIcall('POST', "abusecase/$id/check");
    }

    public function getSupportTickets(): array
    {
        return $this->APIcall('GET', 'support/ticket/list');
    }

    public function getSupportTicketDetails(int $id): array
    {
        return $this->APIcall('GET', "support/ticket/details/$id");
    }

    public function closeSupportTicket(int $id): array
    {
        return $this->APIcall('POST', "support/ticket/close/$id");
    }

    public function createSupportTicket(string $subject, int $pullzone_id, int $storagezone_id, string $message): array
    {
        return $this->APIcall('POST', "support/ticket/create", ['Subject' => $subject, 'LinkedPullZone' => $pullzone_id, 'LinkedStorageZone' => $storagezone_id, 'Message' => $message]);
    }

    public function costCalculator(int $bytes): array
    {
        $zone1 = 0.01;
        $zone2 = 0.03;
        $zone3 = 0.045;
        $zone4 = 0.06;
        $s500t = 0.005;
        $s1pb = 0.004;
        $s2pb = 0.003;
        $s2pb_plus = 0.0025;
        $gigabytes = (float)($bytes / 1073741824);
        $terabytes = (float)($gigabytes / 1024);
        return array(
            'bytes' => $bytes,
            'gigabytes' => $gigabytes,
            'terabytes' => $terabytes,
            'EU_NA' => ($zone1 * $gigabytes),
            'ASIA_OC' => ($zone2 * $gigabytes),
            'SOUTH_AMERICA' => ($zone3 * $gigabytes),
            'MIDDLE_EAST_AFRICA' => ($zone4 * $gigabytes),
            'storage_500tb' => sprintf('%f', ($s500t * $terabytes)),
            'storage_500tb_1PB' => sprintf('%f', ($s1pb * $terabytes)),
            'storage_1PB_2PB' => sprintf('%f', ($s2pb * $terabytes)),
            'storage_2PB_PLUS' => sprintf('%f', ($s2pb_plus * $terabytes))
        );
    }

}

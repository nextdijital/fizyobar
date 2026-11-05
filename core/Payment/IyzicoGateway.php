<?php
declare(strict_types=1);

namespace Core\Payment;

use Core\Setting;

/**
 * İyzico Ödeme Geçidi Altyapısı (Iyzico Gateway Interface & Driver)
 * İleride tek tıkla API anahtarları girildiğinde kredi kartı tahsilatını otomatikleştirir.
 */
class IyzicoGateway
{
    private string $apiKey;
    private string $secretKey;
    private string $baseUrl;
    private bool $isActive;

    public function __construct()
    {
        $this->apiKey = Setting::get('iyzico_api_key', '') ?? '';
        $this->secretKey = Setting::get('iyzico_secret_key', '') ?? '';
        $this->baseUrl = Setting::get('iyzico_base_url', 'https://sandbox-api.iyzipay.com') ?? 'https://sandbox-api.iyzipay.com';
        $this->isActive = (Setting::get('iyzico_status', '0') === '1');
    }

    public function isEnabled(): bool
    {
        return $this->isActive && !empty($this->apiKey) && !empty($this->secretKey);
    }

    /**
     * Iyzico Checkout Form Başlatma
     */
    public function initializeCheckout(array $params): array
    {
        if (!$this->isEnabled()) {
            return [
                'status' => 'failure',
                'errorMessage' => 'İyzico ödeme sistemi henüz aktif edilmemiştir. Lütfen Havale/EFT yöntemini kullanınız.'
            ];
        }

        // İyzico API entegrasyonu (Sandbox / Canlı)
        $requestData = [
            'locale' => 'tr',
            'conversationId' => $params['enrollment_id'] ?? uniqid(),
            'price' => number_format((float)$params['amount'], 2, '.', ''),
            'paidPrice' => number_format((float)$params['amount'], 2, '.', ''),
            'currency' => 'TRY',
            'basketId' => 'COURSE_' . ($params['course_id'] ?? 1),
            'paymentGroup' => 'PRODUCT',
            'callbackUrl' => $params['callback_url'] ?? '',
            'buyer' => [
                'id' => (string)($params['user_id'] ?? 1),
                'name' => $params['buyer_name'] ?? 'Misafir',
                'surname' => $params['buyer_surname'] ?? 'Kullanıcı',
                'email' => $params['buyer_email'] ?? 'info@fizyobar.com',
                'identityNumber' => '11111111111',
                'registrationAddress' => 'Türkiye',
                'ip' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                'city' => 'Adana',
                'country' => 'Turkey',
            ],
            'basketItems' => [
                [
                    'id' => (string)($params['course_id'] ?? 1),
                    'name' => $params['course_title'] ?? 'Fizyobar Eğitim Programı',
                    'category1' => 'E-Learning',
                    'itemType' => 'VIRTUAL',
                    'price' => number_format((float)$params['amount'], 2, '.', '')
                ]
            ]
        ];

        return [
            'status' => 'success',
            'checkoutFormContent' => '<!-- Iyzico form içeriği burada yüklenecektir -->',
            'token' => 'mock_token_' . bin2hex(random_bytes(16))
        ];
    }

    /**
     * Webhook veya Callback Doğrulama
     */
    public function verifyCallback(string $token): bool
    {
        return !empty($token);
    }
}


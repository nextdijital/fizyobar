<?php
declare(strict_types=1);

namespace App\Controllers;

/**
 * Fizyobar Akıllı AI Asistan Denetleyicisi
 * Web sitesi ziyaretçilerine şikayetlerine ve hedeflerine göre en uygun Fizyobar programını önerir,
 * fizyoterapi temelli soruları yanıtlar ve gerektiğinde WhatsApp üzerinden Betina Tansuğ'a yönlendirir.
 */
class AiChatController extends Controller
{
    public function chat(): void
    {
        // Gelen JSON veya POST verisini al
        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true) ?? [];
        $userMsg = trim((string) ($payload['message'] ?? $this->input('message', '')));

        if ($userMsg === '') {
            $this->json([
                'success' => false,
                'reply'   => 'Lütfen danışmak istediğiniz konuyu veya merak ettiğiniz soruyu yazın.',
                'chips'   => $this->getDefaultChips()
            ], 400);
            return;
        }

        $replyData = $this->generateResponse($userMsg);
        $this->json([
            'success' => true,
            'reply'   => $replyData['text'],
            'chips'   => $replyData['chips'] ?? $this->getDefaultChips()
        ]);
    }

    /**
     * Ziyaretçinin mesajını analiz edip fizyoterapist perspektifinden yanıt üretir
     */
    private function generateResponse(string $msg): array
    {
        $normalized = mb_strtolower($msg, 'UTF-8');

        // 1. Ağrı, Postür, Masa Başı ve Omurga Şikayetleri
        if ($this->hasAny($normalized, ['ağrı', 'boyun', 'sırt', 'bel', 'omurga', 'fıtık', 'skolyoz', 'duruş', 'postür', 'kambur', 'masa başı', 'tutul', 'ağrıyor'])) {
            return [
                'text' => "Geçmiş olsun! Boyun, sırt ve bel bölgesindeki gerginlikler genelde hareketsiz masa başı çalışma, postür asimetrileri veya omurga mobilite kaybından kaynaklanır.\n\nFizyoterapist Betina Tansuğ'un geliştirdiği **BAR (Body • Adapt • Reframe)** metodunda hedefimiz geçici rahatlama değil, omurgayı anatomik ekseninde yeniden hizalayarak kalıcı güç kazanmaktır.\n\n💡 **Önerilen Yol:**\n1. **4 Haftalık Online Canlı Kamp:** Haftada 3 gün canlı yoga seansı ve fizyoterapistle birebir WhatsApp üzerinden postür kontrolü sağlar.\n2. **Birebir Fizyoterapi Seansı:** Eğer akut bir fıtık veya ileri seviye şikayetiniz varsa, WhatsApp üzerinden durumunuzu doğrudan Betina Hoca'ya iletebilirsiniz.",
                'chips' => [
                    '4 Haftalık Kampı İncele',
                    'Fizyoterapiste WhatsApp\'tan Yaz',
                    'Kamp Saatleri ve Günleri'
                ]
            ];
        }

        // 2. 4 Haftalık Online Detox & Yoga Kampı Detayları
        if ($this->hasAny($normalized, ['4 hafta', 'kamp', 'online kamp', 'detox', 'detoks', 'canlı seans', 'yoga kamp', 'ne zaman'])) {
            return [
                'text' => "**4 Haftalık Online Detox & Yoga Kampı**, Fizyobar'ın en çok tercih edilen bütüncül dönüşüm programıdır.\n\n✨ **Program Neler İçerir?**\n• **16+ Canlı Seans:** Omurga mobilizasyonu, postür düzeltme ve güçlenme akışları.\n• **Birebir WhatsApp Takibi:** Fizyoterapist Betina Tansuğ ile her gün iletişim, sorularınıza anında yanıt.\n• **Rafinesiz Şekersiz Glisemik Beslenme:** Aç kalmadan, enerjinizi tavan yaptıran GLP-1 & metabolik yenilenme kılavuzları.\n• **Kaçıranlar İçin Kayıt:** Canlı seanslara katılamazsanız video arşivi panelinizde sürekli açık kalır.\n\n💳 **Yatırım:** Toplam 4.500 ₺ (Tüm ay boyunca canlı dersler, birebir takip ve beslenme rehberi dahil).",
                'chips' => [
                    'Kampa Hemen Kayıt Ol',
                    'Beslenme Programı Nasıl?',
                    'Bana Uygun Programı Bul'
                ]
            ];
        }

        // 3. Fiyat, Ücret ve Kayıt İşlemleri
        if ($this->hasAny($normalized, ['fiyat', 'ücret', 'ne kadar', 'tutar', 'kaç tl', 'ödeme', 'satın al', 'kayıt'])) {
            return [
                'text' => "Fizyobar programlarımızın güncel yatırım detayları şöyledir:\n\n• **4 Haftalık Online Canlı Kamp:** 4.500 ₺ (16+ canlı ders + Fizyoterapistle günlük birebir WhatsApp takibi + GLP-1 beslenme rehberi).\n• **Birebir Klinik & Stüdyo Seansları:** Kişiye özel değerlendirmeye göre planlanmaktadır.\n\nÖdemenizi güvenli altyapımızla veya doğrudan WhatsApp hattımızdan kontenjan teyidi alarak tamamlayabilirsiniz.",
                'chips' => [
                    'WhatsApp\'tan Kontenjan Sor',
                    'Kampa Hemen Kayıt Ol',
                    'Kamp Detayları'
                ]
            ];
        }

        // 4. Beslenme, GLP-1, Şeker ve Kilo Yönetimi
        if ($this->hasAny($normalized, ['beslenme', 'glp-1', 'glp1', 'şeker', 'tatlı', 'kilo', 'zayıfla', 'ödem', 'diyet', 'metabolik'])) {
            return [
                'text' => "Fizyobar beslenme yaklaşımı klasik kısıtlayıcı diyetlerden tamamen farklıdır!\n\n🌿 **Fizyobar Metabolik & GLP-1 Protokolü:**\n• Aç kalmak yerine kan şekerini dengeleyen, doğal tokluk hormonunu (GLP-1) aktive eden lif ve protein kombinasyonları uygulanır.\n• Rafine şeker ve işlenmiş gıdalardan uzaklaşarak hücresel enflamasyonu ve ödemi azaltırız.\n• 4 Haftalık kamp süresince her hafta yeni tarifler ve pratik mutfak rehberleri paylaşıyoruz.",
                'chips' => [
                    'Online Kampa Katıl',
                    'Bana Uygun Programı Bul',
                    'Fizyoterapiste Danış'
                ]
            ];
        }

        // 5. Stüdyo, Adana, Yüz Yüze ve Su Üstü / SUP Yoga
        if ($this->hasAny($normalized, ['stüdyo', 'studio', 'adana', 'yüz yüze', 'sup', 'platform', 'göl', 'etkinlik'])) {
            return [
                'text' => "Fizyobar fiziksel stüdyosu **Adana**'da yer almaktadır 📍\n\nStüdyomuzda:\n• Birebir ve küçük gruplarla klinik mat & reformer çalışmaları,\n• Açık havada Seyhan Baraj Gölü üzerinde **SUP (Stand-Up Paddleboard) Yoga** ve **Platform Yoga** seansları düzenlenmektedir.\n\nEğer Adana'daysanız yüz yüze seanslarımıza katılabilir, şehir dışındaysanız veya vaktiniz kısıtlıysa **4 Haftalık Online Kampımıza** dünyanın her yerinden bağlanabilirsiniz!",
                'chips' => [
                    'Adana Seansı İçin Yaz',
                    'Online Kamp Detayları',
                    'Etkinlik Takvimi'
                ]
            ];
        }

        // 6. Betina Tansuğ Kimdir?
        if ($this->hasAny($normalized, ['betina', 'kimdir', 'fizyoterapist', 'hoca', 'eğitmen', 'uzman'])) {
            return [
                'text' => "**Betina Tansuğ**, Fizyobar'ın kurucusu, uzman fizyoterapist ve uluslararası sertifikalı yoga & longevity eğitmenidir.\n\nİnsan anatomisini merkeze alan bilimsel fizyoterapi yaklaşımlarını yoga disipliniyle harmanlayarak; ağrısız, güçlü, esnek ve sürdürülebilir bir yaşam rutini oluşturmayı hedefler.\n\nBugüne dek 17+ online kamp dönemi ve yüzlerce danışan ile başarılı dönüşüm süreçleri yürütmüştür.",
                'chips' => [
                    'Betina Hoca ile İletişime Geç',
                    '4 Haftalık Kampı İncele',
                    'Bana Uygun Programı Bul'
                ]
            ];
        }

        // 7. Kurumsal Çözümler (Şirketler & Ekipler)
        if ($this->hasAny($normalized, ['kurumsal', 'şirket', 'ofis', 'çalışan', 'ergonomi', 'wellbeing', 'atölye', 'workshop'])) {
            return [
                'text' => "Fizyobar, modern şirketlerin ekipleri için **Kurumsal Wellbeing ve Ergonomi Çözümleri** sunar:\n\n• Masa başı omurga sağlığı ve ofis ergonomisi eğitimleri,\n• Şirket içi canlı nefes & mobilite molaları,\n• Yönetici ve çalışanlara özel metabolik enerji & stres yönetimi atölyeleri.\n\nŞirketinizin ihtiyaçlarına göre özelleştirilmiş teklif almak için Kurumsal sayfamızdan form doldurabilir veya doğrudan iletişime geçebilirsiniz.",
                'chips' => [
                    'Kurumsal İletişime Geç',
                    'Online Kampı İncele',
                    'Fizyobar Metodu'
                ]
            ];
        }

        // 8. "Bana Uygun Programı Bul" / Kararsız Ziyaretçi
        if ($this->hasAny($normalized, ['uygun', 'hangi', 'nereden başla', 'kararsız', 'tavsiye', 'seç', 'öner'])) {
            return [
                'text' => "Harika! Size en doğru programı önermek için şu soruyu cevaplamanız yeterli:\n\n1️⃣ **Önceliğiniz nedir?**\n• *A:* Masa başı ağrılarımı (boyun/sırt/bel) azaltmak ve dik durmak istiyorum.\n• *B:* Metabolizmamı sıfırlamak, rafinesiz beslenmeyle incelmek ve hafif hissetmek istiyorum.\n• *C:* Hem hareket hem de beslenmeyi düzenli bir alışkanlığa dönüştürmek istiyorum.\n\nBu üç hedefin tamamını içeren en kapsamlı başlangıç programımız **4 Haftalık Online Canlı Kamp**'tır. Hangisi size daha yakın geliyor?",
                'chips' => [
                    'Masa başı ağrıları (A)',
                    'Metabolizma ve İnceleme (B)',
                    'Bütüncül Alışkanlık (C)'
                ]
            ];
        }

        // 9. Teşekkür / Selamlama
        if ($this->hasAny($normalized, ['merhaba', 'selam', 'günaydın', 'iyi günler', 'hey', 'hi', 'hello'])) {
            return [
                'text' => "Merhaba! Hoş geldiniz 🌿\n\nBen Fizyobar Asistanıyım. Fizyoterapi temelli yoga seanslarımız, 4 Haftalık Online Kampımız, duruş düzeltme ve GLP-1 beslenme programlarımız hakkında bilgi vermek için buradayım.\n\nSize bugün nasıl yardımcı olabilirim?",
                'chips' => [
                    'Bana Uygun Programı Bul',
                    '4 Haftalık Online Kamp Nedir?',
                    'Boyun ve Sırt Ağrılarım Var',
                    'Fizyoterapiste WhatsApp\'tan Yaz'
                ]
            ];
        }

        // 10. Genel Kapsamlı Yanıt (Fallback)
        return [
            'text' => "Sorunuzu aldım! Fizyoterapist Betina Tansuğ rehberliğinde bedeninize en uygun çözümü bulmak için buradayız.\n\nİster online canlı seanslarımıza katılabilir, ister omurga ve beslenme rutinlerinizi yeniden yapılandırabilirsiniz. Dilerseniz sorunuzu doğrudan WhatsApp üzerinden Betina Hoca'ya da iletebilirsiniz.",
            'chips' => [
                'Bana Uygun Programı Bul',
                '4 Haftalık Online Kamp Nedir?',
                'WhatsApp Danışma Hattı',
                'Fiyat ve Detaylar'
            ]
        ];
    }

    private function hasAny(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    private function getDefaultChips(): array
    {
        return [
            'Bana Uygun Programı Bul',
            '4 Haftalık Online Kamp Nedir?',
            'Boyun ve Sırt Ağrılarım Var',
            'WhatsApp Danışma Hattı'
        ];
    }
}


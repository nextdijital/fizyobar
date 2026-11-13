<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

class EventController extends Controller
{
    public function index(): void
    {
        $events = [
            [
                'id' => 1,
                'slug' => 'bobo-yoga-club',
                'title' => 'BOBO Yoga Club',
                'short_title' => 'BOBO YOGA',
                'location' => 'ADANA',
                'description' => 'Enerjisi yüksek topluluk dersleri, modern ritimler ve fonksiyonel akışların buluştuğu hafta sonu buluşmaları.',
                'image' => asset('assets/images/betina-outdoor-stretch.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 2,
                'slug' => 'cocktail-festivali',
                'title' => 'Cocktail Festivali Yoga Deneyimi',
                'short_title' => 'COCKTAIL FESTİVALİ',
                'location' => 'FESTİVAL ALANI',
                'description' => 'Müzik, gastronomi ve hareketi buluşturan; festival enerjisini bedensel farkındalıkla taçlandıran kitlesel seanslar.',
                'image' => asset('assets/images/betina-outdoor-inversion.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 3,
                'slug' => 'dunya-yoga-gunu',
                'title' => 'Dünya Yoga Günü Buluşması',
                'short_title' => 'DÜNYA YOGA GÜNÜ',
                'location' => 'MERKEZ PARK',
                'description' => 'Şehirle iç içe, yüzlerce kişinin aynı nefes ve ritimde buluştuğu ilham verici devasa açık hava pratikleri.',
                'image' => asset('assets/images/hero-poster.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 4,
                'slug' => 'adana-kurek-kulubu',
                'title' => 'Adana Kürek Kulübü & Platform',
                'short_title' => 'KÜREK KULÜBÜ',
                'location' => 'SEYHAN GÖLÜ',
                'description' => 'Su sporları, göl esintisi ve platform üzerinde derin merkez gücünü sınayan adrenalin ve dinginlik seansı.',
                'image' => asset('assets/images/betina-user-photo1.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 5,
                'slug' => 'backyard-marina',
                'title' => 'Backyard Marina & Küvet',
                'short_title' => 'BACKYARD MARİNA',
                'location' => 'BACKYARD',
                'description' => 'Deniz havasında, açık hava ritminde nefes açıcı ve canlandırıcı fonksiyonel outdoor akışlar.',
                'image' => asset('assets/images/betina-user-photo2.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 6,
                'slug' => 'bosnali-hotel-rooftop',
                'title' => 'Bosnalı Hotel Rooftop Yoga',
                'short_title' => 'BOSNALI ROOFTOP',
                'location' => 'TARİHİ TEPEBAĞ',
                'description' => 'Şehrin tarihi silüetinde, büyüleyici çatı katı manzarasıyla gün batımının kızıllığında dinginleşen seanslar.',
                'image' => asset('assets/images/betina-studio-forward-fold.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ],
            [
                'id' => 7,
                'slug' => 'arkeoloji-muzesi',
                'title' => 'Arkeoloji Müzesi Özel Seansı',
                'short_title' => 'ARKEOLOJİ MÜZESİ',
                'location' => 'MÜZE BAHÇESİ',
                'description' => 'Tarihin ve mitolojinin sessiz tanıklığında, bin yıllık eserler arasında zihni ve bedeni köklendiren özel seans.',
                'image' => asset('assets/images/betina-outdoor-stretch.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
            ]
        ];

        $this->render('pages/events', [
            'metaTitle' => Language::get('events_page.meta_title'),
            'metaDescription' => Language::get('events_page.meta_description'),
            'activeTab' => 'events',
            'hideFooter' => true,
            'events' => $events,
        ]);
    }

    public function announcements(): void
    {
        $announcements = [
            [
                'id' => 1,
                'number' => '01',
                'title' => '4 HAFTALIK METABOLİK DETOX & YOGA KAMPI',
                'short_title' => 'DETOX & YOGA',
                'category' => 'Online Kamp',
                'badge' => 'Kayıtlar Açık',
                'date' => '18 KASIM 2026',
                'ref_code' => 'FZB-DOC.01',
                'location' => 'Canlı Zoom & WhatsApp Takip Grubu',
                'summary' => 'Metabolik yenilenme, GLP-1 dengeleyici fonksiyonel beslenme rehberi ve haftada 3 gün canlı yoga seansları.',
                'content' => 'Yeni dönem online detoks kampımızda Betina Tansuğ rehberliğinde hücresel temizlenme, insülin dengesi ve omurga sağlığı için bir araya geliyoruz. Program kapsamında canlı pratikler, kişiye özel beslenme takibi, haftalık glisemik menü planları ve sürekli eğitmen desteği sunulmaktadır. Kontenjanlarımız birebir takip kalitesini korumak için sınırlıdır.',
                'details' => [
                    'Süre: 4 Hafta (12 Canlı Seans)',
                    'Format: Canlı Yayın + Kayıt Erişimi',
                    'Ekstra: Fonksiyonel Bar Kitchen Beslenme Rehberi',
                ],
                'cta_text' => 'Kampa Hemen Kaydol',
                'cta_link' => 'https://wa.me/905321234567?text=' . rawurlencode('Merhaba, 4 Haftalık Online Detox & Yoga Kampı hakkında bilgi ve kayıt için yazıyorum.'),
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'number' => '02',
                'title' => 'FASYA SAĞLIĞI & FOAM ROLLER DERİN DOKU ATÖLYESİ',
                'short_title' => 'FASYA ATÖLYESİ',
                'category' => 'Yüz Yüze Workshop',
                'badge' => '12 Kişilik Kontenjan',
                'date' => '24 KASIM 2026',
                'ref_code' => 'FZB-DOC.02',
                'location' => 'Adana Stüdyo • Gülek Plaza',
                'summary' => 'Miyofasyal tetik nokta gevşetme ve derin doku hidrasyon teknikleri ile kronik tutulmalara son verin.',
                'content' => 'Masa başı çalışanlar, sporcular ve kronik sırt/boyun gerginliği yaşayanlar için özel olarak kurgulanan 2 saatlik yoğun uygulamalı fasya çalıştayı. Bedeninizin bağ doku katmanlarını nasıl serbest bırakacağınızı, dolaşımı nasıl hızlandıracağınızı ve postüral ağrılardan nasıl kurtulacağınızı öğreneceksiniz. Tüm ekipmanlar stüdyomuz tarafından sağlanacaktır.',
                'details' => [
                    'Saat: Cumartesi 14:00 - 16:30',
                    'Eğitmen: Betina Tansuğ & Fizyoterapist Ekibi',
                    'Ekipman: Foam Roller & Masaj Topu Dahil',
                ],
                'cta_text' => 'Atölye Yerinizi Ayırın',
                'cta_link' => 'https://wa.me/905321234567?text=' . rawurlencode('Merhaba, Fasya Sağlığı & Foam Roller Atölyesi için rezervasyon yaptırmak istiyorum.'),
                'is_featured' => false,
            ],
            [
                'id' => 3,
                'number' => '03',
                'title' => 'BAR KITCHEN KIŞ MENÜSÜ & FONKSİYONEL REHBERLER YAYINDA',
                'short_title' => 'BAR KITCHEN KIŞ',
                'category' => 'Bar Kitchen',
                'badge' => 'Yeni İçerikler',
                'date' => '02 ARALIK 2026',
                'ref_code' => 'FZB-DOC.03',
                'location' => 'Fizyobar Dijital Tarif Kütüphanesi',
                'summary' => 'Bağışıklık güçlendirici sıcak kaseler, kış smoothie’leri ve rafine şekersiz fonksiyonel tarifler.',
                'content' => 'Kış aylarında metabolizmayı canlı tutan, rafine şekersiz ve bağırsak mikrobiyomunu destekleyen 12 yeni kış tarifi ve GLP-1 glisemik rehberi Bar Kitchen sayfamızda erişime açıldı. Zerdeçallı altın ezmelerden probiyotik tohum karışımlarına kadar bedeninizin mevsim geçişinde ihtiyaç duyduğu her şey burada.',
                'details' => [
                    'Erişim: Tüm Ziyaretçilere Açık',
                    'Kategori: Sıcak Kaseler, Çorbalar & İçecekler',
                    'Özellik: Adım Adım Tarif Defteri Kartları',
                ],
                'cta_text' => 'Tarifleri İncele',
                'cta_link' => '/fizyobar/recipes',
                'is_featured' => false,
            ],
            [
                'id' => 4,
                'number' => '04',
                'title' => 'REFORMER PİLATES & BİREBİR POSTÜR ANALİZ GÜNLERİ',
                'short_title' => 'POSTÜR ANALİZİ',
                'category' => 'Stüdyo Duyurusu',
                'badge' => 'Ücretsiz Ön Değerlendirme',
                'date' => '10 ARALIK 2026',
                'ref_code' => 'FZB-DOC.04',
                'location' => 'Fizyobar Stüdyo • Özel Seans Alanı',
                'summary' => 'Uzman fizyoterapist eşliğinde skolyoz, kifoz ve postüral asimetri değerlendirmesi.',
                'content' => 'Bedeninizin mekanik dengesini ve kas zincirlerini profesyonel postür analizimizle keşfedin. 30 dakikalık birebir postür taraması, eklem hareket açıklığı ölçümü ve ardından size özel kurgulanacak Reformer Pilates çalışma protokolü için randevu takvimi açıldı.',
                'details' => [
                    'Format: 30 Dakika Birebir Seans',
                    'Kayıt: Önceden Randevu Zorunludur',
                    'Hedef: Doğru Omurga Hizalanması',
                ],
                'cta_text' => 'Randevu Oluştur',
                'cta_link' => 'https://wa.me/905321234567?text=' . rawurlencode('Merhaba, Birebir Postür Analizi için uygun randevu saatlerini öğrenmek istiyorum.'),
                'is_featured' => false,
            ],
            [
                'id' => 5,
                'number' => '05',
                'title' => 'ÇUKUROVA GÖL KENARI SOUND HEALING & GÜN BATIMI YOGASI',
                'short_title' => 'GÖL KENARI YOGA',
                'category' => 'Açık Hava Etkinliği',
                'badge' => 'Topluluk Buluşması',
                'date' => '18 ARALIK 2026',
                'ref_code' => 'FZB-DOC.05',
                'location' => 'Seyhan Baraj Gölü Kıyısı • Adana',
                'summary' => 'Tibet ses çanakları meditasyonu, nefes çalışmaları ve açık havada gün batımı akışı.',
                'content' => 'Şehrin gürültüsünden ve günlük stresinden uzaklaşarak suyun dinginliğinde buluşuyoruz. Tibet çanaklarının derin titreşimleri eşliğinde nefes farkındalığı ve yumuşak vinyasa akışı ile zihinsel ve bedensel reset deneyimi. Matınızı alıp gelin, pratik sonrası Bar Kitchen sıcak bitki çayları ikramımız olacaktır.',
                'details' => [
                    'Saat: Pazar 16:30 - 18:30',
                    'Katılım: Ücretsiz / Açık Topluluk Seansı',
                    'Yanınızda Getirin: Yoga Matı & Rahat Giysiler',
                ],
                'cta_text' => 'Topluluğa Katıl',
                'cta_link' => 'https://wa.me/905321234567?text=' . rawurlencode('Merhaba, Seyhan Baraj Gölü Yoga & Sound Healing etkinliğine katılmak istiyorum.'),
                'is_featured' => false,
            ],
        ];

        $this->render('pages/announcements', [
            'metaTitle' => 'Duyurular & Kamp Kayıtları | FİZYOBAR Wellness Experiences',
            'metaDescription' => 'Fizyobar yeni dönem online kampları, canlı atölyeler ve stüdyo kayıt duyuruları.',
            'activeTab' => 'announcements',
            'announcements' => $announcements,
        ]);
    }

    public function news(): void
    {
        $this->redirect(url('/events'), 301);
    }
}


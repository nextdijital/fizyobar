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
                'title' => 'BOBO Yoga Topluluğu',
                'subtitle' => 'YOGA & AÇIK HAVA AKIŞI',
                'short_title' => 'BOBO YOGA',
                'location' => 'ADANA • MERKEZ PARK',
                'spot' => 'Merkez Park',
                'category' => 'YOGA & NEFES',
                'badge' => 'İLERİ SEVİYE',
                'date_badge' => 'HER PAZAR',
                'time_text' => '09:30 - 11:00',
                'capacity' => '35 Kişilik',
                'price_text' => 'Açık Topluluk Seansı',
                'includes' => ['Fonksiyonel Vinyasa Akışı', 'Bar Kitchen Soğuk Sıkım İkramı', 'Açık Hava & Canlı Ritim', 'Tüm Seviyelere Uygun'],
                'description' => 'Enerjisi yüksek topluluk dersleri, modern ritimler ve fonksiyonel akışların buluştuğu hafta sonu buluşmaları.',
                'long_description' => 'Adana\'nın yeşil kalbinde, açık havanın temiz esintisi ve ritmik modern müzik eşliğinde haftayı tazeleyen fonksiyonel yoga pratiği. Betina Tansuğ rehberliğinde eklem hareketliliği, core güçlenme ve nefes farkındalığı ile zinde bir pazar başlangıcı.',
                'image' => asset('assets/images/betina-outdoor-stretch.jpg'),
                'avatar' => asset('assets/images/betina-user-photo1.jpg'),
                'color' => '#4a1421',
                'text_color' => '#ffffff',
                'wa_text' => 'Merhaba Betina Hocam! BOBO Yoga Club seansı hakkında bilgi almak ve yer ayırtmak istiyorum.'
            ],
            [
                'id' => 2,
                'slug' => 'cocktail-festivali',
                'title' => 'Cocktail Festivali Yoga',
                'subtitle' => 'FESTİVAL & SES AKIŞI',
                'short_title' => 'COCKTAIL FESTİVALİ',
                'location' => 'FESTİVAL ALANI • ANA SAHNE',
                'spot' => 'Festival Alanı',
                'category' => 'FESTİVAL',
                'badge' => 'ÖZEL SEANS',
                'date_badge' => '12 MAYIS',
                'time_text' => '11:00 - 12:30',
                'capacity' => '150+ Katılımcı',
                'price_text' => 'Festival Bileti Dahil',
                'includes' => ['Canlı Müzik ile Hareket', 'Doğal İçecek & Elektrolit Barı', 'Grup Enerjisi & Festival Akışı', 'Fizyobar Mat Hediyesi'],
                'description' => 'Müzik, gastronomi ve hareketi buluşturan; festival enerjisini bedensel farkındalıkla taçlandıran kitlesel seanslar.',
                'long_description' => 'Geleneksel festival atmosferini bedensel esenlikle harmanlayan eşsiz bir deneyim. Canlı müzik performansı eşliğinde tempolu vinyasa akışı, ardından Bar Kitchen fonksiyonel içecek ikramları ile coşkulu bir birliktelik.',
                'image' => asset('assets/images/betina-outdoor-inversion.jpg'),
                'avatar' => asset('assets/images/betina-user-photo2.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
                'wa_text' => 'Merhaba Betina Hocam! Cocktail Festivali Yoga Deneyimi için bilgi almak istiyorum.'
            ],
            [
                'id' => 3,
                'slug' => 'dunya-yoga-gunu',
                'title' => 'Dünya Yoga Günü',
                'subtitle' => 'TOPLULUK & KUTLAMA',
                'short_title' => 'DÜNYA YOGA GÜNÜ',
                'location' => 'MERKEZ PARK • NEHİR KIYISI',
                'spot' => 'Seyhan Nehri',
                'category' => 'YOGA & NEFES',
                'badge' => 'HER SEVİYEYE UYGUN',
                'date_badge' => '21 HAZİRAN',
                'time_text' => '18:30 - 20:30',
                'capacity' => '250+ Katılımcı',
                'price_text' => 'Ücretsiz Katılım',
                'includes' => ['108 Güneşe Selam Döngüsü', 'Tibet Ses Çanakları ile Derin Gevşeme', 'Gün Batımı Topluluk Meditasyonu', 'Bar Kitchen Çay İkramı'],
                'description' => 'Şehirle iç içe, yüzlerce kişinin aynı nefes ve ritimde buluştuğu ilham verici devasa açık hava pratikleri.',
                'long_description' => 'Dünya Yoga Günü\'nde yüzlerce kişi tek nefeste birleşiyor. Gün batımı kızıllığında güneşe selam serileri, ardından Tibet çanaklarının derin titreşimleriyle zihinsel dinginlik ve komünite ruhu.',
                'image' => asset('assets/images/hero-poster.jpg'),
                'avatar' => asset('assets/images/betina-outdoor-stretch.jpg'),
                'color' => '#4a1421',
                'text_color' => '#ffffff',
                'wa_text' => 'Merhaba Betina Hocam! Dünya Yoga Günü etkinliği için kaydolmak istiyorum.'
            ],
            [
                'id' => 4,
                'slug' => 'adana-kurek-kulubu',
                'title' => 'Kürek Kulübü Platform',
                'subtitle' => 'SU VE MERKEZ DENGESİ',
                'short_title' => 'KÜREK KULÜBÜ',
                'location' => 'SEYHAN GÖLÜ • SU PLATFORMU',
                'spot' => 'Seyhan Barajı',
                'category' => 'SU & PLATFORM',
                'badge' => 'İLERİ SEVİYE',
                'date_badge' => 'CUMARTESİ',
                'time_text' => '08:30 - 10:30',
                'capacity' => '18 Kişi',
                'price_text' => 'Ön Rezervasyonlu',
                'includes' => ['Su Üzerinde Denge & Core Akışı', 'Temel Kürek Eğitimi', 'Göl Esintisinde Nefes Çalışması', 'Bar Kitchen Enerji Topları'],
                'description' => 'Su sporları, göl esintisi ve platform üzerinde derin merkez gücünü sınayan adrenalin ve dinginlik seansı.',
                'long_description' => 'Seyhan Baraj Gölü\'nün dingin sularında kurulan özel platform üzerinde yoga ve core stabilizasyonu. Su yüzeyindeki mikro salınımlar derin postural kasları ateşlerken, gölün ferahlatıcı esintisi zihni dinlendirir.',
                'image' => asset('assets/images/betina-user-photo1.jpg'),
                'avatar' => asset('assets/images/hero-poster.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
                'wa_text' => 'Merhaba Betina Hocam! Adana Kürek Kulübü göl platformu seansı için yer ayırtmak istiyorum.'
            ],
            [
                'id' => 5,
                'slug' => 'backyard-marina',
                'title' => 'Backyard Marina & Küvet',
                'subtitle' => 'GÜN BATIMI & SOĞUK SU SEANSI',
                'short_title' => 'BACKYARD MARİNA',
                'location' => 'BACKYARD MARİNA BAHÇESİ',
                'spot' => 'Backyard Marina',
                'category' => 'SU & PLATFORM',
                'badge' => 'ÖZEL BULUŞMA',
                'date_badge' => 'ÇARŞAMBA',
                'time_text' => '18:30 - 20:00',
                'capacity' => '20 Kişi',
                'price_text' => 'Rezervasyonlu',
                'includes' => ['Miyofasyal Derin Doku Açılması', 'Kontrollü Soğuk Su / Buz Terapisi', 'Vagus Siniri Aktivasyonu', 'Detoks İçeceği'],
                'description' => 'Deniz havasında, açık hava ritminde nefes açıcı ve canlandırıcı fonksiyonel outdoor akışlar.',
                'long_description' => 'Marina atmosferinde gün batımının sakinliğiyle buluşan derin bağ doku açılması ve ardından kontrollü soğuk maruziyeti. Hücresel sağlık ve zindeliği hedefleyen sıra dışı bir buluşma ritüeli.',
                'image' => asset('assets/images/betina-user-photo2.jpg'),
                'avatar' => asset('assets/images/kitchen-hero-plate.webp'),
                'color' => '#4a1421',
                'text_color' => '#ffffff',
                'wa_text' => 'Merhaba Betina Hocam! Backyard Marina & Küvet seansı için bilgi almak istiyorum.'
            ],
            [
                'id' => 6,
                'slug' => 'bosnali-hotel-rooftop',
                'title' => 'Tarihi Bosnalı Otel Terası',
                'subtitle' => 'TARİHİ TERAS & YOGA',
                'short_title' => 'BOSNALI TERAS',
                'location' => 'TARİHİ TEPEBAĞ • TERAS',
                'spot' => 'Tarihi Tepebağ',
                'category' => 'TERAS',
                'badge' => 'GÜN BATIMI SAATİ',
                'date_badge' => 'CUMA 19:00',
                'time_text' => '19:00 - 20:30',
                'capacity' => '22 Kişi',
                'price_text' => 'Ön Rezervasyonlu',
                'includes' => ['Tarihi Şehir Silüeti Manzarası', 'Akustik Müzik Eşliğinde Akış', 'Aromaterapi Gevşeme Seansı', 'Bar Kitchen Doğal İçecek'],
                'description' => 'Şehrin tarihi silüetinde, büyüleyici çatı katı manzarasıyla gün batımının kızıllığında dinginleşen seanslar.',
                'long_description' => 'Tarihi Tepebağ evlerinin arasında, Seyhan Nehri\'ne tepeden bakan büyüleyici Bosnalı Hotel terasında haftanın yorgunluğunu geride bırakın. Akustik melodiler ve aromaterapi dokunuşlarıyla derin bir yenilenme.',
                'image' => asset('assets/images/betina-studio-forward-fold.jpg'),
                'avatar' => asset('assets/images/betina-studio-forward-fold.jpg'),
                'color' => '#ffffff',
                'text_color' => '#111111',
                'wa_text' => 'Merhaba Betina Hocam! Bosnalı Teras Yoga seansı için rezervasyon yapmak istiyorum.'
            ],
            [
                'id' => 7,
                'slug' => 'arkeoloji-muzesi',
                'title' => 'Arkeoloji Müzesi Seansı',
                'subtitle' => 'KÜLTÜR & FARKINDALIK',
                'short_title' => 'ARKEOLOJİ MÜZESİ',
                'location' => 'YENİ MÜZE KOMPLEKSİ • BAHÇE',
                'spot' => 'Müze Bahçesi',
                'category' => 'YOGA & NEFES',
                'badge' => 'AYLIK ÖZEL',
                'date_badge' => 'AYDA 1 KEZ',
                'time_text' => '10:00 - 12:00',
                'capacity' => '30 Kişi',
                'price_text' => 'Müze Kartı & Rezervasyon',
                'includes' => ['Antik Sütunlar Arasında Sessiz Yoga', 'Sanat Tarihçisi ile Kısa Tur', 'Rehberli Nefes & Farkındalık', 'Özel Hediye Kiti'],
                'description' => 'Tarihin ve mitolojinin sessiz tanıklığında, bin yıllık eserler arasında zihni ve bedeni köklendiren özel seans.',
                'long_description' => 'Kilikya ve Roma medeniyetlerinin bin yıllık mozaikleri ve mermer heykelleri arasında köklenin. Tarih, sanat ve bedensel hareketi birleştiren, Türkiye\'nin en prestijli müze seanslarından biri.',
                'image' => asset('assets/images/betina-outdoor-stretch.jpg'),
                'avatar' => asset('assets/images/betina-outdoor-inversion.jpg'),
                'color' => '#4a1421',
                'text_color' => '#ffffff',
                'wa_text' => 'Merhaba Betina Hocam! Arkeoloji Müzesi Özel Seansı için kayıt ve bilgi almak istiyorum.'
            ]
        ];

        $this->render('pages/events', [
            'metaTitle' => Language::get('events_page.meta_title'),
            'metaDescription' => Language::get('events_page.meta_description'),
            'activeTab' => 'events',
            'hideFooter' => false,
            'events' => $events,
        ]);
    }

    public function announcements(): void
    {
        $dbRows = \Core\Database::query("SELECT * FROM site_announcements WHERE is_active = 1 ORDER BY sort_order ASC, id DESC");
        $defaultImages = [
            'assets/images/betina-outdoor-stretch.jpg',
            'assets/images/betina-studio-forward-fold.jpg',
            'assets/images/kitchen-hero-plate.webp',
            'assets/images/betina-user-photo1.jpg',
            'assets/images/betina-outdoor-inversion.jpg',
        ];
        if (!empty($dbRows)) {
            $cleanShortTitles = [
                1 => '4 HAFTALIK DETOKS & YOGA',
                2 => 'KLİNİK ANATOMİ & FASYA',
                3 => 'BAR KITCHEN KIŞ DETOKSU',
                4 => 'REFORMER PİLATES & POSTÜR',
                5 => 'GÖL KENARI SOUND HEALING',
            ];
            $announcements = [];
            foreach ($dbRows as $idx => $row) {
                $num = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT);
                $rowId = (int)$row['id'];
                $short = $cleanShortTitles[$rowId] ?? $row['title'];
                $announcements[] = [
                    'id' => $rowId,
                    'number' => $num,
                    'title' => $row['title'],
                    'short_title' => $short,
                    'category' => $row['badge'] ?: 'Genel Bildiri',
                    'badge' => $row['badge'] ?: 'Aktif',
                    'date' => $row['date_text'] ?: date('d.m.Y'),
                    'ref_code' => 'FZB-DOC.' . $num,
                    'location' => $row['location'] ?: 'Fizyobar Online / Stüdyo',
                    'summary' => $row['spot'] ?: '',
                    'content' => $row['content'] ?: '',
                    'image' => $defaultImages[$idx % count($defaultImages)],
                    'details' => [
                        'Tarih: ' . ($row['date_text'] ?: '-'),
                        'Lokasyon: ' . ($row['location'] ?: 'Stüdyo & Online'),
                        'Kategori: ' . ($row['badge'] ?: 'Bildiri')
                    ],
                    'cta_text' => 'Detaylı Bilgi & WhatsApp',
                    'cta_link' => 'https://wa.me/905357056828?text=' . rawurlencode('Merhaba, ' . $row['title'] . ' hakkında bilgi ve kayıt için yazıyorum.'),
                    'is_featured' => ($idx === 0)
                ];
            }
        } else {
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
                'image' => 'assets/images/betina-outdoor-stretch.jpg',
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
                'image' => 'assets/images/betina-studio-forward-fold.jpg',
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
                'image' => 'assets/images/kitchen-hero-plate.webp',
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
                'image' => 'assets/images/betina-user-photo1.jpg',
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
                'image' => 'assets/images/betina-outdoor-inversion.jpg',
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
        }

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


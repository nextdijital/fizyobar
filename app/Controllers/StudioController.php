<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Language;

/**
 * Fizyobar Studio Controller
 * Tarifler, Rehberler, Beslenme Planları ve Studio Ana Sayfası
 */
class StudioController extends Controller
{
    /**
     * Studio Ana Sayfa (Egzersiz, Beslenme, Rehberler ve Tarifler Merkezi)
     */
    public function index(): void
    {
        $this->render('pages/studio', [
            'metaTitle' => 'Studio | FİZYOBAR Wellness Experiences',
            'metaDescription' => 'Fizyobar Studio: Fonksiyonel beslenme planları, rehberler, rafine şekersiz tarifler, makaleler ve blog.',
        ]);
    }

    /**
     * Tarifler Sayfası (Rafine Şekersiz & Fonksiyonel Beslenme)
     */
    public function recipes(): void
    {
        $recipes = [
            [
                'id' => 1,
                'category' => 'smoothie',
                'category_label' => 'Kahvaltı & Smoothie',
                'title' => 'Anti-Enflamatuar Altın Smoothie',
                'time' => '8 dk',
                'calories' => '220 kcal',
                'badge' => 'RAFİNE ŞEKERSİZ',
                'description' => 'Zerdeçal, zencefil, badem sütü ve keten tohumu ile hücresel enflamasyonu azaltan ve güne yüksek enerjiyle başlatan sabah iksiri.',
                'ingredients' => [
                    '1 su bardağı şekersiz badem sütü',
                    '1/2 çay kaşığı organik zerdeçal & karabiber',
                    '1 tatlı kaşığı chia tohumu',
                    '1/2 dondurulmuş muz veya 1/4 avokado',
                    '1 tatlı kaşığı taze rendelenmiş zencefil'
                ],
                'instructions' => 'Tüm malzemeleri yüksek devirli blenderda pürüzsüz kıvama gelene kadar yaklaşık 60 saniye karıştırın. Taze tüketin.'
            ],
            [
                'id' => 2,
                'category' => 'meals',
                'category_label' => 'Sağlıklı Öğünler',
                'title' => 'Avokadolu Yeşil Longevity Kasesi',
                'time' => '15 dk',
                'calories' => '340 kcal',
                'badge' => 'GLUTENSİZ',
                'description' => 'Haşlanmış kinoa, taze bebek ıspanak, fermente zeytin, ceviz ve soğuk sıkım zeytinyağı ile mitokondriyal sağlığı destekleyen hafif öğün.',
                'ingredients' => [
                    '1 çay bardağı haşlanmış kinoa',
                    '1/2 olgun avokado (dilimlenmiş)',
                    '1 avuç bebek ıspanak & roka',
                    '4-5 adet kırma yeşil zeytin',
                    '1 yemek kaşığı soğuk sıkım natürel sızma zeytinyağı',
                    'Yarım limon suyu & kaya tuzu'
                ],
                'instructions' => 'Kinoayı kase tabanına yayın, üzerine yeşillikleri ve avokado dilimlerini yerleştirin. Zeytinyağı ve limon sosuyla harmanlayıp servis yapın.'
            ],
            [
                'id' => 3,
                'category' => 'dessert',
                'category_label' => 'Şekersiz Tatlılar',
                'title' => 'Ham Kakaolu Chia Puding',
                'time' => '10 dk (+dinlenme)',
                'calories' => '180 kcal',
                'badge' => 'DÜŞÜK GLİSEMİK',
                'description' => 'Çiğ kakao, Hindistan cevizi sütü ve chia tohumu ile tatlı krizlerini sıfırlayan, kan şekerini dengede tutan antioksidan deposu tatlı.',
                'ingredients' => [
                    '3 yemek kaşığı chia tohumu',
                    '1 su bardağı Hindistan cevizi sütü',
                    '1 yemek kaşığı ham çiğ kakao tozu',
                    '1 çay kaşığı saf vanilya özütü',
                    'Üzeri için: Yaban mersini & ceviz parçaları'
                ],
                'instructions' => 'Tüm malzemeleri bir kavanozda çırpın. 10 dakika sonra tekrar karıştırıp buzdolabında en az 2 saat (tercihen gece boyu) jelleşmeye bırakın.'
            ],
            [
                'id' => 4,
                'category' => 'drinks',
                'category_label' => 'Detox & İçecekler',
                'title' => 'Metabolik Zencefilli Detox İksiri',
                'time' => '5 dk',
                'calories' => '35 kcal',
                'badge' => 'VAGUS DOSTU',
                'description' => 'Taze limon suyu, elma sirkesi, seylan tarçını ve zencefil ile sabahları sindirim ateşini (Agni) yakan ve vagus sinirini uyaran canlandırıcı tonik.',
                'ingredients' => [
                    '1 su bardağı ılık içme suyu',
                    '1 tatlı kaşığı organik elma sirkesi (katkısız)',
                    'Yarım limonun taze sıkılmış suyu',
                    'Çeyrek çay kaşığı seylan tarçını',
                    'Bir çimdik taze çekilmiş zencefil'
                ],
                'instructions' => 'Ilık suya tüm malzemeleri ekleyip iyice karıştırın. Sabah aç karnına, ilk öğünden 20 dakika önce yudumlayarak için.'
            ],
            [
                'id' => 5,
                'category' => 'meals',
                'category_label' => 'Sağlıklı Öğünler',
                'title' => 'Fırınlanmış Somon & Kuşkonmaz Salatası',
                'time' => '20 dk',
                'calories' => '390 kcal',
                'badge' => 'OMEGA-3 ZENGİNİ',
                'description' => 'Yüksek kaliteli omega-3 yağ asitleri ve prebiyotik lif kaynağı kuşkonmaz ile eklem sağlığını ve zihinsel odaklanmayı artıran akşam yemeği.',
                'ingredients' => [
                    '150g taze somon fileto',
                    '1 demet taze yeşil kuşkonmaz',
                    '1 diş ezilmiş sarımsak',
                    '1 tatlı kaşığı zeytinyağı',
                    'Deniz tuzu & taze çekilmiş karabiber',
                    'Limon dilimleri'
                ],
                'instructions' => 'Fırını 190°C’ye ısıtın. Fırın tepsisine somon ve kuşkonmazları dizin, sarımsaklı zeytinyağını gezdirin. 15-18 dakika pişirin.'
            ],
            [
                'id' => 6,
                'category' => 'dessert',
                'category_label' => 'Şekersiz Tatlılar',
                'title' => 'Fındık Ezmeli Vegan Enerji Topları',
                'time' => '12 dk',
                'calories' => '110 kcal / adet',
                'badge' => 'PİŞİRME GEREKTİRMEZ',
                'description' => 'Medjool hurma, çiğ fındık ve keten tohumu ile egzersiz öncesi veya öğleden sonra enerji düşüşlerinde hızlı ve temiz yakıt.',
                'ingredients' => [
                    '6 adet çekirdeği çıkarılmış Medjool hurma',
                    '1/2 su bardağı çiğ fındık veya ceviz',
                    '1 yemek kaşığı katkısız fındık ezmesi',
                    '1 yemek kaşığı keten tohumu unu',
                    'Dışını kaplamak için Hindistan cevizi tozu'
                ],
                'instructions' => 'Tüm malzemeleri mutfak robotunda yapışkan bir hamur olana dek çekin. Ceviz büyüklüğünde toplar yuvarlayıp Hindistan cevizine bulayın.'
            ]
        ];

        $this->render('pages/recipes', [
            'metaTitle' => 'Tarifler | FİZYOBAR Studio',
            'metaDescription' => 'Rafine şekersiz, anti-enflamatuar, glutensiz ve metabolik denge sağlayan fonksiyonel Fizyobar tarifleri.',
            'recipes' => $recipes
        ]);
    }

    /**
     * Rehberler Sayfası (Longevity, Biyomekanik & Sinir Sistemi Kılavuzları)
     */
    public function guides(): void
    {
        $guides = [
            [
                'id' => 1,
                'category' => 'vagus',
                'category_label' => 'Vagus & Sinir Sistemi',
                'read_time' => '6 dk okuma',
                'title' => 'Vagus Siniri Aktivasyonu ve Diyafram Nefesi Rehberi',
                'subtitle' => 'Kronik sempatik stresi (savaş-kaç) kapatıp parasempatik dinginliğe geçiş protokolü.',
                'highlights' => [
                    'Vagus sinirinin kalp ritmi ve sindirim üzerindeki regülasyonu',
                    '4-7-8 diyafram nefes döngüsü ve fizyolojik sigh tekniği',
                    'Göz kaslarını gevşeterek servikal omurga gerginliğini çözme',
                    'Günlük 5 dakikalık vagal tonus egzersiz rutini'
                ],
                'summary' => 'Vagus siniri, vücudun en uzun kranial siniridir ve zihin ile organlar arasındaki temel iletişim otobanıdır. Diyafram nefesiyle karın içi basıncı regüle ederek sempatik uyarılmayı saniyeler içinde yatıştırabilir ve hücresel toparlanmayı tetikleyebilirsiniz.'
            ],
            [
                'id' => 2,
                'category' => 'biomechanic',
                'category_label' => 'Biyomekanik & Postür',
                'read_time' => '8 dk okuma',
                'title' => 'Masa Başı Çalışanlar İçin Omurga & Eklem Kılavuzu',
                'subtitle' => 'İleri baş postürü, omuz protraksiyonu ve kalça fleksör kısalmalarına bilimsel çözümler.',
                'highlights' => [
                    'Boyun ve sırt ağrılarının temel biyomekanik kök nedenleri',
                    'Torakal omurga ekstansiyon ve rotasyon hareketleri',
                    'Psoas ve piriformis kaslarını güvenli rahatlatma dizilimi',
                    'Her 45 dakikada bir uygulanacak 90 saniyelik mikro-mobilite'
                ],
                'summary' => 'Uzun süre oturarak çalışmak, omurgadaki doğal servikal ve lomber lordoz eğrilerini bozar. Bu rehberde, eklem kapsülünü sıkıştırmadan kas boyunu optimize eden ve postürü yeniden hizalayan BAR System pratiklerini bulacaksınız.'
            ],
            [
                'id' => 3,
                'category' => 'longevity',
                'category_label' => 'Longevity & Yaşam',
                'read_time' => '7 dk okuma',
                'title' => 'Hücresel Longevity & Sirkadiyen Ritim Yönetimi',
                'subtitle' => 'Mitokondriyal canlılık, otofaji ve biyolojik yaşı genç tutmanın kanıta dayalı prensipleri.',
                'highlights' => [
                    'Sabah ilk 30 dakika doğal güneş ışığı almanın kortizol üzerindeki etkisi',
                    '12-14 saatlik sirkadiyen aralıklı beslenme penceresi',
                    'Isı şoku proteinleri (sauna/sıcak duş) ve soğuk uyarım faydaları',
                    'Mavi ışık bloklama ve derin faz uyku (REM/Deep) artırma'
                ],
                'summary' => 'Longevity yalnızca uzun yaşamak değil; ömrün her yılını zihinsel berraklık, esnek eklemler ve yüksek hücresel enerjiyle sürdürebilmektir. Bedenin biyolojik saatiyle uyumlu ritimler oluşturmak bunun ilk adımıdır.'
            ],
            [
                'id' => 4,
                'category' => 'sleep',
                'category_label' => 'Uyku & Sirkadiyen',
                'read_time' => '5 dk okuma',
                'title' => 'Derin Uyku Protokolü & Gece Restorasyonu',
                'subtitle' => 'Bedenin gece boyu doku onarımı ve nöral temizlik yapmasını sağlayan adımlar.',
                'highlights' => [
                    'Yatmadan 2 saat önce sindirimi durdurmanın kalp hızına faydası',
                    'Yatak odası sıcaklığı (18-19°C) ve karanlık izolasyonu',
                    'Yatış öncesi 5 dakikalık omurga açıcı restoratif yoga pozu',
                    'Magnezyum ve bitkisel çay takviyesi zamanlaması'
                ],
                'summary' => 'Derin uyku sırasında beynin glimfatik sistemi aktifleşir ve hücresel atıkları temizler. Doğru bir akşam kapatma rutiniyle uyku kalitenizi ölçülebilir biçimde artırabilirsiniz.'
            ]
        ];

        $this->render('pages/guides', [
            'metaTitle' => 'Rehberler | FİZYOBAR Studio',
            'metaDescription' => 'Longevity, biyomekanik, vagus regülasyonu ve sürdürülebilir iyi yaşam rehberleri.',
            'guides' => $guides
        ]);
    }

    /**
     * Beslenme Planları Sayfası (Glisemik Denge & Longevity Protokolleri)
     */
    public function plans(): void
    {
        $plans = [
            [
                'id' => 1,
                'badge' => 'EN ÇOK TERCİH EDİLEN',
                'title' => 'METABOLİK RESET & DETOX PLANI',
                'duration' => '4 HAFTALIK PROTOKOL',
                'description' => 'Rafine şekeri, enflamatuar yağları ve işlenmiş gıdaları sistemden temizleyerek insülin hassasiyetini ve sindirim dengesini yeniden kuran bütünsel plan.',
                'features' => [
                    'Glisemik Dengeli Haftalık Alışveriş Listeleri',
                    '30+ Rafine Şekersiz & Anti-Enflamatuar Pratik Tarif',
                    'Diyafram Nefesi ile Sindirim Sistemi (Agni) Uyarımı',
                    'Fizyoterapist Eşliğinde Günlük WhatsApp Takip & Soru-Cevap',
                    'Ömür Boyu Saklanabilir Dijital E-Kitap Rehberi'
                ],
                'cta' => 'KAMPA KATIL & PLANI AL',
                'url' => url('/checkout/1')
            ],
            [
                'id' => 2,
                'badge' => 'SÜRDÜRÜLEBİLİR YAŞAM',
                'title' => 'GLUTENSİZ & BİTKİSEL AĞIRLIKLI BESLENME',
                'duration' => 'ÖMÜR BOYU RUTİN',
                'description' => 'Mide-bağırsak şişkinliklerini gideren, eklem yangısını azaltan ve hücresel enerjiyi tavan yaptıran temiz ve dengeli beslenme şablonu.',
                'features' => [
                    'Bağırsak Mikrobiyomunu Besleyen Prebiyotik Menüler',
                    'Glutensiz Ekmek & Pratik Atıştırmalık Alternatifleri',
                    'Hücresel Longevity ve Mitokondri Destekleyici İpuçları',
                    'Restoran ve Sosyal Yaşamda Kolay Uygulama Stratejileri'
                ],
                'cta' => 'WHATSAPP İLE BİLGİ AL',
                'url' => 'https://wa.me/905357056828?text=Beslenme%20planlar%C4%B1%20hakk%C4%B1nda%20bilgi%20almak%20istiyorum.'
            ]
        ];

        $this->render('pages/plans', [
            'metaTitle' => 'Beslenme Planları | FİZYOBAR Studio',
            'metaDescription' => 'Metabolik reset, anti-enflamatuar ve glisemik dengeli fonksiyonel beslenme planları.',
            'plans' => $plans
        ]);
    }

    /**
     * Makaleler Sayfası (Bilimsel Fizyoterapi, Anatomi & Longevity)
     */
    public function articles(): void
    {
        $articles = [
            [
                'id' => 1,
                'category' => 'FİZYOTERAPİ & ANATOMİ',
                'category_slug' => 'biyomekanik',
                'title' => 'Masa Başı Çalışanlar İçin Omurga Biyomekaniği ve Servikal Yük Analizi',
                'excerpt' => 'Başın öne doğru her 2.5 santimetre eğilmesi, boyun omurlarına binen yükü yaklaşık 4.5 kilogram artırır. Kanıta dayalı mikro hareket serileriyle omurga sağlığını koruma rehberi.',
                'read_time' => '6 dk okuma',
                'date' => '02 Kasım 2026',
                'author' => 'Fzt. Betina Tansuğ',
                'lead' => 'Başı öne doğru her 2.5 santimetre eğmek, boyun omurlarına binen yükü yaklaşık 4.5 kilogram artırır: Servikal biyomekanik ve hücresel adaptasyon analizi.',
                'content_col1' => 'Yetişkin bir insanın baş ağırlığı anatomik nötral pozisyonda yaklaşık 4.5 ila 5.5 kilogramdır. Ancak akıllı telefon veya dizüstü bilgisayar ekranına 30 ila 45 derecelik açıyla bakıldığında, servikal C5-C7 omurlarına ve çevreleyen suboksipital kas liflerine binen dinamik yük 18 ila 22 kilograma kadar fırlar. Bu biyomekanik stres sadece kas spazmlarına yol açmaz; disklerde dehidrasyona, sinir kökü sıkışmalarına ve kronik sempatik tonus artışına zemin hazırlar.',
                'content_col2' => 'BAR (Body • Adapt • Reframe) metodolojisinde yaklaşımımız, ağrılı bölgeyi izole biçimde esnetmekten ibaret değildir. Servikal omurgayı korumak için torakal omurga ekstansiyon mobilitesini açmak, derin boyun fleksörlerini (Longus colli & capitis) aktive etmek ve skapular retraksiyonu solunum paternleriyle entegre etmek zorundayız. Beden ancak zincirin tüm halkaları uyumla çalıştığında kalıcı bir hizalanma kazanır.',
                'callout_quote' => 'Hareketsizlik sadece kas kütlesi kaybı değil; hücrelerimizin enerji santralleri olan mitokondrilerin solunum zincirini yavaşlatan ve fasya ağını kristalize eden metabolik bir duraksamadır. Günde 15 dakikalık kanıta dayalı mobilite akışları, servikal yük stresini hücresel düzeyde nötralize eder.',
                'content_col3' => '<strong>Fasya Ağı ve Gerilim Bütünlüğü:</strong> Geleneksel anatomi kitapları kasları birbirinden bağımsız yapılar olarak gösterse de, modern biyomekanik araştırmaları bedenin kesintisiz bir kolajen fasya ağıyla sarılı olduğunu kanıtlamıştır. Boyundaki bir tutulmanın kök nedeni çoğu zaman torakolomber fasyadaki veya pelvik diyaframdaki gerilim asimetrileridir.',
                'content_col4' => '<strong>Metabolik Reset ve Hücresel Yenilenme:</strong> Hareketi rafine şekersiz ve düşük glisemikli fonksiyonel beslenmeyle eşleştirdiğimizde, mitokondriyal biyogenez (yeni enerji santrallerinin üretimi) tetiklenir. Kan şekerindeki dalgalanmaların son bulması dokulardaki sistemik enflamasyonu ve ödemi hafifletir.',
                'references' => [
                    'Kapandji, I. A. (2019). The Physiology of the Joints: The Spinal Column, Pelvic Girdle and Head. Churchill Livingstone.',
                    'Schleip, R., & Müller, D. G. (2012). Training principles for fascial connective tissues. Journal of Bodywork and Movement Therapies.',
                    'Hansraj, K. K. (2014). Assessment of stresses in the cervical spine caused by posture. Surgical Technology International, 25, 277-279.'
                ]
            ],
            [
                'id' => 2,
                'category' => 'LONGEVITY & HÜCRESEL SAĞLIK',
                'category_slug' => 'longevity',
                'title' => 'Mitokondriyal Sağlık ve Hareket: Hücresel Düzeyde Yaşlanmayı Yavaşlatmak',
                'excerpt' => 'Hareketsizlik sadece kas kaybına değil, hücresel enerji santrallerimiz olan mitokondrilerin fonksiyonunu yitirmesine yol açar. Düşük tempolu aerobik akışların longevity üzerindeki etkisi.',
                'read_time' => '8 dk okuma',
                'date' => '24 Ekim 2026',
                'author' => 'Fzt. Betina Tansuğ',
                'lead' => 'Hücresel enerji dinamikleri ve mitokondriyal rejenerasyon: Kronolojik yaştan bağımsız olarak biyolojik yaşı genç tutmanın fizyoterapötik temelleri.',
                'content_col1' => 'Mitokondriler, hücrelerimizin ATP üreten enerji motorlarıdır. Yaşlanma sürecinde gözlenen canlılık kaybının temel nedeni, mitokondri sayısının azalması ve hasarlı mitokondrilerin temizlenememesidir (mitofaji yetersizliği). Düşük şiddetli, sürekli ve solunum odaklı BAR seansları, mitofajiyi tetikleyerek yeni ve dinç mitokondri üretimini uyarır.',
                'content_col2' => 'Sert ve yıpratıcı antrenmanlar kortizolü yükseltip hücresel oksidatif stresi artırabilirken, akışkan klinik yoga ve omurga mobilizasyonları otonom sinir sistemini vagal tonda tutar. Böylece hücresel onarım genleri (SIRT1 ve AMPK) aktif hale gelir ve kronik hücresel yorgunluk tersine döner.',
                'callout_quote' => 'Longevity, daha uzun yaşamak değil; yaşadığımız her günü ağrısız, yüksek enerjili ve bedensel bağımsızlıkla sürdürebilmektir. Hareket, biyolojimizin en güçlü ilacıdır.',
                'content_col3' => '<strong>Oksijen Tüketimi ve Mikro Dolaşım:</strong> Omurga eksenli rotasyon ve göğüs kafesi açıcı egzersizler, akciğerlerin alt loblarına giden hava akımını %40 oranında artırır. Bu durum kılcal damar yoğunluğunu güçlendirerek hücresel düzeyde besin iletimini hızlandırır.',
                'content_col4' => '<strong>Anti-Aging Beslenme Protokolü:</strong> Mitokondri zarını koruyan omega-3 yağ asitleri, polifenoller ve rafine şekersiz glisemik denge, hareketin yarattığı hücresel kazanımları kalıcı hale getiren vazgeçilmez sütunlardır.',
                'references' => [
                    'Lanza, I. R., et al. (2008). Endurance exercise as a countermeasure for human aging. Diabetes, 57(11), 2933-2942.',
                    'Sinclair, D. A. (2019). Lifespan: Why We Age—and Why We Don’t Have To. Atria Books.',
                    'Hood, D. A., et al. (2019). Maintenance of Skeletal Muscle Mitochondria in Health, Exercise, and Aging. Annual Review of Physiology.'
                ]
            ],
            [
                'id' => 3,
                'category' => 'FASYA & POSTÜR',
                'category_slug' => 'fasya',
                'title' => 'Fasya Ağı: Bedenin Görünmez İskeleti ve Kronik Ağrıların Gizli Nedeni',
                'excerpt' => 'Kaslar tek başına çalışmaz; baştan ayağa tüm bedeni saran fasya ağı gerilimleri aktarır. Fasya hidrasyonu ve esnekliği artıran BAR System teknikleri.',
                'read_time' => '5 dk okuma',
                'date' => '15 Ekim 2026',
                'author' => 'Fzt. Betina Tansuğ',
                'lead' => 'Bedenin kesintisiz gerilim ağı: Fasya dokusunun hidrasyonu, elastik enerji depolaması ve kronik ağrı döngüsünün kırılması.',
                'content_col1' => 'Geleneksel tıp uzun yıllar boyunca fasyayı organ ve kasların etrafındaki önemsiz bir zar gibi görmüştür. Oysa fasya, vücuttaki en zengin propriyoseptif (pozisyon algılayıcı) duyu organıdır. Kas iğciklerinden 6 ila 10 kat daha fazla mekanoreseptör içerir.',
                'content_col2' => 'Sürekli oturmak, fasya katmanları arasındaki hyaluronik asidin viskozitesini artırarak yapışıklıklara yol açar. BAR mobilite akışları, üç boyutlu spiral hareketlerle fasyayı sıkıp bırakarak taze doku sıvısının lifler arasında dolaşmasını sağlar.',
                'callout_quote' => 'Bedeniniz bir tahta blok değil, gerilimle ayakta duran elastik bir biyomekanik çadırdır. Bir ipi aşırı gerdiğinizde diğer uçta kopma riski başlar.',
                'content_col3' => '<strong>Miyofasyal Tetik Noktaların Çözülmesi:</strong> Fasya dokusu üzerindeki lokal mikrotravmalar sinir uçlarını uyararak yansıyan ağrılara sebep olur. Doğru solunum ve dinamik germelerle bu kilitlenmeler açılır.',
                'content_col4' => '<strong>Elastik Yaylanma Prensibi:</strong> Sağlıklı fasya, kanguru tendonları gibi kinetik enerjiyi depolar ve efor sarf etmeden geri bırakır. Bu da günlük hayatta yorulmadan hareket etmenin sırrıdır.',
                'references' => [
                    'Myers, T. W. (2020). Anatomy Trains: Myofascial Meridians for Manual and Movement Therapists. Elsevier.',
                    'Stecco, C. (2015). Functional Atlas of the Human Fascial System. Churchill Livingstone.',
                    'Findley, T., et al. (2012). Fascia research: A narrative review. Journal of Bodywork and Movement Therapies.'
                ]
            ]
        ];

        $idParam = $this->input('id');
        $catParam = $this->input('cat', 'all');
        $isSingle = ($idParam !== null && $idParam !== '');
        $selectedId = (int) ($idParam ?? 1);

        $currentArticle = null;
        foreach ($articles as $a) {
            if ($a['id'] === $selectedId) {
                $currentArticle = $a;
                break;
            }
        }
        if (!$currentArticle) {
            $currentArticle = $articles[0];
        }

        $this->render('pages/articles', [
            'metaTitle' => ($isSingle ? e($currentArticle['title']) . ' | ' : '') . 'FİZYOBAR Makaleler',
            'metaDescription' => e($currentArticle['excerpt']),
            'articles' => $articles,
            'currentArticle' => $currentArticle,
            'isSingle' => $isSingle,
            'activeCategory' => (string) $catParam
        ]);
    }

    /**
     * Blog Sayfası (Günlük Wellness, Deneyimler & İpuçları)
     */
    public function blog(): void
    {
        $posts = [
            [
                'id' => 1,
                'badge' => 'KAMP DENEYİMİ',
                'category_slug' => 'kamp',
                'title' => '4 Haftalık Online Kampta Bizi Neler Bekliyor? Adım Adım Dönüşüm Yolculuğu',
                'excerpt' => 'Sadece bir egzersiz programı değil; her sabah yeni bir challenge, günlük WhatsApp eğitmen takibi ve glisemik denge odaklı bütüncül bir yaşam rutini.',
                'date' => '04 Kasım 2026',
                'read_time' => '4 dk okuma',
                'lead' => 'Hareketi yalnızca fiziksel bir pratik değil, beden ve zihin arasında kurulan en güçlü iletişim olarak görüyoruz.',
                'content_col1' => 'Modern yaşamın getirdiği hareketsiz masa başı saatleri, sadece kas gruplarımızı sertleştirmekle kalmıyor; sinir sistemimizi sürekli sempatik alarm modunda tutuyor. Fizyoterapist Betina Tansuğ rehberliğinde oluşturduğumuz günlük pratikler, bedeni zorlayarak tüketmek yerine omurgayı anatomik ekseninde yeniden hizalamayı ve sinir sistemine güven sinyalleri göndermeyi amaçlar.',
                'content_col2' => '4 Haftalık kamplarımızda katılımcılarımızın deneyimlediği en kalıcı değişim, bedeni bir "proje" gibi düzeltmekten çıkıp onu dinlemeyi öğrenmeleridir. Rafine şekersiz glisemik beslenme kılavuzlarımız ve her sabah paylaşılan 15 dakikalık mobilite akışları ile kalıcı, sürdürülebilir ve yargısız bir yaşam ritmi inşa ediyoruz.',
                'image' => 'assets/images/hero-poster.jpg'
            ],
            [
                'id' => 2,
                'badge' => 'GÜNLÜK RUTİN',
                'category_slug' => 'rutin',
                'title' => 'Güne Zinde Başlamak İçin Yatakta Yapılabilecek 5 Dakikalık Mobilite Serisi',
                'excerpt' => 'Alarm çaldığında bedeninize 5 dakika ayırarak sinir sisteminizi parasempatik moddan nazikçe uyandırın. Omurga ve kalça açıcı temel esnemeler.',
                'date' => '28 Ekim 2026',
                'read_time' => '3 dk okuma',
                'lead' => 'Uyanır uyanmaz telefona sarılmak yerine omurganıza 5 dakika ayırarak sinir sisteminize güven verin.',
                'content_col1' => 'Gece boyunca dinlenme modunda kalan omurga diskleri, yerçekimsiz ortamda sıvı emerek genişler. Sabah ilk uyandığınızda ani ve kontrolsüz bükülmeler diskler üzerinde gereksiz baskı oluşturabilir. Bu nedenle güne yumuşak pelvik tiltler, kedi-deve mobilizasyonları ve derin diyafram nefesleriyle başlamak omurgayı günün yüklerine hazırlar.',
                'content_col2' => 'Yataktan kalkmadan önce ayak bileklerinizi dairesel hareketlerle çevirmek ve dizleri göğse çekip hafifçe sağa sola sallamak, lenfatik dolaşımı canlandırır. Bu 5 dakikalık ritüeli 21 gün boyunca uyguladığınızda sabah tutukluklarının tamamen gerilediğini fark edeceksiniz.',
                'image' => 'assets/images/hero-poster.jpg'
            ],
            [
                'id' => 3,
                'badge' => 'BESLENME & YAŞAM',
                'category_slug' => 'beslenme',
                'title' => 'Tatlı Krizlerini Biyolojik Olarak Yönetmek: GLP-1 ve Kan Şekeri Dengesi',
                'excerpt' => 'İrade savaşı vermek yerine hormonları anlamak. Rafine şeker tüketimini sıfırlarken tatlı ihtiyacını fonksiyonel tariflerle karşılama stratejileri.',
                'date' => '19 Ekim 2026',
                'read_time' => '5 dk okuma',
                'lead' => 'Açlıkla veya iradeyle savaşmak zorunda değilsiniz: Biyokimyanızı anlayarak tatlı krizlerini doğal yoldan sıfırlayın.',
                'content_col1' => 'Öğleden sonra aniden gelen karşı konulamaz tatlı istekleri bir "irade zayıflığı" değil, kan şekerinizdeki ani dalgalanmanın biyolojik bir çığlığıdır. Öğlen yemeğinde tüketilen yüksek glisemikli basit karbonhidratlar insülin patlamasına ve ardından gelen ani glikoz düşüşüne neden olur.',
                'content_col2' => 'Fizyobar beslenme protokolünde uyguladığımız sağlıklı yağ (avokado, zeytinyağı, ceviz), temiz protein ve prebiyotik lif kombinasyonları, bağırsaklardan doğal tokluk hormonu olan GLP-1 salgılanmasını uyarır. Böylece açlık hissetmeden hücreleriniz doyar ve rafine şeker ihtiyacı kendiliğinden yok olur.',
                'image' => 'assets/images/hero-poster.jpg'
            ]
        ];

        $idParam = $this->input('id');
        $catParam = $this->input('cat', 'all');
        $isSingle = ($idParam !== null && $idParam !== '');
        $selectedId = (int) ($idParam ?? 1);

        $currentPost = null;
        foreach ($posts as $p) {
            if ($p['id'] === $selectedId) {
                $currentPost = $p;
                break;
            }
        }
        if (!$currentPost) {
            $currentPost = $posts[0];
        }

        $this->render('pages/blog', [
            'metaTitle' => ($isSingle ? e($currentPost['title']) . ' | ' : '') . 'FİZYOBAR Blog',
            'metaDescription' => e($currentPost['excerpt']),
            'posts' => $posts,
            'currentPost' => $currentPost,
            'isSingle' => $isSingle,
            'activeCategory' => (string) $catParam
        ]);
    }
}


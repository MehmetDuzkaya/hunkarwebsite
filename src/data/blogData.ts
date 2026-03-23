import type { BlogPost, BlogCategory } from '../types/blog'

export const blogCategories: BlogCategory[] = [
  {
    id: '1',
    name: 'Baklava Tarihi',
    slug: 'baklava-tarihi',
    description: 'Baklavanın kökeninden günümüze uzanan hikayesi',
  },
  {
    id: '2',
    name: 'Tarifler',
    slug: 'tarifler',
    description: 'Evde baklava ve tatlı tarifleri',
  },
  {
    id: '3',
    name: 'Saklama & Servis',
    slug: 'saklama-servis',
    description: 'Baklavayı doğru saklama ve sunum önerileri',
  },
  {
    id: '4',
    name: 'Haberler',
    slug: 'haberler',
    description: 'Şirketimizden ve sektörden haberler',
  },
]

export const blogPosts: BlogPost[] = [
  {
    id: '1',
    title: 'Baklavanın 2500 Yıllık Tarihi: Asur İmparatorluğu\'ndan Osmanlı Saraylarına',
    slug: 'baklavanin-tarihi',
    excerpt: 'Baklava, dünya mutfak tarihinin en eski ve köklü tatlılarından biri. Peki bu eşsiz lezzet nasıl ortaya çıktı?',
    content: `
# Baklavanın Kökleri

Baklavanın tarihi, tam olarak MÖ 8. yüzyıla, Asur İmparatorluğu'na kadar uzanıyor. O dönemde yufka hamuru arasına fındık ve bal konularak yapılan benzer bir tatlının varlığı biliniyor.

## Osmanlı Dönemi ve Topkapı Sarayı

Ancak baklavanın bugünkü şeklini alması Osmanlı mutfağında gerçekleşti. Özellikle Topkapı Sarayı mutfaklarında saray aşçıları tarafından geliştirilen baklava, özel günlerde padişaha sunulan değerli bir tatlıydı.

### Baklava Alayı

Osmanlı'da her yıl Ramazan'ın 15. gününde saraya yapılan "Baklava Alayı" meşhurdur. Yeniçeriler, kendilerine ikram edilen baklavayı bu gün alırlardı.

## Modern Baklava

Günümüzde baklava, Gaziantep ve çevresinde zirveye ulaşmış, UNESCO Somut Olmayan Kültürel Miras Listesi'ne girmiştir. Her bölgenin kendine özgü baklava çeşitleri gelişmiştir.

**Kaynaklar:**
- Türk Mutfak Kültürü Tarihi, Prof. Dr. Turgut Kut
- Osmanlı Saray Mutfağı, Müge Göle
    `,
    category: 'Baklava Tarihi',
    author: 'Ahmet Hünkar',
    date: '2025-12-01',
    readTime: '5 dakika',
    image: 'https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800',
    tags: ['tarih', 'osmanlı', 'kültür'],
  },
  {
    id: '2',
    title: 'Evde Baklava Nasıl Yapılır? Profesyonel Ustalardan İpuçları',
    slug: 'evde-baklava-yapimi',
    excerpt: '25 yıllık tecrübeli ustalarımızdan öğrendiğimiz sırlarla evde mükemmel baklava yapmanın püf noktaları.',
    content: `
# Evde Baklava Yapımı

Baklava yapmak sabır ve özen isteyen bir sanattır. İşte ustalarımızdan öğrendiğimiz en önemli püf noktalar:

## Malzemeler

**Hamur İçin:**
- 500g un
- 1 yumurta
- 1 çay bardağı süt
- 1 çay bardağı sıvı yağ
- 1 tatlı kaşığı tuz
- Nişasta (serpmek için)

**İç Malzeme:**
- 400g çekilmiş Antep fıstığı veya ceviz
- 2 yemek kaşığı toz şeker (isteğe bağlı)

**Şerbet İçin:**
- 4 su bardağı şeker
- 5 su bardağı su
- Yarım limon suyu

## Yapılışı

### 1. Hamur Hazırlığı
Un, yumurta, süt, sıvı yağ ve tuzu karıştırıp kulak memesi kıvamında hamur yoğurun. 30 dakika dinlendirin.

### 2. Yufka Açma
Hamuru bezelye büyüklüğünde parçalara bölün. Her parçayı merdane ile ince açın, nişasta serpip üst üste koyun.

### 3. Dizilim
- Tepsiye yağ sürün
- İlk 4-5 yufkayı tepsiye serin (her katı yağlayın)
- Fıstık/ceviz serpin
- 2 yufka daha ekleyin
- Tekrar fıstık serpin
- Son 4-5 yufka ile kapatın

### 4. Kesim ve Pişirme
Keskin bir bıçakla istediğiniz şekilde kesin. 180°C fırında 45-50 dakika pişirin (üzeri kızarana kadar).

### 5. Şerbet Dökme
**ÖNEMLİ:** Sıcak baklava üzerine soğuk şerbet veya soğuk baklava üzerine sıcak şerbet dökün. İkisi de sıcak olursa baklava şerbeti çekmez!

## Uzman Tavsiyeleri

- Yufkalar çok ince açılmalı (neredeyse saydam)
- Ara katları mutlaka yağlayın
- Kesim işlemini pişirmeden önce yapın
- Şerbet oranını abartmayın (yumuşak doku istiyorsanız daha fazla)
- İlk gün bekletip ertesi gün yiyin (şerbeti çekmesi için)
    `,
    category: 'Tarifler',
    author: 'Ayşe Güler',
    date: '2025-12-10',
    readTime: '8 dakika',
    image: 'https://images.unsplash.com/photo-1598110750624-207050c4f28c?w=800',
    tags: ['tarif', 'evde baklava', 'yapım'],
  },
  {
    id: '3',
    title: 'Baklava Nasıl Saklanır? Taze Kalması İçin 7 Altın Kural',
    slug: 'baklava-saklama',
    excerpt: 'Baklavanın tazeliğini ve lezzetini korumak için bilmeniz gereken profesyonel saklama yöntemleri.',
    content: `
# Baklavayı Doğru Saklama Yöntemleri

Baklava, doğru saklanmadığında hızla tazeliğini ve gevrekliğini kaybeder. İşte bilmeniz gereken kurallar:

## 7 Altın Kural

### 1. Oda Sıcaklığında Saklayın
Baklava **mutlaka** oda sıcaklığında saklanmalı. Buzdolabında sertleşir ve tadını kaybeder.

### 2. Hava Almayan Kap Kullanın
Baklava nemden çok çabuk etkilenir. Hava geçirmeyen cam veya plastik kapta muhafaza edin.

### 3. Kuru ve Serin Ortam
25°C'nin altında, doğrudan güneş almayan, nem oranı düşük bir yerde saklayın.

### 4. Tülbent Örtü Kullanımı
Geleneksel yöntem: Baklavanın üzerine temiz bir tülbent örtün, sonra kapağı kapatın. Bu fazla nemi emer.

### 5. Üst Üste Dizmeyin
Baklavalar ezilmesin diye üst üste yığmayın. Yan yana dizin.

### 6. 3-5 Gün İçinde Tüketin
Evde saklama koşullarında baklava 3-5 gün tazeliğini korur. Daha uzun süre bekletmeyin.

### 7. Dondurma (Acil Durumlarda)
Eğer uzun süre saklamanız gerekiyorsa:
- Hava almayacak şekilde streç film ile sarın
- Vakumlu torbalara koyun
- -18°C'de 2 aya kadar saklayabilirsiniz
- Çözerken oda sıcaklığında bekletin, mikrodalga kullanmayın

## Yaygın Hatalar

❌ **Buzdolabına koymak:** En büyük hata!
❌ **Açık bırakmak:** Kurur ve sertleşir
❌ **Nem alan yerde saklamak:** Yumuşar ve bozulur
❌ **Plastik poşette saklamak:** Hava alması gerekir ama çok da almamalı

## Profesyonel İpucu

Pastanelerde baklava, özel baklavlıklarda kağıt havlu arasında saklanır. Evde de benzer yöntemi uygulayabilirsiniz: Her katın arasına bir kağıt havlu koyun.
    `,
    category: 'Saklama & Servis',
    author: 'Mehmet Öz',
    date: '2025-12-12',
    readTime: '4 dakika',
    image: 'https://images.unsplash.com/photo-1576618148400-f54bed99fcfd?w=800',
    tags: ['saklama', 'tazelik', 'ipuçları'],
  },
  {
    id: '4',
    title: 'Hünkar Baklava 5. Şubesini Kadıköy\'de Açtı!',
    slug: 'kadikoy-sube-acilis',
    excerpt: 'Geleneksel lezzetin yeni durağı Kadıköy! 5. şubemiz açıldı, sizleri bekliyoruz.',
    content: `
# Kadıköy'de Hizmetinizdeyiz!

25 yıllık baklava ustası geleneğimizi Kadıköy'e taşımanın mutluluğunu yaşıyoruz. 

## Açılış Kampanyası

**15 Aralık - 31 Aralık tarihleri arasında:**
- Tüm baklava çeşitlerinde %20 indirim
- 1 kg ve üzeri alışverişlerde ücretsiz teslimat
- İlk 100 müşteriye özel sürpriz hediye

## Şube Bilgileri

**Adres:** Kadıköy Moda Caddesi No: 123  
**Telefon:** +90 216 555 12 34  
**Çalışma Saatleri:** 08:00 - 22:00 (Her gün)

Sizleri yeni şubemizde ağırlamaktan mutluluk duyarız!
    `,
    category: 'Haberler',
    author: 'Hünkar Baklava',
    date: '2025-12-15',
    readTime: '2 dakika',
    image: 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800',
    tags: ['açılış', 'kampanya', 'kadıköy'],
  },
  {
    id: '5',
    title: 'Antep Fıstığı mı, Ceviz mi? Baklava Seçiminde İlk Adım',
    slug: 'antep-fistigi-vs-ceviz',
    excerpt: 'Baklava alırken fıstık mı ceviz mi tercihi yapmalısınız? İşte detaylı karşılaştırma.',
    content: `
# Fıstık mı, Ceviz mi?

Baklava seçerken en önemli karar: İç malzeme. İşte iki seçeneğin detaylı karşılaştırması:

## Antep Fıstığı

### Avantajları
- Daha yoğun ve zengin aroma
- Prestijli ve özel hissettirir
- Omega-3 ve protein açısından zengin
- Hediye için ideal

### Özellikleri
- Daha yüksek fiyat
- İnce, zarif tat
- Yeşilimsi renk

## Ceviz

### Avantajları
- Ekonomik
- Omega-3 deposu
- Daha yumuşak doku
- Günlük tüketim için uygun

### Özellikleri
- Hafif acımsı tat (bazıları için)
- Koyu renk
- Daha doyurucu

## Hangisini Seçmeliyim?

**Hediye için:** Fıstıklı baklava  
**Kendiniz için:** Her ikisi de harika, damak zevkinize bağlı  
**Çocuklar için:** Fıstıklı (daha tatlı ve yumuşak)  
**Ekonomik:** Cevizli  

## Uzman Önerisi

İlk kez deneyecekseniz **karışık** (hem fıstık hem ceviz) alın, hangisini daha çok sevdiğinizi keşfedin!
    `,
    category: 'Baklava Tarihi',
    author: 'Zeynep Kaya',
    date: '2025-12-08',
    readTime: '3 dakika',
    image: 'https://images.unsplash.com/photo-1607920591413-4ec007e70023?w=800',
    tags: ['fıstık', 'ceviz', 'karşılaştırma'],
  },
  {
    id: '6',
    title: 'Ramazan Pidesi ve Baklava: İftarın Vazgeçilmez İkilisi',
    slug: 'iftar-baklavasi',
    excerpt: 'Ramazan aylarında baklava geleneği ve iftar sofralarındaki yeri.',
    content: `
# İftar Sofralarının Yıldızı: Baklava

Ramazan ayında baklava, iftar sofralarının vazgeçilmez tatlısıdır. 

## Ramazan Geleneği

Osmanlı döneminden beri Ramazan aylarında baklava özel önem taşır. Topkapı Sarayı'nda düzenlenen "Baklava Alayı" bu geleneğin en güzel örneğidir.

## İftar İçin Öneriler

### Hafif Şerbetli Tercih Edin
Oruçtan sonra ağır tatlılar mideyi zorlar. Hafif şerbetli baklava seçeneklerimizi deneyin:
- Havuç Dilimi
- Fıstık Sarma
- İnce Kol Baklava

### Porsiyonlara Dikkat
İftarda 1-2 dilim yeterlidir. Fazla tüketim rahatsızlık verebilir.

### Sütlü Tatlılarla Değişim
Her gün baklava yerine sütlü tatlılarla (künefe, güllaç, sütlaç) değişim yapın.

## Ramazan Kampanyamız

Bu Ramazan ayında:
- İftar saatlerinde özel fiyatlar
- Toplu sipariş indirimleri
- Ücretsiz teslimat (belirli bölgelerde)

Sizleri iftar sofralarınızda ağırlamaktan mutluluk duyarız!
    `,
    category: 'Haberler',
    author: 'Hünkar Baklava',
    date: '2025-12-05',
    readTime: '3 dakika',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800',
    tags: ['ramazan', 'iftar', 'gelenek'],
  },
  {
    id: '7',
    title: 'Evde Börek Yapımı: Peynir, Kıyma ve Patates Böreği Tarifleri',
    slug: 'evde-borek-yapimi',
    excerpt: 'Mahalleli börek, peynir böreği, kıymalı börek - evde yapabileceğiniz lezzetli börek tarifleri.',
    content: `
# Evde Börek Nasıl Yapılır?

Börek, Türk mutfağının en sevilen ve yapılması kolay tatlı olmayan İstanbul tatlısıdır. İşte üç farklı börek tarifi:

## 1. Peynir Böreği (Sigara Böreği)

### Malzemeler
- 250g yufka
- 300g beyaz peynir (kırılmış)
- 1 demet maydanoz (ince doğranmış)
- 2 yumurta sarısı
- Çay kaşığı kara biber
- Sıvı yağ (kızartmak için)

### Yapılışı

1. **Harcı Hazırlayın:** Peyniri mikserde kırın, maydanoz ve kara biberi ekleyin
2. **Yufka Kesimi:** Yufkayı enine bölün (5-6 cm genişliğinde şeritler)
3. **Dolgu:** Her şerit yufkanın bir ucuna 1 yemek kaşığı harcı koyun
4. **Katlama:** Yanları katladıktan sonra sigara şeklinde sarın
5. **Kızartma:** 180°C yağda kızarın, her tarafı sarı olana kadar

⏱️ **Hazırlama süresi:** 20 dakika | **Pişirme süresi:** 15 dakika

## 2. Kıymalı Börek

### Malzemeler
- 250g yufka
- 300g kıymıt kıyma
- 1 orta soğan (ince doğranmış)
- 2 diş sarımsak (ince doğranmış)
- 1 tatlı kaşığı tuz
- Çay kaşığı kara biber
- Çay kaşığı sumak
- 2 yemek kaşığı sıvı yağ

### Yapılışı

1. **Kıymayı Pişirin:** Sıvı yağda soğan ve sarımsağı kızartın, kıymayı ekleyin ve pişirin (8-10 dakika)
2. **Mevsimle:** Tuz, kara biber ve sumak ekleyin, soğumaya bırakın
3. **Yufka Hazırlama:** 2 yufkayı fırın tepsiine serin (yağlayın)
4. **Dolgu:** Kıymanın yarısını dağıtın, 2 yufka daha serin, kalan kıymayı dağıtın
5. **Üzeri:** Son 2 yufka ile kapatın, yağlayın ve kesim yapın
6. **Pişirme:** 180°C'de 35-40 dakika pişirin

⏱️ **Hazırlama süresi:** 25 dakika | **Pişirme süresi:** 40 dakika

## 3. Patates Böreği

### Malzemeler
- 250g yufka
- 600g patates (haşlanıp ezilmiş)
- 1 soğan (ince doğranmış)
- 100g beyaz peynir (toz)
- 1 demet maydanoz
- 2 yumurta sarısı
- 1 yemek kaşığı tereyağ
- Tuz ve kara biber

### Yapılışı

1. **Karışım Hazırlayın:** Tereyağda soğanı kızartın, patateslere ekleyin
2. **Malzeme Ekleme:** Peynir, maydanoz, tuz ve kara biberi karıştırın
3. **Tespiye:** Yufkalarla aynı şekilde peynir böreğinde olduğu gibi işleyin
4. **Üzeri:** Yumurta sarısı sürün
5. **Pişirme:** 180°C'de 35 dakika

⏱️ **Hazırlama süresi:** 20 dakika | **Pişirme süresi:** 35 dakika

## Profesyonel İpuçları

✅ Yufkaları kuru değil, hafif nemli tutun (çevre)
✅ Dolguyu fazla koymayın, kaymakları zorlaşır
✅ Her katman yağlayın (kısır kalmaması için)
✅ Kesim işlemini pişirmeden önce yapın (çıtlak çıkmaması için)
✅ Kızartan börekler sıcak yenmeli
✅ Fırında pişirilen börekler soğuduktan sonra kesilerek yenebilir

## Dondurma İpucu

Çiğ böreği alüminyum folya ya da vakumlu torbada dondurmaya koyabilirsiniz. Direkt fırına atıp 50 dakika pişirin!
    `,
    category: 'Tarifler',
    author: 'Fatma Yılmaz',
    date: '2025-12-14',
    readTime: '7 dakika',
    image: 'https://images.unsplash.com/photo-1585518419775-ce1ed3b3e4b5?w=800',
    tags: ['börek', 'tarif', 'peynir', 'kıyma', 'patates'],
  },
  {
    id: '8',
    title: 'Gaziantep Baklavası Neden Ünlüdür? UNESCO Somut Kültür Mirası',
    slug: 'gaziantep-baklava-unesco',
    excerpt: 'Gaziantep baklavası neden dünyaca ünlü? UNESCO Somut Olmayan Kültür Mirası unvanı nasıl aldı?',
    content: `
# Gaziantep Baklavası: Dünya Mirasının Tadı

Gaziantep baklavası, sadece bir tatlı değildir. Bir medeniyetin, bir kültürün, bir çağ boyu geleneğin simgesidir.

## UNESCO Somut Olmayan Kültürel Miras

2021 yılında Gaziantep baklavası, UNESCO'nun Somut Olmayan Kültürel Miras Temsili Listesi'ne girmiştir. Bu, dünya tarafından baklavanın ne kadar kıymetli olduğunun kanıtıdır.

### Neden Gaziantep?

**1. Usta-Çırak Geleneği**
Gaziantep'te baklava yapımı, 400 yılı aşkın bir süredir nesilden nesile aktarılan bir sanattır. Her usta, çıraklarına sadece tekniği değil, felsefesini de öğretir.

**2. Antep Fıstığı**
Gaziantep Antep fıstığı, dünyanın en iyi fıstığıdır. Tatlı, aromalı ve sorunsuz. Bu fıstığın olmadığı gerçek baklava olmaz.

**3. Kalite İlkesi**
Gaziantep'te 200'den fazla baklava ustası vardır. Hepsi de gıda hijyeni ve kalite konusunda çok titizdir.

**4. Sanatsal Değer**
Her baklava bir sanat eseridir. Kesim, şekillendirme, sunum - her şey planlıdır ve profesyoneldir.

## Gaziantep Baklavası Hakkında Bilgiler

### En Ünlü Çeşitleri
- **Fıstıklı Kare:** En prestijli, en pahalı
- **Kol Baklava:** En zarif
- **Sarıklı Baklava:** Saçak gibi kesilmiş
- **Fındıklı Baklava:** Daha az bilinen ama çok lezzetli

### Sosyal İşlevi
Gaziantep'te baklava:
- Düğünlerde yapılır (gelin, damat için)
- Dini günlerde ikram edilir
- Konuklarla paylaşılır
- Hastalara vizite yatırı olarak götürülür

## Gaziantep Baklava Festivalı

Her yıl Haziran ayında Gaziantep'te "Uluslararası Baklava Festivali" yapılır. Dünyanın her yerinden baklava sevenler bir araya gelir.

### İstatistikler
- 200+ fırında üretilir
- Yıllık 10 ton Antep fıstığı kullanılır
- 50+ ülkeye ihraç edilir
- Günlük 50 ton baklava üretilir

## Hünkar Baklava ile Gaziantep Geleneği

Biz de, 25 yıldır Gaziantep'in geleneklerini takip ederek baklava yapıyoruz. Her ürünümüzde:
- Samimi Gaziantep Antep fıstığı
- 25 yıllık ustanın tecrübesi
- Kalite güvencesi
- Geleneksel üretim yöntemi

Sizinle bu mirasın tadını paylaşmaktan gurur duyuyoruz!
    `,
    category: 'Baklava Tarihi',
    author: 'İbrahim Hünkar',
    date: '2025-12-13',
    readTime: '5 dakika',
    image: 'https://images.unsplash.com/photo-1599599810694-b5ac4dd64f4d?w=800',
    tags: ['gaziantep', 'unesco', 'tarih', 'kültür', 'antep fıstığı'],
  },
  {
    id: '9',
    title: 'Baklava Pişirme Sıcaklığı ve Süresi: Mükemmel Baklava Formülü',
    slug: 'baklava-firinda-pislok',
    excerpt: 'Mükemmel baklava için doğru fırın sıcaklığı, pişirme süresi ve profesyonel sırları.',
    content: `
# Baklava Pişirmede En Kritik Detaylar

Baklava yapımında malzeme kalitesi kadar önemli olan diğer bir faktör pişirmedir. İşte profesyonel ustanın sırları:

## Fırın Sıcaklığı Kılavuzu

### Başlangıç Sıcaklığı: 220°C

İlk 15 dakikada yüksek sıcaklıkta pişirme gerekçesi:
- Yufkalar hızla kalpsiz olur
- Gevrek doku oluşur
- Çevrenin altında pişmemesi engellenir

### Ara Sıcaklığı: 190°C

15. dakikadan sonra ısıyı düşürün. Nedeni:
- Üst tabakalar yanmamış
- İç kısımlar eşit pişer
- Renk homojen kalır

### Son Dönem: 180°C

Son 10-15 dakikada hafif düşürün. Amacı:
- Altını körletmek (aşırı kızarmamak)
- Üst katmanları dengelemek
- İç pişmesi tamamlamak

## Toplam Pişirme Süresi: 45-50 Dakika

**Aşama 1 (0-15 dk):** 220°C  
**Aşama 2 (15-30 dk):** 190°C  
**Aşama 3 (30-45 dk):** 180°C  
**Son Kontrol (45-50 dk):** 175°C

## Vizüel Belirtiler

Saat yerine gözünüze güvenin:

✅ **Başlangıç:** Yufkalar hafif kızarır, görülmeye başlar  
✅ **Orta:** Renk kütlesiz olarak dağılır  
✅ **Son:** Üst tabakalar altın sarısı (koyu değil) ve içinde biraz beyazlık olmalı  
❌ Çok koyuya çevirme - acı tat oluşur  
❌ Açık bırakma - gevrek olmaz, elastik kalır

## Profesyonel Kontrol Yöntemi

### Titreşim Testi
Son 5 dakikada tepsiye hafif vurun. İyi pişmiş baklava biraz titrer ama kaymakları yapışmaz.

### Renklenme Testi
Çöpten bir parça alıp gözle kontrol edin. Açık altın sarısı ideal. Koyu sarı veya kahveci oluyorsa çıkarın.

### Sıcaklık Testi
Tepsinin altına termometre koyun. Üst kısım 200°C'nin üstünde, alt kısım 180°C civarında olmalı.

## Fırın Tipi Farkları

### Elektrikli Fırın
- Daha sabit sıcaklık
- Tavsiye edilen sıcaklık + 10°C az yapın

### Gazlı Fırın
- Daha hızlı ısınır
- Tavsiye edilen sıcaklıktan + 5°C az yapın

### Konveksiyonlu Fırın
- Havası sirkülasyon sağlar
- 25°C daha az sıcaklıkta yapın
- Pişme süresi 10-15 dakika az

## Ortam Koşulları

**Nemli Hava:** Pişme süresini 5 dakika artırın  
**Yüksek Yükseklik:** Sıcaklığı 25°C artırın  
**Çok Soğuk Ortam:** Başlama sıcaklığını 200°C tutun

## Yaygın Hatalar

❌ **Çok Sıcak:** Baklava dışında yanır, içinde pişmez  
❌ **Çok Soğuk:** Gevrek olmaz, yapışkan kalır  
❌ **Sabit Sıcaklık:** Altı okunmadığı halde üst yanmış olur  
❌ **Kısmi Pişirme:** Tabağın ortası iyi, kenarları az pişmiş  

## Uzman İpucu

En iyi baklava, pişi tamamlandıktan 2-3 saat sonra şerbet konulan baklavadır. Bu şekilde yufkalar kendilerine çeker ve maksimum koku katmanı oluşturur!
    `,
    category: 'Tarifler',
    author: 'Murat Demir',
    date: '2025-12-12',
    readTime: '6 dakika',
    image: 'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?w=800',
    tags: ['tarif', 'fırın', 'sıcaklık', 'pişirme', 'baklava'],
  },
  {
    id: '10',
    title: 'Şerbet Karışımı: Konsantrasyonu, Oranı ve Şerbeti Soğuk tutma Sırları',
    slug: 'baklava-serbet-teknigi',
    excerpt: 'Mükemmel şerbet nasıl yapılır? Şerbeti soğuk tutma sırrı nedir? Tüm detaylar burada.',
    content: `
# Şerbet Sanatı: Baklavaların Ruhu

Baklava yapımında malzeme ve pişirme kadar önemli olan bir diğer işlem şerbettir. Şerbet olmadan baklava sadece kurumuş yufkadır.

## Şerbet Malzemeleri

### Temel Reçete (1 kg Baklava için)

**Malzeler:**
- 4 su bardağı tatlı su (1 L)
- 4 su bardağı toz şeker (800g)
- Yarım limon suyu (sirke yerine kullanılır)
- 1 çay kaşığı tarçın (isteğe bağlı)
- 5-6 çörek otu tohumu (isteğe bağlı, ot balığında)

### Oranlar Tablosu

| Baklava Miktarı | Su | Şeker | Limon Suyu |
|---|---|---|---|
| 250g | 1 bardak | 1 bardak | 2 yemek kaşığı |
| 500g | 2 bardak | 2 bardak | 4 yemek kaşığı |
| 1 kg | 4 bardak | 4 bardak | Yarım limon |
| 2 kg | 8 bardak | 8 bardak | 1 limon |

## Şerbet Yapma Teknikleri

### Yöntem 1: Klasik Usul (Soğuk Şerbet Metodu)

**Adımlar:**
1. Su ve şekeri tencereye koyun, kaynatın
2. Şeker tamamen erişince ateşi kısın
3. 5 dakika daha kuru koyun (şerbeti hafif koyulaştırır)
4. Limon suyunu ekleyin, karıştırın
5. **Önemli:** Tencereyi buzdolabına koyup tamamen soğumaya bırakın

**Pişirme Süresi:** 10 dakika  
**Soğutma Süresi:** En az 1 saat

### Yöntem 2: Koyu Şerbet (Daha Fazla Tatlandırma İçin)

Şekeri 25% daha artırın. Bazı bölgelerde (özellikle Gaziantep'te) bu yöntemi tercih ederler.

### Yöntem 3: Hafif Şerbet (Diyetisyenlerin Tercihi)

Şekeri 25% azaltın. Limon suyunu 2 katına çıkarın. Daha hafif, taze bir tat alırsınız.

## Şerbeti Soğuk Tutmanın Sırları

### Saklama Kapları

✅ **Cam Tencereler:** Isıyı çabuk kaybedenler, şerbeti en iyi tutarlar  
✅ **Çelik Tepsiler:** Diyeti kolay yapılır, soğuk kalır  
❌ **Plastik Kaplar:** Isıyı tutar, şerbet ılınır

### Soğuk Hava Depolama

**En İyisi:** Kiler, balkon (kışın)  
**İkinci:** Buzdolabının kapı kısmı (onu az kötü)  
**Dikkat:** Asla freezer'a koymayın (buz oluşur)

### Buz Eklemek

Şerbete 3-4 buz küpü ekleyin, ama:
- Pişirmeden hemen sonra değil
- En son şerbeti dokken
- Buz çabuk erir ve sulandırmaz

## Şerbet ve Baklava Sıcaklığı İlişkisi

### Kural: Zıt Sıcaklıklar!

**Sıcak Baklava + Soğuk Şerbet** ✅ (İdeal)  
- Yufkalar şerbeti çeker ve gevrek kalır
- Tat birleşimleri maksimum olur

**Soğuk Baklava + Sıcak Şerbet** ✅ (Alternatif)  
- Şerbet yufka kat katlara nüfuz eder
- Daha yumuşak, ıslak baklava oluşur

**İkisi de Sıcak** ❌ (Hata!)  
- Şerbet çekmez, üstünde kalır
- Gevrek olmaz, yapışkan olur

**İkisi de Soğuk** ❌ (Hata!)  
- Şerbet katı hale gelir (kristal oluşur)
- Baklava havyar gibi açılır, kur kalır

## Şerbet Tat Uyumları

### Geleneksel Tarif (En Popüler)
- Sade şerbet
- Hafif tarçın aroması
- Limon ile hafif asitllik

### Kokucu Şerbet (Bayramlık)
- Çörek otu ve gül suyu
- Daha sofistike
- Özel günler için

### Portakal Şerbeti (Yaz Seçeneği)
- Limon yerine portakal suyu kullanın
- Daha tatlı, daha hafif
- Soğuk bayram için uygun

## Profesyonel İpuçları

✅ Şerbeti yapıdıktan 1 gün önceden hazırlayın  
✅ Bardağa kapatıp asla açık bırakmayın  
✅ Süzgeçten geçirerek temiz tutun (kristal oluşmasını engeller)  
✅ Kokucu şerbetler yazında daha hızlı bozulur  
✅ Konserve edecekseniz kaynatıp ılındıktan sonra depoya koyun

## Hızlı Şerbet Yapma (Acil Durum)

Zamanınız yoksa:
1. 1 bardak şeker + 1 bardak su + limon suyu
2. Çok kısık ateşte 3 dakika kaynatın
3. Tencereyi buz dolu bir kasının içine koyun (hızlı soğutsun)
4. 20 dakika bekleyin, kullanmaya hazır

⏱️ **Toplam Süre:** 30 dakika (geleneksel 1.5 saate karşılık)
    `,
    category: 'Tarifler',
    author: 'Ayşe Demir',
    date: '2025-12-11',
    readTime: '7 dakika',
    image: 'https://images.unsplash.com/photo-1615485276934-a24d4af4c4f9?w=800',
    tags: ['şerbet', 'tarif', 'teknik', 'baklava', 'profesyonel'],
  },
]

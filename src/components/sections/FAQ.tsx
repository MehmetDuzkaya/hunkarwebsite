import { useState } from 'react'

interface FAQItem {
  question: string
  answer: string
  category: string
}

const faqData: FAQItem[] = [
  {
    category: 'Sipariş & Teslimat',
    question: 'Online sipariş verebilir miyim?',
    answer: 'Evet, WhatsApp üzerinden veya telefonla bize ulaşarak sipariş verebilirsiniz. Yakında online sipariş sistemimiz aktif olacak.',
  },
  {
    category: 'Sipariş & Teslimat',
    question: 'Teslimat ücreti ne kadar?',
    answer: 'Teslimat ücreti bulunduğunuz bölgeye göre değişmektedir. Sipariş verirken size bilgi verilecektir. Belirli bir tutarın üzerindeki siparişlerde teslimat ücretsizdir.',
  },
  {
    category: 'Sipariş & Teslimat',
    question: 'Sipariş ne kadar sürede gelir?',
    answer: 'Normal teslimat süremiz 1-2 saattir. Yoğun saatlerde bu süre 3 saate kadar çıkabilir. Acil siparişleriniz için lütfen bizimle iletişime geçin.',
  },
  {
    category: 'Ürünler',
    question: 'Baklavalarınız günlük üretim mi?',
    answer: 'Evet, tüm ürünlerimiz günlük taze olarak üretilmektedir. Bayat veya dondurulmuş ürün kullanmıyoruz.',
  },
  {
    category: 'Ürünler',
    question: 'Fıstık ve ceviz kalitesi nasıl?',
    answer: 'Sadece Antep fıstığı ve birinci sınıf ceviz kullanıyoruz. Ürünlerimizde katkı maddesi bulunmamaktadır.',
  },
  {
    category: 'Ürünler',
    question: 'Hangi baklava çeşitleriniz var?',
    answer: 'Fıstıklı kare baklava, havuç dilimi, burma, sarma, şöbiyet, kol baklava, cevizli baklava ve daha birçok çeşidimiz mevcuttur. Detaylar için Ürünlerimiz sayfasını ziyaret edebilirsiniz.',
  },
  {
    category: 'Saklama',
    question: 'Baklavalar nasıl saklanmalı?',
    answer: 'Baklavalarımız oda sıcaklığında, kuru ve serin bir ortamda 3-5 gün saklanabilir. Buzdolabına koymanız önerilmez çünkü nem alarak sertleşir.',
  },
  {
    category: 'Saklama',
    question: 'Baklava dondurucu dolabında saklanır mı?',
    answer: 'Tavsiye etmiyoruz. Ancak zorunlu hallerde hava almayacak şekilde ambalajlayıp dondurabilir, çözülünce tüketebilirsiniz. Ancak taze hali kadar lezzetli olmayacaktır.',
  },
  {
    category: 'Ödeme',
    question: 'Hangi ödeme yöntemlerini kabul ediyorsunuz?',
    answer: 'Nakit, kredi kartı ve havale ile ödeme alıyoruz. Kapıda ödeme de mümkündür.',
  },
  {
    category: 'Ödeme',
    question: 'Fatura kesilir mi?',
    answer: 'Evet, talep etmeniz halinde tüm siparişleriniz için fatura kesilmektedir.',
  },
  {
    category: 'Hediye',
    question: 'Kurumsal hediye paketleriniz var mı?',
    answer: 'Evet, özel günler ve kurumsal etkinlikler için özel hediye paketlerimiz mevcuttur. Detaylı bilgi için bizimle iletişime geçebilirsiniz.',
  },
  {
    category: 'Hediye',
    question: 'Şehir dışına gönderim yapıyor musunuz?',
    answer: 'Evet, kargo ile Türkiye\'nin her yerine gönderim yapıyoruz. Özel ambalaj ile ürünlerimiz tazeliğini koruyarak size ulaşır.',
  },
]

export function FAQ() {
  const [openIndex, setOpenIndex] = useState<number | null>(null)
  const [activeCategory, setActiveCategory] = useState<string>('Tümü')

  const categories = ['Tümü', ...Array.from(new Set(faqData.map(item => item.category)))]

  const filteredFAQ = activeCategory === 'Tümü' 
    ? faqData 
    : faqData.filter(item => item.category === activeCategory)

  const toggleFAQ = (index: number) => {
    setOpenIndex(openIndex === index ? null : index)
  }

  return (
    <section className="py-20 bg-gradient-to-b from-white to-pistachio/10">
      <div className="container mx-auto px-4 max-w-4xl">
        {/* Header */}
        <div className="text-center mb-12 animate-fadeIn">
          <h2 className="heading-font text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            Sıkça Sorulan Sorular
          </h2>
          <div className="w-24 h-1 bg-gradient-to-r from-gold to-pistachio mx-auto mb-6"></div>
          <p className="text-gray-600 text-lg max-w-2xl mx-auto">
            Aklınıza takılan sorular mı var? İşte en çok merak edilen konular...
          </p>
        </div>

        {/* Category Filter */}
        <div className="flex flex-wrap justify-center gap-3 mb-10">
          {categories.map((category) => (
            <button
              key={category}
              onClick={() => setActiveCategory(category)}
              className={`px-6 py-2 rounded-full font-medium transition-all duration-300 ${
                activeCategory === category
                  ? 'bg-gradient-to-r from-gold to-pistachio text-white shadow-lg scale-105'
                  : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200'
              }`}
            >
              {category}
            </button>
          ))}
        </div>

        {/* FAQ Items */}
        <div className="space-y-4">
          {filteredFAQ.map((item, index) => (
            <div
              key={index}
              className="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden animate-slideUp"
              style={{ animationDelay: `${index * 0.1}s` }}
            >
              <button
                onClick={() => toggleFAQ(index)}
                className="w-full px-6 py-5 flex items-center justify-between text-left hover:bg-gray-50 transition-colors"
              >
                <div className="flex-1 pr-4">
                  <span className="text-xs font-semibold text-gold uppercase tracking-wide mb-1 block">
                    {item.category}
                  </span>
                  <h3 className="font-semibold text-gray-800 text-lg">
                    {item.question}
                  </h3>
                </div>
                <div
                  className={`flex-shrink-0 w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center transition-transform duration-300 ${
                    openIndex === index ? 'rotate-180' : ''
                  }`}
                >
                  <svg
                    className="w-5 h-5 text-gold"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeWidth={2}
                      d="M19 9l-7 7-7-7"
                    />
                  </svg>
                </div>
              </button>
              <div
                className={`overflow-hidden transition-all duration-300 ${
                  openIndex === index ? 'max-h-96' : 'max-h-0'
                }`}
              >
                <div className="px-6 pb-5 pt-2">
                  <p className="text-gray-600 leading-relaxed">{item.answer}</p>
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* Contact CTA */}
        <div className="mt-12 text-center p-8 bg-gradient-to-r from-gold/10 to-pistachio/10 rounded-2xl">
          <h3 className="heading-font text-2xl font-bold text-gray-800 mb-3">
            Sorunuz yanıtlanmadı mı?
          </h3>
          <p className="text-gray-600 mb-5">
            Bizimle iletişime geçin, size yardımcı olmaktan mutluluk duyarız.
          </p>
          <a
            href="/iletisim"
            className="inline-block px-8 py-3 bg-gradient-to-r from-gold to-pistachio text-white font-semibold rounded-full hover:shadow-lg transform hover:scale-105 transition-all duration-300"
          >
            İletişime Geç
          </a>
        </div>
      </div>
    </section>
  )
}

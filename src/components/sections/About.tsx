export function About() {
  return (
    <section id="hakkimizda" className="py-16 bg-gradient-to-b from-white via-gold/5 to-white">
      <div className="container mx-auto px-4 max-w-6xl">
        <div className="text-center mb-12">
          <h2 className="heading-font text-4xl md:text-5xl text-[#264027] mb-4">
            Hakkımızda
          </h2>
          <div className="w-24 h-1 bg-gradient-to-r from-gold to-pistachio mx-auto mb-6"></div>
          <p className="text-lg text-slate-600 max-w-2xl mx-auto">
            Geleneksel Türk tatlı sanatının en seçkin temsilcilerinden
          </p>
        </div>

        <div className="grid md:grid-cols-2 gap-8 items-center mb-12">
          <div className="space-y-6">
            <div className="bg-white rounded-2xl p-8 shadow-lg border border-gold/20">
              <h3 className="heading-font text-2xl text-[#264027] mb-4">🏛️ Hikayemiz</h3>
              <p className="text-slate-700 leading-relaxed">
                Hünkar Baklava olarak, yılların deneyimi ve geleneksel tariflerle
                hazırladığımız baklavalarımızla damak zevkinize hitap ediyoruz.
                Aileden aileye geçen tariflerimiz ve el emeğiyle ürettiğimiz
                ürünlerimizle, her lokmasında kalite ve lezzeti bir arada sunuyoruz.
              </p>
            </div>
            <div className="bg-white rounded-2xl p-8 shadow-lg border border-pistachio/20">
              <h3 className="heading-font text-2xl text-[#264027] mb-4">🌟 Felsefemiz</h3>
              <p className="text-slate-700 leading-relaxed">
                En kaliteli malzemeler, en taze ürünler ve özgün tariflerimizle
                müşterilerimize en iyi tatlı deneyimini yaşatmak önceliğimizdir.
                Her ürünümüz özenle hazırlanır ve tazeliği garanti edilir.
              </p>
            </div>
          </div>

          <div className="space-y-6">
            <div className="bg-gradient-to-br from-gold/10 to-pistachio/10 rounded-2xl p-8 border border-gold/30">
              <h3 className="heading-font text-2xl text-[#264027] mb-6">✨ Neden Biz?</h3>
              <ul className="space-y-4">
                <li className="flex items-start gap-3">
                  <span className="text-2xl">🥜</span>
                  <div>
                    <p className="font-semibold text-[#264027]">Kaliteli Malzemeler</p>
                    <p className="text-sm text-slate-600">Antep fıstığı, tereyağı ve özel şerbetlerimiz</p>
                  </div>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-2xl">👨‍🍳</span>
                  <div>
                    <p className="font-semibold text-[#264027]">Usta Ellerde Üretim</p>
                    <p className="text-sm text-slate-600">Deneyimli ustalarımızın el emeği</p>
                  </div>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-2xl">🎁</span>
                  <div>
                    <p className="font-semibold text-[#264027]">Özel Ambalaj</p>
                    <p className="text-sm text-slate-600">Hediye için uygun zarif kutular</p>
                  </div>
                </li>
                <li className="flex items-start gap-3">
                  <span className="text-2xl">🚚</span>
                  <div>
                    <p className="font-semibold text-[#264027]">Hızlı Teslimat</p>
                    <p className="text-sm text-slate-600">Taze ürünleriniz kapınızda</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
          <div className="bg-white rounded-xl p-6 text-center shadow-md border border-gold/20">
            <div className="text-4xl font-bold text-gold mb-2">25+</div>
            <p className="text-sm text-slate-600">Yıllık Deneyim</p>
          </div>
          <div className="bg-white rounded-xl p-6 text-center shadow-md border border-gold/20">
            <div className="text-4xl font-bold text-pistachio mb-2">50+</div>
            <p className="text-sm text-slate-600">Çeşit Ürün</p>
          </div>
          <div className="bg-white rounded-xl p-6 text-center shadow-md border border-gold/20">
            <div className="text-4xl font-bold text-gold mb-2">5</div>
            <p className="text-sm text-slate-600">Şube</p>
          </div>
          <div className="bg-white rounded-xl p-6 text-center shadow-md border border-gold/20">
            <div className="text-4xl font-bold text-pistachio mb-2">10K+</div>
            <p className="text-sm text-slate-600">Mutlu Müşteri</p>
          </div>
        </div>

        {/* Foto + Yazı kartları (çapraz sol/sağ) */}
        <div className="mt-14 space-y-10">
          {[{
            title: 'Usta Ellerde Üretim',
            desc: 'Her kat yufka elde açılır, baklava hamuru incecik hazırlanır; bakır tepsilerde taş fırında pişirilir.',
            img: 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200&auto=format&fit=crop',
          }, {
            title: 'Günlük Taze Çıkış',
            desc: 'Sabah çıkan sıcak tepsiler gün içinde şubelere ulaştırılır; şerbet dengesi ve tazelik korunur.',
            img: 'https://images.unsplash.com/photo-1467003909585-2f8a72700288?q=80&w=1200&auto=format&fit=crop',
          }, {
            title: 'Özenli Ambalaj',
            desc: 'Hediye kutuları ve dayanıklı paketleme ile ürünleriniz bozulmadan, estetik şekilde teslim edilir.',
            img: 'https://images.unsplash.com/photo-1523978591478-c753949ff840?q=80&w=1200&auto=format&fit=crop',
          }].map((card, idx) => {
            const imageFirst = idx % 2 === 0
            return (
              <div
                key={card.title}
                className="grid md:grid-cols-2 gap-6 items-center animate-slideUp"
              >
                <div className={`${imageFirst ? '' : 'md:order-2'} rounded-2xl overflow-hidden shadow-lg border border-gold/20 bg-gradient-to-br from-gold/10 to-pistachio/10`}>
                  <img
                    src={card.img}
                    alt={card.title}
                    className="w-full h-64 md:h-72 object-cover"
                    loading="lazy"
                  />
                </div>
                <div className={`${imageFirst ? 'md:order-2' : ''} bg-white rounded-2xl p-6 shadow-lg border border-gold/20 space-y-3`}>
                  <h3 className="heading-font text-2xl text-[#264027]">{card.title}</h3>
                  <p className="text-slate-700 leading-relaxed text-sm md:text-base">{card.desc}</p>
                </div>
              </div>
            )
          })}
        </div>
      </div>
    </section>
  )
}

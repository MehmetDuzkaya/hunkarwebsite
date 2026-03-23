export function Contact() {
  return (
    <section id="iletisim" className="py-16 bg-gradient-to-b from-gold/5 via-pistachio/10 to-gold/5">
      <div className="container mx-auto px-4 max-w-6xl">
        <div className="text-center mb-12">
          <h2 className="heading-font text-4xl md:text-5xl text-[#264027] mb-4">
            İletişim
          </h2>
          <div className="w-24 h-1 bg-gradient-to-r from-gold to-pistachio mx-auto mb-6"></div>
          <p className="text-lg text-slate-600 max-w-2xl mx-auto">
            Sorularınız, siparişleriniz veya özel talepileriniz için bizimle iletişime geçin
          </p>
        </div>

        <div className="grid md:grid-cols-2 gap-8">
          {/* İletişim Bilgileri */}
          <div className="space-y-6">
            <div className="bg-white rounded-2xl p-8 shadow-lg border border-gold/20">
              <h3 className="heading-font text-2xl text-[#264027] mb-6">📞 İletişim Bilgileri</h3>
              
              <div className="space-y-5">
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center flex-shrink-0">
                    <span className="text-2xl">📱</span>
                  </div>
                  <div>
                    <p className="font-semibold text-[#264027] mb-1">Telefon</p>
                    <a href="tel:+902121234567" className="text-slate-600 hover:text-gold transition">
                      +90 (212) 123 45 67
                    </a>
                  </div>
                </div>

                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 rounded-full bg-pistachio/10 flex items-center justify-center flex-shrink-0">
                    <span className="text-2xl">📧</span>
                  </div>
                  <div>
                    <p className="font-semibold text-[#264027] mb-1">E-posta</p>
                    <a href="mailto:info@hunkarbaklava.com" className="text-slate-600 hover:text-pistachio transition">
                      info@hunkarbaklava.com
                    </a>
                  </div>
                </div>

                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center flex-shrink-0">
                    <span className="text-2xl">📍</span>
                  </div>
                  <div>
                    <p className="font-semibold text-[#264027] mb-1">Merkez Adres</p>
                    <p className="text-slate-600">
                      Nispetiye Cad. No:45<br />
                      Levent, Beşiktaş / İstanbul
                    </p>
                  </div>
                </div>

                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 rounded-full bg-pistachio/10 flex items-center justify-center flex-shrink-0">
                    <span className="text-2xl">⏰</span>
                  </div>
                  <div>
                    <p className="font-semibold text-[#264027] mb-1">Çalışma Saatleri</p>
                    <p className="text-slate-600">
                      Hafta İçi: 08:00 - 22:00<br />
                      Hafta Sonu: 09:00 - 23:00
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div className="bg-gradient-to-br from-gold/10 to-pistachio/10 rounded-2xl p-8 border border-gold/30">
              <h3 className="heading-font text-xl text-[#264027] mb-4">🌐 Sosyal Medya</h3>
              <div className="flex gap-4">
                <a
                  href="#"
                  className="w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 transition"
                  aria-label="Instagram"
                >
                  <span className="text-2xl">📷</span>
                </a>
                <a
                  href="#"
                  className="w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 transition"
                  aria-label="Facebook"
                >
                  <span className="text-2xl">👍</span>
                </a>
                <a
                  href="#"
                  className="w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 transition"
                  aria-label="Twitter"
                >
                  <span className="text-2xl">🐦</span>
                </a>
                <a
                  href="#"
                  className="w-12 h-12 rounded-full bg-white shadow-md flex items-center justify-center hover:scale-110 transition"
                  aria-label="WhatsApp"
                >
                  <span className="text-2xl">💬</span>
                </a>
              </div>
            </div>
          </div>

          {/* İletişim Formu */}
          <div className="bg-white rounded-2xl p-8 shadow-lg border border-gold/20">
            <h3 className="heading-font text-2xl text-[#264027] mb-6">✉️ Mesaj Gönderin</h3>
            <form className="space-y-5">
              <div>
                <label htmlFor="name" className="block text-sm font-semibold text-[#264027] mb-2">
                  Adınız Soyadınız
                </label>
                <input
                  type="text"
                  id="name"
                  className="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition"
                  placeholder="İsim Soyisim"
                />
              </div>

              <div>
                <label htmlFor="email" className="block text-sm font-semibold text-[#264027] mb-2">
                  E-posta Adresiniz
                </label>
                <input
                  type="email"
                  id="email"
                  className="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition"
                  placeholder="ornek@email.com"
                />
              </div>

              <div>
                <label htmlFor="phone" className="block text-sm font-semibold text-[#264027] mb-2">
                  Telefon Numaranız
                </label>
                <input
                  type="tel"
                  id="phone"
                  className="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition"
                  placeholder="0500 000 00 00"
                />
              </div>

              <div>
                <label htmlFor="message" className="block text-sm font-semibold text-[#264027] mb-2">
                  Mesajınız
                </label>
                <textarea
                  id="message"
                  rows={5}
                  className="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition resize-none"
                  placeholder="Mesajınızı buraya yazın..."
                ></textarea>
              </div>

              <button
                type="submit"
                className="w-full py-3 bg-gradient-to-r from-gold to-pistachio hover:from-gold/90 hover:to-pistachio/90 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300"
              >
                📨 Gönder
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  )
}

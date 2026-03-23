import { Link } from 'react-router-dom'

export function Footer() {
  const currentYear = new Date().getFullYear()

  return (
    <footer className="bg-gradient-to-r from-gold/95 via-gold/90 to-gold/95 text-white mt-16">
      <div className="container mx-auto px-4 max-w-6xl py-12">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
          {/* Brand */}
          <div>
            <h3 className="heading-font text-2xl font-semibold mb-3">Hünkar Baklava</h3>
            <p className="text-white/90 text-sm leading-relaxed">
              Geleneksel Türk tatlı sanatının en seçkin temsilcilerinden, kalite ve lezzet bir arada.
            </p>
          </div>

          {/* Hızlı Linkler */}
          <div>
            <h4 className="font-semibold text-base mb-4 text-white">Hızlı Linkler</h4>
            <ul className="space-y-2 text-sm">
              <li>
                <Link to="/" className="text-white/90 hover:text-white transition">
                  Ana Sayfa
                </Link>
              </li>
              <li>
                <Link to="/hakkimizda" className="text-white/90 hover:text-white transition">
                  Hakkımızda
                </Link>
              </li>
              <li>
                <Link to="/urunler" className="text-white/90 hover:text-white transition">
                  Ürünlerimiz
                </Link>
              </li>
              <li>
                <Link to="/subeler" className="text-white/90 hover:text-white transition">
                  Şubeler
                </Link>
              </li>
            </ul>
          </div>

          {/* İletişim */}
          <div>
            <h4 className="font-semibold text-base mb-4 text-white">İletişim</h4>
            <ul className="space-y-2 text-sm text-white/90">
              <li>📱 +90 (212) 123 45 67</li>
              <li>📧 info@hunkarbaklava.com</li>
              <li>📍 Nispetiye Cad. No:45</li>
              <li>Beşiktaş / İstanbul</li>
            </ul>
          </div>

          {/* Saatler */}
          <div>
            <h4 className="font-semibold text-base mb-4 text-white">Çalışma Saatleri</h4>
            <ul className="space-y-2 text-sm text-white/90">
              <li>Hafta İçi: 08:00 - 22:00</li>
              <li>Cuma: 08:00 - 23:00</li>
              <li>Cumartesi: 09:00 - 23:00</li>
              <li>Pazar: 10:00 - 22:00</li>
            </ul>
          </div>
        </div>

        {/* Sosyal Medya */}
        <div className="border-t border-white/20 pt-8 mb-6 flex justify-center gap-4">
          <a
            href="#"
            className="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition"
            aria-label="Instagram"
            title="Instagram"
          >
            📷
          </a>
          <a
            href="#"
            className="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition"
            aria-label="Facebook"
            title="Facebook"
          >
            👍
          </a>
          <a
            href="#"
            className="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition"
            aria-label="Twitter"
            title="Twitter"
          >
            🐦
          </a>
          <a
            href="#"
            className="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition"
            aria-label="WhatsApp"
            title="WhatsApp"
          >
            💬
          </a>
        </div>

        {/* Copyright */}
        <div className="text-center border-t border-white/20 pt-6 text-sm text-white/90">
          <p>&copy; {currentYear} Hünkar Baklava. Tüm hakları saklıdır.</p>
        </div>
      </div>
    </footer>
  )
}

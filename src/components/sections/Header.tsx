import { Link } from 'react-router-dom'

export function Header() {
  const navItems = [
    { label: 'Hakkımızda', href: '/hakkimizda' },
    { label: 'Ürünlerimiz', href: '/urunler' },
    { label: 'Blog', href: '/blog' },
    { label: 'SSS', href: '/sss' },
    { label: 'Şubeler', href: '/subeler' },
  ]

  return (
    <header className="py-6">
      <div className="container mx-auto px-4 max-w-6xl">
        <div className="relative overflow-hidden rounded-2xl bg-gradient-to-r from-gold/95 via-gold/90 to-gold/95 backdrop-blur-xl shadow-[0_8px_32px_rgba(212,175,55,0.3)] border border-white/20">
          {/* Cam efekti için dekoratif elementler */}
          <div className="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-transparent pointer-events-none"></div>
          <div className="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
          <div className="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
          
          <div className="relative z-10 px-6 md:px-10 py-5 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-8">
            <Link to="/" className="text-center md:text-left">
              <h1 className="heading-font text-3xl md:text-4xl font-semibold text-white drop-shadow-lg">
                Hünkar Baklava
              </h1>
              <p className="text-white/95 text-xs md:text-sm mt-1 font-medium">
                Geleneksel Lezzet · Özgün Tarifler
              </p>
            </Link>
            <nav className="flex-1 w-full md:w-auto">
              <ul className="flex flex-wrap justify-center md:justify-center gap-3 md:gap-6 text-white/90 font-semibold text-sm md:text-base">
                {navItems.map((item) => (
                  <li key={item.href}>
                    <Link
                      to={item.href}
                      className="px-3 py-2 rounded-full hover:bg-white/15 transition-all duration-200">
                      {item.label}
                    </Link>
                  </li>
                ))}
              </ul>
            </nav>
            <div className="flex items-center gap-3">
              <Link
                to="/iletisim"
                className="px-4 py-2 rounded-full bg-white/15 hover:bg-white/25 text-white font-semibold text-sm md:text-base shadow-lg border border-white/20 transition-all duration-200"
              >
                İletişim
              </Link>
            </div>
          </div>
        </div>
      </div>
    </header>
  )
}

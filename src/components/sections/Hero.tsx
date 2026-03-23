import { heroLogos } from '../../data'

interface HeroProps {
  onProductsClick: () => void
}

export function Hero({ onProductsClick }: HeroProps) {
  return (
    <section className="py-12 bg-gradient-to-b from-white to-pistachio/5">
      <div className="container mx-auto px-4">
        <div className="relative max-w-4xl mx-auto">
          {/* Sol dönen logo */}
          <div className="pointer-events-none absolute -left-20 top-1/2 hidden lg:flex -translate-y-1/2 z-30">
            <div className="w-24 h-24 rounded-full overflow-hidden border-3 border-gold/60 shadow-[0_10px_30px_rgba(212,175,55,0.4)] backdrop-blur-md animate-[spin_12s_linear_infinite]">
              <img
                src={heroLogos[0]}
                alt="Hero logo sol"
                className="w-full h-full object-cover"
              />
            </div>
          </div>

          {/* Sağ dönen logo */}
          <div className="pointer-events-none absolute -right-20 top-1/2 hidden lg:flex -translate-y-1/2 z-30">
            <div className="w-24 h-24 rounded-full overflow-hidden border-3 border-gold/60 shadow-[0_10px_30px_rgba(212,175,55,0.4)] backdrop-blur-md animate-[spin_12s_linear_infinite]">
              <img
                src={heroLogos[1]}
                alt="Hero logo sağ"
                className="w-full h-full object-cover"
              />
            </div>
          </div>

          <div className="relative z-20 text-center py-16 px-8 md:px-12 rounded-3xl bg-gradient-to-br from-gold/10 via-white to-pistachio/10 border border-gold/20 shadow-2xl backdrop-blur-sm">
            <p className="text-sm md:text-base uppercase tracking-[0.3em] text-gold font-semibold mb-3">
              Geleneksel Lezzet
            </p>
            <h2 className="heading-font text-5xl md:text-6xl font-bold text-[#264027] mb-4">
              Hünkar Baklava
            </h2>
            <p className="text-lg md:text-xl text-slate-600 leading-relaxed">
              Antep fıstığı ve Urfa tereyağı ile hazırlanan özel tariflerimiz, her lokmasında Türk tatlı kültürünün zenginliğini sunar.
            </p>
            <div className="mt-8 flex flex-wrap justify-center gap-4">
              <button className="px-8 py-3 bg-gold hover:bg-gold/90 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                Sipariş Ver
              </button>
              <button 
                onClick={onProductsClick}
                className="px-8 py-3 bg-white hover:bg-pistachio/10 text-[#264027] font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-pistachio/30 hover:border-pistachio">
                Ürünlerimiz
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

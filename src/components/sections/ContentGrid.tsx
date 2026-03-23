import { recipes } from '../../data'

export function ContentGrid() {
  return (
    <div className="bg-white">
      <div className="container mx-auto px-4">
        <div className="relative grid md:grid-cols-[70%_30%] gap-8">
          {/* Sol kolon: Info Cards */}
          <div className="space-y-8">
            <div className="grid md:grid-cols-2 gap-6">
              {/* Servis Kartı */}
              <div className="rounded-3xl bg-white shadow-xl border border-pistachio/30 overflow-hidden">
                <div className="aspect-video bg-gradient-to-br from-gold/20 to-pistachio/20 flex items-center justify-center">
                  <img
                    src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80"
                    alt="İstanbul Servis"
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="p-8 text-center">
                  <h3 className="heading-font text-2xl md:text-3xl text-[#264027] mb-3">
                    İstanbul İçi Servis
                  </h3>
                  <p className="text-slate-700 text-base md:text-lg leading-relaxed">
                    Toplu siparişleriniz için servis vardır.
                  </p>
                </div>
              </div>

              {/* Malzeme Kartı */}
              <div className="rounded-3xl bg-white shadow-xl border border-pistachio/30 overflow-hidden">
                <div className="aspect-video bg-gradient-to-br from-pistachio/20 to-gold/20 flex items-center justify-center">
                  <img
                    src="https://images.unsplash.com/photo-1608797178974-15b35a64ede9?auto=format&fit=crop&w=800&q=80"
                    alt="Kaliteli Malzemeler"
                    className="w-full h-full object-cover"
                  />
                </div>
                <div className="p-8 text-center">
                  <h3 className="heading-font text-2xl md:text-3xl text-[#264027] mb-3">
                    Kaliteli Malzemeler
                  </h3>
                  <p className="text-slate-700 text-base md:text-lg leading-relaxed">
                    Ürünlerimiz Antep fıstığı, Urfa tereyağı ile özenle hazırlanır.
                  </p>
                </div>
              </div>
            </div>
          </div>

          {/* Sağ kolon: Tarifler */}
          <div className="relative">
            <div className="flex flex-col h-full relative z-10 rounded-3xl bg-white shadow-2xl border border-pistachio/30 p-6 md:p-8">
              <h2 className="heading-font text-2xl md:text-3xl text-[#264027] mb-4">Tarifler</h2>
              <div className="space-y-4 flex-grow">
                {recipes.map((recipe) => (
                  <div key={recipe.category} className="border-b border-pistachio/30 pb-4 last:border-0 last:pb-0">
                    <h3 className="text-lg font-semibold text-[#264027] mb-2">{recipe.category}</h3>
                    <ul className="space-y-2 text-sm text-slate-700">
                      {recipe.items.map((item) => (
                        <li key={item.name} className="leading-snug">
                          <span className="font-semibold text-pistachio">{item.name}:</span> {item.desc}
                        </li>
                      ))}
                    </ul>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

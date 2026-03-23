import { cityPrices } from '../../data'

export function PriceComparison() {
  return (
    <section id="fiyatlar" className="bg-[radial-gradient(circle_at_top_left,#e5f3de_0%,#fdfcf8_55%,#fdfcf8_100%)] py-12">
      <div className="container mx-auto px-4">
        <h2 className="heading-font text-3xl md:text-4xl text-center text-[#264027] mb-8">
          Türkiye'de Ortalama Tereyağlı Baklava Satış Fiyatları
        </h2>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
          {cityPrices.map((cityData) => (
            <div
              key={cityData.city}
              className="rounded-2xl bg-white shadow-lg border border-gold/30 p-6 hover:shadow-xl transition"
            >
              <h3 className="heading-font text-xl md:text-2xl text-gold text-center mb-4 pb-3 border-b border-gold/20">
                {cityData.city}
              </h3>
              <ul className="space-y-3">
                {cityData.prices.map((item) => (
                  <li
                    key={item.name}
                    className="flex justify-between items-center text-sm"
                  >
                    <span className="text-slate-700 font-medium">{item.name}</span>
                    <span className="text-pistachio font-bold">{item.price}</span>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

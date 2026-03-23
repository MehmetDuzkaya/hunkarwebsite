import { baklavaCosting } from '../../data'

export function CostBreakdown() {
  return (
    <section className="bg-white py-12">
      <div className="container mx-auto px-4">
        <h2 className="heading-font text-3xl md:text-4xl text-center text-[#264027] mb-8">
          Ortalama Baklava Maliyetleri (kg başına)
        </h2>
        <div className="max-w-3xl mx-auto">
          <div className="rounded-3xl bg-gradient-to-br from-gold/5 to-pistachio/5 shadow-lg border border-gold/30 p-8">
            <div className="space-y-3">
              {baklavaCosting.map((cost, idx) => (
                <div key={idx} className="flex justify-between items-center py-3 border-b border-pistachio/20 last:border-0">
                  <span className="text-slate-700 font-medium">{cost.item}</span>
                  <span className="text-gold font-bold text-lg">{cost.cost}</span>
                </div>
              ))}
            </div>
            <div className="mt-8 pt-6 border-t-2 border-gold">
              <div className="flex justify-between items-center mb-6">
                <span className="text-lg font-bold text-[#264027]">Toplam Maliyet:</span>
                <span className="text-2xl font-bold text-pistachio">320₺/kg</span>
              </div>
              <div className="space-y-3">
                <div className="p-4 bg-pistachio/10 rounded-xl border border-pistachio/30">
                  <div className="flex justify-between items-center">
                    <span className="text-sm font-semibold text-[#264027]">%50 Kâr Marjı:</span>
                    <span className="text-2xl font-bold text-pistachio">480₺/kg</span>
                  </div>
                </div>
                <div className="p-4 bg-gold/10 rounded-xl border border-gold/30">
                  <div className="flex justify-between items-center">
                    <span className="text-sm font-semibold text-[#264027]">%70 Kâr Marjı:</span>
                    <span className="text-2xl font-bold text-gold">544₺/kg</span>
                  </div>
                </div>
                <div className="p-4 bg-gradient-to-r from-gold/20 to-pistachio/20 rounded-xl border-2 border-gold">
                  <div className="flex justify-between items-center">
                    <span className="text-base font-bold text-[#264027]">%100 Kâr Marjı:</span>
                    <span className="text-3xl font-bold text-[#264027]">640₺/kg</span>
                  </div>
                </div>
              </div>
              <p className="text-xs text-slate-600 mt-4 text-center">
                *Kâr marjları pazar koşullarına göre ayarlanabilir.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

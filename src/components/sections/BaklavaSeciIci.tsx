interface BaklavaPicerProps {
  showBaklavaPicker: boolean
  baklavaNut: string | null
  baklavaSherbetLevel: string | null
  baklavaPurpose: string | null
  baklavaRecommendation: string | null
  baklavaDetails: string | null
  onTogglePicker: () => void
  onSelectNut: (nut: string) => void
  onSelectSherbet: (level: string) => void
  onSelectPurpose: (purpose: string) => void
  onReset: () => void
}

export function BaklavaSeciIci({
  showBaklavaPicker,
  baklavaNut,
  baklavaSherbetLevel,
  baklavaPurpose,
  baklavaRecommendation,
  baklavaDetails,
  onTogglePicker,
  onSelectNut,
  onSelectSherbet,
  onSelectPurpose,
  onReset,
}: BaklavaPicerProps) {
  return (
    <section className="bg-gradient-to-b from-gold/5 via-pistachio/10 to-gold/5 py-16">
      <div className="container mx-auto px-4">
        <div className="max-w-2xl mx-auto">
          <div className="text-center mb-10">
            <h2 className="heading-font text-3xl md:text-4xl text-[#264027] mb-3">
              🍯 Baklava Seçici
            </h2>
            <p className="text-slate-600 text-base md:text-lg">
              3 basit soru ile sana en uygun baklava türünü bulalım
            </p>
          </div>

          {!showBaklavaPicker ? (
            <div className="text-center">
              <button
                onClick={onTogglePicker}
                className="px-8 py-4 bg-gradient-to-r from-gold to-pistachio hover:from-gold/90 hover:to-pistachio/90 text-white font-bold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 inline-flex items-center gap-2"
              >
                <span className="text-2xl">✨</span>
                Benim İçin En Uygun Baklava Nedir?
              </button>
            </div>
          ) : (
            <div className="bg-white rounded-3xl shadow-2xl border border-gold/30 p-8">
              {!baklavaRecommendation ? (
                <div className="space-y-8">
                  {/* Soru 1: Fıstık vs Ceviz */}
                  {!baklavaNut && (
                    <div className="space-y-4">
                      <h3 className="heading-font text-2xl text-[#264027] text-center mb-6">
                        Soru 1️⃣: Fıstıklı mı, cevizli mi?
                      </h3>
                      <div className="grid grid-cols-2 gap-4">
                        <button
                          onClick={() => onSelectNut('fistik')}
                          className="p-6 bg-gradient-to-br from-gold/20 to-gold/10 border-2 border-gold hover:border-gold/70 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">🥜</span>
                          Fıstıklı
                        </button>
                        <button
                          onClick={() => onSelectNut('ceviz')}
                          className="p-6 bg-gradient-to-br from-pistachio/20 to-pistachio/10 border-2 border-pistachio hover:border-pistachio/70 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">🌰</span>
                          Cevizli
                        </button>
                      </div>
                    </div>
                  )}

                  {/* Soru 2: Şerbet Yoğunluğu */}
                  {baklavaNut && !baklavaSherbetLevel && (
                    <div className="space-y-4 animate-fadeIn">
                      <h3 className="heading-font text-2xl text-[#264027] text-center mb-6">
                        Soru 2️⃣: Şerbet yoğun mu, hafif mi?
                      </h3>
                      <div className="grid grid-cols-2 gap-4">
                        <button
                          onClick={() => onSelectSherbet('yogun')}
                          className="p-6 bg-gradient-to-br from-amber-100 to-amber-50 border-2 border-amber-400 hover:border-amber-600 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">🍯</span>
                          Yoğun & Tatlı
                        </button>
                        <button
                          onClick={() => onSelectSherbet('hafif')}
                          className="p-6 bg-gradient-to-br from-blue-100 to-blue-50 border-2 border-blue-400 hover:border-blue-600 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">💧</span>
                          Hafif & Dengeli
                        </button>
                      </div>
                    </div>
                  )}

                  {/* Soru 3: Kullanım Amacı */}
                  {baklavaNut && baklavaSherbetLevel && !baklavaPurpose && (
                    <div className="space-y-4 animate-fadeIn">
                      <h3 className="heading-font text-2xl text-[#264027] text-center mb-6">
                        Soru 3️⃣: Hediye mi, kendin için mi?
                      </h3>
                      <div className="grid grid-cols-2 gap-4">
                        <button
                          onClick={() => onSelectPurpose('hediye')}
                          className="p-6 bg-gradient-to-br from-red-100 to-red-50 border-2 border-red-400 hover:border-red-600 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">🎁</span>
                          Hediye
                        </button>
                        <button
                          onClick={() => onSelectPurpose('kendin')}
                          className="p-6 bg-gradient-to-br from-purple-100 to-purple-50 border-2 border-purple-400 hover:border-purple-600 rounded-2xl transition-all duration-300 hover:shadow-lg hover:scale-105 font-semibold text-[#264027]"
                        >
                          <span className="text-4xl block mb-2">😋</span>
                          Kendin İçin
                        </button>
                      </div>
                    </div>
                  )}
                </div>
              ) : (
                <div className="text-center space-y-6 animate-fadeIn">
                  {baklavaRecommendation ? (
                    <>
                      <div className="text-6xl">🎉</div>
                      <h3 className="heading-font text-3xl text-[#264027]">
                        Sana Mükemmel Baklava Buldum!
                      </h3>
                      <div className="bg-gradient-to-r from-gold/20 to-pistachio/20 rounded-2xl border-2 border-gold/50 p-6">
                        <p className="text-3xl font-bold text-[#264027] leading-relaxed mb-4">
                          {baklavaRecommendation}
                        </p>
                        <p className="text-slate-700 text-base leading-relaxed">
                          {baklavaDetails}
                        </p>
                      </div>
                      <div className="space-y-4 mt-6 pt-6 border-t border-gold/20">
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                          <div className="bg-gold/10 rounded-xl p-4">
                            <p className="text-sm font-semibold text-[#264027] mb-2">📦 Sunumu</p>
                            <p className="text-xs text-slate-600">Zarif kutu ambalajda sunulur, hediye almak için hazır</p>
                          </div>
                          <div className="bg-pistachio/10 rounded-xl p-4">
                            <p className="text-sm font-semibold text-[#264027] mb-2">⏰ Taze Saklama</p>
                            <p className="text-xs text-slate-600">Oda sıcaklığında 5-7 gün, buzdolabında 15 gün taze kalır</p>
                          </div>
                          <div className="bg-amber-100/30 rounded-xl p-4">
                            <p className="text-sm font-semibold text-[#264027] mb-2">🎁 Sunuş İpuçları</p>
                            <p className="text-xs text-slate-600">Çay, kahve veya sütün yanında servis edin</p>
                          </div>
                        </div>
                      </div>
                      <div className="flex gap-4 flex-wrap justify-center pt-4">
                        <button
                          onClick={onReset}
                          className="px-6 py-3 bg-white text-[#264027] border-2 border-gold/50 font-semibold rounded-full hover:bg-gold/10 transition-all duration-300"
                        >
                          ← Başa Dön
                        </button>
                        <button className="px-6 py-3 bg-gradient-to-r from-gold to-pistachio text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300">
                          🛒 Hemen Sipariş Ver
                        </button>
                      </div>
                    </>
                  ) : (
                    <div className="text-center py-12">
                      <p className="text-slate-500 text-lg">Soruları yanıtlayarak başlayın...</p>
                    </div>
                  )}
                </div>
              )}
            </div>
          )}
        </div>
      </div>
    </section>
  )
}

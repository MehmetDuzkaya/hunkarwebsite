import type { Location } from '../../types'

interface LocationFinderProps {
  showLocationFinder: boolean
  nearbyLocations: (Location & { distance: number })[]
  onFindNearby: () => void
  onOpenMaps: (location: Location) => void
  onOpenWhatsApp: (phone: string) => void
}

export function LocationFinder({
  showLocationFinder,
  nearbyLocations,
  onFindNearby,
  onOpenMaps,
  onOpenWhatsApp,
}: LocationFinderProps) {
  return (
    <section id="subeler" className="bg-gradient-to-r from-gold/10 via-pistachio/5 to-gold/10 py-12 border-y border-gold/20">
      <div className="container mx-auto px-4">
        <div className="max-w-3xl mx-auto">
          <div className="text-center mb-8">
            <h2 className="heading-font text-3xl md:text-4xl text-[#264027] mb-3">
              En Yakın Şubemizi Bulun
            </h2>
            <p className="text-slate-600 text-base md:text-lg">
              Konumunuza en yakın Hünkar Baklava şubesini keşfedin
            </p>
          </div>

          <div className="flex justify-center mb-8">
            <button
              onClick={onFindNearby}
              className="px-8 py-4 bg-gradient-to-r from-gold to-gold/90 hover:from-gold/90 hover:to-gold text-white font-bold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2"
            >
              <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              En Yakın Şubeyi Bul
            </button>
          </div>

          {showLocationFinder && nearbyLocations.length > 0 && (
            <div className="space-y-4">
              <div className="text-center mb-6">
                <p className="text-sm text-slate-600">
                  Konumunuza en yakın {nearbyLocations.length} şubemiz listeleniyor
                </p>
              </div>

              {nearbyLocations.map((location) => (
                <div
                  key={location.id}
                  className="bg-white rounded-2xl shadow-lg border border-gold/30 overflow-hidden hover:shadow-xl transition-all duration-300"
                >
                  <div className="p-6">
                    <div className="flex justify-between items-start mb-4">
                      <div className="flex-1">
                        <h3 className="heading-font text-xl md:text-2xl text-[#264027] mb-1">
                          {location.name}
                        </h3>
                        <div className="flex items-center gap-2">
                          <span className={`inline-block px-3 py-1 rounded-full text-sm font-semibold ${
                            location.isOpen
                              ? 'bg-pistachio/20 text-pistachio'
                              : 'bg-red-100 text-red-700'
                          }`}>
                            {location.isOpen ? '🟢 Açık' : '🔴 Kapalı'}
                          </span>
                          <span className="text-gold font-bold text-lg">📍 {location.distance} km</span>
                        </div>
                      </div>
                    </div>

                    <div className="space-y-3 mb-6 text-slate-700">
                      <div className="flex items-start gap-3">
                        <span className="text-gold text-xl mt-1">📍</span>
                        <div>
                          <p className="font-semibold text-sm">Adres</p>
                          <p className="text-sm text-slate-600">{location.address}</p>
                        </div>
                      </div>
                      <div className="flex items-start gap-3">
                        <span className="text-gold text-xl mt-1">⏰</span>
                        <div>
                          <p className="font-semibold text-sm">Çalışma Saatleri</p>
                          <p className="text-sm text-slate-600">{location.workingHours}</p>
                        </div>
                      </div>
                      <div className="flex items-start gap-3">
                        <span className="text-gold text-xl mt-1">📞</span>
                        <div>
                          <p className="font-semibold text-sm">Telefon</p>
                          <p className="text-sm text-slate-600">{location.phone}</p>
                        </div>
                      </div>
                    </div>

                    <div className="flex flex-wrap gap-3">
                      <button
                        onClick={() => onOpenMaps(location)}
                        className="flex-1 px-4 py-3 bg-gold hover:bg-gold/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105"
                      >
                        📍 Yol Tarifi
                      </button>
                      <button
                        onClick={() => onOpenWhatsApp(location.phone)}
                        className="flex-1 px-4 py-3 bg-pistachio hover:bg-pistachio/90 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105"
                      >
                        💬 WhatsApp
                      </button>
                      <button
                        onClick={() => window.open(`tel:${location.phone}`)}
                        className="flex-1 px-4 py-3 bg-slate-600 hover:bg-slate-700 text-white font-semibold rounded-lg transition-all duration-300 hover:scale-105"
                      >
                        📞 Ara
                      </button>
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </div>
    </section>
  )
}

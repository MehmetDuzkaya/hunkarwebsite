import { useState, useEffect } from 'react'
import {
  Hero,
  About,
  LocationFinder,
  ContentGrid,
  PriceComparison,
  CostBreakdown,
  BaklavaSeciIci,
  ProductSliders,
} from '../components/sections'
import {
  baklavaProducts,
  borekProducts,
  dessertProducts,
  locations,
} from '../data'
import type { Location } from '../types'

export function HomePage() {
  const [activeTab, setActiveTab] = useState<'baklava' | 'borek' | 'dessert'>('baklava')
  const [nearbyLocations, setNearbyLocations] = useState<(Location & { distance: number })[]>([])
  const [showLocationFinder, setShowLocationFinder] = useState(false)
  const [showBaklavaPicker, setShowBaklavaPicker] = useState(false)
  const [baklavaNut, setBaklavaNut] = useState<string | null>(null)
  const [baklavaSherbetLevel, setBaklavaSherbetLevel] = useState<string | null>(null)
  const [baklavaPurpose, setBaklavaPurpose] = useState<string | null>(null)
  const [baklavaRecommendation, setBaklavaRecommendation] = useState<string | null>(null)
  const [baklavaDetails, setBaklavaDetails] = useState<string | null>(null)

  const getBaklavRecommendation = () => {
    let recommendation = ''
    let details = ''

    if (baklavaNut === 'fistik' && baklavaSherbetLevel === 'yogun' && baklavaPurpose === 'hediye') {
      recommendation = 'Fıstıklı Kare Baklava'
      details = 'En prestijli baklava çeşididir. Kare şeklinde kesilmiş, her katmanında bol Antep fıstığı bulunan ve yoğun şerbetle tatlandırılmış lüks bir seçim. Özel günler ve hediye için idealdir.'
    } else if (baklavaNut === 'fistik' && baklavaSherbetLevel === 'yogun' && baklavaPurpose === 'kendin') {
      recommendation = 'Burma Baklava (Fıstıklı)'
      details = 'Burma şeklinde sarılmış, içinde bol fıstık bulunan ve yoğun şerbetli baklava. Hem göze hem damağa hitap eden, doyurucu bir tatlı deneyimi sunar. Tatlı sevenler için mükemmel.'
    } else if (baklavaNut === 'fistik' && baklavaSherbetLevel === 'hafif' && baklavaPurpose === 'hediye') {
      recommendation = 'Havuç Dilimi'
      details = 'Baklavaların en zariflerinden biri. İnce uzun dilimler halinde kesilmiş, hafif şerbetli ve üzeri fıstıkla süslenmiş. Sunum şıklığı ve dengeli tadıyla misafir ağırlamada tercih edilir.'
    } else if (baklavaNut === 'fistik' && baklavaSherbetLevel === 'hafif' && baklavaPurpose === 'kendin') {
      recommendation = 'Fıstık Sarma'
      details = 'Yufkalar arasında fıstık bulunan, rulo şeklinde sarılmış ve hafif şerbetli bir baklava çeşidi. Çok ağır olmayan yapısıyla günlük tüketim için uygundur.'
    } else if (baklavaNut === 'ceviz' && baklavaSherbetLevel === 'yogun' && baklavaPurpose === 'hediye') {
      recommendation = 'Şöbiyet'
      details = 'Kaymak veya muhallebi kreması ile zenginleştirilmiş, cevizli ve yoğun şerbetli özel bir baklava çeşidi. Farklı lezzet arayanlar ve özel misafirler için göz alıcı bir seçim.'
    } else if (baklavaNut === 'ceviz' && baklavaSherbetLevel === 'yogun' && baklavaPurpose === 'kendin') {
      recommendation = 'Kol Baklava (Cevizli)'
      details = 'Geleneksel Türk baklavası. Kol şeklinde uzun dilimler halinde, bol cevizli ve yoğun şerbetli. Klasik baklava tadını sevenler için vazgeçilmez bir lezzet.'
    } else if (baklavaNut === 'ceviz' && baklavaSherbetLevel === 'hafif' && baklavaPurpose === 'hediye') {
      recommendation = 'Sütlü Nuriye'
      details = 'Cevizli baklava katmanlarının arasına sütlü sos dökülerek hazırlanan hafif şerbetli bir çeşit. Farklı doku ve yumuşak tadıyla beğeni kazanan modern bir baklava türü.'
    } else if (baklavaNut === 'ceviz' && baklavaSherbetLevel === 'hafif' && baklavaPurpose === 'kendin') {
      recommendation = 'Cevizli Muska Baklava'
      details = 'Üçgen şeklinde (muska) katlanmış, ceviz dolgulu ve hafif şerbetli baklava. Porsiyonluk yapısı ve dengeli tadıyla günlük tüketim için idealdir.'
    }

    setBaklavaRecommendation(recommendation)
    setBaklavaDetails(details)
  }

  useEffect(() => {
    if (baklavaNut && baklavaSherbetLevel && baklavaPurpose) {
      getBaklavRecommendation()
    }
  }, [baklavaNut, baklavaSherbetLevel, baklavaPurpose])

  const resetBaklavaPicker = () => {
    setBaklavaNut(null)
    setBaklavaSherbetLevel(null)
    setBaklavaPurpose(null)
    setBaklavaRecommendation(null)
    setBaklavaDetails(null)
  }

  const calculateDistance = (lat1: number, lon1: number, lat2: number, lon2: number): number => {
    const R = 6371
    const dLat = ((lat2 - lat1) * Math.PI) / 180
    const dLon = ((lon2 - lon1) * Math.PI) / 180
    const a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos((lat1 * Math.PI) / 180) *
        Math.cos((lat2 * Math.PI) / 180) *
        Math.sin(dLon / 2) *
        Math.sin(dLon / 2)
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))
    return R * c
  }

  const handleFindNearby = () => {
    setShowLocationFinder(true)
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const { latitude, longitude } = position.coords

          const locationsWithDistance = locations.map((loc) => ({
            ...loc,
            distance: parseFloat(
              calculateDistance(latitude, longitude, loc.latitude, loc.longitude).toFixed(2)
            ),
          }))

          locationsWithDistance.sort((a, b) => a.distance - b.distance)
          setNearbyLocations(locationsWithDistance)
        },
        () => {
          alert('Konum erişimine izin vermediniz. Lütfen tarayıcı ayarlarından izin verin.')
        }
      )
    }
  }

  const openGoogleMaps = (location: Location) => {
    const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${location.latitude},${location.longitude}`
    window.open(mapsUrl, '_blank')
  }

  const openWhatsApp = (phone: string) => {
    const whatsappUrl = `https://wa.me/${phone.replace(/\D/g, '')}`
    window.open(whatsappUrl, '_blank')
  }

  return (
    <>
      <Hero onProductsClick={() => {}} />
      
      <About />

      <LocationFinder
        showLocationFinder={showLocationFinder}
        nearbyLocations={nearbyLocations}
        onFindNearby={handleFindNearby}
        onOpenMaps={openGoogleMaps}
        onOpenWhatsApp={openWhatsApp}
      />

      <ContentGrid />

      <PriceComparison />

      <CostBreakdown />

      <BaklavaSeciIci
        showBaklavaPicker={showBaklavaPicker}
        baklavaNut={baklavaNut}
        baklavaSherbetLevel={baklavaSherbetLevel}
        baklavaPurpose={baklavaPurpose}
        baklavaRecommendation={baklavaRecommendation}
        baklavaDetails={baklavaDetails}
        onTogglePicker={() => setShowBaklavaPicker(!showBaklavaPicker)}
        onSelectNut={setBaklavaNut}
        onSelectSherbet={setBaklavaSherbetLevel}
        onSelectPurpose={setBaklavaPurpose}
        onReset={resetBaklavaPicker}
      />

      <ProductSliders
        activeTab={activeTab}
        onTabChange={setActiveTab}
        baklavaProducts={baklavaProducts}
        borekProducts={borekProducts}
        dessertProducts={dessertProducts}
      />
    </>
  )
}

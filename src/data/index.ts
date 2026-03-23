import type { Product, MenuItem, Location, CityPrice, BaklavaCosting, Recipe } from '../types'

export const products: Product[] = [
  {
    id: 1,
    name: 'Baklava',
    image:
      'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=600&q=80',
  },
  {
    id: 2,
    name: 'Pasta ve Tatlılar',
    image:
      'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=600&q=80',
  },
  {
    id: 3,
    name: 'Börekler',
    image:
      'https://images.unsplash.com/photo-1581368131140-1c87c8c5c21e?auto=format&fit=crop&w=600&q=80',
  },
  {
    id: 4,
    name: 'Tatlı Çeşitleri',
    image:
      'https://images.unsplash.com/photo-1504753793650-d4a2b783c15e?auto=format&fit=crop&w=600&q=80',
  },
]

export const heroLogos = [
  'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=300&q=80',
  'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=300&q=80',
]

export const recipes: Recipe[] = [
  {
    category: 'Baklava',
    items: [
      { name: 'Fıstıklı Baklava', desc: 'İnce kat hamur, Antep fıstığı, şerbet dengesi.' },
      { name: 'Cevizli Baklava', desc: 'Odun ateşinde pişmiş hafif kıtır dokulu.' },
    ],
  },
]

export const cityPrices: CityPrice[] = [
  {
    city: 'İstanbul',
    prices: [
      { name: 'Fıstıklı Baklava', price: '850₺/kg' },
      { name: 'Cevizli Baklava', price: '650₺/kg' },
      { name: 'Şöbiyet', price: '720₺/kg' },
    ],
  },
  {
    city: 'İzmir',
    prices: [
      { name: 'Fıstıklı Baklava', price: '820₺/kg' },
      { name: 'Cevizli Baklava', price: '630₺/kg' },
      { name: 'Şöbiyet', price: '700₺/kg' },
    ],
  },
  {
    city: 'Ankara',
    prices: [
      { name: 'Fıstıklı Baklava', price: '840₺/kg' },
      { name: 'Cevizli Baklava', price: '640₺/kg' },
      { name: 'Şöbiyet', price: '710₺/kg' },
    ],
  },
  {
    city: 'Bursa',
    prices: [
      { name: 'Fıstıklı Baklava', price: '830₺/kg' },
      { name: 'Cevizli Baklava', price: '635₺/kg' },
      { name: 'Şöbiyet', price: '705₺/kg' },
    ],
  },
  {
    city: 'Antalya',
    prices: [
      { name: 'Fıstıklı Baklava', price: '860₺/kg' },
      { name: 'Cevizli Baklava', price: '660₺/kg' },
      { name: 'Şöbiyet', price: '730₺/kg' },
    ],
  },
]

export const baklavaCosting: BaklavaCosting[] = [
  { item: 'Antep Fıstığı (150 g)', cost: '120₺' },
  { item: 'Urfa Tereyağı (250 g)', cost: '70₺' },
  { item: 'Un (250 g)', cost: '3₺' },
  { item: 'Şeker (450 g)', cost: '11₺' },
  { item: 'Nişasta (60 g)', cost: '2.4₺' },
  { item: 'Su', cost: '0.5₺' },
  { item: 'Tuz / Limon', cost: '1₺' },
  { item: 'Enerji (Fırın + Makine)', cost: '17₺' },
  { item: 'İşçilik', cost: '30₺' },
  { item: 'Dükkan Gideri (Kira + Temel Giderler)', cost: '30₺' },
  { item: 'İşveren SGK + Vergi Yükü', cost: '6₺' },
  { item: 'Muhasebe / Mali Müşavir', cost: '4₺' },
  { item: 'Amortisman (Fırın + Makineler)', cost: '5₺' },
  { item: 'Sigorta / Ruhsat / İzinler', cost: '2₺' },
  { item: 'Bakım / Onarım', cost: '3₺' },
  { item: 'Pazarlama / Dağıtım Payı', cost: '5₺' },
  { item: 'Hammadde Fire / Zayi (%3)', cost: '6.2₺' },
  { item: 'POS / Banka Kesintileri', cost: '1.5₺' },
  { item: 'Beklenmeyen Gider Payı', cost: '3.3₺' },
]

export const baklavaProducts: MenuItem[] = [
  {
    id: 1,
    name: 'Fıstıklı Baklava',
    desc: 'Antep fıstığı ile hazırlanmış, şerbet dengesi kusursuz',
    image: 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=500&q=80',
    price: '480₺/kg',
  },
  {
    id: 2,
    name: 'Cevizli Baklava',
    desc: 'Taze ceviz dolgusu, hafif ve kıtır dokulu',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=500&q=80',
    price: '420₺/kg',
  },
  {
    id: 3,
    name: 'Şöbiyet',
    desc: 'İnce hamur, fıstık ve ceviz karışımı, tereyağ ile hazırlandı',
    image: 'https://images.unsplash.com/photo-1599599810694-b5ac4dd30e2b?auto=format&fit=crop&w=500&q=80',
    price: '450₺/kg',
  },
  {
    id: 4,
    name: 'Fındık Çatlaması',
    desc: 'Çatlaması tekstürü, fındık dolgusu, çıtır kat hamur',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=500&q=80',
    price: '490₺/kg',
  },
  {
    id: 5,
    name: 'Arnavut Baklavaası',
    desc: 'Kare parçalar, fıstık dolgusu, hafif şerbeti ile lezzetli',
    image: 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=500&q=80',
    price: '470₺/kg',
  },
]

export const borekProducts: MenuItem[] = [
  {
    id: 1,
    name: 'Peynir Böreği',
    desc: 'Taze beyaz peynir, maydanoz ve dill, kıtır yufka',
    image: 'https://images.unsplash.com/photo-1555939594-58d7cb561e1d?auto=format&fit=crop&w=500&q=80',
    price: '180₺/kg',
  },
  {
    id: 2,
    name: 'Kıyma Böreği',
    desc: 'Baharat uyumlu kıyma, tereyağ ile pişmiş, altın sarısı',
    image: 'https://images.unsplash.com/photo-1599599810694-b5ac4dd30e2b?auto=format&fit=crop&w=500&q=80',
    price: '160₺/kg',
  },
  {
    id: 3,
    name: 'Ispanaklı Börek',
    desc: 'Taze ıspanak, çökelek, fıstık dolgusu, ince yufka',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=500&q=80',
    price: '175₺/kg',
  },
  {
    id: 4,
    name: 'Tavuk Böreği',
    desc: 'Yumuşak tavuk eti, baharat karışımı, ince hamur',
    image: 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=500&q=80',
    price: '195₺/kg',
  },
  {
    id: 5,
    name: 'Kasarlı Sigara Böreği',
    desc: 'Kaşar peyniri, taze maydanoz, kızartılmış çıtır',
    image: 'https://images.unsplash.com/photo-1555939594-58d7cb561e1d?auto=format&fit=crop&w=500&q=80',
    price: '170₺/kg',
  },
]

export const dessertProducts: MenuItem[] = [
  {
    id: 1,
    name: 'Kadayıf Dolması',
    desc: 'Çıtır kadayıf, fıstık dolgusu, hafif şerbeti ile',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=500&q=80',
    price: '350₺/kg',
  },
  {
    id: 2,
    name: 'Revani',
    desc: 'Irmik tabanlı, hindistan cevizi, şerbet çorbası',
    image: 'https://images.unsplash.com/photo-1599599810694-b5ac4dd30e2b?auto=format&fit=crop&w=500&q=80',
    price: '180₺/kg',
  },
  {
    id: 3,
    name: 'Künefe',
    desc: 'İnce tel kadayıf, tatlı peynir, fıstık, şerbet',
    image: 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?auto=format&fit=crop&w=500&q=80',
    price: '420₺/kg',
  },
  {
    id: 4,
    name: 'Sarı Baklava',
    desc: 'Tereyağ, un, şeker karışımı, şerbet çorbası',
    image: 'https://images.unsplash.com/photo-1555939594-58d7cb561e1d?auto=format&fit=crop&w=500&q=80',
    price: '280₺/kg',
  },
  {
    id: 5,
    name: 'Sutlaç',
    desc: 'Taze süt, pirinç, tarçın, çok lezzetli',
    image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=500&q=80',
    price: '120₺/kg',
  },
]

export const locations: Location[] = [
  {
    id: 1,
    name: 'Hünkar Baklava - Sultanahmet',
    address: 'Divanyolu Cad. No: 12, Sultanahmet, İstanbul',
    phone: '+90 (212) 555-0001',
    workingHours: '09:00 - 22:00',
    latitude: 41.0054,
    longitude: 28.9769,
    isOpen: true,
  },
  {
    id: 2,
    name: 'Hünkar Baklava - Bebek',
    address: 'Cevdet Paşa Cad. No: 45, Bebek, İstanbul',
    phone: '+90 (212) 555-0002',
    workingHours: '10:00 - 23:00',
    latitude: 41.0738,
    longitude: 29.0024,
    isOpen: true,
  },
  {
    id: 3,
    name: 'Hünkar Baklava - Fatih',
    address: 'Millet Cad. No: 78, Fatih, İstanbul',
    phone: '+90 (212) 555-0003',
    workingHours: '09:30 - 21:30',
    latitude: 41.0121,
    longitude: 28.9465,
    isOpen: false,
  },
  {
    id: 4,
    name: 'Hünkar Baklava - Nişantaşı',
    address: 'Teşvikiye Cad. No: 34, Nişantaşı, İstanbul',
    phone: '+90 (212) 555-0004',
    workingHours: '10:00 - 22:30',
    latitude: 41.0487,
    longitude: 29.0132,
    isOpen: true,
  },
  {
    id: 5,
    name: 'Hünkar Baklava - Eminönü',
    address: 'Rüstem Paşa Cad. No: 56, Eminönü, İstanbul',
    phone: '+90 (212) 555-0005',
    workingHours: '08:30 - 20:00',
    latitude: 41.0142,
    longitude: 28.9697,
    isOpen: true,
  },
]

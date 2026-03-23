export interface Product {
  id: number
  name: string
  image: string
}

export interface MenuItem {
  id: number
  name: string
  desc: string
  image: string
  price: string
}

export interface Location {
  id: number
  name: string
  address: string
  phone: string
  workingHours: string
  latitude: number
  longitude: number
  isOpen: boolean
}

export interface CityPrice {
  city: string
  prices: Array<{
    name: string
    price: string
  }>
}

export interface BaklavaCosting {
  item: string
  cost: string
}

export interface Recipe {
  category: string
  items: Array<{
    name: string
    desc: string
  }>
}

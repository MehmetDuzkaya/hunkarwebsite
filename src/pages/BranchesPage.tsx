import { useState } from 'react'
import { LocationFinder } from '../components/sections'
import { locations } from '../data'
import type { Location } from '../types'

export function BranchesPage() {
  const [nearbyLocations, setNearbyLocations] = useState<(Location & { distance: number })[]>([])
  const [showLocationFinder, setShowLocationFinder] = useState(false)

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
    <div className="py-16 animate-slideUp">
      <LocationFinder
        showLocationFinder={showLocationFinder}
        nearbyLocations={nearbyLocations}
        onFindNearby={handleFindNearby}
        onOpenMaps={openGoogleMaps}
        onOpenWhatsApp={openWhatsApp}
      />
    </div>
  )
}

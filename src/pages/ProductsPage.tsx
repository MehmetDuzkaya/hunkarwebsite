import { CategorySlider } from '../components/sections'
import { baklavaProducts, borekProducts, dessertProducts } from '../data'

export function ProductsPage() {
  return (
    <div className="py-8 md:py-12">
      <div className="space-y-12 md:space-y-16">
        <CategorySlider title="Baklava Çeşitleri" products={baklavaProducts} />
        <CategorySlider title="Börek Çeşitleri" products={borekProducts} />
        <CategorySlider title="Tatlı Çeşitleri" products={dessertProducts} />
      </div>
    </div>
  )
}

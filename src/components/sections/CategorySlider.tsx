import { Swiper, SwiperSlide } from 'swiper/react'
import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import type { MenuItem } from '../../types'

interface CategorySliderProps {
  title: string
  products: MenuItem[]
}

export function CategorySlider({ title, products }: CategorySliderProps) {
  return (
    <section className="bg-gradient-to-b from-white via-pistachio/5 to-white py-12">
      <div className="container mx-auto px-4">
        <h2 className="heading-font text-3xl md:text-4xl text-center text-[#264027] mb-10 animate-slideUp">
          {title}
        </h2>
        <Swiper
          modules={[Navigation, Pagination, Autoplay]}
          navigation
          pagination={{ clickable: true }}
          autoplay={{ delay: 5000, disableOnInteraction: false }}
          loop
          breakpoints={{
            320: { slidesPerView: 1, spaceBetween: 20 },
            640: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 3, spaceBetween: 30 },
          }}
          className="pb-12"
       >
          {products.map((product) => (
            <SwiperSlide key={product.id}>
              <div className="group h-full">
                <div className="rounded-2xl bg-white shadow-lg border border-gold/30 overflow-hidden h-full flex flex-col hover:shadow-2xl transition-all duration-300 hover:border-gold animate-fadeIn">
                  <div className="aspect-square overflow-hidden bg-gradient-to-br from-gold/10 to-pistachio/10">
                    <img
                      src={product.image}
                      alt={product.name}
                      className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                    />
                  </div>
                  <div className="p-6 flex-grow flex flex-col">
                    <h3 className="heading-font text-xl text-[#264027] mb-2">{product.name}</h3>
                    <p className="text-slate-600 text-sm mb-4 flex-grow">{product.desc}</p>
                    <div className="flex justify-between items-center pt-4 border-t border-pistachio/20">
                      <span className="text-lg font-bold text-gold">{product.price}</span>
                      <button className="px-4 py-2 bg-pistachio hover:bg-pistachio/90 text-white rounded-lg font-semibold transition-all duration-300 hover:scale-105">
                        Sipariş
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </SwiperSlide>
          ))}
        </Swiper>
      </div>
    </section>
  )
}

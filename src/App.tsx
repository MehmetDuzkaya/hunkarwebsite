import './App.css'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import { Header, Footer } from './components/sections'
import { ScrollToTop } from './components/ui/ScrollToTop'
import { WhatsAppButton } from './components/ui/WhatsAppButton'
import { HomePage } from './pages/HomePage'
import { AboutPage } from './pages/AboutPage'
import { ProductsPage } from './pages/ProductsPage'
import { BranchesPage } from './pages/BranchesPage'
import { ContactPage } from './pages/ContactPage'
import { BlogPage } from './pages/BlogPage'
import { BlogDetailPage } from './pages/BlogDetailPage'
import { FAQPage } from './pages/FAQPage'

function App() {
  return (
    <Router>
      <div className="min-h-screen bg-white flex flex-col">
        <Header />
        <main className="flex-grow">
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/hakkimizda" element={<AboutPage />} />
            <Route path="/urunler" element={<ProductsPage />} />
            <Route path="/blog" element={<BlogPage />} />
            <Route path="/blog/:slug" element={<BlogDetailPage />} />
            <Route path="/sss" element={<FAQPage />} />
            <Route path="/subeler" element={<BranchesPage />} />
            <Route path="/iletisim" element={<ContactPage />} />
          </Routes>
        </main>
        <Footer />
        <ScrollToTop />
        <WhatsAppButton />
      </div>
    </Router>
  )
}

export default App

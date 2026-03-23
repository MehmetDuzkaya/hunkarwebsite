export interface BlogPost {
  id: string
  title: string
  slug: string
  excerpt: string
  content: string
  category: string
  author: string
  date: string
  readTime: string
  image: string
  tags: string[]
}

export interface BlogCategory {
  id: string
  name: string
  slug: string
  description: string
}

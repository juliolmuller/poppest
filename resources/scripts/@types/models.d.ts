export interface Language {
  id: number
  name: string
}

export interface Repository {
  name: string
  avatar: string
  owner: string
  description: string
  stars: number
  forks: number
  language: Language
  url: string
}

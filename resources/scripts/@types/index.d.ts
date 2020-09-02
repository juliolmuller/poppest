declare module '*.gif'

declare module '*.svg'

interface JQuery {
  modal: (action: 'hide' | 'show' | 'toggle') => any
}

declare interface Language {
  id: number
  name: string
}

declare interface Repository {
  name: string
  avatar: string
  owner: string
  description: string
  stars: number
  forks: number
  language: Language
  url: string
}

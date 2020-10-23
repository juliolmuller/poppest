declare module '*.gif'
declare module '*.svg'

interface JQuery {
  modal: (action: 'hide' | 'show' | 'toggle') => any
}

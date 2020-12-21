import axios, { AxiosResponse } from 'axios'
import { Language, Repository } from '../@types/models'

const metaTimestamp = document.head.querySelector<HTMLMetaElement>('meta[name="timestamp"]')
const metaToken = document.head.querySelector<HTMLMetaElement>('meta[name="app-token"]')
const http = axios.create({
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-TIMESTAMP': metaTimestamp?.content,
    'X-TOKEN': metaToken?.content,
  },
})

export const refreshDatabase = (): Promise<AxiosResponse> => {
  return http.post('/api/load')
}

export const getLanguages = (): Promise<AxiosResponse<Language[]>> => {
  return http.get('/api/languages')
}

export const getRepositories = (languageId: number): Promise<AxiosResponse<Repository[]>> => {
  return http.get(`/api/repositories/${languageId}`)
}

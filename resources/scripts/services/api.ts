import axios, { AxiosResponse } from 'axios'
import { Language, Repository } from '../@types/models'

const metaTimestamp = document.head.querySelector<HTMLMetaElement>('meta[name="timestamp"]')
const metaToken = document.head.querySelector<HTMLMetaElement>('meta[name="app-token"]')

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['X-TIMESTAMP'] = metaTimestamp?.content
axios.defaults.headers.common['X-TOKEN'] = metaToken?.content

export const refreshDatabase = (): Promise<AxiosResponse> => {
  return axios.post('/api/load')
}

export const getLanguages = (): Promise<AxiosResponse<Language[]>> => {
  return axios.get('/api/languages')
}

export const getRepositories = (languageId: number): Promise<AxiosResponse<Repository[]>> => {
  return axios.get(`/api/repositories/${languageId}`)
}

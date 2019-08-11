import axios from 'axios'

/**
 * Define standard headers for AJAX requests
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['X-TIMESTAMP'] = document.head.querySelector('meta[name="timestamp"]').content
axios.defaults.headers.common['X-TOKEN'] = document.head.querySelector('meta[name="app-token"]').content

/**
 * Esport an instance of the API Consumer
 */
export default new function() {

  /**
   * Submit a request to refresh database
   */
  this.refreshDatabase = () => axios.post('/api/load')

  /**
   * Request list of languages available in the application
   */
  this.getLanguages = () => axios.get('/api/languages')

  /**
   * Request for the repositories records for an specific language
   */
  this.getRepositories = languageId => axios.get(`/api/repositories/${languageId}`)
}

import { useEffect, useState } from 'react'
import { Language } from '../@types/models'
import { getLanguages, refreshDatabase } from '../services/api'
import loading from '../assets/loading.gif'

interface ControlPanelProps {
  activateTab: (tab: number) => void
  activeLang: number
}

function ControlPanel(props: ControlPanelProps) {
  const [isRefreshing, setIsRefreshing] = useState(false)
  const [languages, setLanguages] = useState<Language[]>([])

  useEffect(() => {
    getLanguages().then((response) => setLanguages(response.data))
  }, [])

  const getRefreshmentStyles = () => {
    return isRefreshing ? {
      background: `url(${loading})`,
      backgroundPosition: 'center',
      backgroundSize: 'cover',
      color: 'rgb(0, 0, 0, 0)',
      overflow: 'hidden',
    } : undefined
  }

  const refreshResources = () => {
    setIsRefreshing(true)
    refreshDatabase().finally(() => {
      props.activateTab(props.activeLang)
      setIsRefreshing(false)
    })
  }

  return (
    <>
      <div className="row">
        <div className="col-12 col-sm-10 mb-4">
          <h2 className="content-header d-md-none" aria-hidden>
            Pick a language:
          </h2>
          <h2 className="content-header d-none d-md-block">
            Pick your favorite language:
          </h2>
        </div>
        <div className="col-12 col-sm-2">
          <button
            type="button"
            className="btn btn-lg btn-outline-pop btn-block"
            style={getRefreshmentStyles()}
            disabled={isRefreshing}
            onClick={refreshResources}
          >Refresh</button>
        </div>
      </div>
      <nav className="nav nav-pills nav-fill">
        {languages.map((lang: Language) => (
          <button
            key={lang.id}
            type="button"
            id={`activate-lang-${lang.id}`}
            className={`btn btn-outline-pop nav-item ${props.activeLang === lang.id ? 'active' : ''}`}
            disabled={isRefreshing}
            onClick={() => props.activateTab(lang.id)}
          >{lang.name}</button>
        ))}
      </nav>
    </>
  )
}

export default ControlPanel

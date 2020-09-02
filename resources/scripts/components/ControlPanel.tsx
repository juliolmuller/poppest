import React, { useState, useEffect } from 'react'
import api from '../services/ApiConsumer'
import loading from '../assets/loading.gif'

interface ControlPanelProps {
  activateTab: (tab: number) => void
  activeLang: number
}

const ControlPanel: React.FC<ControlPanelProps> = ({ activeLang, activateTab }) => {
  const [isRefreshing, setIsRefreshing] = useState(false)
  const [languages, setLanguages] = useState([])

  useEffect(() => {
    api.getLanguages().then((response: any) => setLanguages(response.data))
  }, [])

  function getRefreshmentStyles() {
    if (isRefreshing) {
      return {
        background: `url(${loading})`,
        backgroundPosition: 'center',
        backgroundSize: 'cover',
        color: 'rgb(0, 0, 0, 0)',
        overflow: 'hidden'
      }
    }
  }

  function refreshResources() {
    setIsRefreshing(true)
    api.refreshDatabase().finally(() => {
      activateTab(activeLang)
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
            className={`btn btn-outline-pop nav-item ${activeLang === lang.id ? 'active' : ''}`}
            disabled={isRefreshing}
            onClick={() => activateTab(lang.id)}
          >{lang.name}</button>
        ))}
      </nav>
    </>
  )
}

export default ControlPanel

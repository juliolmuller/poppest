import React, { useState, useEffect } from 'react'
import Repo from './Repo'
import Modal from './Modal'
import api from './../services/ApiConsumer'
import loading from './../assets/loading.gif'

interface DisplayPanelProps {
  activeLang: number
}

const DisplayPanel: React.FC<DisplayPanelProps> = ({ activeLang }) => {
  const [repositories, setRepositories] = useState<Repository[]>([])
  const [detailsFor, setDetails] = useState<Repository | {}>({})
  const [visibleDetails, setVisibleDetails] = useState(false)
  const [isLoading, setIsLoading] = useState(false)

  useEffect(() => {
    setIsLoading(true)
    api.getRepositories(activeLang)
      .then((response: any) => setRepositories(response.data))
      .finally(() => setTimeout(setIsLoading, 1000, false))
  }, [activeLang])

  function toggleDetails(repo?: Repository) {
    setVisibleDetails(Boolean(repo))
    setDetails(repo || {})
  }

  return (
    <div>
      <div className={`text-center ${isLoading ? '' : 'd-none'}`}>
        <img src={loading} style={{ width: '100%', maxWidth: '600px' }} alt="Loading animation" />
      </div>
      <div className={`row ${isLoading ? 'd-none' : ''}`}>
        {repositories.map((repo: Repository, index: number) => (
          <Repo key={index} repo={repo} showDetails={toggleDetails} />
        ))}
      </div>
      {visibleDetails && (
        <Modal repo={detailsFor as Repository} hideDetails={toggleDetails} />
      )}
    </div>
  )
}

export default DisplayPanel
